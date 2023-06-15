<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Unificada as ModelUnificada;

use Helpme;

class Unificada extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Unificada|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/unificada');
  }

  public function obtenerBase(){
    echo json_encode( ModelUnificada::obtenerBase() );
  }

}
