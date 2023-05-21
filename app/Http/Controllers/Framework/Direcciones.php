<?php
namespace App\Http\Controllers\Framework;
use App\Models\Framework\Direcciones as ModelDirecciones;
use Illuminate\Http\Request;
use Helpme;

class Direcciones extends Controller
{
  public function __construct()
  {
      //$this->middleware('permiso:Catalogo|editar_catalogo', ['only' => ['data_catalogo','editar_catalogo']]);
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

  public function get_ciudades($id_estado,$id_pais)
  {
    echo ModelDirecciones::get_ciudades($id_estado,$id_pais);
  }

  public function get_estados($id_pais)
  {
    echo ModelDirecciones::get_estados($id_pais);
  }

}
