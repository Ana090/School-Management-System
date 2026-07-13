<?php

namespace App\Http\Controllers\TuitionFeeController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRooms\ClassRooms;
use App\Models\TuitionFee\TuitionFee;

class TuitionFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $TuitionFee = TuitionFee::with('classRoom')->get();
        $classes = ClassRooms::all();
      return view("Page.Fee.TuitionFee", compact('TuitionFee', 'classes'));
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
                $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'class_id' => 'required|exists:class_rooms,id',
            'academic_year' => 'required|string'
        ]);

        TuitionFee::create($request->all());

        return redirect()->back()
            ->with('success', 'تم إضافة الرسوم بنجاح');
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
    public function destroy( Request $request , string $id)
    {
         TuitionFee::findOrFail( $request->id )->delete();
            return redirect()->back()
            ->with('info', 'Deete sacsefu');

        
    }
}
