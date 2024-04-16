<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        //Validacion
        $this->validate($request, [
            // 'name' => 'required|max:30',
            'name' => ['required','max:30'],
            'username' => ['required','unique:users','min:3','max:20'],
            'email' => ['required','unique:users','email','max:60'],
            'password' => ['required','confirmed','min:6']
        ]);

        dd('Creando Usuario');

    }
}
