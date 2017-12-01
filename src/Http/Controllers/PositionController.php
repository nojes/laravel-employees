<?php

namespace nojes\employee\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use nojes\employee\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
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
            $positions = Position::where('title', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $positions = Position::paginate($perPage);
        }

        return view('employee::backend.position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('employee::backend.position.create');
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
        
        Position::create($requestData);

        return redirect('employees/position')->with('flash_message', 'Position added!');
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
        $positions = Position::findOrFail($id);

        return view('employee::backend.position.show', compact('positions'));
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
        $positions = Position::findOrFail($id);

        return view('employee::backend.position.edit', compact('positions'));
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
        
        $position = Position::findOrFail($id);
        $position->update($requestData);

        return redirect('employees/position')->with('flash_message', 'Position updated!');
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
        Position::destroy($id);

        return redirect('employees/position')->with('flash_message', 'Position deleted!');
    }
}
