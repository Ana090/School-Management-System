<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tuition_fees', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الرسوم
            $table->decimal('amount', 10, 2); // المبلغ

            $table->foreignId('class_id')
                ->constrained('class_rooms')
                ->cascadeOnDelete();

            $table->string('academic_year'); // السنة الدراسية

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuition_fees');
    }
};
