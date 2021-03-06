@extends('employees::backend.layout')

@section('employees::content')
    <div class="panel panel-default">
        <div class="panel-heading">Position {{ $position->id }}</div>
        <div class="panel-body">

            <a href="{{ url('/employees/position') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/employees/position/' . $position->id . '/edit') }}" title="Edit Position"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('/employees/position' . '/' . $position->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-xs" title="Delete Position" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $position->id }}</td>
                        </tr>
                        <tr><th> Title </th><td> {{ $position->title }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
