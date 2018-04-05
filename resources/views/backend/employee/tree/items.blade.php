@php
/**
 * @var \nojes\employees\Models\Employee[] $employees
 * @var array $htmlOptions
 */
@endphp

<ol id="{{ $htmlOptions['id'] or 'employee_tree' }}" class="{{ $htmlOptions['class'] or 'sortable' }}">
    @foreach($employees as $employee)
        @include('employees::backend.employee.tree._item', ['employee' => $employee])
    @endforeach
</ol>
