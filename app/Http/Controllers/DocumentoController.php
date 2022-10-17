<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    // Ver los documentos
    public function index()
    {
        return view('documento.index');
    }
}
