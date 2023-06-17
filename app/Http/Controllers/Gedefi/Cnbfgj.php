<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Cnbfgj as ModelCnbfgj;

use Helpme;

class Cnbfgj extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Cnbfgj|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/cnbfgj');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnbfgj::obtenerBase() );
  }

}
