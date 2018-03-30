@php
/**
 * @var \nojes\employees\Models\Employee $employee
 */

@endphp


@foreach($employees as $employee)
    @include('employees::backend.employee.tree._item', ['employee' => $employee])
@endforeach


