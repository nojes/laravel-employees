@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('employee::backend.sidebar')

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Position #{{ $position->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/employees/position') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/employees/position/' . $position->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('employee::backend.position.form', ['submitButtonText' => 'Update'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
