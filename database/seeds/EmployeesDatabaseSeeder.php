<?php

namespace nojes\employees\database\seeds;

use Illuminate\Database\Seeder;

class EmployeesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(EmployeePositionTableSeeder::class);
         $this->call(EmployeeTableSeeder::class);
    }
}
