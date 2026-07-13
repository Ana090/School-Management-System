<?php

namespace App\Http\Controllers\classRoom;

use App\Http\Controllers\Controller;
use App\Models\ClassRooms\ClassRooms;
use App\Models\Teachers\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\ClassRoomRequest;
use App\Models\Students\student;

class classController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Teachers = Teacher::all();
        $ClassRooms = ClassRooms::all();
        $studnet = Student::count();
        

         return view('Page.classRoom.index', compact('Teachers', 'ClassRooms' , 'studnet'));
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
    public function store(ClassRoomRequest $request)
    {
        try {
            ClassRooms::create([
                "Name" => $request->Name,
                "Nu_of_St" => $request->Nu_of_St,
                'code' => $request->code,
                "teacher_id" => $request->teacher_id,
            ]);
            return redirect()->back()->with('success', 'Data saved successfully');

        } catch (\Throwable $th) {

            return back()
                ->with('error', 'Something went wrong ❌')
                ->withInput(); // يرجع البيانات
        }
        //  return $request ;





    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
         $Students = student::where('ClassRoom_id' , $id)->get() ;
         return view('page.classRoom.student' , compact('Students')) ;
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
    public function update(ClassRoomRequest $request, string $id)
    {
        try {
            $ClassRoom = ClassRooms::findOrFail($request->id);
            $ClassRoom->update([
                "Name" => $request->Name,
                "Nu_of_St" => $request->Nu_of_St,
                'code' => $request->code,
                "teacher_id" => $request->teacher_id,
            ]);
            return redirect()->back()->with('success', 'Data saved successfully');

        } catch (\Throwable $th) {
            //throw $th;
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request, string $id)
    {
        try {
            ClassRooms::findOrFail($request->id)->delete();
            return redirect()->back()->with('info', 'Delete successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
