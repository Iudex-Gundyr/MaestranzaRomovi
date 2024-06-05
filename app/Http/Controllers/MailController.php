<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendContactMail;
use Illuminate\Support\Facades\Mail; // Corrección aquí

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $details = [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
        ];
    
        Mail::to('r.monroy.v@maestranzaromovi.cl')->send(new SendContactMail($details));
    
    }
}