<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Unificada extends Model
{
  protected $table = 'GE_UNIFICADA';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Unificada::all();
  }

  static function recuperar($id){
    return Unificada::find($id);
  }

  static function obtenerBase(){
    $database = new Unificada();
    $dataTable = new DT(
      $database,
      ['id', 'nombre', 'apaterno', 'amaterno', 'origen']
    );
    return $dataTable->make();
  }

}

?>
