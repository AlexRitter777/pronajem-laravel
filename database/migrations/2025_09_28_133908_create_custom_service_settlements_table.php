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
        Schema::create('custom_service_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained();
            $table->foreignId('landlord_id')->constrained();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('building_manager_id')->constrained();
            $table->date('building_manager_settlement_start_date');
            $table->date('building_manager_settlement_end_date');
            $table->date('settlement_start_date');
            $table->date('settlement_end_date');
            $table->json('expenses');
            $table->decimal('total_annual_expenses', 10, 2);
            $table->json('meter_readings');
            $table->decimal('total_hot_water_meter_readings', 10, 3);
            $table->decimal('total_cold_water_meter_readings', 10, 3);
            $table->decimal('total_heating_meter_readings', 10, 3);
            $table->json('heating_coefficients')->nullable();
            $table->decimal('total_heating_coefficients', 10, 3)->default(1);
            $table->enum('initial_reading_source', ['Vyúčtování dodavatele', 'Předavácí protokol'])->default('Vyúčtování dodavatele');
            $table->enum('final_reading_source', ['Vyúčtování dodavatele', 'Předavácí protokol'])->default('Vyúčtování dodavatele');
            $table->decimal('hot_water_base_cost_year', 10, 3)->nullable();
            $table->decimal('heating_base_cost_year', 10, 3)->nullable();
            $table->decimal('hot_water_unit_price', 10, 3)->nullable();
            $table->decimal('heating_unit_price', 10, 3)->nullable();
            $table->decimal('cold_water_unit_price', 10, 3)->nullable();
            $table->decimal('cold_water_for_hot_water_unit_price', 10, 3)->nullable();
            $table->boolean('heating_price_correction')->default(false);
            $table->decimal('corrected_heating_price', 10, 2)->nullable();
            $table->decimal('heating_consumption_due_corrected_periods', 10, 2)->nullable();
            $table->boolean('final_prices_corrections')->default(false);
            $table->decimal('services_expenses_correction',5, 2)->nullable();
            $table->decimal('hot_water_expenses_correction',5, 2)->nullable();
            $table->decimal('heating_expenses_correction',5, 2)->nullable();
            $table->decimal('cold_water_expenses_correction',5, 2)->nullable();
            $table->json('payments')->nullable();
            $table->decimal('total_annual_payments', 10, 3)->default(0);
            $table->boolean('show_account_number')->default(false);
            $table->string('account_number')->nullable();
            $table->date('due_date')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->index('property_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_service_settlements');
    }
};
