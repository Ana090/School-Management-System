<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_promotions', function (Blueprint $table) {
             $table->id();

    $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->onUpdate('cascade');

    // الفصل القديم
    $table->foreignId('from_class_id')->constrained('class_rooms')->onDelete('cascade')->onUpdate('cascade');

    // الفصل الجديد
    $table->foreignId('to_class_id')->constrained('class_rooms')->onDelete('cascade')->onUpdate('cascade');

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_promotions');
    }
};
