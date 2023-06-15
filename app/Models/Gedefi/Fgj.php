<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Fgj extends Model
{
  protected $table = 'GE_FGJ';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Fgj::all();
  }

  static function recuperar($id){
    return Fgj::find($id);
  }

  static function obtenerBase(){
    $database = new Fgj();
    $dataTable = new DT(
      $database,
      ['﻿idausente', 'nombre', 'apaterno', 'amaterno', 'edad', 'dessexo', 'desctipo', 'descmunicipio', 'colonia', 'descTipoAu', 'fechaausencia', 'abrevTipo', 'descTipo2', 'apoyo', 'iddenunciante', 'nombre_denunciante', 'apaterno_denunciante', 'amaterno_denunciante', 'fechaalta', 'desctiporeporte', 'desctipocancelacion', 'fechalocalizacion', 'FechaCapturaLocalizacion', 'deschechos', 'desclocalizado', 'desclugar', 'municipiolocalizacion', 'numavprev', 'avprev', 'ausencia_fecha', 'alta_fecha', 'localizacion_fecha', 'alta_semana', 'localizacion_semana']
    );
    return $dataTable->make();
  }

}

?>
