<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settlement_meters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('settlement_id')
                ->constrained('services_settlements')
                ->cascadeOnDelete();
            $table->enum('meter_type', ['hot_water', 'cold_water', 'heating']);
            $table->string('meter_type_name', 100);
            $table->string('meter_number')->nullable();
            $table->decimal('start_value', 10, 4);
            $table->decimal('end_value', 10, 4);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settlement_meters');
    }
};
