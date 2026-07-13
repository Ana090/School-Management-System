<?php

namespace App\Models\subject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassRooms\ClassRooms;
use App\Models\Teachers\Teacher;

class subject extends Model
{
    use HasFactory;

      protected $fillable = [
        'Name',
        'code',
        'Classes',
        'teacher_id'
    ];
    // العلاقات
    public function classRoom()
    {
        return $this->belongsTo( ClassRooms::class, 'Classes');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
