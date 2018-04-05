<?php

namespace nojes\employees\database\seeds;

use Illuminate\Database\Seeder;
use nojes\employees\Models\Position;

class EmployeePositionTableSeeder extends Seeder
{
    CONST INSERT_METHOD = 'insert';
    CONST FACTORY_METHOD = 'factory';

    /**
     * @var string Run method.
     */
    protected $method = self::INSERT_METHOD;

    /**
     * @var array Position titles.
     */
    protected $titles = [];

    /**
     * @var int Positions create count.
     */
    protected $count;

    /**
     * EmployeePositionTableSeeder constructor.
     */
    public function __construct()
    {
        $this->method = config('employees.seeds.position.method', $this->method);
        $this->titles = config('employees.seeds.position.titles', []);
        $this->count = config('employees.seeds.position.count', count($this->titles));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->comment('Using `'.$this->method.'` seeding method.');
        $this->{$this->method}();
        $this->command->info('Inserted '.$this->count.' records.');
    }

    /**
     * Uses `employees.seeds.position.titles` for seeding.
     */
    protected function insert()
    {
        foreach ($this->titles as $index => $title) {
            $position = new Position(['title' => $title]);
            if (!$position->save()) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
    }

    /**
     * Uses `PositionFactory` for seeding.
     */
    protected function factory()
    {
        factory(Position::class, count($this->titles))->create()->each(function($model) {
            $model->save();
        });
    }
}
