<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Cbp as ModelCbp;

use Helpme;

class Cbp extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:Cbp|index', ['only' => ['index']]);
      $this->middleware('permiso:Cbp|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/cbp');
  }

  public function obtenerBase(){
    echo json_encode( ModelCbp::obtenerBase() );
  }

}
