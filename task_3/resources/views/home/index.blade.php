@extends('layouts.app')

@section('content')
				<h2 class="title">
					Recent Pictures
				</h2>
				<ul class="recent-pictures grid">
					@foreach ($images as $image)
					<li class="picture grid-item">
						<a href="image/{{ $image->id }}">
						<div class="picture-content">
							<img class="picture-image" src="{{ $image->url_small }}" />
							<p class="picture-title">
								{{ $image->title }}
							</p>
							<div class="picture-users">
								<div class="col-md-2">
									<img src="{{ $image->url_small }}">
								</div>
								<div class="col-md-10">
									{{ $image->users->first_name . ' ' . $image->users->last_name }}
								</div>
							</div>
						</div>
						</a>
					</li>
					@endforeach
				</ul>
			</div>
			<div class="clear"></div>
			<div class="text-center">
				{!! $images->render() !!}
			</div>
@stop