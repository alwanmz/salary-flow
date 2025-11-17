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
        Schema::create('allowances', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique()->comment('Auto-generated: ALW001, ALW002, etc');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('allowance_type_id')->constrained('allowance_types')->onDelete('restrict');
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal_berlaku');
            $table->date('tanggal_berakhir')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['employee_id', 'allowance_type_id']);
            $table->index('kode');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowances');
    }
};
