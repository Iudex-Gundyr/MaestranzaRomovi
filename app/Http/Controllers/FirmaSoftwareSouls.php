<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FirmaSoftwareSouls extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function FirmaSoftwareSouls()
    {
        return view('Firmas.FirmaSoftSouls'); 
    }
}
