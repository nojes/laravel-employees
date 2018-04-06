<?php

namespace nojes\employees\Http\Controllers\Employee;

use nojes\employees\Models\Employee;
use Illuminate\Http\Request;

trait Tree
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tree(Request $request)
    {
        $keyword = $request->get('search');

        $employees = Employee::with(['position', 'children'])
            ->whereHas('position', function($query) use($keyword) {
                $query->where('title', 'LIKE', '%'.$keyword.'%');
            })
            ->orWhere('name', 'LIKE', "%$keyword%")
            ->whereIsRoot()
            ->paginate();

        return view('employees::backend.employee.tree.index', compact('employees'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function treeItemChildren($id, Request $request)
    {
        /** @var Employee $employee */
        $employee = Employee::with(['children', 'position'])->findOrFail($id);
        $htmlOptions = $request->get('htmlOptions', [
            'id' => 'collapse_'.$id,
            'class' => 'collapse'
        ]);

        return view('employees::backend.employee.tree.items', [
            'employees' => $employee->children,
            'htmlOptions' => $htmlOptions
        ]);
    }

    /**
     * @param Request $request
     * @return array|bool|string
     */
    public function updateTree(Request $request)
    {
        $items = $request->get('items');

        if (count($items)) {
            foreach ($items as $key => $item) {
                if (!empty($item['item_id'])) {
                    $employee = Employee::find($item['item_id'], ['id']);
                    $employee->parent_id = $item['parent_id'];
                    $employee->_lft = $item['left'];
                    $employee->_rgt = $item['right'];
                    $employee->save();
                }
            }

            return 'ok';
        }

        return false;
    }
}
