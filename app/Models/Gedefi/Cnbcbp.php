<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Cnbcbp extends Model
{
  protected $table = 'GE_CBP_CNB';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Cnbcbp::all();
  }

  static function recuperar($id){
    return Cnbcbp::find($id);
  }

  static function obtenerBase(){
    $database = new Cnbcbp();
    $dataTable = new DT(
      $database,
      ['id', 'nom', 'apaterno',  'amaterno']
    );
    return $dataTable->make();
  }

}

?>
