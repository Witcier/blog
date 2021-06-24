<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTablesSeeder::class);
        $this->call(AdminConfigSeeder::class);
        $this->call(NavMenuSeeder::class);
        $this->call(NavigationCategorySeeder::class);
        $this->call(NavigationSiteSeeder::class);
    }
}
