<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Unificadadup extends Model
{
  protected $table = 'GE_UNIFICADA_DUP';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Unificadadup::all();
  }

  static function recuperar($id){
    return Unificadadup::find($id);
  }

  static function obtenerBase(){
    $database = new Unificadadup();
    $dataTable = new DT(
      $database,
      ['id', 'nom', 'apaterno',  'amaterno', 'repeticiones', 'ids_origen']
    );
    $dataTable->setFormatRowFunction(function ($database) {
      return [
        $database->id ,
        $database->nom ,
        $database->apaterno,
        $database->amaterno ,
        $database->repeticiones ,
        self::out($database->ids_origen)
      ];
    });
    return $dataTable->make();
  }

  static function out($ids_origen){

    $reg = explode(',', $ids_origen);
    $salida = '';

    for($i=0; $i<count($reg); $i++ ){
     $elem = explode('|', $reg[$i]);
     $salida .= '<a data-iden="'.$elem[0].'" data-base="'.strtolower($elem[1]).'" class="modal_dup btn btn-secondary btn-sm m-btn m-btn--custom m-btn--label-accent">'.$elem[0].'-'.$elem[1].'</a>&nbsp;&nbsp;';
    }

    return $salida;
  }

}

?>
