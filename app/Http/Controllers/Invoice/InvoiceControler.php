<?php

namespace App\Http\Controllers\Invoice;
//  use App\Http\Models\StudentAccont\StudentAccont;
use App\Models\Invoice\Invoice;
use App\Models\Settings\Setting;
use App\Models\Students\student;
use App\Models\StudentAccont\StudentAccont;

use App\Models\TuitionFee\TuitionFee;
use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $invoices =  Invoice::all();
    //    return $Invoice ;
    //    $invoices = DB::table('invoices')->get();
    return view('page.fee.invocie', compact('invoices')); // أو اسم الصفحة عندك

      }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    DB::beginTransaction();

    try {
        // =========================
        // حفظ الفاتورة
        // =========================
        $invoice = new Invoice();

        $invoice->invoice_date = date('Y-m-d');
        $invoice->student_id   = $request->student_id;
        $invoice->ClassRoom_id = $request->ClassRooms_id;
         $invoice->invoice_number =
    'INV-' .
    now()->format('Ymd-His') .
    '-' .
    str_pad($invoice->id, 5, '0', STR_PAD_LEFT);
         // المبلغ المطلوب
        $invoice->amount       = $request->amount;

        // المبلغ المدفوع
        $invoice->Amount_paid  = $request->Amount_paid;

        $invoice->description  = $request->description;

        $invoice->save();


        // =========================
        // تحديث حساب الطالب
        // =========================
        $studentAccount = StudentAccont::where('student_id', $request->student_id)
            ->first();

        // إذا الحساب غير موجود
        if (!$studentAccount) {

            $studentAccount = new StudentAccont();

            $studentAccount->student_id = $request->student_id;
            $studentAccount->type = 'invoice';

            // قيم ابتدائية
            $studentAccount->debit = 0;
            $studentAccount->credit = 0;
        }

        $studentAccount->date = date('Y-m-d');

        // إضافة الرسوم الجديدة إلى القديمة
        $studentAccount->debit = $request->debit;

        // إضافة الدفع الجديد إلى القديم
        $studentAccount->credit =
            ($studentAccount->credit ?? 0) + $request->Amount_paid;

        $studentAccount->invoice_id = $invoice->id;

        $studentAccount->description = $request->description;

        $studentAccount->save();


       DB::commit();

return redirect()
    ->route('invoice.print', $invoice->id);

    } catch (\Exception $e) {

        DB::rollback();

        return back()
            ->withErrors(['error' => $e->getMessage()])
            ->withInput();
    }
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $student = student::findOrFail($id);
 $debit = StudentAccont::where('student_id', $id)->sum('debit');
$credit = StudentAccont::where('student_id', $id)->sum('credit');

 $type = StudentAccont::where('student_id', $id)->value('description');

$amount = $debit - $credit;
 if ($amount <= 0) {
  return redirect()
            ->route('Student.index')
            ->with('info', '      لا يوجد رسوم مستحقة لهذا الطالب'); // يمكنك تعديل الرسالة حسب الحاجة
 }else {
            return view('page.fee.addinvocie' , compact('student', 'amount' ,'type' ,'debit')); ;


    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function print($id)
{
    $setting = Setting::latest()->first();
    $invoice = Invoice::findOrFail($id);
    // return $setting ;

    return view('page.fee.print', compact('invoice' , 'setting'));
}
}
