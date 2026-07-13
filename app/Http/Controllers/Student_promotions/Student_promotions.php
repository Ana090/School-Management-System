<?php

namespace App\Http\Controllers\Student_promotions;

use App\Http\Controllers\Controller;
use App\Models\ClassRooms\ClassRooms;
use App\Models\Students\student;
use Illuminate\Http\Request;
use App\Models\Student_promotions\Student_promotion;

class Student_promotions extends Controller
{
    /**
     * Display a listing of the resource.
     */
 

    /*
    |--------------------------------------------------------------------------
    | عرض سجل التصعيدات
    |--------------------------------------------------------------------------
    */

 public function index(Request $request)
{
    $query = Student_promotion::with(['student','fromClass','toClass']);

    // البحث باسم الطالب
    if ($request->filled('student_name')) {

        $query->whereHas('student', function ($q) use ($request) {
            $q->where('Name', 'like', '%' . $request->student_name . '%');
        });
    }

    // الفصل القديم
    if ($request->filled('from_class_id')) {
        $query->where('from_class_id', $request->from_class_id);
    }

    // الفصل الجديد
    if ($request->filled('to_class_id')) {
        $query->where('to_class_id', $request->to_class_id);
    }

    // السنة الدراسية
    if ($request->filled('academic_year')) {
        $query->where('academic_year', $request->academic_year);
    }

    // التاريخ
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $promotions = $query->latest()->paginate(10)->withQueryString();

    $classes = ClassRooms::all();

    return view('Page.Student_promotions.index',
        compact('promotions','classes')
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      $Classes =   ClassRooms::all();
      $students = student::all();
        return view('Page.Student_promotions.add', compact('Classes', 'students')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
  

    public function store(Request $request)
    {
        $request->validate([
            'from_class_id' => 'required',
            'to_class_id' => 'required',
        ]);

        $students = $request->students;

        // إذا لم يتم اختيار أي طالب → كل الطلاب
        if (!$students) {

            $students = Student::where('ClassRoom_id', $request->from_class_id)
                ->pluck('id')
                ->toArray();
        }

        foreach ($students as $id) {

            $student = Student::find($id);

            if ($student) {

                // حفظ في جدول التصعيدات
                Student_promotion::create([

                    'student_id' => $student->id,
                    'from_class_id' => $request->from_class_id,
                    'to_class_id' => $request->to_class_id,
                    'academic_year' => date('Y') . '-' . (date('Y') + 1),

                ]);

                // تحديث الفصل
                $student->update([
                    'ClassRoom_id' => $request->to_class_id
                ]);
            }
        }

        return back()->with('success', 'تمت الترقية بنجاح');
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
    public function getStudents($id)
    {
        $students = Student::where('ClassRoom_id', $id)->get();

        return view('Page.Student_promotions.students_rows', compact('students'));
    }
}
