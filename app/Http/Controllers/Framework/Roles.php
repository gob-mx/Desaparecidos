<?php

namespace App\Http\Controllers\Framework;
use Illuminate\Http\Request;
use App\Models\Framework\Roles as ModelRoles;
use App\Models\Framework\Catalogo;
use Helpme;

class Roles extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Roles|Roles|index', ['only' => ['index']]);
      $this->middleware('permiso:Roles|clonar', ['only' => ['clonar']]);
      $this->middleware('permiso:Roles|modal_roles', ['only' => ['modal_roles']]);
      $this->middleware('permiso:Roles|agregar_rol', ['only' => ['agregar_rol']]);
      $this->middleware('permiso:Roles|permisos', ['only' => ['permisos']]);
      $this->middleware('permiso:Roles|establecer_permiso', ['only' => ['establecer_permiso','establecer_acceso']]);
  }
  public function index(){require URL_TEMPLATE.'404.php';}

  public function establecer_permiso($role,$metodo,$estado){ print json_encode(ModelRoles::setear_permiso($role,$metodo,$estado));}

  public function establecer_acceso($id_rol,$access,$estado){print json_encode(ModelRoles::setear_acceso($id_rol,$access,$estado,'fw_roles','fw_roles'));}

  public function clonar($id_rol,$transfer){
      print ModelRoles::clonar_permisos($id_rol,$transfer).'ok';
  }

  public function agregar_rol(Request $request){ print json_encode(ModelRoles::agregar_rol($request));}

  public function modal_roles(){
      $roles = ModelRoles::queryRoles(null);
      $tiporol = Catalogo::selectCatalog('tiporol',null);
      $datos = [
          'roles' => $roles,
          'tiporol' => $tiporol
      ];
      return view('modales/roles/gestion_roles')->with('datos', $datos);
  }

  public function permisos($rol){
      $descripcion = ModelRoles::get_rol($rol);
      $metodos = ModelRoles::getMetodos();

          foreach ($metodos as $num => $metodo){
            $permisos[$num] = ModelRoles::getPermisos($rol,$metodo->id_metodo);
          }

      $roles = ModelRoles::select_roles();
      $roles_ck = ModelRoles::check_roles();

          for($i=0;$i < count($roles_ck); $i++){
                $accesos[$i] = ModelRoles::getAccesos($rol,$roles_ck[$i]['value'],'fw_roles','fw_roles');
          }

      $datos = [
          'descripcion' => $descripcion,
          'metodos' => $metodos,
          'roles' => $roles,
          'roles_ck' => $roles_ck,
          'rol' => $rol,
          'permisos' => $permisos,
          'accesos' => $accesos
      ];
      return view('permisos/index')->with('datos', $datos);
  }
}
