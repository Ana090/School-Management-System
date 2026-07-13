<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teachers\Teacher;
use App\Http\Requests\TeacherRequest;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Teachers = Teacher::all();
        return view('Page.Teacher.index', compact('Teachers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Page.Teacher.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('img')) {
                $imagePath = $request->file('img')->store('teachers', 'public');
            }
            Teacher::create([
                'Name' => $request->Name,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Address' => $request->Address,
                'status' => $request->status,
                'Suplation' => $request->Suplation,
                'img' => $imagePath
            ]);
            return redirect()->back()->with('success', 'Data saved successfully');
        } catch (\Throwable $th) {

            return back()
                ->with('error', 'Something went wrong ❌')
                ->withInput(); // يرجع البيانات
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::find($id);
        return view('page.teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, string $id)
    {
        try {
            $Teacher = Teacher::find($request->id)->update([
                'Name' => $request->Name,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Address' => $request->Address,
                'status' => $request->status,
                'Suplation' => $request->Suplation,
            ]);
            return redirect()->back()->with('success', 'Data saved successfully');


        } catch (\Throwable $th) {
            //throw $th;
            return back()
                ->with('error', 'Something went wrong ❌')
                ->withInput(); // يرجع البيانات
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $teacher = Teacher::findOrFail($request->id);
            // حذف الصورة من storage إذا موجودة
            if ($teacher->img && Storage::disk('public')->exists($teacher->img)) {
                Storage::disk('public')->delete($teacher->img);
            }
            $teacher->delete();
            return redirect()->back()->with('info', 'Delete successfully');
        } catch (\Throwable $th) {

        }
    }
}
