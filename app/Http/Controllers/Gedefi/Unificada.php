<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Unificada as ModelUnificada;

use Helpme;

class Unificada extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Unificada|index', ['only' => ['index']]);
    $this->middleware('permiso:Unificada|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/unificada');
  }

  public function obtenerBase(){
    echo json_encode( ModelUnificada::obtenerBase() );
  }

}
