<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Cbpfgjdup as ModelCbpfgjdup;

use Helpme;

class Cbpfgjdup extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Cbpfgjdup|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/cbpfgjdup');
  }

  public function obtenerBase(){
    echo json_encode( ModelCbpfgjdup::obtenerBase() );
  }

}
