@extends('layouts.app')

@section('content')
                <div class="images">
                    <div class="col-md-3">
                        <div class="dashboard-profile box">
                            <p class="dashboard-profile-name">
                                {!! link_to(route('images.create'), 'Post new Image', ['class' => 'btn btn-raised btn-primary']) !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h2 class="title">
                            Your Images
                        </h2>
                        <div class="dashboard-images box">
                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                      <th>Id</th>
                                      <th>Images</th>
                                      <th>Title</th>
                                      <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                    <tr>
                                        <td>{{ $image->id }}</td>
                                        <td>
                                            <img src='{{ $image->url_small }}' class="dashboard-images-thumb">
                                        </td>
                                        <td>
                                            {{ $image->title }}
                                        </td>
                                        <td>
                                            <a href="/images/{{ $image->id }}" class="btn btn-raised btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {!! $images->render() !!}
                        </div>
                    </div>
                </div>
            </div>
@stop