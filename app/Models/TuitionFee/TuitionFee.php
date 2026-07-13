<?php

namespace App\Models\TuitionFee;

use App\Models\ClassRooms\ClassRooms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuitionFee extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'amount',
        'class_id',
        'academic_year'
    ];

    // العلاقة مع الصف
    public function classRoom()
    {
        return $this->belongsTo(ClassRooms::class, 'class_id');
    }
}
