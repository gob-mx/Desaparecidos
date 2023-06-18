<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Cbpfgj as ModelCbpfgj;

use Helpme;

class Cbpfgj extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Cbpfgj|index', ['only' => ['index']]);
    $this->middleware('permiso:Cbpfgj|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/cbpfgj');
  }

  public function obtenerBase(){
    echo json_encode( ModelCbpfgj::obtenerBase() );
  }

}
