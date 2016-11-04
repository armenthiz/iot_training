@extends('layouts.app')

@section('content')
                <h2 class="title">
                    Register Here
                </h2>
                <div class="register center-block" style="width:400px;">
                    {!! Form::open(['route' => 'user.register_store', 'role' => 'form']) !!}
                        <div class="form-group">
                            {!! Form::label('first_name', 'First Name', []) !!}
                            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Your First Name ..']) !!}
                            <div class="text-danger">
                            @if (! empty($errors))
                                {!! $errors->first('first_name') !!}
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('last_name', 'Last Name', []) !!}
                            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Your Last Name ..']) !!}
                            <div class="text-danger">
                            @if (! empty($errors))
                                {!! $errors->first('last_name') !!}
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email', []) !!}
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Your Email Name ..']) !!}
                            <div class="text-danger">
                            @if (! empty($errors))
                                {!! $errors->first('email') !!}
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password', []) !!}
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Your Password Name ..']) !!}
                            <div class="text-danger">
                            @if (! empty($errors))
                                {!! $errors->first('password') !!}
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" class="btn btn-raised btn-primary" value="Register" />
                            <a href="#"> Forgot password?</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
@stop