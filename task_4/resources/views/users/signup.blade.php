@extends('layouts.application')

@section('content')
    {!! Form::open(['route' => 'signup.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
    <div class="form-group">
        {!! Form::label('first_name', 'First Name', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::text('first_name', null, array('class' => 'form-control')) !!}
            <div class="text-danger">
            @if (! empty($errors))
                {!! $errors->first('first_name') !!}
            @endif
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-group">
        {!! Form::label('last_name', 'Last Name', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::text('last_name', null, array('class' => 'form-control')) !!}
            <div class="text-danger">
            @if (! empty($errors))
                {!! $errors->first('last_name') !!}
            @endif
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
            <div class="text-danger">
            @if (! empty($errors))
                {!! $errors->first('email') !!}
            @endif
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::password('password', array('class' => 'form-control')) !!}
            <div class="text-danger">
            @if (! empty($errors))
                {!! $errors->first('password') !!}
            @endif
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Password Confirm', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-4">
            {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
            <div class="text-danger">
            @if (! empty($errors))
                {!! $errors->first('password_confirmation') !!}
            @endif
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-group">
        <div class="col-lg-3"></div>
        <div class="col-lg-4">
            {!! Form::submit('Signup', array('class' => 'btn btn-raised btn-primary')) !!}
        </div>
        <div class="clear"></div>
    </div>
    {!! Form::close() !!}
@stop