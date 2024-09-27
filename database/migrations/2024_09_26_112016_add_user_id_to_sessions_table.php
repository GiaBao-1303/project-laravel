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
        Schema::table('sessions', function (Blueprint $table) {
            // Only add ip_address if it doesn't exist
            if (!Schema::hasColumn('sessions', 'ip_address')) {
                $table->string('ip_address')->nullable();
            }

            // Only add user_id if it doesn't exist
            if (!Schema::hasColumn('sessions', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Ensure columns are dropped only if they exist
            if (Schema::hasColumn('sessions', 'ip_address')) {
                $table->dropColumn('ip_address');
            }
            if (Schema::hasColumn('sessions', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
