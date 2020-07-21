@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        	<div class="container">
        		<div class="col-md-4 float-left">
        			<h2>Busqueda: {{ $search }}</h2>
        		</div>
        		
        		<div class="col-md-12">
            		<form class="col-md-3 float-right" action="{{ url('/buscar/'.$search) }}" method="get">
            			<label for="filter">Ordenar</label>
            			<select name="filter" class="form-control">
            				<option value="new">Más nuevos primero</option>
            				<option value="old">Más antiguos primero</option>
            				<option value="alfa">Orden alfabético</option>
            			</select>
            			
            			<input type="submit" value="Ordenar" class="btn-filter btn btn-nm btn-primary" />
            		</form>
        		</div>
        
        		<div class="clearfix"></div>
        		<br />
        		@include('video.videosList')
        	</div>
        </div>
    </div>
@endsection