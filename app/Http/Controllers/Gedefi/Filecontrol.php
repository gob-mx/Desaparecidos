<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;
use App\Models\Gedefi\Filecontrol as ModelFilecontrol;
use App\Models\Gedefi\Cbp as Cbp;
use App\Models\Gedefi\Cnb as Cnb;
use App\Models\Gedefi\Fgj as Fgj;

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
    ModelFilecontrol::generar_unificada();
    return view('desaparecidos/generate');
  }

  public function generar_cbp_cnb(){
    ModelFilecontrol::generar_cbp_cnb();
    return view('desaparecidos/generate');
  }

  public function generar_cbp_fgj(){
    ModelFilecontrol::generar_cbp_fgj();
    return view('desaparecidos/generate');
  }

  public function generar_cnb_fgj(){
    ModelFilecontrol::generar_cnb_fgj();
    return view('desaparecidos/generate');
  }

  public function generar_duplicados_unificada(){
    ModelFilecontrol::generar_duplicados_unificada();
    return view('desaparecidos/generate');
  }

  public function generar_duplicados_cbp_cnb(){
    ModelFilecontrol::generar_duplicados_cbp_cnb();
    return view('desaparecidos/generate');
  }

  public function generar_duplicados_cbp_fgj(){
    ModelFilecontrol::generar_duplicados_cbp_fgj();
    return view('desaparecidos/generate');
  }

  public function generar_duplicados_cnb_fgj(){
    ModelFilecontrol::generar_duplicados_cnb_fgj();
    return view('desaparecidos/generate');
  }

  public function reprocesar($doc, $id){
    $datos = ModelDesaparecidos::reprocesar($doc, $id);
    return view('desaparecidos/filecontrol')->with($datos);
  }

  public function getUnlocated($id, $doc)
  {
      switch($doc){
        case 'fgj':
          $datos = Fgj::recuperar($id);
          break;
        case 'cbp':
          $datos = Cbp::recuperar($id);
          break;
        case 'cnb':
          $datos = Cnb::recuperar($id);
          break;
      }
      return view('modales/filecontrol/getunlocated')->with('datos', $datos);
  }

}
