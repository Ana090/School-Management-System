<?php

namespace App\Models\Teachers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory; 
    protected $fillable=[
         'Name',
         'Email',
         'Phone',
         'Address',
         'status',
         'img',
         'Suplation'
    ] ;
}
