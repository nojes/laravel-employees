@php
/**
 * @var \nojes\employees\Models\Employee $employee
 */

@endphp

<li class="list-group-item" id="{{ 'employee_'.$employee->id }}">
    <div>
        <span>
            <img src="{{ $employee->photoUrl }}" alt="" class="img-circle" width="40px" height="40px">

            <strong>{{ $employee->position->title }}</strong>

            <a href="{{ url('/employees/employee', $employee->id) }}" title="View Employee">
                {{ $employee->name }}
            </a>
        </span>

        @if(count($employee->children) > 0)
            <ol>
                @include('employees::backend.employee.tree.items', ['employees' => $employee->children])
            </ol>
        @endif
    </div>
</li>
