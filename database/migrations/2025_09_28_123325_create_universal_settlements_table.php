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
        Schema::create('universal_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('landlord_id')->constrained('landlords');
            $table->foreignId('tenant_id')->constrained('tenants');
            $table->enum('Settlement_type', ['Vyúčtování spotřeby plynu', 'Vyúčtování spotřeby vody, Vyúčtování stočného, Vyúčtování spotřeby elektřiny']);
            $table->string('energy_supplier_name');
            $table->date('settlement_start_date');
            $table->date('settlement_end_date');
            $table->decimal('initial_reading', 10, 2);
            $table->decimal('final_reading', 10, 2);
            $table->enum('initial_reading_source', ['Vyúčtování dodavatele', 'Předavácí protokol'])->default('Vyúčtování dodavatele');
            $table->enum('final_reading_source', ['Vyúčtování dodavatele', 'Předavácí protokol'])->default('Vyúčtování dodavatele');
            $table->decimal('unit_price', 5, 2)->nullable();
            $table->decimal('monthly_price', 5, 2)->nullable();
            $table->decimal('other_expenses', 10, 2)->nullable();
            $table->string('other_expenses_description')->nullable();
            $table->json('payments')->nullable();
            $table->decimal('total_annual_payments', 10, 3)->default(0);
            $table->boolean('show_account_number')->default(false);
            $table->string('account_number')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universal_settlements');
    }
};
