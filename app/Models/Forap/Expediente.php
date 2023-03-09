<?php
namespace App\Models\Forap;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Expediente extends Model
{
  protected $table = 'fa_expediente';
  protected $primaryKey = 'id_expediente';
  public $timestamps = false;

  static function guardar_expediente($expediente, $tokenFSIAP){

      $id_unidad = self::getUnidadID($expediente);
      if(!$id_unidad){return false;}
      $expedienteID = self::obtener_folio($expediente['carpetainvestigacion']);
      $id_expediente = $expedienteID?$expedienteID:self::insertar_expediente($expediente['carpetainvestigacion'],"ABC123");
      $id_trazabilidad = $expedienteID?self::actualizaTraza($id_expediente, $id_unidad):self::insertTrazabilidad($id_expediente, $id_unidad);
      $expedienteID?self::actualizaDelitos($id_expediente, $expediente):self::insertDelitos($id_expediente, $expediente);
      $id_victima = $expedienteID?self::actualizaVictimas($id_expediente, $expediente):self::insertVictimas($id_expediente, $expediente);

      $remoteUserID = self::obtener_remoteUser($expediente['numEmpleado']);
      $id_remoteUser = $remoteUserID?$remoteUserID:self::insertar_remoteUser($expediente);
      $id_trazabilidadUser = $remoteUserID?self::actualizaTrazaUser($id_remoteUser, $id_unidad):self::insertTrazabilidadUser($id_remoteUser, $id_unidad);

      self::caducarTokens($id_expediente, $id_victima);
      $url_token = self::insertToken($id_expediente, $id_unidad, $id_trazabilidad, $id_remoteUser, $id_trazabilidadUser, $id_victima, $tokenFSIAP);
      //$url_token = Helpme::token(32);
      return $url_token;

  }

  static function actualizaTrazaUser($id_remoteUser, $id_unidad){
    $trazabilidadUserID = DB::table('fa_trazabilidadUser')
                ->select('id_trazabilidadUser')
                ->where('id_remoteUser','=',$id_remoteUser)
                ->where('id_unidad','=',$id_unidad)
                ->where('cat_status_remoteUser','=',21)
                ->get();
    return (isset($trazabilidadUserID[0]))?$trazabilidadUserID[0]->id_trazabilidadUser:self::updateTrazabilidadUser($id_remoteUser, $id_unidad);
  }

  static function insertTrazabilidadUser($id_remoteUser, $id_unidad){
    $id_trazabilidadUser = DB::table('fa_trazabilidadUser')->insertGetId(
        [
            'id_remoteUser' => $id_remoteUser,
            'id_unidad' => $id_unidad,
            'fecha_registro' => date("Y-m-d H:i:s"),
            'cat_status_remoteUser' => 21,
            'user_alta' => 1,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    return $id_trazabilidadUser;
  }

  static function updateTrazabilidadUser($id_remoteUser, $id_unidad){
    DB::table('fa_trazabilidadUser')
            ->where('id_remoteUser', $id_remoteUser)
            ->update([
                'cat_status_remoteUser' => 22
            ]);
    return self::insertTrazabilidadUser($id_remoteUser, $id_unidad);
  }

  static function insertar_usuario($numEmpleado){
    $id_usuario = DB::table('fw_usuarios')->insertGetId(
        [
            'usuario' => $numEmpleado,
            'id_rol' => 2,
            'id_ubicacion' => 1,
            'correo' => 'noreply@fgjcdmx.gobmx',
            'cat_status' => 3,
            'cat_pass_chge' => 11,
            'user_alta' => 1,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    self::insertar_configuracion_usuario($id_usuario);
    return $id_usuario;
  }

  static function insertar_configuracion_usuario($id_usuario){
    $id_usuario_config = DB::table('fw_usuarios_config')->insertGetId(
        [
            'id_usuario' => $id_usuario,
            'user_alta' => 1,
            'aceptar_tyc' => 'SI',
            'avatar' => 'JCydXQ.jpg',
            'paginacion' => 20,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    return $id_usuario_config;
  }

  static function obtener_remoteUser($numEmpleado){
    $result = DB::table('fa_remoteUser')
                ->select('id_remoteUser')
                ->where('numEmpleado','=',$numEmpleado)
                ->get();
    return (isset($result[0]))?$result[0]->id_remoteUser:false;
  }

  static function insertar_remoteUser($expediente){
    $id_usuario = self::insertar_usuario($expediente['numEmpleado']);
    $id_remoteUser = DB::table('fa_remoteUser')->insertGetId(
        [
            'id_usuario' => $id_usuario,
            'nombreEmpleado' => $expediente['nombreEmpleado'],
            'numEmpleado' => $expediente['numEmpleado'],
            'user_alta' => 1,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    return $id_remoteUser;
  }

  static function caducarTokens($id_expediente, $id_victima){
    DB::table('fa_tokens')
            ->where('id_expediente', $id_expediente)
            ->where('id_victima', $id_victima)
            ->update([
                'cat_status_token' => 30
            ]);
    return true;
  }

  static function insertToken($id_expediente, $id_unidad, $id_trazabilidad, $id_remoteUser, $id_trazabilidadUser, $id_victima, $tokenFSIAP){
      $url_token = Helpme::token(32);
      $id_token = DB::table('fa_tokens')->insertGetId(
          [
            'id_expediente' => $id_expediente,
            'id_unidad' => $id_unidad,
            'id_trazabilidad' => $id_trazabilidad,
            'id_remoteUser' => $id_remoteUser,
            'id_trazabilidadUser' => $id_trazabilidadUser,
            'id_victima' => $id_victima,
            'cat_status_token' => 29,
            'url_token' => $url_token,
            'tokenFSIAP' => $tokenFSIAP,
            'user_alta' => 1,
            'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );
    return $url_token;
  }

  static function actualizaTraza($id_expediente, $id_unidad){
    $trazabilidadID = DB::table('fa_trazabilidad')
                ->select('id_trazabilidad')
                ->where('id_expediente','=',$id_expediente)
                ->where('id_unidad','=',$id_unidad)
                ->where('cat_status_expediente','=',23)
                ->get();
    return (isset($trazabilidadID[0]))?$trazabilidadID[0]->id_trazabilidad:self::updateTrazabilidad($id_expediente, $id_unidad);
  }

  static function updateTrazabilidad($id_expediente, $id_unidad){
    DB::table('fa_trazabilidad')
            ->where('id_expediente', $id_expediente)
            ->update([
                'cat_status_expediente' => 24
            ]);
    return self::insertTrazabilidad($id_expediente, $id_unidad);
  }

  static function insertTrazabilidad($id_expediente, $id_unidad){
    $id_trazabilidad = DB::table('fa_trazabilidad')->insertGetId(
        [
            'id_expediente' => $id_expediente,
            'id_unidad' => $id_unidad,
            'fecha_registro' => date("Y-m-d H:i:s"),
            'cat_status_expediente' => 23,
            'user_alta' => 1,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    return $id_trazabilidad;
  }

  static function actualizaVictimas($id_expediente, $expediente){

    $num_victimas = count($expediente['Victimas']);
    //se esta recibiendo actualmnte en el servicio una sola victima, en caso de recibir mas
    //se cambia la regla de negocio y se altera $url_token por un arreglo para procesarlo
    for ($i = 0; $i < $num_victimas; $i++) {

        //existe victima?
        $victima_exist[$i] = array();
        $victima_exist[$i] = DB::table('fa_victimas')
                              ->select('id_victima')
                              ->where('id_expediente','=',$id_expediente)
                              ->where('cat_status_victima','=',25)
                              ->where('idvictima','=',$expediente['Victimas'][$i]['idvictima'])
                              ->get();

        $existe_victima = isset($victima_exist[$i][0])?true:false;

        //la victima ya existe...
        if($existe_victima == true){
          //hay cambios en os datos capturados de la victima?
          $id_victimax[$i] = array();
          $id_victimax[$i] = DB::table('fa_victimas')
                      ->select('id_victima')
                      ->where('id_expediente','=',$id_expediente)
                      ->where('idvictima','=',$expediente['Victimas'][$i]['idvictima'])
                      ->where('nombreVictima','=',$expediente['Victimas'][$i]['nombreVictima'])
                      ->where('sexo','=',$expediente['Victimas'][$i]['sexo'])
                      ->where('genero','=',$expediente['Victimas'][$i]['genero'])
                      ->where('edad','=',$expediente['Victimas'][$i]['edad'])
                      ->where('cat_status_victima','=',25)
                      ->get();

          $victima_cambio = isset($id_victimax[$i][0])?false:true;

          // si existen cambios se setea como archivada y se inserta nuevamente la victima
          if($victima_cambio == true){
            $id_victima = self::updateVictima($id_expediente, $expediente['Victimas'][$i], $victima_exist[$i][0]->id_victima);
          }else{
            $id_victima = $victima_exist[$i][0]->id_victima;
          }

        }else{
          // la victima no existe (tiene cambioss) y se inserta
          $id_victima = self::insertVictima($id_expediente, $expediente['Victimas'][$i]);
        }
    }
    return $id_victima;
  }

  static function updateVictima($id_expediente, $expediente, $id_victima){
    DB::table('fa_victimas')
            ->where('id_victima', $id_victima)
            ->update([
                'cat_status_victima' => 26
            ]);
    $id_victima = self::insertVictima($id_expediente, $expediente);
    return $id_victima;
  }

  static function insertVictima($id_expediente, $expediente){

      $id_victima = DB::table('fa_victimas')->insertGetId(
          [
            'id_expediente' => $id_expediente,
            'idvictima' => $expediente['idvictima'],
            'nombreVictima' => $expediente['nombreVictima'],
            //'nombre' => $expediente['nombre'],
            //'apellidoPat' => $expediente['apellidoPat'],
            //'apellidoMat' => $expediente['apellidoMat'],
            'sexo' => $expediente['sexo'],
            'genero' => $expediente['genero'],
            'edad' => $expediente['edad'],
            'cat_status_victima' => 25,
            'user_alta' => 1,
            'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );
    return $id_victima;
  }

  static function insertVictimas($id_expediente, $expediente){
    $num_victimas = count($expediente['Victimas']);
    //se esta recibiendo actualmnte en el servicio una sola victima, en caso de recibir mas
    //se cambia la regla de negocio y se altera $url_token por un arreglo para procesarlo
    // $id_victima cambia a array
    for ($i = 0; $i < $num_victimas; $i++) {
      $id_victima = self::insertVictima($id_expediente, $expediente['Victimas'][$i]);
    }
    return $id_victima;
  }

  static function obtener_folio($expediente){
    $result = Expediente::where('folio', '=', $expediente)
              ->select('id_expediente')
              ->get();
    return (isset($result[0]))?$result[0]->id_expediente:false;
  }

  static function insertar_expediente($expediente,$control){
    $id_expediente = DB::table('fa_expediente')->insertGetId(
        [
            'folio' => $expediente,
            'control' => $control,
            'user_alta' => 1,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    return $id_expediente;
  }

  static function getUnidadID($expediente){
    $unidadID = DB::table('fa_unidad')
                ->select('id_unidad')
                ->where('cvefiscalia','=',$expediente['empleadoFiscalia'])
                ->where('cveagencia','=',$expediente['empleadoAgencia'])
                ->where('cveunidad','=',$expediente['empleadoUnidad'])
                ->get();
    $id_unidad = (isset($unidadID[0]))?$unidadID[0]->id_unidad:false;
    return $id_unidad;
  }

  static function actualizaDelitos($id_expediente, $expediente){

    $numdelitos = count($expediente['Delitos']);
    for ($i = 0; $i < $numdelitos; $i++) {

        //existe el delito?
        $delito_exist[$i] = array();
        $delito_exist[$i] = DB::table('fa_delitos')
                              ->select('id_delito')
                              ->where('id_expediente','=',$id_expediente)
                              ->where('cvedelito','=',$expediente['Delitos'][$i]['cvedelito'])
                              ->where('cat_status_delito','=',27)
                              ->get();

        $existe_delito = isset($delito_exist[$i][0])?true:false;

        //el delito ya existe...
        if($existe_delito == true){
          //hay cambios en os datos capturados de la victima?
          $id_delito[$i] = array();
          $id_delito[$i] = DB::table('fa_delitos')
                      ->select('id_delito')
                      ->where('id_expediente','=',$id_expediente)
                      ->where('cvedelito','=',$expediente['Delitos'][$i]['cvedelito'])
                      ->where('descdelito','=',$expediente['Delitos'][$i]['descdelito'])
                      ->where('cvemodalidad','=',$expediente['Delitos'][$i]['cvemodalidad'])
                      ->where('descmodalidad','=',$expediente['Delitos'][$i]['descmodalidad'])
                      ->where('cat_status_delito','=',27)
                      ->get();

          $delito_cambio = isset($id_delito[$i][0])?false:true;

          // si existen cambios se setea como archivado y se inserta nuevamente el delito
          if($delito_cambio == true){
            self::updateDelito($id_expediente, $expediente['Delitos'][$i], $delito_exist[$i][0]->id_delito);
          }

        }else{
        // el delito no existe y se inserta
          self::insertDelito($id_expediente, $expediente['Delitos'][$i]);
        }
    }
    return true;
  }

  static function insertDelito($id_expediente, $expediente){
      $id_delito = DB::table('fa_delitos')->insertGetId(
          [
              'id_expediente' => $id_expediente,
              'cvedelito' => $expediente['cvedelito'],
              'descdelito' => $expediente['descdelito'],
              'cvemodalidad' => $expediente['cvemodalidad'],
              'descmodalidad' => $expediente['descmodalidad'],
              'cat_status_delito' => 27,
              'user_alta' => 1,
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );
    return true;
  }

  static function insertDelitos($id_expediente, $expediente){
    $numdelitos = count($expediente['Delitos']);
    for ($i = 0; $i < $numdelitos; $i++) {
      self::insertDelito($id_expediente, $expediente['Delitos'][$i]);
    }
    return true;
  }

  static function updateDelito($id_expediente, $expediente, $id_delito){
    DB::table('fa_delitos')
            ->where('id_delito', $id_delito)
            ->update([
                'cat_status_delito' => 28
            ]);
    self::insertDelito($id_expediente, $expediente);
    return true;
  }

}
