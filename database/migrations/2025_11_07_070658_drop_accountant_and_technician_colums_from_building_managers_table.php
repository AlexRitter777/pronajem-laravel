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
        Schema::table('building_managers', function (Blueprint $table) {
            $table->dropColumn('accountant_name');
            $table->dropColumn('accountant_phone');
            $table->dropColumn('accountant_email');
            $table->dropColumn('technician_name');
            $table->dropColumn('technician_phone');
            $table->dropColumn('technician_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('building_managers', function (Blueprint $table) {
            $table->string('accountant_name')->nullable();
            $table->string('accountant_phone')->nullable();
            $table->string('accountant_email')->nullable();
            $table->string('technician_name')->nullable();
            $table->string('technician_phone')->nullable();
            $table->string('technician_email')->nullable();
        });
    }
};
