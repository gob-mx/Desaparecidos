<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gedefi\Unificadadup as ModelUnificadadup;

use Helpme;

class Unificadadup extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:Unificadadup|index', ['only' => ['index']]);
    $this->middleware('permiso:Unificadadup|obtenerBase', ['only' => ['obtenerBase']]);
  }


  public function index(){
    return view('filecontrol/unificadadup');
  }

  public function obtenerBase(){
    echo json_encode( ModelUnificadadup::obtenerBase() );
  }

}
