<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Filecontrol as ModelFilecontrol;

use Helpme;

class Filecontrol extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Filecontrol|index', ['only' => ['index']]);
  }


  public function index(){
    return view('desaparecidos/filecontrol');
  }

  public function obtenerArchivos(){
    echo json_encode( ModelFilecontrol::obtenerArchivos() );
  }

  public function generate(){
    return view('desaparecidos/generate');
  }

  public function menu_ven(){
    return view('desaparecidos/menu_ven');
  }

  public function generar_unificada(){
    echo json_encode( ModelFilecontrol::generar_unificada() );
  }

  public function generar_cbp_cnb(){
    echo json_encode( ModelFilecontrol::generar_cbp_cnb() );
  }

  public function generar_cbp_fgj(){
    echo json_encode( ModelFilecontrol::generar_cbp_fgj() );
  }

  public function generar_cnb_fgj(){
    echo json_encode( ModelFilecontrol::generar_cnb_fgj() );
  }

}
