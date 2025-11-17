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
        Schema::create('salary_adjustment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_adjustment_id')->constrained('salary_adjustments')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->decimal('nominal_penambahan', 15, 2)->default(0);
            $table->decimal('nominal_pengurangan', 15, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index(['salary_adjustment_id', 'employee_id']);
            $table->unique(['salary_adjustment_id', 'employee_id'], 'unique_adjustment_employee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_adjustment_details');
    }
};
