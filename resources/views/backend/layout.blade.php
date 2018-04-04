@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('employees::backend.sidebar')
            </div>

            <div class="col-md-12">
                @yield('employees::content')
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
@stack('scripts')
