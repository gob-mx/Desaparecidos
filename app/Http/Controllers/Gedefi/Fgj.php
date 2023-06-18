<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Fgj as ModelFgj;

use Helpme;

class Fgj extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Fgj|index', ['only' => ['index']]);
    $this->middleware('permiso:Fgj|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/fgj');
  }

  public function obtenerBase(){
    echo json_encode( ModelFgj::obtenerBase() );
  }

}
