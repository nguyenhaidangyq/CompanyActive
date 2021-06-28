<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Staff;
use Database\Factories\StaffFactory;
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
        // \App\Models\User::factory(10)->create();
        Staff::factory(300)->create();
        Department::factory(30)->create();
    }
}
