
<div class="panel panel-default panel-flush">
    <div class="panel-body">
        <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="{!! Request::is('employees/employee') ? "active" : "" !!}">
                <a href="{{ url('/employees/employee') }}">
                    Employees
                    <span class="badge">{{ \nojes\employees\Models\Employee::count() }}</span>
                </a>
            </li>
            <li role="presentation" class="{!! Request::is('employees/position') ? "active" : "" !!}">
                <a href="{{ url('/employees/position') }}">
                    Positions
                    <span class="badge">{{ \nojes\employees\Models\Position::count() }}</span>
                </a>
            </li>
            <li role="presentation" class="{!! Request::is('employees/employee/tree') ? "active" : "" !!}">
                <a href="{{ url('/employees/employee/tree') }}">
                    Tree
                </a>
            </li>
        </ul>
    </div>
</div>
