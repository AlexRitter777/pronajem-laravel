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
        Schema::create('annual_service_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained();
            $table->foreignId('landlord_id')->constrained();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('building_manager_id')->constrained();
            $table->year('year');
            $table->json('expenses');
            $table->decimal('total_annual_expenses', 10, 2);
            $table->json('payments')->nullable();
            $table->decimal('total_annual_payments', 10, 2)->default(0);
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
        Schema::dropIfExists('annual_service_settlements');
    }
};
