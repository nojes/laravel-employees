<?php

use Illuminate\Database\Seeder;
use nojes\employee\Models\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employee::class, 100)->create()->each(function(Employee $employee) {
            if (empty($employee->head_id)) {
                $employees = Employee::limit(10)->get();
                $employee->head_id = ($employees->isNotEmpty()) ? $employees->random()->id : NULL;
            }
            $employee->save();
        });
    }
}
