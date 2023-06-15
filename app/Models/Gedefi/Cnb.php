<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Cnb extends Model
{
  protected $table = 'GE_CNB';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Cnb::all();
  }

  static function recuperar($id){
    return Cnb::find($id);
  }

  static function obtenerBase(){
    $database = new Cnb();
    $dataTable = new DT(
      $database,
      ['﻿Consecutivo',  'FUB',  'Nombre',  'PrimerApellido',  'SegundoApellido',  'Fecha de nacimiento',  'Edad (En años)',  'Sexo',  'Lugar de Nacimiento',  'CURP',  'RFC',  'Nacionalidad',  'Fecha de Hechos',  'Autoridad Inicia',  'Total de reportes',  'Estatus Canalizacion',  'Fecha de Canalizacion',  'Entidad de la Desaparicion',  'Estatus Victima',  'Clasificacion']
    );
    return $dataTable->make();
  }

}

?>
