<?php

namespace App\Http\Controllers\Framework;
use Illuminate\Http\Request;
use App\Models\Framework\Controllers;
use App\Models\Framework\Roles;
use App\Models\Framework\Accesos;
use App\Models\Framework\Permisos;
use App\Models\Framework\Usuarios;
use Helpme;
use DB;

class Webhook extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Webwook|index', ['only' => ['index']]);
  }

  static public function index(){}


  static public function syncmetodo(){
      $secret=env('SYSTEM_KEY');
      $system_id=env('SYSTEM_ID');
      $webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
      $metododata = $_SERVER ['HTTP_METODODATA'];
      $body = file_get_contents('php://input');
      $expected_signature = hash_hmac( 'sha256', $body, $secret, false );
      if($webhook_signature == $expected_signature) {

        $metododata = json_decode($metododata);
        echo Permisos::importarMetodo($metododata);
      } else {
        header("Status: 401 Not authenticated");
      }
  }


  static public function syncrol(){
      $secret=env('SYSTEM_KEY');
      $system_id=env('SYSTEM_ID');
  		$webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
      $roldata = $_SERVER ['HTTP_ROLDATA'];
  		$body = file_get_contents('php://input');
  		$expected_signature = hash_hmac( 'sha256', $body, $secret, false );
  		if($webhook_signature == $expected_signature) {

        $roldata = json_decode($roldata);
        echo Roles::importarRol($roldata);

  		} else {
  			header("Status: 401 Not authenticated");
  		}
  }

  static public function updateroldata(){

      $secret=env('SYSTEM_KEY');
      $system_id=env('SYSTEM_ID');

  		$webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
      $roldata = $_SERVER ['HTTP_ROLDATA'];
  		$body = file_get_contents('php://input');
  		$expected_signature = hash_hmac( 'sha256', $body, $secret, false );
  		if($webhook_signature == $expected_signature) {

        $data = json_decode($roldata);
        $data_rol = Roles::updateFromRemoteRolData($data);
        echo json_encode($data_rol);

  		} else {
  			header("Status: 401 Not authenticated");
  		}

  }

  static public function updateuser(){

      $secret=env('SYSTEM_KEY');
      $system_id=env('SYSTEM_ID');
  		$webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
      $userdata = $_SERVER ['HTTP_USERDATA'];
      $id_rol = $_SERVER ['HTTP_IDROL'];
      $cat_status = $_SERVER ['HTTP_CATSTATUS'];
  		$body = file_get_contents('php://input');
  		$expected_signature = hash_hmac( 'sha256', $body, $secret, false );
  		if($webhook_signature == $expected_signature) {

        $data = json_decode($userdata);
        $data_usr = Usuarios::updateFromRemoteUser($data, $id_rol, $cat_status);
        echo json_encode($data_usr);
  		} else {
  			header("Status: 401 Not authenticated");
  		}

  }

  static public function syncuser(){

      $secret=env('SYSTEM_KEY');
      $system_id=env('SYSTEM_ID');
  		$webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
      $userdata = $_SERVER ['HTTP_USERDATA'];
      $id_rol = $_SERVER ['HTTP_IDROL'];
  		$body = file_get_contents('php://input');
  		$expected_signature = hash_hmac( 'sha256', $body, $secret, false );
  		if($webhook_signature == $expected_signature) {

        $data = json_decode($userdata);
        echo Usuarios::importarUsuario($data, $id_rol);
  		} else {
  			header("Status: 401 Not authenticated");
  		}

  }

  static public function backup(){

      $secret=env('SYSTEM_KEY');
      $system_id=env('SYSTEM_ID');
  		$webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
  		$body = file_get_contents('php://input');
  		$expected_signature = hash_hmac( 'sha256', $body, $secret, false );

  		if($webhook_signature == $expected_signature) {


        $metodos = Controllers::getAll();
        $roles = Roles::getAll();
        $accesos = Accesos::getAll();

        $datos = [
            'metodos' => json_encode($metodos),
            'roles' => json_encode($roles),
            'accesos' => json_encode($accesos)
        ];

        $header_send = base64_encode(json_encode($datos));

        echo $header_send;

  		} else {
  			header("Status: 401 Not authenticated");
  		}

  }

  static public function populate(){

      $secret=env('SYSTEM_KEY');
      $system_id=env('SYSTEM_ID');
  		$webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
  		$body = file_get_contents('php://input');
  		$expected_signature = hash_hmac( 'sha256', $body, $secret, false );

  		if($webhook_signature == $expected_signature) {

          $data = json_decode($body);
          $ids_inserts = $data->ids_inserts;

          $remote_model = self::getModelosRemotos($ids_inserts);

          DB::statement('SET FOREIGN_KEY_CHECKS=0;');
          DB::table('fw_acceso')->truncate();
          DB::table('fw_auditoria')->truncate();
          DB::table('fw_login')->truncate();
          DB::table('fw_login_log')->truncate();
          DB::table('fw_lost_password')->truncate();
          DB::table('fw_permisos')->truncate();
          DB::table('fw_usuarios_config')->truncate();
          DB::table('fw_usuarios')->truncate();
          DB::table('fw_roles')->truncate();
          DB::table('fw_metodos')->truncate();
          DB::statement('SET FOREIGN_KEY_CHECKS=1;');

          $remote_model = base64_decode($remote_model);
          $remote_model = json_decode($remote_model, true);

          $last_ids = self::populateImports($remote_model);

          echo json_encode($last_ids);

  		} else {
  			header("Status: 401 Not authenticated");
  		}

  }

  static function populateImports($remote_model){

    $metodos = json_decode($remote_model['metodos'], true);
    $roles = json_decode($remote_model['roles'], true);
    $accesos = json_decode($remote_model['accesos'], true);

    for($i=0; $i < count($metodos); $i++){
      $id_metodo = DB::table('fw_metodos')->insertGetId(
          [
            'id_metodo'=>$metodos[$i]['id_metodo'],
            'controlador'=>$metodos[$i]['controlador'],
            'metodo'=>$metodos[$i]['metodo'],
            'nombre'=>$metodos[$i]['nombre'],
            'descripcion'=>$metodos[$i]['descripcion'],
            'auditable'=>$metodos[$i]['auditable'],
            'user_alta'=>$metodos[$i]['user_alta'],
            'user_mod'=>$metodos[$i]['user_mod'],
            'fecha_alta'=>$metodos[$i]['fecha_alta'],
            'fecha_mod'=>$metodos[$i]['fecha_mod']
          ]
      );
    }


    for($i=0; $i < count($roles); $i++){
      $id_rol = DB::table('fw_roles')->insertGetId(
          [
            'id_rol'=>$roles[$i]['id_rol'],
            'cat_tiporol'=>$roles[$i]['cat_tiporol'],
            'descripcion'=>$roles[$i]['descripcion'],
            'token'=>$roles[$i]['token'],
            'user_alta'=>$roles[$i]['user_alta'],
            'user_mod'=>$roles[$i]['user_mod'],
            'fecha_alta'=>$roles[$i]['fecha_alta'],
            'fecha_mod'=>$roles[$i]['fecha_mod']
          ]
      );
    }



    for($i=0; $i < count($accesos); $i++){
      $id_permiso = DB::table('fw_permisos')->insertGetId(
          [
            'id_permiso'=>$accesos[$i]['id_permiso'],
            'id_metodo'=>$accesos[$i]['id_metodo'],
            'id_rol'=>$accesos[$i]['id_rol'],
            'user_alta'=>$accesos[$i]['user_alta'],
            'user_mod'=>$accesos[$i]['user_mod'],
            'fecha_alta'=>$accesos[$i]['fecha_alta'],
            'fecha_mod'=>$accesos[$i]['fecha_mod']
          ]
      );
    }


    return array(
            'last_id_metodo' => $id_metodo ,
            'last_id_role' => $id_rol,
            'last_id_permiso' => $id_permiso
          );

  }

  static function getModelosRemotos($ids_inserts){

    $app_url = env('EXT_LOGIN').'sendModelsSystem';
    $app_secret = env('SYSTEM_KEY');
    $app_name = env('APP_NAME');
    $id_sistema = env('SYSTEM_ID');
    $ids_inserts = json_encode($ids_inserts);
    $post_send = json_encode(array('ids_inserts' => $ids_inserts));
    $sign = hash_hmac('sha256', $post_send, $app_secret, false);

    $headers = array(
       'systemverify-Signature:'.$sign,
       'system:'.$app_name,
       'system-id:'.$id_sistema,
       'ip:'.$_SERVER['REMOTE_ADDR']
    );

    $curl = null;
    $curl = curl_init($app_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_send);
    return curl_exec($curl);
  }
}
