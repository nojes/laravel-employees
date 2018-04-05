<?php

namespace nojes\employees\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

/**
 * Position repository
 */
class PositionRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return \nojes\employees\Models\Position::class;
    }
}
