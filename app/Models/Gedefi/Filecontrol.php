<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Filecontrol extends Model
{
  protected $table = 'GE_FileControl';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Filecontrol::all();
  }

  static function recuperar($id){
    return Filecontrol::find($id);
  }

  static function obtenerArchivos(){
    $database = new Filecontrol();
    $dataTable = new DT(
      $database->join('cm_catalogo as cat1','cat1.id_cat','=','GE_FileControl.cat_status_file')->join('cm_catalogo as cat2','cat2.id_cat','=','GE_FileControl.cat_type_source'),
      ['id', 'cat2.etiqueta', 'cat1.etiqueta', 'filetype', 'registros', 'GE_FileControl.user_alta', 'GE_FileControl.user_mod', 'GE_FileControl.fecha_alta', 'GE_FileControl.fecha_mod']
    );
    return $dataTable->make();
  }

  static function generar_unificada(){
    DB::select('DROP TABLE IF EXISTS GE_UNIFICADA');
    DB::select("
      CREATE TABLE GE_UNIFICADA
      SELECT nombre, apaterno, amaterno, 'FGJ' as origen
      FROM GE_FGJ
      UNION
      SELECT NOMBRE, PATERNO, MATERNO, 'CBP' as origen
      FROM GE_CBP
      UNION
      SELECT Nombre, PrimerApellido, SegundoApellido, 'CNB' as origen
      FROM GE_CNB
    ");
    DB::select('
    ALTER TABLE GE_UNIFICADA
    ADD COLUMN `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
    ADD PRIMARY KEY (`id`)
    ');
  }

  static function generar_cbp_cnb(){
    DB::select('DROP TABLE IF EXISTS GE_CBP_CNB');
    DB::select("
    CREATE TABLE GE_CBP_CNB SELECT
    cnb.id as id_cnb, cbp.id as id_cbp, cnb.Nombre as nom, cnb.PrimerApellido as apaterno, cnb.SegundoApellido as amaterno
    FROM
      GE_CNB as cnb
      INNER JOIN GE_CBP as cbp
      ON 	cbp.MATERNO = cnb.SegundoApellido
      AND cbp.PATERNO = cnb.PrimerApellido
      AND cbp.NOMBRE  = cnb.Nombre
    ");
    DB::select('
    ALTER TABLE GE_CBP_CNB
    ADD COLUMN `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
    ADD PRIMARY KEY (`id`)
    ');
  }

  static function generar_cbp_fgj(){
    DB::select('DROP TABLE IF EXISTS GE_CBP_FGJ');
    set_time_limit(0);
    DB::select("
    CREATE TABLE GE_CBP_FGJ SELECT
    fgj.id as id_fgj, cbp.id as id_cbp, fgj.nombre as nom, fgj.apaterno, fgj.amaterno
    FROM
    	GE_FGJ as fgj
    	INNER JOIN GE_CBP as cbp
    	ON 	cbp.MATERNO = fgj.amaterno
    	AND cbp.PATERNO = fgj.apaterno
    	AND cbp.NOMBRE  = fgj.nombre
    ");
    DB::select('
    ALTER TABLE GE_CBP_FGJ
    ADD COLUMN `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
    ADD PRIMARY KEY (`id`)
    ');
  }

  static function generar_cnb_fgj(){
    DB::select('DROP TABLE IF EXISTS GE_CNB_FGJ');
    set_time_limit(0);
    DB::select("
    CREATE TABLE GE_CNB_FGJ SELECT
    fgj.id as id_fgj, cnb.id as id_cnb, fgj.nombre as nom, fgj.apaterno, fgj.amaterno
    FROM
    	GE_FGJ as fgj
    	INNER JOIN GE_CNB as cnb
    	ON 	cnb.SegundoApellido = fgj.amaterno
    	AND cnb.PrimerApellido = fgj.apaterno
    	AND cnb.Nombre  = fgj.nombre
    ");
    DB::select('
    ALTER TABLE GE_CNB_FGJ
    ADD COLUMN `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
    ADD PRIMARY KEY (`id`)
    ');
  }

}

?>
