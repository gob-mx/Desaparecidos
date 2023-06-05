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

  static function aseguradoFullData($id_solicitud){

    $asegurado = DB::table('AS_Solicitudes AS ass')
              ->join('AS_Asegurado AS asa', 'ass.id', '=', 'asa.id_solicitud')
              ->join('AS_Polizas AS asp', 'ass.id_poliza', '=', 'asp.id')
              ->join('AS_Fallecido AS asf', 'ass.id', '=', 'asf.id_solicitud')
              ->join('cm_catalogo AS cat_edif_fall', 'asf.cat_edificio_fallecimiento', '=', 'cat_edif_fall.id_cat')
              ->join('AS_Estado_pais AS lugar_fall', 'asf.id_lugar_fallecimiento', '=', 'lugar_fall.id')
              ->join('AS_Direcciones AS dir_dom', 'asa.id_domicilio_cuando_fallecio', '=', 'dir_dom.id')
              ->join('AS_Direcciones AS dir_emp', 'asa.id_domicilio_empresa', '=', 'dir_emp.id')
              ->join('SPM_CP AS cp_dom', 'dir_dom.id_cp', '=', 'cp_dom.id')
              ->join('SPM_CP AS cp_emp', 'dir_emp.id', '=', 'cp_emp.id')
              ->join('AS_Estado_pais AS lugar_nac', 'asa.id_ciudad_lugar_nacimiento', '=', 'lugar_nac.id')
              ->join('SPM_ciudades AS cty_dom', 'cp_dom.id_ciudad', '=', 'cty_dom.id')
              ->join('SPM_estados AS edo_dom', 'cp_dom.id_estado', '=', 'edo_dom.id')
              ->join('SPM_municipios AS mun_dom', 'cp_dom.id_municipio', '=', 'mun_dom.id')
              ->join('SPM_ciudades AS cty_emp', 'cp_emp.id_ciudad', '=', 'cty_emp.id')
              ->join('SPM_estados AS edo_emp', 'cp_emp.id_estado', '=', 'edo_emp.id')
              ->join('SPM_municipios AS mun_emp', 'cp_emp.id_municipio', '=', 'mun_emp.id')
              ->join('CAT_Nacionalidad AS cat_nacionalidad', 'asa.id_nacionalidad', '=', 'cat_nacionalidad.id')
              ->join('CAT_Ocupaciones AS cat_ocupaciones', 'asa.id_ocupacion', '=', 'cat_ocupaciones.id')
              ->join('cm_catalogo AS tipo_seguro', 'asa.cat_tipo_seguro', '=', 'tipo_seguro.id_cat')
              ->select('asp.FechaNac', 'asp.RFC', 'asa.telefono', 'asp.Paterno', 'asp.Materno', 'asp.Nombre', 'asa.otras_empresas','asa.antiguedad_en_empresa', 'asa.empresa_trabajo', 'asa.afiliacion_imss_issste', 'asa.curp', 'asa.no_certificado', 'asa.grupo_y_colectivo', 'asa.no_polizas', 'asf.fecha_fallecimiento', 'asf.causa_fallecimiento', 'asf.agencia_servicio_funerario', 'asf.fecha_servicios_funerarios', 'asf.autoridad_tomo_hechos_violentos AS violento', 'cat_edif_fall.etiqueta AS edificio_fallecimiento', 'dir_dom.calle AS dom_calle', 'dir_dom.num_ext AS dom_num_ext', 'dir_dom.num_int AS dom_num_int', 'cp_dom.codigo_postal AS dom_cp', 'cp_dom.asentamiento AS dom_asenta', 'cty_dom.ciudad AS dom_cty', 'edo_dom.estado AS dom_edo', 'mun_dom.municipio AS dom_mun', 'dir_emp.calle AS emp_calle', 'dir_emp.num_ext AS emp_num_ext', 'dir_emp.num_int AS emp_num_int', 'cp_emp.codigo_postal AS emp_cp', 'cp_emp.asentamiento AS emp_asenta', 'cty_emp.ciudad AS emp_cty', 'edo_emp.estado AS emp_edo', 'mun_emp.municipio AS emp_mun', 'lugar_fall.id_pais AS pais_fall', 'lugar_nac.id_pais AS pais_nac', 'cat_nacionalidad.Nacionalidad', 'cat_ocupaciones.ocupacion', 'tipo_seguro.etiqueta AS tipo_seguro', 'lugar_nac.id AS nac_id', 'lugar_fall.id AS fal_id')
              ->where('ass.id', '=', $id_solicitud)
              ->get();
    return $asegurado[0];

  }

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

  static function getLugar($id, $tabla){
      $lugar = DB::table('AS_Estado_pais as ep')
              ->select('ep.id')
              ->where('ep.id_relacionado', '=', $id)
              ->where('ep.tabla_relacionada', '=', $tabla)
              ->first();
      if(isset($lugar->id)){
        return $lugar->id;
      }else{
        return false;
      }
  }

  static function datos_asegurado($request){

    $existe_lugar_nac = self::getLugar($request->input('id_solicitud'), 'AS_Asegurado');
    if($existe_lugar_nac == false){
      $id_ciudad_lugar_nacimiento = DB::table('AS_Estado_pais')->insertGetId(
          [
              'id_estado' => $request->input('entidad_as'),
              'id_ciudad' => $request->input('ciudad_nac'),
              'id_pais' => $request->input('pais_as'),
              'id_relacionado' => $request->input('id_solicitud'),
              'tabla_relacionada' => 'AS_Asegurado'
          ]
      );
    }else{
          DB::table('AS_Estado_pais')
          ->where('id', $existe_lugar_nac)
          ->update([
              'id_estado' => $request->input('entidad_as'),
              'id_ciudad' => $request->input('ciudad_nac'),
              'id_pais' => $request->input('pais_as')
          ]);
      $id_ciudad_lugar_nacimiento = $existe_lugar_nac;
    }
    $asegurado = DB::table('AS_Asegurado')
            ->where('id_solicitud', $request->input('id_solicitud'))
            ->update([
                'id_domicilio_cuando_fallecio' => $request->input('id_dom_1'),
                'id_ciudad_lugar_nacimiento' => $id_ciudad_lugar_nacimiento,
                'id_domicilio_empresa' => $request->input('id_dom_2'),
                'id_nacionalidad' => $request->input('nacionalidades'),
                'no_polizas' => $request->input('no_polizas'),
                'cat_tipo_seguro' => $request->input('tipo_seguro'),
                'grupo_y_colectivo' => $request->input('grupo_y_colectivo'),
                'no_certificado' => $request->input('no_certificado'),
                'telefono' => $request->input('telefono'),
                'curp' => $request->input('curp'),
                'cat_status_print' => 102,
                'afiliacion_imss_issste' => $request->input('afiliacion_imss_issste'),
                'id_ocupacion' => $request->input('ocupacion'),
                'empresa_trabajo' => $request->input('empresa_trabajo'),
                'antiguedad_en_empresa' => $request->input('antiguedad_en_empresa'),
                'otras_empresas' => $request->input('otras_empresas')
            ]);
    $existe_lugar_fal = self::getLugar($request->input('id_solicitud'), 'AS_Fallecido');
    if($existe_lugar_fal == false){
    $id_lugar_fallecimiento = DB::table('AS_Estado_pais')->insertGetId(
          [
              'id_estado' => $request->input('entidad_fall'),
              'id_ciudad' => $request->input('id_lugar'),
              'id_pais' => $request->input('pais_fall'),
              'id_relacionado' => $request->input('id_solicitud'),
              'tabla_relacionada' => 'AS_Fallecido'
          ]
      );
    }else{
          DB::table('AS_Estado_pais')
          ->where('id', $existe_lugar_fal)
          ->update([
              'id_estado' => $request->input('entidad_fall'),
              'id_ciudad' => $request->input('id_lugar'),
              'id_pais' => $request->input('pais_fall')
          ]);
      $id_lugar_fallecimiento = $existe_lugar_fal;
    }
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

  static function polizaData($id_poliza){
    $poliza = DB::table('AS_Polizas as asp')
              ->select('asp.*' )
              ->where('asp.id', '=', $id_poliza)
              ->get();
    return  $poliza[0];
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
      $poliza = self::polizaData($request->input('id_poliza'));
      $iddb = DB::table('AS_DatosBeneficiario')->insertGetId(
          [
              'id_beneficiario' => $idb,
              'cat_parentesco' => 88,
              'cat_status_print' => 101,
              'ap_paterno' => $poliza->Paterno,
              'ap_materno' => $poliza->Materno,
              'nombres' => $poliza->Nombre,
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );

    }else{ // si el beneficiario no es el titular
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

  static function repetido($id){
      $solicitud = DB::table('AS_Solicitudes as ass')
                ->select('ass.*')
                ->where('ass.id_poliza', '=', $id)
                ->get();
      if(count($solicitud) >= 1){
        return true;
      }else{
        return false;
      }
  }

}
