<?php

namespace App\Http\Controllers\Framework;
use Illuminate\Http\Request;
use App\Models\Framework\Roles;
use App\Models\Framework\Usuarios;
use Helpme;

class Inicio extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Inicio|index', ['only' => ['index','load_start']]);
  }

  public function index()
  {
    $avatar_usr_circ = '';
    $usuario_name = array();


    if(isset($_SESSION['id_rol'])){

            $id_rol = $_SESSION['id_rol'];
            $id_usuario = $_SESSION['id_usuario'];
            $rol = Roles::rol();


            $usuario_menu_top = Usuarios::datos_usuario($id_usuario);
            $perfil_menu_top  = Usuarios::perfil_usuario($id_usuario);
            $avatar_usr_circ = (empty ($perfil_menu_top['avatar'])) ? 'img/avatar.jpg' : 'tmp/'.Helpme::duplicatePublic($perfil_menu_top['avatar'],'perfiles');
            $usuario_name = $usuario_menu_top['nombres'];

    }

    $datos = [
        'avatar_usr_circ' => $avatar_usr_circ,
        'usuario_name' => $usuario_name,
        'rol' => $rol,
        'id_rol' => $id_rol,
        'usuario_menu_top' => $usuario_menu_top
    ];
    return view('plantilla/start')->with('datos', $datos);
  }

  public function load_start(){
      return view('inicio/index');
  }
}
