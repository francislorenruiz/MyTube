<hr/>
<h4>Comentarios</h4>
<hr/>

@if(session('message'))
	<div class="alert alert-success">
		{{ session('message') }}
	</div>
@endif

@if(Auth::check())
	<div class="d-flex justify-content-center">
        <form class="col-md-4" method="POST" action="{{ url('/comment') }}">
        	{!! csrf_field() !!}
        	
        	<input type="hidden" name="video_id" value="{{ $video->id }}" required />
            	<p>
            		<textarea class="form-control" name="body" placeholder="Escribe tu comentario..." required></textarea>
            	</p>
        	<input type="submit" value="Comentar" class="btn btn-success" />
        </form>
    	<div class="clearfix"></div>
	</div>
	<hr/>
@endif

@if(isset($video->comments))
	<div id="comments-list">
		@foreach($video->comments as $comment)
			<div class="d-flex justify-content-center">
    			<div class="comment-item col-md-8">
    				<div class="card comment-data">
        				<div class="card-header">
        					<div class="card-title">
        						<strong>{{ $comment->user->name.' '.$comment->user->surname }}</strong> {{ \FormatTime::LongTimeFilter($comment->created_at) }}
        					</div>
        				</div>
        				<div class="card-body">
        					{{ $comment->body }}
        				
    				
    				        <!-- Solo pueden eliminar comentarios el que lo hizo o el que subió el vídeo -->
            				@if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id))
            					<div class="float-right">
                					<!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                    <a href="#modalPersonalizado{{$comment->id}}" role="button" class="btn btn-sm btn-primary" data-toggle="modal">Eliminar</a>
                                      
                                    <!-- Modal / Ventana / Overlay en HTML -->
                                    <div id="modalPersonalizado{{$comment->id}}" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content col-md-12">
                                                <div class="modal-header">
                                                	<h4 class="modal-title">¿Estás seguro?</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Seguro que quieres borrar este comentario?</p>
                                                    <p class="font-italic"><small>{{ $comment->body }}</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <a href="{{ url('/delete-comment/'.$comment->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            				@endif
        				</div>
    				</div>
    			</div>
			</div>
		@endforeach
	</div>
	
	<div class="clearfix"></div>
@endif

