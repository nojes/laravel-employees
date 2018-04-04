@extends('employees::backend.layout')

@section('employees::content')
    <div class="panel panel-default">
        <div class="panel-heading">Employee {{ $employee->id }}</div>
        <div class="panel-body">

            <a href="{{ url('employees/employee') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('employees/employee/' . $employee->id . '/edit') }}" title="Edit Employee"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('employees/employee' . '/' . $employee->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-xs" title="Delete Employee" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th> Photo </th>
                            <td><img src="{{ Storage::url($employee->photo) }}" alt="" class="col-md-6"></td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $employee->name }} </td>
                        </tr>
                        <tr>
                            <th> Position </th>
                            <td>
                                <a href="{{ url('employees/position', $employee->position_id) }}">
                                    {{ $employee->position->title }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th> Head </th>
                            <td>
                                <img src="{{ Storage::url($employee->head->photo) }}" alt="" class="img-circle" width="40px" height="40px">
                                <a href="{{ url('employees/employee', $employee->parent_id) }}">
                                    {{ $employee->head->name }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
