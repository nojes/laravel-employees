<?php

namespace nojes\employees\database\seeds;

use Illuminate\Database\Seeder;
use nojes\employees\Models\Employee;
use Symfony\Component\Console\Output\OutputInterface;

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
     * @var array Factory states to be applied to the model.
     */
    protected $states = [];

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface | \Symfony\Component\Console\Style\SymfonyStyle
     */
    protected $output;

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
        $this->states = config('employees.seeds.employee.states', $this->states);
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
        $this->output = $this->command->getOutput();

        $this->command->comment("Records count: ".$this->count);
        $this->command->comment("Nodes depth: ".$this->depth);
        $this->command->comment("Root nodes: ".$this->_rootNodesCount);
        $this->command->comment("Child nodes: ".$this->_childNodesCount);

        $this->callFactories();

        $this->command->info("\nInserted ".$this->count.' records.');
    }

    protected function callFactories()
    {
        $this->command->info("\nInserting root nodes...");
        $this->createRootNodes();

        $this->command->info("\nInserting child nodes...");
        $this->createChildNodes();
    }

    protected function createRootNodes()
    {
        $this->callFactory($this->_rootNodesCount);
    }

    protected function createChildNodes()
    {
        $this->callFactory($this->_childNodesCount, function (Employee $employee) {
            $employees = Employee::limit($this->_childNodesCount)->get(['id']);

            do {$randomId = $employees->random()->id;}
            while ($randomId == $employee->id);

            $employee->parent_id = $randomId;
            $employee->save();
        });
    }

    /**
     * @param integer $count Count of create models.
     * @param Closure|null $closure Handles for each model.
     */
    protected function callFactory($count, $closure = null)
    {
        $closure = (!empty($closure)) ? $closure : function(Employee $employee) {$employee->save();};
        $progressBar = $this->output->createProgressBar($count);
        $progressBar->start();

        factory(Employee::class, $count)
            ->states($this->states)
            ->make()
            ->each(function(Employee $employee) use ($closure, $progressBar) {
                $closure($employee);

                $progressBar->advance();
            });

        $progressBar->finish();
    }
}
