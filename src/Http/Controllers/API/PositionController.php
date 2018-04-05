<?php

namespace nojes\employees\Http\Controllers\API;

use nojes\employees\Repositories\PositionRepository;

/**
 * Class PositionController
 *
 * @property PositionRepository $repository
 */
class PositionController extends ApiController
{
    public function __construct(PositionRepository $repository)
    {
        parent::__construct($repository);
    }
}
