<?php

namespace App\Models\Gfsiniestros;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Beneficiarios extends Model
{
  protected $table = 'AS_Beneficiarios';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function beneficiarioFullData($id_beneficiario){

    $beneficiarios = DB::table('AS_DatosBeneficiario AS dat_ben')
              ->join('AS_Beneficiarios AS ben', 'dat_ben.id_beneficiario', '=', 'ben.id')
              ->join('AS_Direcciones AS dir', 'dat_ben.id_direccion', '=', 'dir.id')
              ->join('SPM_CP AS cp_dir', 'dir.id_cp', '=', 'cp_dir.id')
              ->join('SPM_estados AS edo_dir', 'cp_dir.id_estado', '=', 'edo_dir.id')
              ->join('SPM_ciudades AS ciudad_dir', 'cp_dir.id_ciudad', '=', 'ciudad_dir.id')
              ->join('SPM_municipios AS mun_dir', 'cp_dir.id_municipio', '=', 'mun_dir.id')
              ->join('AS_Estado_pais AS nacimiento', 'dat_ben.id_estado_pais_nac', '=', 'nacimiento.id')
              ->join('CAT_Paises AS pais_rec', 'dat_ben.id_pais_residencia', '=', 'pais_rec.id')
              ->join('CAT_Nacionalidad AS nacionalidad', 'dat_ben.id_nacionalidad', '=', 'nacionalidad.id')
              ->join('CAT_Ocupaciones AS ocupa', 'dat_ben.id_ocupacion', '=', 'ocupa.id')
              ->join('cm_catalogo AS parentesco', 'dat_ben.cat_parentesco', '=', 'parentesco.id_cat')
              ->join('CAT_Bancos AS banco', 'dat_ben.id_banco', '=', 'banco.cve')
              ->join('cm_catalogo AS giro', 'dat_ben.cat_giro_actividad', '=', 'giro.id_cat')
              ->select('dir.calle AS d_calle', 'dir.num_ext AS d_num_ext', 'dir.num_int AS d_num_int', 'cp_dir.codigo_postal AS d_cp', 'cp_dir.asentamiento AS d_asenta', 'edo_dir.estado AS d_estado', 'ciudad_dir.ciudad AS d_ciudad', 'mun_dir.municipio AS d_mun', 'nacimiento.id AS id_nac', 'pais_rec.pais AS pais_rec', 'nacionalidad.Nacionalidad AS nacion','ocupa.ocupacion AS ocupa', 'parentesco.etiqueta AS parent', 'banco.banco AS banco', 'giro.etiqueta AS giro', 'dat_ben.ap_paterno AS paterno', 'dat_ben.ap_materno AS materno', 'dat_ben.nombres AS nombres', 'dat_ben.fecha_nac AS fecha_nac', 'dat_ben.lada_telefono AS tel', 'dat_ben.email AS mail', 'dat_ben.curp AS curp', 'dat_ben.rfc AS rfc', 'dat_ben.serie_e_firma AS efirma','dat_ben.CLABE AS clabe', 'dat_ben.fecha_alta AS fecha_alta', 'ben.id_solicitud AS id_solicitud','nacimiento.id_pais AS pais_nac','nacimiento.id AS id_nac')
              ->where('ben.id', '=', $id_beneficiario)
              ->get();
    return $beneficiarios[0];

  }

  static function getArrayBeneficiarios($id_solicitud){

    $beneficiarios = DB::table('AS_DatosBeneficiario AS adb')
              ->join('AS_Beneficiarios AS asb', 'adb.id_beneficiario', '=', 'asb.id')
              ->select('adb.*')
              ->where('asb.id_solicitud', '=', $id_solicitud)
              ->get();
    return $beneficiarios;

  }

  static function datos_beneficiario($request){

    $id_ciudad_lugar_nacimiento = DB::table('AS_Estado_pais')->insertGetId(
        [
            'id_estado' => $request->input('id_estado_nac'),
            'id_ciudad' => $request->input('ciudad_ben_nac'),
            'id_pais' => $request->input('id_pais_nacimiento')
        ]
    );

    $beneficiario = DB::table('AS_DatosBeneficiario')
            ->where('id_beneficiario', $request->input('id_beneficiario'))
            ->update([
                'id_direccion' => $request->input('id_dom_4'),
                'id_pais_residencia' => $request->input('id_pais_residencia'),
                'id_nacionalidad' => $request->input('id_nacionalidad'),
                'id_ocupacion' => $request->input('ocupacion'),
                'id_estado_pais_nac' => $id_ciudad_lugar_nacimiento,
                'cat_parentesco' => $request->input('parentesco'),
                'id_banco' => $request->input('bank_id'),
                'cat_giro_actividad' => $request->input('giro_actividad'),
                'ap_paterno' => $request->input('ap_paterno'),
                'ap_materno' => $request->input('ap_materno'),
                'cat_status_print' => 102,
                'nombres' => $request->input('nombres'),
                'fecha_nac' => $request->input('fecha_nac'),
                'lada_telefono' => $request->input('lada_telefono'),
                'email' => $request->input('email'),
                'curp' => $request->input('curp'),
                'rfc' => $request->input('rfc'),
                'serie_e_firma' => $request->input('serie_e_firma'),
                'CLABE' => $request->input('CLABE'),
            ]);

    $datos = [
        'beneficiario' => $beneficiario
    ];
    return $datos;
  }

  static function getBankName($id){

    $bank = DB::table('CAT_Bancos as catb')
              ->select('catb.banco')
              ->where('catb.id', '=', $id)
              ->get();
      if(isset($bank[0]->banco)){
        return $bank[0]->banco;
      }else{
        return 'No existe el identificador del banco';
      }

  }

  static function eliminarBeneficiario($id_beneficiario){
    $beneficiario = Beneficiarios::find($id_beneficiario);
    if(is_file('../storage/documentos/'.$beneficiario->poliza_designacion)){unlink('../storage/documentos/'.$beneficiario->poliza_designacion);}
    if(is_file('../storage/documentos/'.$beneficiario->comprobante_domicilio)){unlink('../storage/documentos/'.$beneficiario->comprobante_domicilio);}
    if(is_file('../storage/documentos/'.$beneficiario->comprobante_domicilio_extranjero)){unlink('../storage/documentos/'.$beneficiario->comprobante_domicilio_extranjero);}
    if(is_file('../storage/documentos/'.$beneficiario->ine)){unlink('../storage/documentos/'.$beneficiario->ine);}
    if(is_file('../storage/documentos/'.$beneficiario->fto_pld)){unlink('../storage/documentos/'.$beneficiario->fto_pld);}
    if(is_file('../storage/documentos/'.$beneficiario->fto_transferencia)){unlink('../storage/documentos/'.$beneficiario->fto_transferencia);}
    if(is_file('../storage/documentos/'.$beneficiario->estado_cuenta)){unlink('../storage/documentos/'.$beneficiario->estado_cuenta);}
    if(is_file('../storage/documentos/'.$beneficiario->cedula_fiscal)){unlink('../storage/documentos/'.$beneficiario->cedula_fiscal);}
    if(is_file('../storage/documentos/'.$beneficiario->curp)){unlink('../storage/documentos/'.$beneficiario->curp);}
    if(is_file('../storage/documentos/'.$beneficiario->comprobante_fiel)){unlink('../storage/documentos/'.$beneficiario->comprobante_fiel);}
    $del1 = DB::table('AS_DatosBeneficiario')->where('id_beneficiario','=',$id_beneficiario)->delete();
    $del2 = $beneficiario->delete();
    $count = DB::table('AS_Beneficiarios')->where('id_solicitud','=',$beneficiario->id_solicitud)->count();
    $iddb = DB::table('AS_Solicitudes')->where('id','=',$beneficiario->id_solicitud)->update(['num_beneficiarios' => $count]);
    $datos = [
        'AS_DatosBeneficiario' => $del1,
        'AS_Beneficiarios' => $del2,
        'num_beneficiarios' => $count
    ];
    return $datos;

  }
  static function editBeneficiario($request){

    $iddb = DB::table('AS_DatosBeneficiario')->where('id_beneficiario', $request->input('id_beneficiario'))
        ->update([
            'nombres' => $request->input('nombre'),
            'ap_paterno' => $request->input('paterno'),
            'ap_materno' => $request->input('materno'),
            'cat_parentesco' => $request->input('parentesco')
        ]);

    $datos = [
        'datosbeneficiario' => $iddb
    ];
    return $datos;
  }

  static function addBeneficiario($request){

    $idb = DB::table('AS_Beneficiarios')->insertGetId(
        [
            'id_solicitud' => $request->input('id_solicitud'),
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    $iddb = DB::table('AS_DatosBeneficiario')->insertGetId(
        [
            'id_beneficiario' => $idb,
            'cat_status_print' => 101,
            'nombres' => $request->input('nombre'),
            'ap_paterno' => $request->input('paterno'),
            'ap_materno' => $request->input('materno'),
            'cat_parentesco' => $request->input('parentesco'),
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );
    $count = DB::table('AS_Beneficiarios')->where('id_solicitud','=',$request->input('id_solicitud'))->count();
    $iddb = DB::table('AS_Solicitudes')->where('id','=',$request->input('id_solicitud'))->update(['num_beneficiarios' => $count]);

    $datos = [
        'beneficiario' => $idb,
        'datosbeneficiario' => $iddb,
        'num_beneficiarios' => $count
    ];
    return $datos;
  }

  static function getAll(){
    return Beneficiarios::all();
  }

  static function recuperar($id){
    return Beneficiarios::find($id);
  }

  static function getDatosBeneficiario($id_beneficiario){

    $beneficiario = DB::table('AS_DatosBeneficiario as asdb')
              ->select('asdb.*')
              ->where('asdb.id_beneficiario', '=', $id_beneficiario)
              ->get();
    return $beneficiario[0];

  }

  static function beneficiario($id_beneficiario){

    $beneficiario = DB::table('AS_DatosBeneficiario as asdb')
              ->select('asdb.nombres', 'asdb.ap_paterno', 'asdb.ap_materno')
              ->where('asdb.id_beneficiario', '=', $id_beneficiario)
              ->get();
      if($beneficiario[0]->nombres){
        return $beneficiario[0]->nombres.' '.$beneficiario[0]->ap_paterno.' '.$beneficiario[0]->ap_materno;
      }else{
        return 'No ha capturado el nombre del beneficiario';
      }

  }

  static function update_document_ben($id_beneficiario,$file,$doc){
    $solicitud = self::recuperar($id_beneficiario);
    $doc_actual = $solicitud[$doc];

      if($doc_actual){ unlink('../storage/documentos/'.$doc_actual);  }

      DB::table('AS_Beneficiarios')
      ->where('id', $id_beneficiario)
      ->update([
          $doc=> $file
      ]);
      return array('resp' => true);
  }

}
