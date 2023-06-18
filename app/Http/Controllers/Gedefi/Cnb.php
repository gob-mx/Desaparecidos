<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Cnb as ModelCnb;

use Helpme;

class Cnb extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Cnb|index', ['only' => ['index']]);
    $this->middleware('permiso:Cnb|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/cnb');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnb::obtenerBase() );
  }

}
