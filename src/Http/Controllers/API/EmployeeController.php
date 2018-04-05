<?php

namespace nojes\employees\Http\Controllers\API;

use nojes\employees\Repositories\EmployeeRepository;

/**
 * Employee Controller
 *
 * @property EmployeeRepository $repository
 */
class EmployeeController extends ApiController
{
    /**
     * EmployeeController constructor.
     *
     * @param EmployeeRepository $repository
     */
    public function __construct(EmployeeRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @inheritdoc
     */
    public function index()
    {
        return $this->repository->with(['position', 'children'])->paginate();
    }

    /**
     * @inheritdoc
     */
    public function show($id)
    {
        return $this->repository->with(['children', 'position'])->find($id);
    }
}
