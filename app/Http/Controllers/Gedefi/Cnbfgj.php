<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Cnbfgj as ModelCnbfgj;

use Helpme;

class Cnbfgj extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Cnbfgj|index', ['only' => ['index']]);
    $this->middleware('permiso:Cnbfgj|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/cnbfgj');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnbfgj::obtenerBase() );
  }

}
