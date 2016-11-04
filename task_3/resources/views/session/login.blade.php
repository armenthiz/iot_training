@extends('layouts.app')

@section('content')
                <h2 class="title">
                    Login Here
                </h2>
                <div class="login center-block" style="width:400px;">
                    {!! Form::open(['route' => 'session.login_store', 'role' => 'form']) !!}
                        <div class="form-group">
                            {!! Form::label('email', 'Email', []) !!}
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Your Email ..']) !!}
                            <div class="text-danger">
                            @if (! empty($errors))
                                {!! $errors->first('email') !!}
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password', []) !!}
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Your Password']) !!}
                            <div class="text-danger">
                            @if (! empty($errors))
                                {!! $errors->first('password') !!}
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('remember', 'Remember Me? ', []) !!}
                            {!! Form::checkbox('remember', null, []) !!}
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btn btn-raised btn-primary" value="Login" />
                            or
                            {!! link_to(route('reminders.create'), 'Forgot Password?') !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
@stop