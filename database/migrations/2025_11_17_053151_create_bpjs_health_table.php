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
        Schema::create('bpjs_health', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('nomor_bpjs', 50)->unique()->nullable();
            $table->integer('kelas')->default(3)->comment('Kelas perawatan: 1, 2, atau 3');
            $table->decimal('upah_untuk_bpjs', 15, 2)->comment('Base untuk perhitungan, max 12jt');
            $table->decimal('iuran_perusahaan', 15, 2)->comment('4% dari upah');
            $table->decimal('iuran_karyawan', 15, 2)->comment('1% dari upah');
            $table->date('tanggal_berlaku');
            $table->date('tanggal_berakhir')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('employee_id');
            $table->index('nomor_bpjs');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpjs_health');
    }
};
