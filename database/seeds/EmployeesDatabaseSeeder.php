<?php

namespace nojes\employees\database\seeds;

use Illuminate\Database\Seeder;
use nojes\employees\Models\Position;

class EmployeesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedPositions();
        $this->seedEmployees();
    }

    protected function seedPositions()
    {
        $emptyTable = empty(Position::count());
        $seedOnce = config('employees.seeds.position.once', true);

        if ($emptyTable || !$seedOnce) {
            $this->call(EmployeePositionTableSeeder::class);
        }
    }

    protected function seedEmployees()
    {
        $this->call(EmployeeTableSeeder::class);
    }
}
