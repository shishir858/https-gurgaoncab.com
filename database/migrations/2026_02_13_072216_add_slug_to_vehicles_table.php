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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->integer('seating_capacity')->default(4)->after('capacity');
            $table->integer('luggage_capacity')->nullable()->after('seating_capacity');
            $table->boolean('has_ac')->default(true)->after('features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['slug', 'seating_capacity', 'luggage_capacity', 'has_ac']);
        });
    }
};
