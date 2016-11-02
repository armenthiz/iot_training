@extends('layouts.app')

@section('content')
            <div class="content container">
                <div class="images">
                    <div class="col-md-3">
                        <div class="dashboard-profile box">
                            <p class="dashboard-profile-name">
                                {!! link_to(route('images.create'), 'Post new Image', ['class' => 'btn btn-raised btn-primary']) !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="dashboard-images-show box">
                            <div class="col-md-4">
                                <img src="{{ $image->url }}" class="dashboard-images-show-thumb" />
                            </div>
                            <div class="col-md-8">
                                <p>Title: </p>
                                <p class="dashboard-show-text">
                                    {{ $image->title }}
                                </p>
                                {!! Form::open(array('route' => array('images.destroy', $image->id), 'method' => 'delete')) !!}
                                    {!! link_to(route('images.index'), 'Back', ['class' => 'btn btn-raised btn-info']) !!}
                                    {!! link_to(route('images.edit', $image->id), 'Edit', ['class' => 'btn btn-raised btn-warning']) !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-raised btn-danger', 'onclick' => 'return confirm(\'are you sure?\'')) !!}
                                {!! Form::close() !!}
                                {{-- <a href="/images/{{ $image->id }}/edit" class="btn btn-raised btn-info">Edit</a> --}}
                                {{-- <a href="/images/{{ $image->id }}" class="btn btn-raised btn-danger">Delete</a> --}}
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
@stop