<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zone_id')->constrained()->cascadeOnDelete();
            $table->string('permit_type');
            $table->integer('max_weight_kg')->nullable();
            $table->string('street_side')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
