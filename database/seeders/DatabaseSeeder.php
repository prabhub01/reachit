<?php

namespace Database\Seeders;

use AdminsTableSeeder;
use Illuminate\Database\Seeder;

use SiteSettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTypeTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(SiteSettingSeeder::class);
    }
}
