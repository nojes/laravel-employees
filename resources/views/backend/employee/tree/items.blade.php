@php
/**
 * @var \nojes\employees\Models\Employee[] $employees
 * @var array $htmlOptions
 */
@endphp

<ol id="{{ $htmlOptions['id'] or 'employee_tree' }}" class="{{ $htmlOptions['class'] or 'list-group sortable' }}">
    @foreach($employees as $employee)
        @include('employees::backend.employee.tree._item', ['employee' => $employee])
    @endforeach
</ol>

@push('scripts')
    <script src="{{ asset('vendor/nojes/employees/js/tree/items.js') }}" type="text/javascript"></script>
@endpush
