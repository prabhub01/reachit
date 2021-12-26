<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            ['admin_type_id' => 1, 'first_name' => 'Superadmin', 'email' => 'superadmin@pndc.com', 'password' => bcrypt('password'), 'is_active' => 1],
        ];
        DB::table('admins')->insert($admins);
    }
}
