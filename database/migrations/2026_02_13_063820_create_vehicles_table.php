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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->string('model');
            $table->integer('capacity');
            $table->integer('seating_capacity')->default(4);
            $table->integer('luggage_capacity')->nullable();
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->boolean('has_ac')->default(1);
            $table->decimal('price_per_km', 8, 2);
            $table->decimal('price_per_day', 10, 2);
            $table->string('image');
            $table->longText('gallery')->nullable();
            $table->boolean('is_luxury')->default(0);
            $table->boolean('is_available')->default(1);
            $table->boolean('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
