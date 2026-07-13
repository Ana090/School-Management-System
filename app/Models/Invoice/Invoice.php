<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassRooms\ClassRooms;
use App\Models\StudentAccont\StudentAccont;

use App\Models\Students\Student;

class Invoice extends Model
{
   use HasFactory;

    protected $fillable = [
        'invoice_date',
        'student_id',
        'ClassRoom_id',
        'amount',
        'description',
        'Amount_paid',
        'invoice_number',
    ];

    // علاقة الفاتورة مع الطالب
   
  public function ClassRoom()
    {
        return $this->belongsTo('App\Models\ClassRooms\ClassRooms', 'ClassRoom_id');
    }
    // علاقة الفاتورة مع الفصل الدراسي
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // // علاقة الفاتورة مع حسابات الطلاب (يمكن أن يكون للفاتورة حركة واحدة في حساب الطالب)
    // public function studentAccount()
    // {
    //     return $this->hasOne(StudentAccont::class);
    // }
}