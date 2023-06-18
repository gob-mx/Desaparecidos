<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Cnbcbp as ModelCnbcbp;

use Helpme;

class Cnbcbp extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Cnbcbp|index', ['only' => ['index']]);
    $this->middleware('permiso:Cnbcbp|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/cnbcbp');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnbcbp::obtenerBase() );
  }

}
