<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrerController extends Controller
{
    //
    public function index () 
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        // dd($request);    De esta manera accedo a todos lo valores
        // dd($request->get('email'));  De esta manera solo accede al valor que quiero ver

        $request->request->add(['username'=> Str::slug($request->username)]);


        //Validacion
        $this->validate($request, [
            // 'name' => 'required|max:30',
            'name' => ['required','max:30'],
            'username' => ['required','unique:users','min:3','max:20'],
            'email' => ['required','unique:users','email','max:60'],
            'password' => ['required','confirmed','min:6']
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenticar un usuario
        auth()->attempt([
            'email'=> $request->email,
            'password'=>$request->password
        ]);

        //Redireccionamiento despues de crear el usuario
        return redirect()->route('posts.index');

    }
}
