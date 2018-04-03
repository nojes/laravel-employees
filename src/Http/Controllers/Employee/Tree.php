<?php

namespace nojes\employees\Http\Controllers\Employee;

use nojes\employees\Models\Employee;
use Illuminate\Http\Request;

trait Tree
{
    public function updateTree(Request $request)
    {
        $items = $request->get('items');

        if (count($items)) {
            foreach ($items as $key => $item) {
                if (!empty($item['item_id'])) {
                    $employee = Employee::find($item['item_id']);
                    $employee->parent_id = $item['parent_id'];
//                    $employee->_lft = $item['left'];
//                    $employee->_rgt = $item['right'];
                    $employee->save();
                }
            }

            return 'success';
        }

        return false;
    }
}
