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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 50)->unique();
            $table->string('nama', 100);
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->comment('L=Laki-laki, P=Perempuan');
            $table->string('no_hp', 20)->nullable();
            $table->enum('status_perkawinan', ['TK/0', 'TK/1', 'TK/2', 'TK/3', 'K/0', 'K/1', 'K/2', 'K/3'])
                  ->default('TK/0')
                  ->comment('Untuk perhitungan PTKP pajak');
            
            // Foreign Keys
            $table->foreignId('branch_id')->constrained('branches')->onDelete('restrict');
            $table->foreignId('department_id')->constrained('departments')->onDelete('restrict');
            $table->foreignId('position_id')->constrained('positions')->onDelete('restrict');
            $table->foreignId('work_schedule_id')->nullable()->constrained('work_schedules')->onDelete('set null');
            
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->enum('status_karyawan', ['tetap', 'kontrak', 'probation', 'magang', 'resign'])
                  ->default('probation');
            
            // File upload
            $table->string('file_keterangan_kerja')->nullable()->comment('Path to uploaded document');
            $table->string('foto')->nullable();
            
            // Email & User relation (optional)
            $table->string('email')->unique()->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('nik');
            $table->index('nama');
            $table->index(['branch_id', 'department_id']);
            $table->index('status_karyawan');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
