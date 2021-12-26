<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = DB::table('modules')->pluck('id')->toArray();

        $insert = [];

        for ($i = 0; $i < count($modules); $i++) {
            $insert[] = ['admin_type_id' => '1', 'module_id' => $modules[$i], 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '1', 'changeStatus' => '1'];
        }

        DB::table('admin_accesses')->insert($insert);
    }
}
