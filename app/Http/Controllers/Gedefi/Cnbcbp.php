<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Cnbcbp as ModelCnbcbp;

use Helpme;

class Cnbcbp extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Cnbcbp|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/cnbcbp');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnbcbp::obtenerBase() );
  }

}
