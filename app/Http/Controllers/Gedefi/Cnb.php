<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Cnb as ModelCnb;

use Helpme;

class Cnb extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Cnb|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/cnb');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnb::obtenerBase() );
  }

}
