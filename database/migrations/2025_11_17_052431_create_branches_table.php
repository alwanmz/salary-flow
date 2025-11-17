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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique()->comment('Auto-generated: BR001, BR002, etc');
            $table->string('nama_cabang', 100);
            $table->text('alamat')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('lokasi', 255)->nullable()->comment('Address/landmark untuk GPS');
            $table->decimal('latitude', 10, 8)->nullable()->comment('GPS coordinate');
            $table->decimal('longitude', 11, 8)->nullable()->comment('GPS coordinate');
            $table->integer('radius')->default(100)->comment('Radius in meters untuk attendance');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('kode');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
