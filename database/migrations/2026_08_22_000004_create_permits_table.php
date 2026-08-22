<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique();
            $table->foreignId('applicant_id')->constrained()->restrictOnDelete();
            $table->foreignId('zone_id')->constrained()->restrictOnDelete();
            $table->string('permit_type');
            $table->date('request_date');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('vehicle_weight_kg')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('street_side')->nullable();
            $table->integer('operations_count')->default(1);
            $table->decimal('calculated_amount', 10, 2)->default(0);
            $table->string('status')->default('pending');
            $table->boolean('is_paid')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permits');
    }
};
