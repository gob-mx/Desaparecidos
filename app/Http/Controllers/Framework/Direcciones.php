<?php
namespace App\Http\Controllers\Framework;
use App\Models\Framework\Direcciones as ModelDirecciones;
use Illuminate\Http\Request;
use Helpme;

class Direcciones extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Direcciones|modal_dir', ['only' => ['modal_dir']]);
      $this->middleware('permiso:Direcciones|cp_search', ['only' => ['cp_search']]);
      $this->middleware('permiso:Direcciones|get_all', ['only' => ['get_all']]);
      $this->middleware('permiso:Direcciones|insert', ['only' => ['insert']]);
      $this->middleware('permiso:Direcciones|get_ciudades', ['only' => ['get_ciudades']]);
      $this->middleware('permiso:Direcciones|get_estados', ['only' => ['get_estados']]);
  }

  public function index(){
    exit();
  }

  public function modal_dir($iden,$id,$hidden)
  {
    $direcciones = ModelDirecciones::storage_addresses($iden);
    $datos = [
        'iden' => $iden,
        'id' => $id,
        'hidden' => $hidden,
        'direcciones' => $direcciones
    ];
    return view('modales/direcciones/modal_dir')->with('datos', $datos);
  }

  public function cp_search($cp)
  {
    echo ModelDirecciones::select_asentamientos($cp);
  }

  public function get_all($id_cp)
  {
    print json_encode (ModelDirecciones::get_all($id_cp));
  }

  public function insert(Request $request)
  {
    print json_encode (ModelDirecciones::insert($request));
  }

  public function get_ciudades($id_pais,$id_estado)
  {
    echo ModelDirecciones::get_ciudades($id_pais,$id_estado);
  }

  public function get_estados($id_pais)
  {
    echo ModelDirecciones::get_estados($id_pais);
  }

}
