<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\User;
use App\Video;
use App\Comment;


class UserController extends Controller
{
    public function channel($user_id)
    {
        $user = User::find($user_id);
        
        if(!is_object($user))
        {
            return redirect()->route('home');
        }
        
        $videos = Video::where('user_id', $user_id)->paginate(5);
        
        return view('user.channel', array(
            'user' => $user,
            'videos' => $videos
        ));
    }
    
    public function delete($user_id)
    {
        $user = User::find($user_id);
        $mensaje = array('message' => 'El usuario no ha podido eliminarse');
        
        if(!is_object($user))
        {
            return redirect()->route('home');
        }
        
        // Eliminamos todos los vídeos del usuario
        $videos = Video::where('user_id', $user_id)->get();
        foreach ($videos as $video)
        {
            $comments = Comment::where('video_id', $video->id)->get();
            
            //Eliminar comentarios
            if($comments && count($comments) >= 1)
            {
                foreach ($comments as $comment)
                {
                    $comment->delete();
                }
            }
            
            //Eliminar ficheros
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);
            
            //Eliminar registro
            $video->delete();
        }
        
        //Eliminamos todos los comentarios del usuario
        $comments = Comment::where('user_id', $user->id)->get();
        foreach ($comments as $comment)
        {
            $comment->delete();
        }
        
        //Eliminamos el usuario
        $user->delete();
        
        $mensaje = array('message' => 'Usuario eliminado correctamente');
        
        return redirect()->route('home')->with($mensaje);
    }
}
