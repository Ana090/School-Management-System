<?php

namespace App\Models\ClassRooms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRooms extends Model
{
    use HasFactory;
    protected $fillable = [
        "Name",
        'code',
        "teacher_id",
        "Nu_of_St"
    ];

    public function Teacher()
    {
        return $this->belongsTo('App\Models\Teachers\Teacher', 'teacher_id');
    }
}
