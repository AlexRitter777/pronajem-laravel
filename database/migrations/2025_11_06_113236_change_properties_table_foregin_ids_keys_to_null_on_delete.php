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
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->nullOnDelete();

            $table->dropForeign(['landlord_id']);
            $table->foreign('landlord_id')
                ->references('id')
                ->on('landlords')
                ->nullOnDelete();

            $table->dropForeign(['electricity_supplier_id']);
            $table->foreign('electricity_supplier_id')
                ->references('id')
                ->on('electricity_suppliers')
                ->nullOnDelete();

            $table->dropForeign(['building_manager_id']);
            $table->foreign('building_manager_id')
                ->references('id')
                ->on('building_managers')
                ->nullOnDelete();

            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants');

            $table->dropForeign(['landlord_id']);
            $table->foreign('landlord_id')
                ->references('id')
                ->on('landlords');

            $table->dropForeign(['electricity_supplier_id']);
            $table->foreign('electricity_supplier_id')
                ->references('id')
                ->on('electricity_suppliers');

            $table->dropForeign(['building_manager_id']);
            $table->foreign('building_manager_id')
                ->references('id')
                ->on('building_managers');

            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

        });
    }
};
