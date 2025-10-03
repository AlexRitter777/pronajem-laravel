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
        Schema::create('deposit_settlements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('landlord_id')->constrained('landlords');
            $table->foreignId('tenant_id')->constrained('tenants');
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->enum('contract_end_reason', [
                'Výpověď',
                'Konec nájmu na dobu určitou',
                'Dohoda o ukončení nájmu',
                'Jiný'
            ]);
            $table->decimal('total_deposit', 10, 3)->default(0);
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
        Schema::dropIfExists('deposit_settlements');
    }
};
