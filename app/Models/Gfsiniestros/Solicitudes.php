<?php

namespace App\Models\Gfsiniestros;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Solicitudes extends Model
{
  protected $table = 'AS_Solicitudes';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function contarFaltantes($id_solicitud){
    $incompletos = DB::table('AS_DatosBeneficiario as dbf')
              ->select(	'dbf.cat_status_print' )
              ->join('AS_Beneficiarios as ben','dbf.id_beneficiario', '=', 'ben.id')
              ->where('dbf.cat_status_print', '=', 101)
              ->where('ben.id_solicitud', '=', $id_solicitud)
              ->get();
    return count($incompletos);
  }
  static function getMessages($id_solicitud){
    $mensajes = DB::table('AS_Crm as crm')
              ->select(	'usr.nombres', 	'usr.apellido_paterno',	'usr.apellido_materno', 	'cat.etiqueta', 	'crm.fecha_alta', 	'crm.mensaje', 	'ucg.avatar', 	'cat.valor' )
              ->join('fw_usuarios AS usr','crm.id_usuario', '=', 'usr.id_usuario')
              ->join('cm_catalogo AS cat','crm.cat_status_crm', '=', 'cat.id_cat')
              ->join('fw_usuarios_config AS ucg','usr.id_usuario', '=', 'ucg.id_usuario')
              ->where('crm.id_solicitud', '=', $id_solicitud)
              ->get();
    return $mensajes;
  }
  static function add_mensaje($request){
      $insert_time = date("Y-m-d H:i:s");
      $id = DB::table('AS_Crm')->insertGetId(
          [
              'id_solicitud' => $request->input('id_solicitud'),
              'id_usuario' => $_SESSION['id_usuario'],
              'mensaje' => $request->input('mensaje'),
              'cat_status_crm' => 97,
              'fecha_alta' => $insert_time
          ]
      );
      $mensajes = DB::table('AS_Crm as crm')
                ->select('usr.nombres', 	'usr.apellido_paterno',	'usr.apellido_materno', 	'cat.etiqueta', 	'crm.fecha_alta', 	'crm.mensaje', 	'ucg.avatar', 	'cat.valor' )
                ->join('fw_usuarios AS usr','crm.id_usuario', '=', 'usr.id_usuario')
                ->join('cm_catalogo AS cat','crm.cat_status_crm', '=', 'cat.id_cat')
                ->join('fw_usuarios_config AS ucg','usr.id_usuario', '=', 'ucg.id_usuario')
                ->where('crm.id', '=', $id)
                ->get();
      $avatar_usr_circ = (isset($mensajes[0]->avatar)) ?'tmp/'.Helpme::duplicatePublic($mensajes[0]->avatar,'perfiles'):'img/avatar.jpg';
      $datos = [
          'mensaje' => $mensajes[0]->mensaje,
          'usuario' => $mensajes[0]->nombres.' '.$mensajes[0]->apellido_paterno.' '.$mensajes[0]->apellido_materno,
          'insert_time' => $mensajes[0]->fecha_alta,
          'status_crm' => $mensajes[0]->etiqueta,
          'image' => $avatar_usr_circ,
          'class' => $mensajes[0]->valor  //success, brand, info

      ];
      return $datos;

  }

  static function getAll(){
    return Solicitudes::all();
  }

  static function asegurado($id_solicitud){
    $asegurado = DB::table('AS_Asegurado as asa')
              ->select('asa.*' )
              ->where('asa.id_solicitud', '=', $id_solicitud)
              ->get();
    if(isset($asegurado[0])){
      return $asegurado[0];
    }else{
      return null;
    }
  }

  static function fallecido($id_solicitud){
    $fallecido = DB::table('AS_Fallecido as asf')
              ->select('asf.*' )
              ->where('asf.id_solicitud', '=', $id_solicitud)
              ->get();
        if(isset($fallecido[0])){
          return $fallecido[0];
        }else{
          return null;
        }
  }

  static function estado_pais($id){
    $edipais = DB::table('AS_Estado_pais as asep')
              ->select('asep.*' )
              ->where('asep.id', '=', $id)
              ->get();
        if(isset($edipais[0])){
          $datos = [
              'id_estado' => $edipais[0]->id_estado,
              'id_pais' => $edipais[0]->id_pais,
              'id_ciudad' => $edipais[0]->id_ciudad,
              'id' => $edipais[0]->id
          ];
          return $datos;
        }else{
          $datos = [
              'id_estado' => null,
              'id_pais' => null,
              'id_ciudad' => null,
              'id' => 141
          ];
          return $datos;
        }
  }

  static function recuperar($id_solicitud){
    return Solicitudes::find($id_solicitud);
  }

  static function polizaData($id_poliza){
    $poliza = DB::table('AS_Polizas as asp')
              ->select('asp.*' )
              ->where('asp.id', '=', $id_poliza)
              ->get();
    return  $poliza[0];
  }

  static function solicitudGet($id_solicitud){
    $solicitud = DB::table('AS_Solicitudes as ass')
              ->join('AS_Polizas as asp','asp.id','=','ass.id_poliza')
              ->join('cm_catalogo as cat','cat.id_cat','=','ass.cat_forma_pago')
              ->select('ass.id as id_solicitud','asp.RFC','asp.Nombre', 'asp.Paterno', 'asp.Materno', 'ass.cat_forma_pago', 'cat.etiqueta','esTitular', 'num_beneficiarios' )
              ->where('ass.id', '=', $id_solicitud)
              ->get();
    return  $solicitud;
  }

  static function update_document_sol($id_solicitud,$file,$doc){
    $solicitud = self::recuperar($id_solicitud);
    $doc_actual = $solicitud[$doc];

      if($doc_actual){ unlink('../storage/documentos/'.$doc_actual);  }

      DB::table('AS_Solicitudes')
      ->where('id', $id_solicitud)
      ->update([
          $doc=> $file
      ]);
      return array('resp' => true);
  }


  static function titular($id_solicitud){

    $titular = DB::table('AS_Solicitudes as ass')
              ->join('AS_Polizas as asp','asp.id','=','ass.id_poliza')
              ->select('asp.Nombre', 'asp.Paterno', 'asp.Materno')
              ->where('ass.id', '=', $id_solicitud)
              ->get();

    return $titular[0]->Nombre.' '.$titular[0]->Paterno.' '.$titular[0]->Materno;

  }

  static function datos_asegurado($request){

    $id_ciudad_lugar_nacimiento = DB::table('AS_Estado_pais')->insertGetId(
        [
            'id_estado' => $request->input('entidad_as'),
            'id_ciudad' => $request->input('ciudad_nac'),
            'id_pais' => $request->input('pais_as')
        ]
    );
    $asegurado = DB::table('AS_Asegurado')
            ->where('id_solicitud', $request->input('id_solicitud'))
            ->update([
                'id_domicilio_cuando_fallecio' => $request->input('id_dom_1'),
                'id_ciudad_lugar_nacimiento' => $id_ciudad_lugar_nacimiento,
                'id_domicilio_empresa' => $request->input('id_dom_2'),
                'id_nacionalidad' => $request->input('nacionalidades'),
                'no_polizas' => $request->input('no_polizas'),
                'tipo_seguro' => $request->input('tipo_seguro'),
                'grupo_y_colectivo' => $request->input('grupo_y_colectivo'),
                'no_certificado' => $request->input('no_certificado'),
                'curp' => $request->input('curp'),
                'cat_status_print' => 102,
                'afiliacion_imss_issste' => $request->input('afiliacion_imss_issste'),
                'id_ocupacion' => $request->input('ocupacion'),
                'empresa_trabajo' => $request->input('empresa_trabajo'),
                'antiguedad_en_empresa' => $request->input('antiguedad_en_empresa'),
                'otras_empresas' => $request->input('otras_empresas')
            ]);
    $id_lugar_fallecimiento = DB::table('AS_Estado_pais')->insertGetId(
        [
            'id_estado' => $request->input('entidad_fall'),
            'id_ciudad' => $request->input('id_lugar'),
            'id_pais' => $request->input('pais_fall')
        ]
    );
    $fallecido = DB::table('AS_Fallecido')
            ->where('id_solicitud', $request->input('id_solicitud'))
            ->update([
                'cat_edificio_fallecimiento' => $request->input('cat_edificio_fallecimiento'),
                'id_lugar_fallecimiento' => $id_lugar_fallecimiento,
                'fecha_fallecimiento' => $request->input('fecha_fallecimiento'),
                'causa_fallecimiento' => $request->input('causa_fallecimiento'),
                'cat_status_print' => 102,
                'agencia_servicio_funerario' => $request->input('agencia_servicio_funerario'),
                'fecha_servicios_funerarios' => $request->input('fecha_servicios_funerarios'),
                'autoridad_tomo_hechos_violentos' => $request->input('autoridad_tomo_hechos_violentos')
            ]);
      $datos = [
          'id_ciudad_lugar_nacimiento' => $id_ciudad_lugar_nacimiento,
          'asegurado' => $asegurado,
          'id_lugar_fallecimiento' => $id_lugar_fallecimiento,
          'fallecido' => $fallecido
      ];
      return $datos;

  }

  static function insertar($request){

    //verificar si ya existe un solicitud para el titular que se quiere ingresar
    //{}


    $titular = (null !== $request->input('titular'))?1:0;
    $benefit = ($titular == 1)?1:$request->input('beneficiarios');
    $id = DB::table('AS_Solicitudes')->insertGetId(
        [
            'id_poliza' => $request->input('id_poliza'),
            'id_usuario' => $_SESSION['id_usuario'],
            'esTitular' => $titular,
            'cat_forma_pago' => $request->input('forma_pago'),
            'num_beneficiarios' => $benefit,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );

    if(null !== $request->input('titular')){ // si solo existe el titular

      $idb = DB::table('AS_Beneficiarios')->insertGetId(
          [
              'id_solicitud' => $id,
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );
      $iddb = DB::table('AS_DatosBeneficiario')->insertGetId(
          [
              'id_beneficiario' => $idb,
              'cat_parentesco' => 88,
              'cat_status_print' => 101,
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );

    }else{
      for($i = 1; $i <= $benefit; $i++){

        $idb = DB::table('AS_Beneficiarios')->insertGetId(
            [
                'id_solicitud' => $id,
                'fecha_alta' => date("Y-m-d H:i:s")
            ]
        );
        $iddb = DB::table('AS_DatosBeneficiario')->insertGetId(
            [
                'id_beneficiario' => $idb,
                'cat_parentesco' => 88,
                'cat_status_print' => 101,
                'fecha_alta' => date("Y-m-d H:i:s")
            ]
        );

      }

    }

    $ida = DB::table('AS_Asegurado')->insertGetId(
        [
            'id_solicitud' => $id,
            'id_domicilio_empresa' => 1,
            'cat_status_print' => 101,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );

    $idf = DB::table('AS_Fallecido')->insertGetId(
        [
            'id_solicitud' => $id,
            'cat_status_print' => 101,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );



    $datos = [
        'success' => true,
        'id' => $id,
        'titular' => $request->input('titular')
    ];
    return $datos;
  }

}
