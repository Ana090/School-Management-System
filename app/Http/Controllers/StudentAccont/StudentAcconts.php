<?php

namespace App\Http\Controllers\StudentAccont;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice\Invoice;
use App\Models\Students\student;
use App\Models\StudentAccont\StudentAccont;
use App\Models\ClassRooms\ClassRooms;


class StudentAcconts extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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

    public function report(Request $request)
{
     $query = StudentAccont::query();

    // فلترة حسب الطالب
    if ($request->student_id) {
        $query->where('student_id', $request->student_id);
    }

    // فلترة حسب النوع
    if ($request->type) {
        $query->where('type', $request->type);
    }

    // فلترة من تاريخ
    if ($request->from_date) {
        $query->whereDate('date', '>=', $request->from_date);
    }

    // فلترة إلى تاريخ
    if ($request->to_date) {
        $query->whereDate('date', '<=', $request->to_date);
    }
 if ($request->classroom_id) {

    $query->whereHas('student', function ($q) use ($request) {

        $q->where('ClassRoom_id', $request->classroom_id);

    });

}

if ($request->status == 'paid') {
    $query->whereColumn('debit', '=', 'credit');
}
if ($request->status == 'paid_partial') {
    $query->where('credit', '>', 0 )->whereColumn('debit', '!=', 'credit');
}
if ($request->status == 'unpaid') {
    $query->whereColumn('debit', '!=', 'credit');
}

    $accounts = $query->latest()->get();

    // الإجماليات
    $totalDebit = $accounts->sum('debit');
    $totalCredit = $accounts->sum('credit');
    $balance = $totalDebit - $totalCredit;

    $students = Student::all();
     $classrooms = ClassRooms::all();
    return view('Page.reports.student_accounts', compact(
        'accounts',
        'students',
        'totalDebit',
        'totalCredit',
        'balance',
        'classrooms'
    ));
}
}
