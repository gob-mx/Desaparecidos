<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Cbp extends Model
{
  protected $table = 'GE_CBP';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Cbp::all();
  }

  static function recuperar($id){
    return Cbp::find($id);
  }

  static function obtenerBase(){
    $database = new Cbp();
    $dataTable = new DT(
      $database,
      ['﻿EXPEDIENTE', 'NOMBRE_COMPELTO', 'STATUS', 'FECHA_EVENTO', 'FECHA_REPORTE', 'FECHA_LOC', 'ALCALDIA_D', 'ALCALDIA_VIVE', 'ANO_DESAP', 'ANO_REP', 'COLONIA_D', 'COLONIA_VIVE', 'EDAD', 'ENTIDAD_D', 'ENTIDAD_LOC', 'FIPEDE', 'FOLIO_NACIONAL', 'MATERNO', 'NOMBRE', 'PATERNO', 'SEXO', 'CLASIFICACION_ETARIA', 'SIRILO', 'DIGITO']
    );
    return $dataTable->make();
  }

}

?>
