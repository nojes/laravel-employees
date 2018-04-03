@extends('layouts.app')

@php
/**
 * @var \nojes\employees\Models\Employee[] $employees
 */
@endphp

@section('content')
    <div class="container">
        <div class="row">
            @include('employees::backend.sidebar')
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Employees</div>
                    <div class="panel-body">
                        <a href="{{ url('/employees/employee/create') }}" class="btn btn-success btn-sm" title="Add New Employee">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/employees/employee') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Head</th>
                                        <th>Position</th>
                                        <th>Salary</th>
                                        <th>Hired At</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration or $employee->id }}</td>
                                        <td>
                                            <img src="{{ $employee->photoUrl }}" alt="" class="img-circle" width="40px" height="40px">
                                        </td>
                                        <td>
                                            <a href="{{ url('/employees/employee', $employee->id) }}" title="View Employee">
                                                {{ $employee->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/employees/employee', $employee->id) }}" title="View Employee Head">
                                                {{ $employee->head->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/employees/position', $employee->position_id) }}" title="View Employee Position">
                                                {{ $employee->position->title}}
                                            </a>
                                        </td>
                                        <td>${{ $employee->salary }}</td>
                                        <td>{{ Carbon\Carbon::parse($employee->hired_at)->format('Y-m-d') }}</td>
                                        <td>{{ Carbon\Carbon::parse($employee->updated_at)->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url('/employees/employee/' . $employee->id . '/edit') }}" title="Edit Employee"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/employees/employee' . '/' . $employee->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Employee" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $employees->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
