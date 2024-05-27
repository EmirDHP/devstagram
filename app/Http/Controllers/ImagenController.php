<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        // return "Desde imagen controller";
        // $input = $request->all();
        $imagen = $request->file('file');


        return response()->json(['imagen' => $imagen->extension()]);
    }
}
