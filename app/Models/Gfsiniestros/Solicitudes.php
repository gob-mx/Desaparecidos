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
    $datos = [
        'success' => true,
        'id' => $id,
        'titular' => $request->input('titular')
    ];
    return $datos;
  }

}
