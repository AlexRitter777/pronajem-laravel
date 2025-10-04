<?php

namespace Database\Seeders;

use App\Models\BuildingManager;
use App\Models\ElectricitySupplier;
use App\Models\Landlord;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // User::factory(10)->create();

        //Create landlords without properties
        Landlord::factory()->count(4)->create();

        //Create tenants without properties
        Tenant::factory()->count(4)->create();

        //Create properties without landlords, tenants, building managers, electricity suppliers
        Property::factory()->count(5)->create();

        $landlords = Landlord::factory()->count(4)->create();
        $buildingManagers = BuildingManager::factory()->count(8)->create();
        $electricitySuppliers = ElectricitySupplier::factory()->count(3)->create();

        Property::factory()
            ->count(20)
            ->make()
            ->each(function ($property) use ($landlords, $buildingManagers, $electricitySuppliers) {
                $property->landlord_id = $landlords->random()->id;
                $property->tenant_id = Tenant::factory()->create()->id; //unique tenant for each property
                $property->building_manager_id = $buildingManagers->random()->id;
                $property->electricity_supplier_id = $electricitySuppliers->random()->id;
                $property->save();
            });

        $this->call([
            ExpenseSeeder::class,
            MeterTypeSeeder::class,
        ]);

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
