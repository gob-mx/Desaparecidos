<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Filecontrol as ModelFilecontrol;
use App\Models\Gedefi\Cbp as Cbp;
use App\Models\Gedefi\Cnb as Cnb;
use App\Models\Gedefi\Fgj as Fgj;

use Helpme;

class Filecontrol extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:Filecontrol|index', ['only' => ['index']]);
      $this->middleware('permiso:Filecontrol|upload_cbp', ['only' => ['upload_cbp']]);
      $this->middleware('permiso:Filecontrol|upload_cnb', ['only' => ['upload_cnb']]);
      $this->middleware('permiso:Filecontrol|upload_fgj', ['only' => ['upload_fgj']]);
      $this->middleware('permiso:Filecontrol|upload', ['only' => ['upload']]);
      $this->middleware('permiso:Filecontrol|obtenerArchivos', ['only' => ['obtenerArchivos']]);
      $this->middleware('permiso:Filecontrol|generate', ['only' => ['generate']]);
      $this->middleware('permiso:Filecontrol|menu_ven', ['only' => ['menu_ven']]);
      $this->middleware('permiso:Filecontrol|generar_unificada', ['only' => ['generar_unificada']]);
      $this->middleware('permiso:Filecontrol|generar_cbp_cnb', ['only' => ['generar_cbp_cnb']]);
      $this->middleware('permiso:Filecontrol|generar_cbp_fgj', ['only' => ['generar_cbp_fgj']]);
      $this->middleware('permiso:Filecontrol|generar_cnb_fgj', ['only' => ['generar_cnb_fgj']]);
      $this->middleware('permiso:Filecontrol|generar_duplicados_unificada', ['only' => ['generar_duplicados_unificada']]);
      $this->middleware('permiso:Filecontrol|generar_duplicados_cbp_cnb', ['only' => ['generar_duplicados_cbp_cnb']]);
      $this->middleware('permiso:Filecontrol|generar_duplicados_cbp_fgj', ['only' => ['generar_duplicados_cbp_fgj']]);
      $this->middleware('permiso:Filecontrol|generar_duplicados_cnb_fgj', ['only' => ['generar_duplicados_cnb_fgj']]);
      $this->middleware('permiso:Filecontrol|reprocesar', ['only' => ['reprocesar']]);
      $this->middleware('permiso:Filecontrol|getUnlocated', ['only' => ['getUnlocated']]);
  }

  public function upload_cbp($file){ return ModelFilecontrol::upload_excel($file,'cbp');}
  public function upload_cnb($file){ return ModelFilecontrol::upload_excel($file,'cnb');}
  public function upload_fgj($file){ return ModelFilecontrol::upload_excel($file,'fgj');}

  public function upload() {
      $datos = [
          'date' => date("Y-m-d H:i:s")
      ];
      return view('filecontrol/upload')->with('datos', $datos);
  }

  public function index(){
    return view('filecontrol/filecontrol');
  }

  public function obtenerArchivos(){
    echo json_encode( ModelFilecontrol::obtenerArchivos() );
  }

  public function generate(){
    return view('filecontrol/generate');
  }

  public function menu_ven(){
    return view('filecontrol/menu_ven');
  }

  public function generar_unificada(){
    ModelFilecontrol::generar_unificada();
    return view('filecontrol/generate');
  }

  public function generar_cbp_cnb(){
    ModelFilecontrol::generar_cbp_cnb();
    return view('filecontrol/generate');
  }

  public function generar_cbp_fgj(){
    ModelFilecontrol::generar_cbp_fgj();
    return view('filecontrol/generate');
  }

  public function generar_cnb_fgj(){
    ModelFilecontrol::generar_cnb_fgj();
    return view('filecontrol/generate');
  }

  public function generar_duplicados_unificada(){
    ModelFilecontrol::generar_duplicados_unificada();
    return view('filecontrol/generate');
  }

  public function generar_duplicados_cbp_cnb(){
    ModelFilecontrol::generar_duplicados_cbp_cnb();
    return view('filecontrol/generate');
  }

  public function generar_duplicados_cbp_fgj(){
    ModelFilecontrol::generar_duplicados_cbp_fgj();
    return view('filecontrol/generate');
  }

  public function generar_duplicados_cnb_fgj(){
    ModelFilecontrol::generar_duplicados_cnb_fgj();
    return view('filecontrol/generate');
  }

  public function reprocesar($doc, $id = false){
    $datos = ModelFilecontrol::reprocesar($doc, $id);
    return view('filecontrol/filecontrol')->with($datos);
  }

  public function getUnlocated($id, $doc){
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
