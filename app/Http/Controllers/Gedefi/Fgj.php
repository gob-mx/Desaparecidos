<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Fgj as ModelFgj;

use Helpme;

class Fgj extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Fgj|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/fgj');
  }

  public function obtenerBase(){
    echo json_encode( ModelFgj::obtenerBase() );
  }

}
