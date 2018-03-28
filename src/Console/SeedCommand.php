<?php

namespace nojes\employees\Console;

/**
 * Seed package command.
 * @author Vyacheslav Nozhenko <vv.nojenko@gmail.com>
 */
class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database by `EmployeesDatabaseSeeder`.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Seeding...');
        $this->call('db:seed', ['--class' => 'nojes\employees\database\seeds\EmployeesDatabaseSeeder']);

        $this->info("Laravel Employees is successfully seeded!\n");
    }
}
