<?php

namespace nojes\employees\Console;
use Symfony\Component\Process\Process;

/**
 * Install package command.
 * @author Vyacheslav Nozhenko <vv.nojenko@gmail.com>
 */
class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Laravel Employees package.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->call('migrate');
        } catch (\Illuminate\Database\QueryException $e) {
            $this->error($e->getMessage());
            exit();
        }

        if (\App::VERSION() >= '5.2') {
            $this->info("Generating the authentication scaffolding...");
            $this->call('make:auth');
        }

        $this->info("Publishing the resources...");
        $this->call('vendor:publish', ['--provider' => 'nojes\employees\EmployeesServiceProvider', '--force' => true]);

        $this->info("Dumping the composer autoload...");
        (new Process('composer dump-autoload'))->run();

        $this->info("Migrating the database tables into your application...");
        $this->call('migrate');

        if ($this->confirm('Do you want to seed your database with test data? (only `employee`, `employee_position` tables)')) {
            $this->call('db:seed', ['--class' => 'nojes\employees\database\seeds\EmployeesDatabaseSeeder']);
        }

        $this->info("Laravel Employees is successfully installed!\n");
    }
}
