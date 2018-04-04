@extends('employees::backend.layout')

@section('employees::content')
    <div class="panel panel-default">
        <div class="panel-heading">Position</div>
        <div class="panel-body">
            <a href="{{ url('/employees/position/create') }}" class="btn btn-success btn-sm" title="Add New Position">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>

            <form method="GET" action="{{ url('/employees/position') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                            <th>Title</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($positions as $position)
                        <tr>
                            <td>{{ $loop->iteration or $position->id }}</td>
                            <td>
                                <a href="{{ url('/employees/position/' . $position->id) }}" title="View Position">
                                    {{ $position->title }}
                                </a>
                            </td>
                            <td>{{ Carbon\Carbon::parse($position->updated_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url('/employees/position/' . $position->id . '/edit') }}" title="Edit Position"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                <form method="POST" action="{{ url('/employees/position' . '/' . $position->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-xs" title="Delete Position" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $positions->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
