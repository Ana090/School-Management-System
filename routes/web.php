<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\classRoom\classController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\SubjectController\SubjectController;
use App\Http\Controllers\TuitionFeeController\TuitionFeeController;
use App\Http\Controllers\Invoice\InvoiceControler;
use App\Http\Controllers\Student_promotions\Student_promotions;
use App\Http\Controllers\Settings\SettingController;
use App\Http\Controllers\StudentAccont\StudentAcconts;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 

Route::get('/', function () {
    return view('Dashbord');
    
})->middleware(['auth', 'verified'])->name('dashboard');
    Route::middleware('auth')->group(function () {
        Route::middleware('auth')->group(function () {

//  user 
     Route:: resource('classRoom'  , classController::class);
    Route:: resource('teacher'  , TeacherController::class);
    Route:: resource('Student'  , StudentController::class);

    // onlty admin can access this route
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['auth', 'admin'])->group(function () {

    Route:: resource('subject'  , SubjectController::class);
    Route:: resource('TuitionFee'  , TuitionFeeController::class);
    Route:: resource('Invoice'  , InvoiceControler::class);
    Route:: get('student.accounts.report'  , [StudentAcconts::class , 'report'])->name('student.accounts.report');
    Route:: resource('Student_promotions'  , Student_promotions::class);
    Route:: resource('setting'  , SettingController::class);
 
        Route:: resource('Users'  , UserController::class);

    });

Route::get('get_amount_id/{id}', [StudentController::class, 'getAmountByClassRoom'])->name('get_amount_id');
    
        });
        Route::get('invoice.print/{id}', [InvoiceControler::class, 'print'])->name('invoice.print');
});

require __DIR__.'/auth.php';
