<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccesoController extends Controller
{
    public function mostrarFormulario(){
        return view('auth.acceso');
    }
    public function iniciarSesion(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6'
        ],[
            'email.required' => 'El correo electronico es obligatorio',
            'email.email' => '>Debe ingrsar un correo valido',
            'email.max' => 'El correo no puede tener mas de 255 caracteres',
            'email.required' => 'La contraseña es oblogatoria',
            'email.string' => 'La contraseña debe ser una cadena de texto',
            'email.min' => 'La contraseña debe tener al menos 6 caracteres',
        ]);

        if($validator->fails()){
            if($request->ajax()){
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

        return redirect()
        ->back()
        ->withErrors($validator)
        ->withImput($request->only('email'));

        }

        $credenciales = $request->only('email','password');

        if(Auth::attempt($credenciales)){
            $request->session()->regenerate();
            $usuario = Auth::user();


            if($request->ajax()){
                return response()->json([
                    'success' => true,
                    'mensaje' => 'Inicio de sesion exitoso',
                    'redirect' => ''
                ]);
            }

        }
    }
}
