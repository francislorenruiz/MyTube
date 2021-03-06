@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    	@if(Auth::check())
        	<div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        {{ __('¡Estás logueado!') }}
                    </div>
                </div>
                <p>
            </div>
        @endif
    
    	<div class="container">
    		@if(session('message'))
    			<div class="alert alert-success">
    				{{ session('message') }}
    			</div>
    		@endif
    		
    		@include('video.videosList')
    	</div>
    </div>
</div>
@endsection
