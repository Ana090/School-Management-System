<?php

namespace App\Models\Student_promotions;

use App\Models\ClassRooms\ClassRooms;
use App\Models\Students\student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_promotion extends Model
{
    use HasFactory;
    protected $fillable = [

    'student_id',
    'from_class_id',
    'to_class_id',

];


  public function student()
    {

        return $this->belongsTo(student::class);

    }

    /*
    |--------------------------------------------------------------------------
    | الفصل السابق
    |--------------------------------------------------------------------------
    */

    public function fromClass()
    {

        return $this->belongsTo(
            ClassRooms::class,
            'from_class_id'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | الفصل الجديد
    |--------------------------------------------------------------------------
    */

    public function toClass()
    {

        return $this->belongsTo(
            ClassRooms::class,
            'to_class_id'
        );

    }
}
