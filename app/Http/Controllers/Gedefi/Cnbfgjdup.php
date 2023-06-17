<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Cnbfgjdup as ModelCnbfgjdup;

use Helpme;

class Cnbfgjdup extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Cnbfgjdup|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/cnbfgjdup');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnbfgjdup::obtenerBase() );
  }

}
