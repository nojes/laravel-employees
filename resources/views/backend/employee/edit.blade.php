@extends('employees::backend.layout')

@section('employees::content')
    <div class="panel panel-default">
        <div class="panel-heading">Edit Employee #{{ $employee->id }}</div>
        <div class="panel-body">
            <a href="{{ url('/employees/employee') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ url('/employees/employee/' . $employee->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                @include ('employees::backend.employee.form', ['submitButtonText' => 'Update'])

            </form>

        </div>
    </div>
@endsection
