<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settlement_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('settlement_id')
                ->constrained('services_settlements')
                ->cascadeOnDelete();
            $table->unsignedInteger('payment_month');
            $table->unsignedInteger('payment_year');
            $table->decimal('amount', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settlement_payments');
    }
};
