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
      ['id', 'cat2.etiqueta', 'cat1.etiqueta', 'filetype', 'registros', 'GE_FileControl.user_alta', 'GE_FileControl.fecha_alta']
    );
    $dataTable->setFormatRowFunction(function ($database) {
      return [
        $database->id ,
        $database->cat2Etiqueta ,
        $database->cat1Etiqueta,
        $database->filetype ,
        $database->registros ,
        $database->gEFileControlUserAlta ,
        $database->gEFileControlFechaAlta ,
        self::out($database->id,$database->cat2Etiqueta)
      ];
    });

    return $dataTable->make();
  }
  static function out($id, $type_source){

    $salida = '
    <a onclick="carga_archivo(\'contenedor_principal\',\'filecontrol/reprocesar/'.strtolower($type_source).'/'.$id.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-cogwheel"></i>
    </a>
    ';

    return $salida;
  }

  static function generar_unificada(){
    DB::select('SET foreign_key_checks = 0');
    DB::select('TRUNCATE TABLE GE_UNIFICADA;');
    DB::select('SET foreign_key_checks = 1;');
    DB::select("
    INSERT INTO GE_UNIFICADA ( nom, apaterno, amaterno ) SELECT DISTINCT
    nom,
    apaterno,
    amaterno
    FROM
    	(
    	SELECT
    		nombre AS nom,
    		apaterno,
    		amaterno
    	FROM
    		GE_FGJ AS fgj UNION
    	SELECT
    		NOMBRE AS nom,
    		PATERNO AS apaterno,
    		MATERNO AS amaterno
    	FROM
    		GE_CBP AS cbp UNION
    	SELECT
    		Nombre AS nom,
    		PrimerApellido AS apaterno,
    		SegundoApellido AS amaterno
    	FROM
    	GE_CNB AS cnb
    	) AS temp;
    ");
  }

  static function generar_cbp_cnb(){
    DB::select('SET foreign_key_checks = 0');
    DB::select('TRUNCATE TABLE GE_CBP_CNB;');
    DB::select('SET foreign_key_checks = 1;');
    DB::select("
    INSERT INTO GE_CBP_CNB (nom, apaterno, amaterno)
    SELECT DISTINCT
    	cbp.NOMBRE as nom,
    	cbp.PATERNO as apaterno,
    	cbp.MATERNO as amaterno
    FROM
    	GE_CBP as cbp
    	INNER JOIN GE_CNB as cnb ON cbp.NOMBRE = cnb.Nombre
    	AND cbp.PATERNO = cnb.PrimerApellido
    	AND cbp.MATERNO = cnb.SegundoApellido;
    ");
  }

  static function generar_cbp_fgj(){
    DB::select('SET foreign_key_checks = 0');
    DB::select('TRUNCATE TABLE GE_CBP_FGJ;');
    DB::select('SET foreign_key_checks = 1;');
    set_time_limit(0);
    DB::select("
    INSERT INTO GE_CBP_FGJ (nom, apaterno, amaterno)
    SELECT DISTINCT
    	cbp.NOMBRE as nom,
    	cbp.PATERNO as apaterno,
    	cbp.MATERNO as amaterno
    FROM
    	GE_CBP as cbp
    	INNER JOIN GE_FGJ as fgj ON cbp.NOMBRE = fgj.nombre
    	AND cbp.PATERNO = fgj.apaterno
    	AND cbp.MATERNO = fgj.amaterno
    ");
  }

  static function generar_cnb_fgj(){
    DB::select('SET foreign_key_checks = 0');
    DB::select('TRUNCATE TABLE GE_CNB_FGJ;');
    DB::select('SET foreign_key_checks = 1;');
    set_time_limit(0);
    DB::select("
    INSERT INTO GE_CNB_FGJ (nom, apaterno, amaterno)
    SELECT DISTINCT
    	cnb.Nombre AS nom,
    	cnb.PrimerApellido AS apaterno,
    	cnb.SegundoApellido AS amaterno
    FROM
    	GE_CNB AS cnb
    	INNER JOIN GE_FGJ AS fgj ON cnb.Nombre = fgj.nombre
    	AND cnb.PrimerApellido = fgj.apaterno
    	AND cnb.SegundoApellido = fgj.amaterno
    ");
  }
  static function generar_duplicados_unificada(){
    DB::select('SET foreign_key_checks = 0');
    DB::select('TRUNCATE TABLE GE_UNIFICADA_DUP;');
    DB::select('SET foreign_key_checks = 1;');
    set_time_limit(0);
    DB::select("
    INSERT INTO GE_UNIFICADA_DUP (nom, apaterno, amaterno, repeticiones, ids_origen)
    SELECT nom, apaterno, amaterno, COUNT(*) AS repeticiones, GROUP_CONCAT(id, '|' ,origen) AS `ids_origen`
      FROM (
          SELECT 'CBP' as origen, id, NOMBRE as nom, PATERNO as apaterno, MATERNO as amaterno
          FROM GE_CBP
          UNION ALL
          SELECT 'CNB' as origen, id, Nombre as nom, PrimerApellido as apaterno, SegundoApellido as amaterno
          FROM GE_CNB
          UNION ALL
          SELECT 'FGJ' as origen, id, nombre as nom, apaterno, amaterno
          FROM GE_FGJ
      ) AS combined_tables
      GROUP BY nom, apaterno, amaterno
      HAVING COUNT(*) > 1
      order by repeticiones desc
    ");
  }
  static function generar_duplicados_cbp_cnb(){
    DB::select('SET foreign_key_checks = 0');
    DB::select('TRUNCATE TABLE GE_CBP_CNB_DUP;');
    DB::select('SET foreign_key_checks = 1;');
    set_time_limit(0);
    DB::select("
    INSERT INTO GE_CBP_CNB_DUP (nom, apaterno, amaterno, repeticiones, ids_origen)
    SELECT nom, apaterno, amaterno, COUNT(*) AS repeticiones, GROUP_CONCAT(id, '|' ,origen) AS `ids_origen`
    FROM (
        SELECT 'CBP' as origen, id, NOMBRE as nom, PATERNO as apaterno, MATERNO as amaterno
        FROM GE_CBP
        UNION ALL
        SELECT 'CNB' as origen, id, Nombre as nom, PrimerApellido as apaterno, SegundoApellido as amaterno
        FROM GE_CNB
    ) AS combined_tables
    GROUP BY nom, apaterno, amaterno
    HAVING COUNT(*) > 1
    order by repeticiones desc
    ");
  }
  static function generar_duplicados_cbp_fgj(){
    DB::select('SET foreign_key_checks = 0');
    DB::select('TRUNCATE TABLE GE_CBP_FGJ_DUP;');
    DB::select('SET foreign_key_checks = 1;');
    set_time_limit(0);
    DB::select("
    INSERT INTO GE_CBP_FGJ_DUP (nom, apaterno, amaterno, repeticiones, ids_origen)
    SELECT nom, apaterno, amaterno, COUNT(*) AS repeticiones, GROUP_CONCAT(id, '|' ,origen) AS `ids_origen`
    FROM (
        SELECT 'CBP' as origen, id, NOMBRE as nom, PATERNO as apaterno, MATERNO as amaterno
        FROM GE_CBP
        UNION ALL
        SELECT 'FGJ' as origen, id, nombre as nom, apaterno, amaterno
        FROM GE_FGJ
    ) AS combined_tables
    GROUP BY nom, apaterno, amaterno
    HAVING COUNT(*) > 1
    order by repeticiones desc
    ");
  }
  static function generar_duplicados_cnb_fgj(){
    DB::select('SET foreign_key_checks = 0');
    DB::select('TRUNCATE TABLE GE_CNB_FGJ_DUP;');
    DB::select('SET foreign_key_checks = 1;');
    set_time_limit(0);
    DB::select("
    INSERT INTO GE_CNB_FGJ_DUP (nom, apaterno, amaterno, repeticiones, ids_origen)
    SELECT nom, apaterno, amaterno, COUNT(*) AS repeticiones, GROUP_CONCAT(id, '|' ,origen) AS `ids_origen`
    FROM (
        SELECT 'CNB' as origen, id, Nombre as nom, PrimerApellido as apaterno, SegundoApellido as amaterno
        FROM GE_CNB
        UNION ALL
        SELECT 'FGJ' as origen, id, nombre as nom, apaterno, amaterno
        FROM GE_FGJ
    ) AS combined_tables
    GROUP BY nom, apaterno, amaterno
    HAVING COUNT(*) > 1
    order by repeticiones desc
    ");
  }

}

?>
