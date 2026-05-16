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
        Schema::create('services_settlements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('landlord_id')
                ->constrained('landlords')
                ->nullOnDelete();
            $table->string('landlord_name');
            $table->string('landlord_address');

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->nullOnDelete();
            $table->string('tenant_name');
            $table->string('tenant_address');

            $table->foreignId('property_id')
                ->constrained('properties')
                ->nullOnDelete();
            $table->string('property_address', 500);
            $table->string('property_type', 100)->nullable();

            $table->year('invoicing_year');
            $table->date('tenant_occupancy_start_date');
            $table->date('tenant_occupancy_end_date');

            $table->enum('coefficient_mode', ['none', 'single', 'detailed'])
                ->default('none');

            $table->decimal('coef_expenses', 5, 4)->nullable();
            $table->decimal('coef_hot_water', 5, 4)->nullable();
            $table->decimal('coef_heating', 5, 4)->nullable();
            $table->decimal('coef_cold_water_waste', 5, 4)->nullable();

            $table->decimal('utility_hot_water', 10, 2)->nullable();
            $table->decimal('utility_cold_water', 10, 2)->nullable();
            $table->decimal('utility_heating', 10, 2)->nullable();
            $table->decimal('utility_cold_water_for_hot', 10, 2)->nullable();

            $table->json('result_snapshot')->nullable();
            $table->string('algorithm_version', 10)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_service_settlements');
    }
};
