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


  static function getAll(){
    return Beneficiarios::all();
  }

  static function recuperar($id){
    return Beneficiarios::find($id);
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
