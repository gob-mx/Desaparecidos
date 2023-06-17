<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Unificadadup as ModelUnificadadup;

use Helpme;

class Unificadadup extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Unificadadup|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/unificadadup');
  }

  public function obtenerBase(){
    echo json_encode( ModelUnificadadup::obtenerBase() );
  }

}
