<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyTube') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'MyTube') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <form class="nav navbar-form form-inline" role="search" action="{{ url('/buscar') }}">
                       	<div class="form-group">
                        	<input type="text" class="form-control" placeholder="¿Qué quieres ver?" name="search" />
                        </div>
                        <button type="submit" class="btn btn-default">
                        	<span class="glyphicon glyphicon-search">Buscar</span>
                        </button>
                   </form>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                        	<li>
                            	<a class="nav-link" href="{{ route('createVideo') }}">Subir vídeo</a>
                            </li>
                            <li class="nav-item dropdown">
                            	
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} 
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="#borrarUsuarioModal{{Auth::user()->name}}" role="button" class="dropdown-item" data-toggle="modal">Eliminar usuario</a>   
                                	<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                                
                                <!-- Modal / Ventana / Overlay en HTML -->
                              	<div id="borrarUsuarioModal{{Auth::user()->name}}" class="modal fade">
                                	<div class="modal-dialog">
                                    	<div class="modal-content">
                       	                	<div class="modal-header">
                                            	<h4 class="modal-title">¿Estás seguro?</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                            	<p>¿Seguro que quieres borrar tu usario?</p>
                                            	<p>Esta acción eliminará también todos tus vídeos y comentarios.</p>
                                            </div>
                                            <div class="modal-footer">
                                            	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            	<a href="{{ route('userDelete', Auth::user()->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                                            </div>
                                    	</div>
                                 	</div>
                                 </div>
                                
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 	@csrf
                                 </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        
        <footer class="col-md-10 offset-md-1">
        	<hr/>
        	<p>
        		MyTube, un pequeño portal de vídeos
        	</p>
        </footer>
    </div>
</body>
</html>
