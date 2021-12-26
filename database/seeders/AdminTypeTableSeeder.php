<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminTypes = [
            ['id' => 1, 'name' => 'Developer', 'is_active' => 1],
            ['id' => 2, 'name' => 'Site Admin', 'is_active' => 1],
            ['id' => 3, 'name' => 'Check In Admin', 'is_active' => 1],
            ['id' => 4, 'name' => 'User Approve Admin', 'is_active' => 1],
            ['id' => 5, 'name' => 'Check In Verifier Admin', 'is_active' => 1]
        ];


        $admin_type = [];

        $all_type = \App\Models\AdminType::pluck('name')->toArray();

        $new_type = [];
        for($i = 0 ; $i < count($adminTypes); $i++){
            if(!in_array($adminTypes[$i]['name'], $all_type)){
                $new_type[] = $adminTypes[$i];
            }
        }

        \App\Models\AdminType::insert($new_type);

    }
}
