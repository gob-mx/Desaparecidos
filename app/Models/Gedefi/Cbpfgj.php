<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Cbpfgj extends Model
{
  protected $table = 'GE_CBP_FGJ';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Cbpfgj::all();
  }

  static function recuperar($id){
    return Cbpfgj::find($id);
  }

  static function obtenerBase(){
    $database = new Cbpfgj();
    $dataTable = new DT(
      $database,
      ['id', 'nom', 'apaterno',  'amaterno']
    );
    return $dataTable->make();
  }

}

?>
