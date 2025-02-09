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

        $posts = Post::where('user_id', $user -> id)->paginate(9);

        // dd($post);

        return view('dashboard',[
            'user'=> $user,
            'posts'=>$posts
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
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // Manera numero 3 de crear un registro pero al estilo de Laravel
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' =>auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(Post $post){
        return view('posts.show', [
            'post' => $post
        ]);
    }

}
