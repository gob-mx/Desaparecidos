<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Cbpfgjdup as ModelCbpfgjdup;

use Helpme;

class Cbpfgjdup extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Cbpfgjdup|index', ['only' => ['index']]);
    $this->middleware('permiso:Cbpfgjdup|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/cbpfgjdup');
  }

  public function obtenerBase(){
    echo json_encode( ModelCbpfgjdup::obtenerBase() );
  }

}
