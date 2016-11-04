@extends('layouts.app')

@section('content')
            <div class="content container">
                <div class="images">
                    <div class="col-md-3">
                        <div class="dashboard-profile box">
                            <p class="dashboard-profile-name">
                                {{ $user->first_name . ' ' . $user->last_name }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="dashboard-images-show box">
                            <div class="col-md-12">
                                <img src="{{ $image->url }}" class="dashboard-images-show-thumb" />
                            </div>
                            <div class="col-md-12">
                                <br />
                                <blockquote class="pull-left">
                                    <p>{{ $image->title }}</p>
                                    <small>
                                        <cite title="Source Title">
                                            {!! link_to(route('home.index'), 'Back to home') !!}
                                        </cite>
                                    </small>
                                </blockquote>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
@stop