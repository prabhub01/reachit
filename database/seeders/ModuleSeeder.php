<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            ['name' => 'Configuration', 'alias' => 'configuration', 'display_order' => '1'],
            ['name' => 'Admin Type', 'alias' => 'admin-type', 'display_order' => '2'],
            ['name' => 'Admin', 'alias' => 'admin', 'display_order' => '3'],
            ['name' => 'Site Setting', 'alias' => 'site-setting', 'display_order' => '4'],
            ['name' => 'Country', 'alias' => 'country', 'display_order' => '5'],
            ['name' => 'Destination', 'alias' => 'destination', 'display_order' => '6'],
            ['name' => 'Sector', 'alias' => 'sector', 'display_order' => '7'],
            ['name' => 'Flight Types', 'alias' => 'flight-types', 'display_order' => '8'],
            ['name' => 'Points Management', 'alias' => 'points-management', 'display_order' => '9'],
            ['name' => 'User Approve', 'alias' => 'user-approve', 'display_order' => '10'],
            ['name' => 'Check In Entry', 'alias' => 'checkin-entry', 'display_order' => '11'],

        ];

        $all_modules = [];

        $all_modules = \App\Models\Module::pluck('alias')->toArray();

        $new_modules = [];
        for($i = 0 ; $i < count($modules); $i++){
            if(!in_array($modules[$i]['alias'], $all_modules)){
                $new_modules[] = $modules[$i];
            }
        }

        \App\Models\Module::insert($new_modules);

    }
}
