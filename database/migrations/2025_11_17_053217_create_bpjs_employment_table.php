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
        Schema::create('bpjs_employment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('nomor_bpjs', 50)->unique()->nullable();
            $table->decimal('upah_untuk_bpjs', 15, 2)->comment('Base untuk perhitungan');
            
            // JHT - Jaminan Hari Tua
            $table->decimal('jht_perusahaan', 15, 2)->comment('3.7% dari upah');
            $table->decimal('jht_karyawan', 15, 2)->comment('2% dari upah');
            
            // JP - Jaminan Pensiun (max dari 10.042.300)
            $table->decimal('jp_perusahaan', 15, 2)->comment('2% dari upah');
            $table->decimal('jp_karyawan', 15, 2)->comment('1% dari upah');
            
            // JKK - Jaminan Kecelakaan Kerja (perusahaan only)
            $table->decimal('jkk_perusahaan', 15, 2)->comment('0.24%-1.74% tergantung risiko');
            
            // JKM - Jaminan Kematian (perusahaan only)
            $table->decimal('jkm_perusahaan', 15, 2)->comment('0.3% dari upah');
            
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
        Schema::dropIfExists('bpjs_employment');
    }
};
