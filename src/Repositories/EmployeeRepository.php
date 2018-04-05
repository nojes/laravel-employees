<?php

namespace nojes\employees\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

/**
 * Employee repository
 */
class EmployeeRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return \nojes\employees\Models\Employee::class;
    }
}
