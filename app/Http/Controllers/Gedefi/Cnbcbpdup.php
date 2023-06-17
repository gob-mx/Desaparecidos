<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Cnbcbpdup as ModelCnbcbpdup;

use Helpme;

class Cnbcbpdup extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Cnbcbpdup|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/cnbcbpdup');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnbcbpdup::obtenerBase() );
  }

}
