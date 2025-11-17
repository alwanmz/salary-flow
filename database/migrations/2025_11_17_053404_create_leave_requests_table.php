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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique()->comment('Auto-generated: LRQ001, LRQ002, etc');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('leave_type_id')->nullable()->constrained('leave_types')->onDelete('set null')
                  ->comment('Null untuk izin/sakit, filled untuk cuti');
            $table->enum('jenis_absen', ['izin', 'cuti', 'sakit']);
            $table->date('tanggal_dari');
            $table->date('tanggal_ke');
            $table->integer('jumlah_hari')->comment('Auto-calculated excluding weekends');
            $table->text('keterangan')->nullable();
            $table->string('file_surat_sakit')->nullable()->comment('Required untuk sakit');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['employee_id', 'status']);
            $table->index('kode');
            $table->index(['tanggal_dari', 'tanggal_ke']);
            $table->index('jenis_absen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
