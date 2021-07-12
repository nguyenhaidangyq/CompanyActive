<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Mr_Cong;
use App\Models\Staff;
use Illuminate\Database\Seeder;
require_once 'vendor/autoload.php';


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
        Department::factory(50)->create();
        Staff::factory(300)->create();
















        //LINH

        Customer::factory(200)->create();
        Appointment::factory(200)->create();

    }
}
