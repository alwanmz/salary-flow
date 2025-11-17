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
        Schema::table('users', function (Blueprint $table) {
            // Tambah username untuk login
            $table->string('username', 50)->unique()->after('name');
            
            // Tambah avatar_url untuk foto profil
            $table->string('avatar_url')->nullable()->after('email');
            
            // Relasi ke branch - multi branch support
            $table->foreignId('branch_id')->nullable()
                  ->after('avatar_url')
                  ->constrained('branches')
                  ->onDelete('set null');
            
            // Optional: Tambah fields lain yang mungkin dibutuhkan
            $table->string('phone', 20)->nullable()->after('branch_id');
            $table->boolean('is_active')->default(true)->after('password');
            $table->timestamp('last_login_at')->nullable()->after('remember_token');
            
            // Index untuk performa
            $table->index('username');
            $table->index('branch_id');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key dulu sebelum drop column
            $table->dropForeign(['branch_id']);
            
            // Drop columns
            $table->dropColumn([
                'username',
                'avatar_url',
                'branch_id',
                'phone',
                'is_active',
                'last_login_at'
            ]);
        });
    }
};
