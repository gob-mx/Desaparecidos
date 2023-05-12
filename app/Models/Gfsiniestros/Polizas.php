<?php

namespace App\Models\Gfsiniestros;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Polizas extends Model
{
  protected $table = 'AS_Polizas';
  protected $primaryKey = 'id';
  public $timestamps = false;


  static function getAll(){
    return Polizas::all();
  }

  static function buscar($request){
    $array = array();
    $res = Polizas::where('Nombre','=',$request->input('nombre'))
                ->where('Paterno','=',$request->input('paterno'))
                ->where('Materno','=',$request->input('materno'))
                ->orWhere('RFC', '=', $request->input('rfc'))
                ->limit(1)
                ->get();
    if(count($res)==1){
        foreach ($res as $row) {
            $array['success']=true;
            $array['id_poliza']=$row->id;
            $array['nombre']=$row->Nombre;
            $array['paterno']=$row->Paterno;
            $array['materno']=$row->Materno;
            $array['rfc']=$row->RFC;
        }
    }
    return $array;
  }


}
