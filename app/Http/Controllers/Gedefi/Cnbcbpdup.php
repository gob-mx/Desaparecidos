<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Cnbcbpdup as ModelCnbcbpdup;

use Helpme;

class Cnbcbpdup extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Cnbcbpdup|index', ['only' => ['index']]);
    $this->middleware('permiso:Cnbcbpdup|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/cnbcbpdup');
  }

  public function obtenerBase(){
    echo json_encode( ModelCnbcbpdup::obtenerBase() );
  }

}
