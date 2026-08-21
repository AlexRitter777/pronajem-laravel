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
                ->nullable()
                ->constrained('landlords')
                ->nullOnDelete();
            $table->string('landlord_name');
            $table->string('landlord_address');

            $table->foreignId('tenant_id')
                ->nullable()
                ->constrained('tenants')
                ->nullOnDelete();
            $table->string('tenant_name');
            $table->string('tenant_address');

            $table->foreignId('property_id')
                ->nullable()
                ->constrained('properties')
                ->nullOnDelete();
            $table->string('property_address', 500);
            $table->string('property_type', 100)->nullable();

            $table->unsignedInteger('invoicing_year');
            $table->date('tenant_occupancy_start_date');
            $table->date('tenant_occupancy_end_date');

            $table->enum('coefficient_mode', ['none', 'one', 'many'])
                ->nullable()
                ->default(null);

            $table->decimal('coef_expenses', 5, 3)->nullable();
            $table->decimal('coef_hot_water', 5, 3)->nullable();
            $table->decimal('coef_heating', 5, 3)->nullable();
            $table->decimal('coef_cold_water_waste', 5, 3)->nullable();

            $table->decimal('utility_hot_water', 10, 2)->nullable();
            $table->decimal('utility_cold_water', 10, 2)->nullable();
            $table->decimal('utility_heating', 10, 2)->nullable();
            $table->decimal('utility_cold_water_for_hot', 10, 2)->nullable();

            $table->decimal('hot_water_fixed_amount', 10, 4)->nullable();
            $table->decimal('hot_water_unit_price', 10, 4)->nullable();
            $table->decimal('cold_water_for_hot_unit_price', 10, 4)->nullable();
            $table->decimal('cold_water_unit_price', 10, 4)->nullable();
            $table->decimal('heating_fixed_amount', 10, 4)->nullable();
            $table->decimal('heating_unit_price', 10, 4)->nullable();

            $table->boolean('has_heating_coefficients');
            $table->decimal('heating_coefficient_first', 6, 4)->nullable();
            $table->decimal('heating_coefficient_second', 6, 4)->nullable();
            $table->decimal('heating_coefficient_third', 6, 4)->nullable();

            $table->boolean('has_annual_consumption');
            $table->decimal('meter_start_year_value', 10, 4)->nullable();
            $table->decimal('meter_end_year_value', 10, 4)->nullable();
            $table->decimal('annual_consumption', 10, 2)->nullable();

            $table->decimal('result_balance', 10, 2);
            $table->string('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_settlements');
    }
};
