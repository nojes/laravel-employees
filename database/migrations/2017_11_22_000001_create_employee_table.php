<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateEmployeeTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'employee';

    /**
     * Run the migrations.
     * @table employee
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;

        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            NestedSet::columns($table);
            $table->integer('position_id')->unsigned()->nullable()->comment('Position ID');
            $table->string('name')->nullable()->comment('Name');
            $table->integer('salary')->nullable()->comment('Salary');
            $table->date('hired_at')->nullable()->comment('Hired At');
            $table->string('photo')->nullable()->comment('Photo');
            $table->timestamps();
        });

        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('position_id')->references('id')->on('employee_position')
                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
        Schema::dropIfExists($this->set_schema_table);
     }
}
