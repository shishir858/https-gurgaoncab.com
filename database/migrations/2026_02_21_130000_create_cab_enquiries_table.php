<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cab_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('passenger')->nullable();
            $table->string('pickup_location');
            $table->string('drop_location');
            $table->string('vehicle_type');
            $table->string('phone');
            $table->date('date');
            $table->string('pickup_time')->nullable();
            $table->string('email');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cab_enquiries');
    }
};
