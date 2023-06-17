<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Cnbfgj extends Model
{
  protected $table = 'GE_CNB_FGJ';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Cnbfgj::all();
  }

  static function recuperar($id){
    return Cnbfgj::find($id);
  }

  static function obtenerBase(){
    $database = new Cnbfgj();
    $dataTable = new DT(
      $database,
      ['id', 'nom', 'apaterno',  'amaterno']
    );
    return $dataTable->make();
  }

}

?>
