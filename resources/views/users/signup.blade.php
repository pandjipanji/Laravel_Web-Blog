@extends("layouts.application")
@section("content")
<div class="container" style="background-color: #ffffff">
{!! Form::open(['route' => 'signup.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
    <div class="form-group">
        {!! Form::label('first_name', 'First Name', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::text('first_name', null, array('class' => 'form-control')) !!}
            <div class="text-danger">{!! $errors->first('first_name') !!}</div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
        {!! Form::label('last_name', 'Last Name', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::text('last_name', null, array('class' => 'form-control')) !!}
            <div class="text-danger">{!! $errors->first('last_name') !!}</div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::text('email', null, array('class' => 'form-control'))!!}
            <div class="text-danger">{!! $errors->first('email') !!}</div>
        </div>
        <div class="clear"></div>
    </div>

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
            
            {{ link_to(url()->previous(), 'Back', ['class' => 'btn btn-raised btn-info pull-left']) }}
            
            {!! Form::submit('Signup', array('class' => 'btn btn-raised btn-primary')) !!}
        </div>
        <div class="clear"></div>
    </div>
{!! Form::close() !!}
</div>
@stop