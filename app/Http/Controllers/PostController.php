<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index(User $user)
    {
        // dd(auth()->user());
        // dd($user->username);
        return view('dashboard',[
            'user'=> $user
        ]);
    }

    public function create()
    {
        // dd('Creando post...');
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // dd('creado publicacion');
        $this->validate($request,[
        'titulo' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required'
        ]);


        // Manera numero 1 de crear un registro
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' =>auth()->user()->id
        // ]);

        // Manera numero 2 de crear un registro
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index', auth()->user()->username);
    }

}
