<?php

namespace App\Models\StudentAccont;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassRooms\ClassRooms;
use App\Models\Invoice\Invoice;

use App\Models\Students\Student;
class StudentAccont extends Model
{
      use HasFactory;

    // تحديد اسم الجدول صراحة لتجنب أي أخطاء في التسمية التلقائية
    protected $table = 'student_accounts';

    protected $fillable = [
        'date',
        'type',
        'student_id',
        'invoice_id',
        'debit',
        'credit',
        'description',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
