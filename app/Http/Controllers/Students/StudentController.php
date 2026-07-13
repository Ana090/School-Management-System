<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\ClassRooms\ClassRooms;
use App\Models\Teachers\Teacher;
use App\Models\TuitionFee\TuitionFee;
use App\Models\StudentAccont\StudentAccont;

use Illuminate\Support\Facades\Storage;
use App\Models\Students\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use App\Models\Invoice\Invoice;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Students = student::all();
        return view('Page.Student.index', compact('Students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ClassesRooms = ClassRooms::all();
        return view('Page.Student.add', compact('ClassesRooms'));

    }

    /**
     * Store a newly created resource in storage.
     */
       public function store(Request $request)
    {
        // 1. التحقق من البيانات (Validation)
        $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:students,Email',
            'Phone' => 'required',
            'Date_of_Birth' => 'required|date',
            'Address' => 'required',
            'ClassesRoom' => 'required|exists:class_rooms,id',
            'amount_id' => 'required', // معرف المبلغ المطلوب (من جدول الرسوم مثلاً)
            'Amount_paid' => 'required|numeric|min:0',
            'ID_number' => 'required|digits:11|unique:students,ID_number',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // استخدام DB Transaction لضمان حفظ البيانات في جميع الجداول أو عدم حفظها نهائياً في حال حدوث خطأ
        DB::beginTransaction();

        // return $request ;
        try {
            // 2. حفظ صورة الطالب
            $path = $request->file('img')->store('students', 'public');

            // 3. حفظ بيانات الطالب في جدول students
            $student = new Student();
            $student->Name = $request->Name;
            $student->Email = $request->Email;
            $student->Phone = $request->Phone;
            $student->Date_of_Birth = $request->Date_of_Birth;
            $student->Address = $request->Address;
            $student->ClassRoom_id = $request->ClassesRoom;
            $student->ID_number = $request->ID_number;
            $student->img = $path;
            $student->save();

            // 4. حفظ الفاتورة في جدول invoices
            // نفترض أن amount_id يأتي منه المبلغ الإجمالي المطلوب
            // هنا سنقوم بجلب القيمة الفعلية للمبلغ المطلوب من قاعدة البيانات (مثال)
            $total_amount = TuitionFee::find($request->amount_id)->amount; 
            $Name_amount = TuitionFee::find($request->amount_id)->name;
            // يجب استبدال هذا السطر بجلب المبلغ الفعلي من جدول الرسوم بناءً على amount_id
            // return $request ;
            // $total_amount = TuitionFee::where('id' , $request->amount_id)->pluck('amount'); // قيمة افتراضية للتوضيح، يجب استبدالها بجلب القيمة الحقيقية من جدول الرسوم
             $invoice = new Invoice();
            $invoice->invoice_date = date('Y-m-d');
            $invoice->student_id = $student->id;
            $invoice->ClassRoom_id = $request->ClassesRoom;
            $invoice->amount = $total_amount; // المبلغ الكلي المطلوب
          
            $invoice->description =$Name_amount;
            $invoice->Amount_paid = $request->Amount_paid;
             $invoice->invoice_number =
    'INV-' .
    now()->format('Ymd-His') .
    '-' .
    str_pad($invoice->id, 5, '0', STR_PAD_LEFT);
             $invoice->save();

            // 5. حفظ الحساب في جدول student_accounts
            // هذا الجدول يسجل الحركات المالية (مدين ودائن)
            $studentAccount = new StudentAccont();
            $studentAccount->date = date('Y-m-d');
            $studentAccount->type = 'invoice'; // نوع الحركة: فاتورة
            $studentAccount->student_id = $student->id;
            $studentAccount->invoice_id = $invoice->id;
            
            // المبلغ المطلوب (مدين - Debit)
            $studentAccount->debit = $total_amount;
            
            // المبلغ المدفوع (دائن - Credit)
            $studentAccount->credit = $request->Amount_paid;
            
            $studentAccount->description = $Name_amount ;
            $studentAccount->save();

            DB::commit();
            return redirect()->route('Student.index')->with('success', 'تم حفظ بيانات الطالب والفاتورة بنجاح');

        } catch (\Exception $e) {
            DB::rollback();
            // حذف الصورة إذا فشلت العملية
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**     
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
        // return $id ;
        $student  = student::findOrFail($id);
        $ClassesRooms = ClassRooms::all();
         return view('page.student.edit', compact('student', 'ClassesRooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
    
        
        try {
            $student = student::findOrFail($request->id)->update([
                'Name' => $request->Name,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Address' => $request->Address,
                'Date_of_Birth' => $request->Date_of_Birth,
                'ClassRoom' => $request->ClassRoom,
                'ID_number' => $request->ID_number,

            ]);
            return redirect()->back()->with('success', 'Data saved successfully');
        } catch (\Throwable $th) {

            return back()
                ->with('error', $th->getMessage())
                ->withInput(); // يرجع البيانات
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,  string $id)
    {
        //

           try {
            $Student = student::findOrFail($request->id);
            // حذف الصورة من storage إذا موجودة
            if ($Student->img && Storage::disk('public')->exists($Student->img)) {
                Storage::disk('public')->delete($Student->img);
            }
            $Student->delete();
            return redirect()->back()->with('info', 'Delete successfully');
        } catch (\Throwable $th) {

        }
    }
    

     public function getAmountByClassRoom($id)
    {
        // الطريقة الأولى: باستخدام Eloquent ORM (موصى بها إذا كانت العلاقات معدة بشكل صحيح)
        // نفترض أن لديك موديل Fee يحتوي على حقل class_room_id وحقل amount
        /*
        $amounts = Fee::where('class_room_id', $id)->pluck('amount', 'id');
        return response()->json($amounts);
        */

        // الطريقة الثانية: باستخدام Query Builder (إذا لم تكن تستخدم Eloquent بشكل كامل)
        // استبدل 'fees' باسم جدول الرسوم الفعلي لديك
        // استبدل 'class_room_id' باسم العمود الذي يربط الرسوم بالفصل الدراسي
        // استبدل 'amount' باسم العمود الذي يحتوي على قيمة المبلغ
        
        $amounts = DB::table('tuition_fees') // اسم جدول الرسوم
            ->where('class_id', $id) // العمود الذي يربط الرسوم بالفصل
            ->pluck('amount', 'id'); // جلب قيمة المبلغ كقيمة، والـ id كمفتاح

        // إرجاع البيانات بصيغة JSON ليتعامل معها كود الـ AJAX
        return response()->json($amounts);
    }
}