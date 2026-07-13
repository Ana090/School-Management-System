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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->string('invoice_number')->unique();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

            $table->foreignId('ClassRoom_id')->constrained('class_rooms')->onDelete('cascade');
 
            $table->decimal('amount', 10, 2); // المبلغ الكلي للفاتورة
            $table->decimal('Amount_paid', 10, 2); // المبلغ الكلي للفاتورة
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
