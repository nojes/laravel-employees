<?php

namespace nojes\employees\database\seeds;

use Illuminate\Database\Seeder;
use nojes\employees\Models\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * @var int Employees create count.
     */
    protected $count = 100;

    /**
     * EmployeeTableSeeder constructor.
     */
    public function __construct()
    {
        $this->count = config('employees.seeds.employee.count', $this->count);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employee::class, $this->count)->create()->each(function(Employee $employee) {
            if (empty($employee->head_id)) {
                $employees = Employee::limit(10)->get();
                $employee->head_id = ($employees->isNotEmpty()) ? $employees->random()->id : NULL;
            }
            $employee->save();
        });

        $this->command->info('Inserted '.$this->count.' records.');
    }
}
