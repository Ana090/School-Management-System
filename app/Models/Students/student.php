<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassRooms\ClassRooms;
use App\Models\Invoice\Invoice;

use App\Models\StudentAccont\StudentAccont;


class student extends Model
{
    use HasFactory;

  protected $fillable = [
        'Name',
        'Email',
        'Phone',
        'Date_of_Birth',
        'Address',
        'ClassRoom_id',
        'ID_number',
        'img',
    ];

    // علاقة الطالب مع الفصل الدراسي (ClassRoom)
    public function ClassRooms()
    {
        return $this->belongsTo(ClassRooms::class, 'ClassRoom_id');
    }

    // علاقة الطالب مع الفواتير (Invoices)
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // علاقة الطالب مع حسابات الطلاب (StudentAccounts)
    public function studentAccounts()
    {
        return $this->hasMany(StudentAccont::class);
    }
}

