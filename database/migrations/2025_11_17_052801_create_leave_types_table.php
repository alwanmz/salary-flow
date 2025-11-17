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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cuti', 20)->unique()->comment('Auto-generated: CT001, CT002, etc');
            $table->string('jenis_cuti', 100);
            $table->integer('jumlah_hari')->default(0)->comment('Quota per tahun');
            $table->text('keterangan')->nullable();
            $table->boolean('is_paid')->default(true)->comment('Cuti berbayar atau tidak');
            $table->boolean('requires_approval')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('kode_cuti');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
