<?php

namespace App\Http\Controllers;

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
}
