<div id="videos-list">
    @if(count($videos) >= 1)
        @foreach($videos as $video)
        	<div class="video-item pull-left card">
        		<div class="card-body row">
            		<!-- imagen del vídeo -->
            		@if(Storage::disk('images')->has($video->image))
            			<div class="video-image-thumb col-md-3 pull-left">
            				<div class="video-image-mask">
            					<img src="{{ url('miniatura/'.$video->image) }}" class="video-image"></img>
            				</div>
            			</div>
           			@endif
            					
           			<div class="data align-self-center">
           				<h4 class="video-title"><a href="{{ route('detailVideo', ['video_id' => $video->id]) }}">{{ $video->title }}</a></h4>
           				<p><a href="{{ route('channel', ['user_id' => $video->user->id]) }}">{{ $video->user->name.' '.$video->user->surname }}</a> | {{ \FormatTime::LongTimeFilter($video->created_at) }}</p>
        				<a href="{{ route('detailVideo', ['video_id' => $video->id]) }}" class="btn btn-success">Ver</a>
           				@if(Auth::check() && Auth::user()->id == $video->user->id)
         				<a href="{{ route('videoEdit', ['video_id' => $video->id]) }}" class="btn btn-warning">Editar</a>
            				<!-- Botón en HTML (lanza el modal en Bootstrap) -->
                            <a href="#victorModal{{$video->id}}" role="button" class="btn btn-primary" data-toggle="modal">Eliminar</a>
                                          
                            <!-- Modal / Ventana / Overlay en HTML -->
                  	        <div id="victorModal{{$video->id}}" class="modal fade">
                            	<div class="modal-dialog">
                            		<div class="modal-content">
           	                			<div class="modal-header">
                                      		<h4 class="modal-title">¿Estás seguro?</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                         </div>
                                         <div class="modal-body">
                                         	<p>¿Seguro que quieres borrar este vídeo?</p>
                                            <p class="text-warning"><small>{{ $video->title }}</small></p>
                                         </div>
                                         <div class="modal-footer">
                                         	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                          	<a href="{{ url('/delete-video/'.$video->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                                         </div>
                                    </div>
                                </div>
                            </div>
            			@endif
            		</div>
     			</div>
        	</div>
        	<p>
        @endforeach
    @else
    	<div class="alert alert-warning">No hay videos actualmente</div>
   	@endif
    			
    <div class="clearfix"></div>
    {{$videos->links()}}
</div>