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


  static function getAll(){
    return Solicitudes::all();
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

  static function insertar($request){
    $benefit = (null !== $request->input('beneficiarios'))?$request->input('beneficiarios'):1;
    $titular = (null !== $request->input('titular'))?1:0;
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

    if(null !== $request->input('titular')){

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
                'fecha_alta' => date("Y-m-d H:i:s")
            ]
        );
      }

    }

    $ida = DB::table('AS_Asegurado')->insertGetId(
        [
            'id_solicitud' => $id,
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
