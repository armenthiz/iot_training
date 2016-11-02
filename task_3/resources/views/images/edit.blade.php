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
                        <div class="dashboard-images-edit box">
                            {!! Form::model($image, ['route' => ['images.update', $image->id], 'method' => 'put', 'role' => 'form', 'files' => true]) !!}
                              <fieldset>
                                <legend>Edit image</legend>
                                <div class="form-group">
                                    {!! Form::label('image', 'Upload Image', ['class' => 'col-md-2 control-label']) !!}

                                      <div class="col-md-10">
                                        <label class="control-label"><a href="javascript:void(0)" class="btn btn-raised btn-primary">Upload Image</a></label>
                                        {!! Form::file('image') !!}
                                        <input id="input-1a" type="file" class="file" name="image" data-show-preview="false">
                                        <div class="text-danger">
                                        @if (! empty($errors))
                                            {!! $errors->first('image') !!}
                                        @endif
                                        </div>
                                      </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}
                                      <div class="col-md-10">
                                        {!! Form::textarea('title', $image->title, ['class' => 'form-control']) !!}
                                        <div class="text-danger">
                                        @if (! empty($errors))
                                            {!! $errors->first('title') !!}
                                        @endif
                                        </div>
                                      </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-md-10 col-md-offset-2">
                                    {!! Form::submit('update', ['class' => 'btn btn-raised btn-primary']) !!}
                                  </div>
                                </div>
                              </fieldset>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
@stop