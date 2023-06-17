<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Cbpfgj as ModelCbpfgj;

use Helpme;

class Cbpfgj extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Cbpfgj|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/cbpfgj');
  }

  public function obtenerBase(){
    echo json_encode( ModelCbpfgj::obtenerBase() );
  }

}
