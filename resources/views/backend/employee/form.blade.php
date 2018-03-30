@php
/**
 * @var \nojes\employees\Models\Position[] $positions
 * @var \nojes\employees\Models\Employee $employee
 */
@endphp

<div>
    <div class="form-group {{ $errors->has('head_id') ? 'has-error' : ''}}">
        <label for="head_id" class="col-md-4 control-label">{{ 'Head' }}</label>
        <div class="col-md-6">
            <select class="form-control" name="head_id" id="head_id">
                <option value=""> - </option>
                @foreach($heads as $head)
                    @php $selected = (isset($employee) && $head->id == $employee->head_id) ? 'selected' : ''; @endphp
                    <option value="{{$head->id}}" {{$selected}}>{{$head->name}}</option>
                @endforeach
            </select>
            {{--<input class="form-control" name="head_id" type="number" id="head_id" value="{{ $employee->head_id or ''}}" >--}}
            {!! $errors->first('head_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('position_id') ? 'has-error' : ''}}">
        <label for="position_id" class="col-md-4 control-label">{{ 'Position Title' }}</label>
        <div class="col-md-6">
            <select class="form-control" name="position_id" id="position_id">
                <option value=""> - </option>
                @foreach($positions as $position)
                    @php $selected = (isset($employee) && $position->id == $employee->position_id) ? 'selected' : ''; @endphp
                    <option value="{{$position->id}}" {{$selected}}>{{$position->title}}</option>
                @endforeach
            </select>
            {{--<input class="form-control" name="position_id" type="number" id="position_id" value="{{ $employee->position->title or ''}}" >--}}
            {!! $errors->first('position_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="name" type="text" id="name" value="{{ $employee->name or ''}}" >
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('salary') ? 'has-error' : ''}}">
        <label for="salary" class="col-md-4 control-label">{{ 'Salary' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="salary" type="number" id="salary" value="{{ $employee->salary or ''}}" >
            {!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('hired_at') ? 'has-error' : ''}}">
        <label for="hired_at" class="col-md-4 control-label">{{ 'Hired At' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="hired_at" type="date" id="hired_at" value="{{ $employee->hired_at or date("Y-m-d H:i:s")}}" >
            {!! $errors->first('hired_at', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
        <label for="photo" class="col-md-4 control-label">{{ 'Photo' }}</label>
        <div class="col-md-6">
            @if(!empty($employee->photo))
                <img src="{{ Storage::url($employee->photo)}}" alt="" class="img-responsive img-thumbnail">
            @endif
            <input class="form-control" name="photo" type="file" id="photo">
            {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
            <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
        </div>
    </div>
</div>
