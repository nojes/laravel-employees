@php
/**
 * @var \nojes\employees\Models\Employee $employee
 */

$item_id = 'employee_'.$employee->id;
$collapse_id = 'collapse_'.$employee->id;
$renderChildren = (!config('employees.views.tree.lazyChildren', true) && $employee->children->isNotEmpty());

@endphp

<li class="list-group-item" id="{{ $item_id }}">
    <div>
        @if($employee->children->isNotEmpty())
            <span class="btn navbar-link disclose" data-toggle="collapse" data-target="#{{ $collapse_id }}">+ </span>
        @endif

        <span>
            <img src="{{ $employee->photoUrl }}" alt="" class="img-circle" width="40px" height="40px">

            <strong>{{ $employee->position->title }}</strong>

            <a href="{{ url('/employees/employee', $employee->id) }}" title="View Employee">
                {{ $employee->name }}
            </a>
        </span>

        @if($renderChildren)
            @include('employees::backend.employee.tree.items', [
                'employees' => $employee->children,
                'htmlOptions' => [
                    'id' => $collapse_id,
                    'class' => 'collapse'
                ]
            ])
        @endif
    </div>
</li>
