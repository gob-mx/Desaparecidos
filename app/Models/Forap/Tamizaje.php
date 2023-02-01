<?php
namespace App\Models\Forap;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Tamizaje extends Model
{
  protected $table = 'fa_evaluacion';
  protected $primaryKey = 'id_evaluacion';
  public $timestamps = false;

  static function violenciaMujeresGet(){
    $dataTable = new DT(
      Tamizaje::where('id_examen', '=', 1),['id_evaluacion', 'id_expediente']
    );
    return $dataTable->make();
  }

  static function getStatus($id_evaluacion){
    return Tamizaje::where('id_evaluacion', $id_evaluacion)->first();
  }


  static function obtener_delito($id_delito){
    $result = DB::table('fa_delitos')
                ->select('descdelito')
                ->where('id_delito','=',$id_delito)
                ->get();
    return $result[0]->descdelito;
  }

  static function obtener_array_eva_react($id_reactivo){
    $result = DB::table('fa_eva_react')
                ->select('campo_unico')
                ->where('id_reactivo','=',$id_reactivo)
                ->get();
    $json = $result[0]->campo_unico;
    return json_decode($json);
  }

  static function obtener_options($id_evaluacion){
    $result = DB::table('fa_evaluacion as fae')
                ->join('fa_eva_opc AS faeo', 'fae.id_evaluacion', '=', 'faeo.id_evaluacion')
                ->join('fa_reactivos AS far', 'faeo.id_reactivo', '=', 'far.id_reactivo')
                ->join('fa_opciones AS fao', 'faeo.id_opcion', '=', 'fao.id_opcion')
                ->select(	'far.reactivo', 'faeo.id_reactivo', 'far.valor as val_react', 	'fao.nombre', 	'faeo.id_opcion', 	'fao.valor as val_opc')
                ->where('faeo.multi_o_single','=','Single')
                ->where('fae.id_evaluacion','=',$id_evaluacion)
                ->get();
    $array = [];
    foreach($result as $clave => $valor){
      $array[$valor->id_reactivo] = array(
                                    "reactivo" => $valor->reactivo,
                                    "id_reactivo" => $valor->id_reactivo,
                                    "val_react" => $valor->val_react,
                                    "nombre" => $valor->nombre,
                                    "id_opcion" => $valor->id_opcion,
                                    "val_opc" => $valor->val_opc,
                                  );
    }
    return $array;
  }

  static function obtener_checkbox($id_evaluacion){
    $result = DB::table('fa_evaluacion as fae')
                ->join('fa_eva_opc AS faeo', 'fae.id_evaluacion', '=', 'faeo.id_evaluacion')
                ->join('fa_reactivos AS far', 'faeo.id_reactivo', '=', 'far.id_reactivo')
                ->join('fa_opciones AS fao', 'faeo.id_opcion', '=', 'fao.id_opcion')
                ->select(	'far.reactivo', 'faeo.id_reactivo', 'far.valor as val_react', 	'fao.nombre', 	'faeo.id_opcion', 	'fao.valor as val_opc')
                ->where('faeo.multi_o_single','=','Multi')
                ->where('fae.id_evaluacion','=',$id_evaluacion)
                ->get();
    $array = [];
    foreach($result as $clave => $valor){
      $array[$valor->id_reactivo][$valor->id_opcion] = array(
                                    "reactivo" => $valor->reactivo,
                                    "id_reactivo" => $valor->id_reactivo,
                                    "val_react" => $valor->val_react,
                                    "nombre" => $valor->nombre,
                                    "id_opcion" => $valor->id_opcion,
                                    "val_opc" => $valor->val_opc,
                                  );
    }
    return $array;
  }

  static function obtener_reactivos($id_evaluacion){
    $result = DB::table('fa_evaluacion as fae')
                ->join('fa_eva_react AS faer', 'fae.id_evaluacion', '=', 'faer.id_evaluacion')
                ->join('fa_reactivos AS far', 'faer.id_reactivo', '=', 'far.id_reactivo')
                ->select(	'far.reactivo', 'faer.campo_unico', 'far.valor', 'far.id_reactivo', 'faer.id_eva_react')
                ->where('fae.id_evaluacion','=',$id_evaluacion)
                ->get();
    $array = [];
    foreach($result as $clave => $valor){
      $array[$valor->id_reactivo] = array(
                                    "reactivo" => $valor->reactivo,
                                    "campo_unico" => $valor->campo_unico,
                                    "valor" => $valor->valor,
                                    "id_reactivo" => $valor->id_reactivo,
                                    "id_eva_react" => $valor->id_eva_react
                                  );
    }
    $i = base64_encode($array[41]['campo_unico']);
    //dd(base64_decode($i));
    //dd($i);
    return $array;
  }

  static function actualizar_estado_evaluacion($id_evaluacion, $status){
      $eva_opc = DB::table('fa_evaluacion')
                ->where('id_evaluacion', $id_evaluacion)
                ->update(['cat_status_evaluacion' => $status]);
  }

  static function riesgo($id_evaluacion){
      $total = DB::table('fa_evaluacion')
                ->join('fa_eva_opc', 'fa_evaluacion.id_evaluacion', '=', 'fa_eva_opc.id_evaluacion')
                ->join('fa_opciones', 'fa_eva_opc.id_opcion', '=', 'fa_opciones.id_opcion')
                ->where('fa_evaluacion.id_evaluacion', $id_evaluacion)
                ->sum('fa_opciones.valor');
      return $total;
  }

  static function agregar_options($data){
    $eva_opc = DB::table('fa_eva_opc')
              ->where('id_evaluacion', $data['id_evaluacion'])
              ->where('id_reactivo', $data['clave'])
              ->first();
    if(isset($eva_opc)){
      $eva_opc = DB::table('fa_eva_opc')
                ->where('id_eva_opc', $eva_opc->id_eva_opc)
                ->update(['id_opcion' => $data['valor']]);
    }else{
      $id_eva_opc = DB::table('fa_eva_opc')->insertGetId(
          [
              'id_evaluacion' => $data['id_evaluacion'],
              'id_reactivo' => $data['clave'],
              'id_opcion' => $data['valor'],
              'multi_o_single' => 'Single',
              'user_alta' => 1,
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );
    }
  }
  static function agregar_checkbox($data){
    foreach($data['valor'] as $val){
      $eva_opc = DB::table('fa_eva_opc')
                ->where('id_evaluacion', $data['id_evaluacion'])
                ->where('id_reactivo', $data['clave'])
                ->where('id_opcion', $val)
                ->first();
      if(!isset($eva_opc)){
        $id_eva_opc = DB::table('fa_eva_opc')->insertGetId(
            [
                'id_evaluacion' => $data['id_evaluacion'],
                'id_reactivo' => $data['clave'],
                'id_opcion' => $val,
                'multi_o_single' => 'Multi',
                'user_alta' => 1,
                'fecha_alta' => date("Y-m-d H:i:s")
            ]
        );
      }
    }
    $eva_opc_chk = DB::table('fa_eva_opc')
              ->select('id_eva_opc','id_opcion')
              ->where('id_evaluacion', $data['id_evaluacion'])
              ->where('id_reactivo', $data['clave'])
              ->get();
    foreach($eva_opc_chk as $val){
      if(!in_array($val->id_opcion,$data['valor'])){
        DB::table('fa_eva_opc')->where('id_eva_opc', $val->id_eva_opc)->delete();
      }
    }
  }



  static function agregar_reactivos($data, $arreglos){
    $valor = (in_array($data['clave'], $arreglos))?json_encode($data['valor']):$data['valor'];
    $eva_react = DB::table('fa_eva_react')
              ->where('id_evaluacion', $data['id_evaluacion'])
              ->where('id_reactivo', $data['clave'])
              ->first();
    if(isset($eva_react)){
      DB::table('fa_eva_react')->where('id_eva_react', $eva_react->id_eva_react)->update(['campo_unico' => $valor]);
    }else{
      $id_eva_react = DB::table('fa_eva_react')->insertGetId(
          [
              'id_evaluacion' => $data['id_evaluacion'],
              'id_reactivo' => $data['clave'],
              'campo_unico' => $valor,
              'user_alta' => 1,
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );
    }
  }
  static function determinar_evaluacion($data){

    $dato = DB::table('fa_evaluacion')
              ->where('id_expediente', $data['id_expediente'])
              ->where('id_entrevistado', $data['id_entrevistado'])
              ->where('id_examen', $data['id_examen'])
              ->orderBy('id_expediente', 'asc')
              ->first();
    $result = (isset($dato->id_evaluacion))?['id_evaluacion' => $dato->id_evaluacion,'cat_status_evaluacion' => $dato->cat_status_evaluacion]:self::agregar_evaluacion($data);
    return $result;
  }

  static function agregar_evaluacion($data){
    $id_evaluacion = DB::table('fa_evaluacion')->insertGetId(
        [
            'id_expediente' => $data['id_expediente'],
            'id_entrevistado' => $data['id_entrevistado'],
            'id_aplicador' => $data['id_aplicador'],
            'id_examen' => $data['id_examen'],
            'cat_status_evaluacion' => 40,
            'user_alta' => 1,
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    $datos = [
        'id_evaluacion' => $id_evaluacion,
        'cat_status_evaluacion' => 40
    ];
    return $datos;
  }

  static function getToken($tokenFSIAP){
    $data = DB::table('fa_tokens as fat')
              ->join('fa_remoteUser AS far', 'far.id_remoteUser', '=', 'fat.id_remoteUser')
              ->select('fat.id_expediente','fat.id_victima','far.id_usuario')
              ->where('fat.tokenFSIAP', '=', $tokenFSIAP)
              ->get();
    return $data;
  }
  static function getEvaluacion($id_expediente, $id_entrevistado){
    $data = DB::table('fa_evaluacion as fae')
              ->join('cm_catalogo AS cat', 'fae.cat_status_evaluacion', '=', 'cat.id_cat')
              ->select('fae.id_evaluacion', 'cat.etiqueta')
              ->where('fae.id_expediente', '=', $id_expediente)
              ->where('fae.id_entrevistado', '=', $id_entrevistado)
              ->get();
    return $data;
  }
  static function data_tamizaje($token){
    $data = DB::table('fa_tokens as fat')
              ->join('fa_remoteUser AS far', 'far.id_remoteUser', '=', 'fat.id_remoteUser')
              ->join('fa_unidad AS fau', 'fat.id_unidad', '=', 'fau.id_unidad')
              ->join('fa_agencia AS faa', 'fau.id_agencia', '=', 'faa.id_agencia')
              ->join('fa_fiscalia AS faf', 'faa.id_fiscalia', '=', 'faf.id_fiscalia')
              ->join('fa_expediente AS fae', 'fat.id_expediente', '=', 'fae.id_expediente')
              ->join('fa_victimas AS fav', 'fat.id_victima', '=', 'fav.id_victima')
              ->select('fat.id_expediente','fat.id_victima','fat.id_remoteUser','fav.nombreVictima', 'fae.folio', 'far.nombreEmpleado', 'faf.id_fiscalia', 'faa.id_agencia', 'fau.id_unidad', 'faf.descfiscalia', 'faa.desc_agencia', 'fau.desc_unidad', 'fav.edad' )
              ->where('fat.url_token', '=', $token)
              ->get();

    $delitos = DB::table('fa_tokens as fat')
              ->join('fa_expediente AS fae', 'fat.id_expediente', '=', 'fae.id_expediente')
              ->join('fa_delitos AS fad', 'fae.id_expediente', '=', 'fad.id_expediente')
              ->select('fad.id_delito', 'fad.descdelito')
              ->where('fat.url_token', '=', $token)
              ->get();

    $reactivo = DB::table('fa_examen as fae')
              ->Join('fa_reactivos AS far', 'fae.id_examen', '=', 'far.id_examen')
              ->leftJoin('fa_opciones AS fao', 'far.id_reactivo', '=', 'fao.id_reactivo')
              ->select(
                'fae.id_examen',
                'fae.nombre AS name_exam',
                'far.reactivo',
                'far.ayuda AS react_ayuda',
                'far.id_reactivo AS react_id_reactivo',
                'fao.id_opcion AS opc_id_opcion',
                'far.valor AS react_valor',
                'fao.nombre AS opc_nombre',
                'fao.ayuda AS opc_ayuda',
                'fao.valor AS opc_valor',
                'far.grupo',
                'far.subgrupo'
                )
              ->where('fae.id_examen', '=', 1)
              ->orderBy('react_id_reactivo', 'asc')
              ->orderBy('opc_id_opcion', 'asc')
              ->get();
      $react = [];
      foreach($reactivo as $clave => $valor){
        $val_opc = isset($valor->opc_id_opcion)?$valor->opc_id_opcion:0;
        $react[$valor->react_id_reactivo][$val_opc] = array(
                                      "id_examen" => $valor->id_examen,
                                      "name_exam" => $valor->name_exam,
                                      "reactivo" => $valor->reactivo,
                                      "react_ayuda" => $valor->react_ayuda,
                                      "react_id_reactivo" => $valor->react_id_reactivo,
                                      "opc_id_opcion" => $valor->opc_id_opcion,
                                      "react_valor" => $valor->react_valor,
                                      "opc_nombre" => $valor->opc_nombre,
                                      "opc_ayuda" => $valor->opc_ayuda,
                                      "opc_valor" => $valor->opc_valor,
                                      "grupo" => $valor->grupo,
                                      "subgrupo" => $valor->subgrupo
                                    );
      }

      $delitos_opc = array();
      if(count($delitos)>=1){
        $cont = 0;
        foreach ($delitos as $row) {
          $delitos_opc[$cont]['value']=$row->id_delito;
          $delitos_opc[$cont]['valor']=strtoupper($row->descdelito);
          $cont++;
        }
      }

      $evaluacion = [
          'id_expediente' => $data[0]->id_expediente,
          'id_entrevistado' => $data[0]->id_victima,
          'id_aplicador' => $data[0]->id_remoteUser,
          'id_examen' => 1
      ];

      $data_evaluacion = self::determinar_evaluacion($evaluacion);
      $id_evaluacion = $data_evaluacion['id_evaluacion'];
      $riesgo = self::riesgo($id_evaluacion);
      $cat_status_evaluacion = $data_evaluacion['cat_status_evaluacion'];
      $datos = [
          'generales' => $data[0],
          'quest' => $react,
          'delitos' => $delitos_opc,
          'id_evaluacion' => $id_evaluacion,
          'cat_status_evaluacion' => $cat_status_evaluacion,
          'riesgo' => $riesgo
      ];
    return $datos;
  }

}
