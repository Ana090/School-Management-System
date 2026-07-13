<?php

namespace App\Http\Controllers\SubjectController;

use App\Http\Controllers\Controller;
use App\Models\ClassRooms\ClassRooms;
use App\Models\subject\subject;
use App\Models\Teachers\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            $subjects = subject::with(['classRoom', 'teacher'])->get();
        $Teachers = Teacher::all();
        $classes = ClassRooms::all(); 
         return view('page.subject.index', compact('Teachers' ,'classes' ,'subjects'));
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
        // return $request;
    $request->validate([
        'Name' => 'required|string|max:255',
        'code' => 'required|string|unique:subjects,code',
        'Classes' => 'required|exists:class_rooms,id',
        'teacher_id' => 'required|exists:teachers,id',
    ]);

    subject::create([
        'Name' => $request->Name,
        'code' => $request->code,
        'Classes' => $request->Classes, // انت اسمها Classes في الفورم
        'teacher_id' => $request->teacher_id,
    ]);

    return redirect()->back()->with('success', 'تم إضافة المادة بنجاح');
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
    public function destroy(request $request ,string $id)
    {
        subject::findOrFail($request->id)->delete();
         return redirect()->back()
            ->with('info', 'Deete sacsefu');
    }
}
