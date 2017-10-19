@extends("layouts.application")
@section("content")
{!! Form::open(['route'=>['reminders.update', $id, $code], 'class' => 'form-horizontal', 'role' => 'form']) !!}
    <div class="form-group">
    {!! Form::label('password', 'Password', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::password('password', array('class' => 'form-control')) !!}
            <div class="text-danger">{!! $errors->first('password') !!}</div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
    {!! Form::label('password_confirmation', 'Password Confirm', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
        <div class="col-lg-3"></div>
        <div class="col-lg-4">
            {!! Form::submit('Submit', array('class' => 'btn btn-raised btn-primary')) !!}
        </div>
        <div class="clear"></div>
    </div>
{!! Form::close() !!}
@stop