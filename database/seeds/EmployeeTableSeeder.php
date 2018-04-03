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
     * @var int Depth of nesting.
     */
    protected $depth = 3;

    /**
     * @var int Count of root nodes.
     */
    private $_rootNodesCount;

    /**
     * @var int Count of children nodes.
     */
    private $_childNodesCount;

    /**
     * EmployeeTableSeeder constructor.
     */
    public function __construct()
    {
        $this->count = config('employees.seeds.employee.count', $this->count);
        $this->depth = config('employees.seeds.employee.depth', $this->depth);
        $this->_rootNodesCount = round($this->count / $this->depth);
        $this->_childNodesCount = ($this->count - $this->_rootNodesCount);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->comment("Depth: ".$this->depth);
        $this->command->comment("Root nodes: ".$this->_rootNodesCount);
        $this->command->comment("Child nodes: ".$this->_childNodesCount);

        $this->command->info("Inserting...");
        $this->callFactories();

        $this->command->info('Inserted '.$this->count.' records.');
    }

    protected function callFactories()
    {
        $this->createRootNodes();
        $this->createChildNodes();
    }

    protected function createRootNodes()
    {
        factory(Employee::class, $this->_rootNodesCount)->create();
    }

    protected function createChildNodes()
    {
        factory(Employee::class, $this->_childNodesCount)
            ->create()
            ->each(function(Employee $employee) {
                $employees = Employee::limit($this->_childNodesCount)->get(['id']);

                do {$randomId = $employees->random()->id;}
                while ($randomId == $employee->id);

                $employee->parent_id = $randomId;
                $employee->save();
            }
        );
    }
}
