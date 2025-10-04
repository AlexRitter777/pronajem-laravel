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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('description')->nullable();
            $table->string('address');
            $table->integer('rent_amount')->nullable();
            $table->integer('service_charge')->nullable();
            $table->integer('electricity_charge')->nullable();
            $table->integer('deposit_amount')->nullable();
            $table->date('contract_finished_at')->nullable();
            $table->foreignId('landlord_id')->nullable()->constrained();
            $table->foreignId('tenant_id')->nullable()->constrained();
            $table->foreignId('electricity_supplier_id')->nullable()->constrained();
            $table->foreignId('building_manager_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->index('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
