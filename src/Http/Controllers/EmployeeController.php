<?php

namespace nojes\employees\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use nojes\employees\Models\Employee;
use nojes\employees\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $employees = Employee::with(['head', 'position'])
                ->where('head_id', 'LIKE', "%$keyword%")
                ->orWhere('position_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('surname', 'LIKE', "%$keyword%")
                ->orWhere('patronymic', 'LIKE', "%$keyword%")
                ->orWhere('salary', 'LIKE', "%$keyword%")
                ->orWhere('hired_at', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $employees = Employee::with(['head', 'position'])
                ->paginate($perPage);
        }

        return view('employees::backend.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $positions = Position::all();
        $heads = Employee::all();

        return view('employees::backend.employee.create', compact('positions', 'heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        $requestData['photo'] = $request->file('photo')->store('public/employees/photos');
        Employee::create($requestData);

        return redirect('employees/employee')->with('flash_message', 'Employee added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $employee = Employee::with(['head', 'position'])->findOrFail($id);

        return view('employees::backend.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $heads = Employee::all()->except($id);
        $positions = Position::all();

        return view('employees::backend.employee.edit', compact(
            'employee', 'heads', 'positions'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();

        $employee = Employee::findOrFail($id);
        $requestData['photo'] = $request->file('photo')->store('public/employees/photos');
        $employee->update($requestData);

        return redirect('employees/employee')->with('flash_message', 'Employee updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Employee::destroy($id);

        return redirect('employees/employee')->with('flash_message', 'Employee deleted!');
    }
}
