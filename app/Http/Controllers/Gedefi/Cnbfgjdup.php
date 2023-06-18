<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Cnbfgjdup as ModelCnbfgjdup;

use Helpme;

class Cnbfgjdup extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Cnbfgjdup|index', ['only' => ['index']]);
    $this->middleware('permiso:Cnbfgjdup|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/cnbfgjdup');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnbfgjdup::obtenerBase() );
  }

}
