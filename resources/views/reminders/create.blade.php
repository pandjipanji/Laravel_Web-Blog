@extends("layouts.application")
@section("content")

{!! Form::open(['route' => 'reminders.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
    <div class="form-group">
    {!! Form::label('email', 'Email', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
            <div class="text-danger">{!! $errors->first('email') !!}</div>
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