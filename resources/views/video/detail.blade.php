@extends('layouts.app')

@section('content')
	<div class="col-md-10 offset-md-1">
		<h2>{{ $video->title }}</h2>
		<hr/>
		
		<div class="d-flex justify-content-center">
			<video controls id="video-player">
				<source src="{{ route('fileVideo', ['filename'=>$video->video_path]) }}"></source>
				Tu navegador no es compatible con HTML5
			</video>
		</div>
		
		<p></p>
		
		<div class="d-flex justify-content-center">
			<div class="card video-data">
				<div class="card-header">
					<div class="card-title">
						Subido por <strong>
										<a href="{{ route('channel', ['user_id' => $video->user->id]) }}">
											{{ $video->user->name.' '.$video->user->surname }}
										</a>
									</strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}
					</div>
				</div>
				<div class="card-body">
					{{ $video->description }}
				</div>
			</div>
		</div>
		@include('video.comments')
	</div>
@endsection