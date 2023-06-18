<?php

namespace App\Models\Gedefi;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use PhpOffice\PhpSpreadsheet\IOFactory;
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


////////////////////////////////////////////////////////////////////////////////////

static function reprocesar($doc, $id=false){
    $file = ($id)?self::getActualFile($doc, $id):self::getActualFile($doc);
    $inputFileName = '../storage/excel/'.$doc.'/'.$file->file;
    $datos = self::cargar_csv($file->file,$doc,$file->hash_file, $inputFileName);
    self::setStatusFile($doc, 19);
    self::setStatusFileId($file->id, 21);
    return $datos;
}

static function getActualFile($doc, $id = false){
  switch($doc){case 'cbp': $source = 16; break; case 'cnb': $source = 17; break; case 'fgj': $source = 18; break; }
  return ($id)?Filecontrol::find($id):Filecontrol::where('cat_type_source', $source)->where('cat_status_file', 21)->first();
}

static function upload_excel($file,$doc){
    $inputFileName = '../storage/excel/'.$doc.'/'.$file;
    $hash_file = hash_file('md5', $inputFileName);
    $existe = self::existe($hash_file);
    if($existe){
      unlink($inputFileName);
      self::devolver_almacenado($existe);
    }else{
      $datos = self::cargar_csv($file,$doc,$hash_file, $inputFileName);
      self::setStatusFile($doc, 19);
      $datos['id'] = self::insert($datos, 21);
      print json_encode($datos);
    }
}

static function setStatusFileId($id, $status){
  return Filecontrol::where('id', $id)
      ->update([
          'cat_status_file' => $status
      ]);
}

static function setStatusFile($doc, $status){
  switch($doc){case 'cbp': $source = 16; break; case 'cnb': $source = 17; break; case 'fgj': $source = 18; break; }
  return Filecontrol::where('cat_type_source', $source)
      ->update([
          'cat_status_file' => $status
      ]);
}
static function devolver_almacenado($existe){
  $datos = [
      'id' => $existe->id,
      'file' => $existe->file,
      'doc' => $existe->cat_type_source,
      'hash_file' => $existe->hash_file,
      'inputFileType' => $existe->filetype,
      'registros' => $existe->registros,
      'mensaje' => 'El documento que intenta subir ya se había procesado con anterioridad',
      'resp' => true
  ];
  print json_encode($datos);
}
static function cargar_csv($file,$doc,$hash_file, $inputFileName){

  $hash_file2 = hash_file('md5', $inputFileName);

  if($hash_file2 != $hash_file){
    $datos = [
        'file' => $file,
        'doc' => $doc,
        'hash_file' => $hash_file,
        'hash_file2' => $hash_file2,
        'inputFileName' => $inputFileName,
          'mensaje' => 'el Hash del archivo no es el mismo que está almacenado',
        'resp' => false
    ];
    print json_encode($datos);
    exit();
  }

  $fp = fopen($inputFileName, 'r');
  $lines = count(file($inputFileName));
  $count=0;
  $inputFileType = self::getExtension($file, true);
  while($data = fgetcsv($fp, 1000, ',', '"')):
    if($count != 0){
      switch($doc){
        case "cbp":
              self::process_cbp($data);
        break;
        case "cnb":
              self::process_cnb($data);
        break;
        case "fgj":
              self::process_fgj($data);
        break;
      }
    }else{
      switch($doc){
        case "cbp":
          if(($data[0] != "﻿EXPEDIENTE") ||
          ($data[1] != "NOMBRE_COMPELTO") ||
          ($data[2] != "STATUS") ||
          ($data[3] != "FECHA_EVENTO") ||
          ($data[4] != "FECHA_REPORTE") ||
          ($data[5] != "FECHA_LOC") ||
          ($data[6] != "ALCALDIA_D") ||
          ($data[7] != "ALCALDIA_VIVE") ||
          ($data[8] != "ANO_DESAP") ||
          ($data[9] != "ANO_REP") ||
          ($data[10]!=  "COLONIA_D") ||
          ($data[11]!=  "COLONIA_VIVE") ||
          ($data[12]!=  "EDAD") ||
          ($data[13]!=  "ENTIDAD_D") ||
          ($data[14]!=  "ENTIDAD_LOC") ||
          ($data[15]!=  "FIPEDE") ||
          ($data[16]!=  "FOLIO_NACIONAL") ||
          ($data[17]!=  "MATERNO") ||
          ($data[18]!=  "NOMBRE") ||
          ($data[19]!=  "PATERNO") ||
          ($data[20]!=  "SEXO") ||
          ($data[21]!=  "CLASIFICACION_ETARIA") ||
          ($data[22]!=  "SIRILO") ||
          ($data[23]!=  "DIGITO")){

            $datos = [
                'file' => $file,
                'doc' => $doc,
                'hash_file' => $hash_file,
                'inputFileName' => $inputFileName,
                'inputFileType' => $inputFileType,
                'registros' => $lines-1,
                'mensaje' => 'El formato del archivo no es compatible con la base de datos',
                'resp' => false
            ];
            $datos['id'] = self::insert($datos, 20);
            print json_encode($datos);
            exit();
          }else{
            DB::select('SET foreign_key_checks = 0');
            DB::select('TRUNCATE TABLE GE_CBP;');
            DB::select('SET foreign_key_checks = 1;');
          }
        break;
        case "cnb":
          if(($data[0] != "﻿Consecutivo") ||
          ($data[1] != "FUB") ||
          ($data[2] != "Nombre") ||
          ($data[3] != "PrimerApellido") ||
          ($data[4] != "SegundoApellido") ||
          ($data[5] != "Fecha de nacimiento") ||
          ($data[6] != "Edad (En años)") ||
          ($data[7] != "Sexo") ||
          ($data[8] != "Lugar de Nacimiento") ||
          ($data[9] != "CURP") ||
          ($data[10] != "RFC") ||
          ($data[11] != "Nacionalidad") ||
          ($data[12] != "Fecha de Hechos") ||
          ($data[13] != "Autoridad Inicia") ||
          ($data[14] != "Total de reportes") ||
          ($data[15] != "Estatus Canalizacion") ||
          ($data[16] != "Fecha de Canalizacion") ||
          ($data[17] != "Entidad de la Desaparicion") ||
          ($data[18] != "Estatus Victima") ||
          ($data[19] != "Clasificacion")){

            $datos = [
                'file' => $file,
                'doc' => $doc,
                'hash_file' => $hash_file,
                'inputFileName' => $inputFileName,
                'inputFileType' => $inputFileType,
                'registros' => $lines-1,
                'mensaje' => 'El formato del archivo no es compatible con la base de datos',
                'resp' => false
            ];
            $datos['id'] = self::insert($datos, 20);
            print json_encode($datos);
            exit();

          }else{
            DB::select('SET foreign_key_checks = 0');
            DB::select('TRUNCATE TABLE GE_CNB;');
            DB::select('SET foreign_key_checks = 1;');
          }
        break;
        case "fgj":
          if(($data[0] != "﻿idausente") ||
          ($data[1] != "nombre") ||
          ($data[2] != "apaterno") ||
          ($data[3] != "amaterno") ||
          ($data[4] != "edad") ||
          ($data[5] != "dessexo") ||
          ($data[6] != "desctipo") ||
          ($data[7] != "descmunicipio") ||
          ($data[8] != "colonia") ||
          ($data[9] != "descTipoAu") ||
          ($data[10] != "fechaausencia") ||
          ($data[11] != "abrevTipo") ||
          ($data[12] != "descTipo") ||
          ($data[13] != "apoyo") ||
          ($data[14] != "iddenunciante") ||
          ($data[15] != "nombre_denunciante") ||
          ($data[16] != "apaterno_denunciante") ||
          ($data[17] != "amaterno_denunciante") ||
          ($data[18] != "fechaalta") ||
          ($data[19] != "desctiporeporte") ||
          ($data[20] != "desctipocancelacion") ||
          ($data[21] != "fechalocalizacion") ||
          ($data[22] != "FechaCapturaLocalizacion") ||
          ($data[23] != "deschechos") ||
          ($data[24] != "desclocalizado") ||
          ($data[25] != "desclugar") ||
          ($data[26] != "municipiolocalizacion") ||
          ($data[27] != "numavprev") ||
          ($data[28] != "avprev") ||
          ($data[29] != "ausencia_fecha") ||
          ($data[30] != "alta_fecha") ||
          ($data[31] != "localizacion_fecha") ||
          ($data[32] != "alta_semana") ||
          ($data[33] != "localizacion_semana")){

            $datos = [
                'file' => $file,
                'doc' => $doc,
                'hash_file' => $hash_file,
                'inputFileName' => $inputFileName,
                'inputFileType' => $inputFileType,
                'registros' => $lines-1,
                'mensaje' => 'El formato del archivo no es compatible con la base de datos',
                'resp' => false
            ];
            $datos['id'] = self::insert($datos, 20);
            print json_encode($datos);
            exit();

          }else{
            DB::select('SET foreign_key_checks = 0');
            DB::select('TRUNCATE TABLE GE_FGJ;');
            DB::select('SET foreign_key_checks = 1;');
          }
        break;
      }
    }
  $count++;
  endwhile;
  fclose($fp);

  $datos = [
      'file' => $file,
      'doc' => $doc,
      'hash_file' => $hash_file,
      'inputFileName' => $inputFileName,
      'inputFileType' => $inputFileType,
      'registros' => $count-1,
      'resp' => true
  ];
  return $datos;
}

static function insert($datos, $stat){
  switch($datos['doc']){case 'cbp': $source = 16; break; case 'cnb': $source = 17; break; case 'fgj': $source = 18; break; }
  $idb = DB::table('GE_FileControl')->insertGetId(
      [
          'cat_type_source' => $source,
          'cat_status_file' => $stat,
          'file' => $datos['file'],
          'filetype' => $datos['inputFileType'],
          'registros' => $datos['registros'],
          'hash_file' => $datos['hash_file'],
          'user_alta' => $_SESSION['id_usuario'],
          'fecha_alta' => date("Y-m-d H:i:s")
      ]
  );
  return $idb;
}

static function process_cbp($data){
  $id = DB::table('GE_CBP')->insertGetId(
      [
        '﻿EXPEDIENTE' => $data[0],
        'NOMBRE_COMPELTO' => $data[1],
        'STATUS' => $data[2],
        'FECHA_EVENTO' => $data[3],
        'FECHA_REPORTE' => $data[4],
        'FECHA_LOC' => $data[5],
        'ALCALDIA_D' => $data[6],
        'ALCALDIA_VIVE' => $data[7],
        'ANO_DESAP' => $data[8],
        'ANO_REP' => $data[9],
        'COLONIA_D' => $data[10],
        'COLONIA_VIVE' => $data[11],
        'EDAD' => $data[12],
        'ENTIDAD_D' => $data[13],
        'ENTIDAD_LOC' => $data[14],
        'FIPEDE' => $data[15],
        'FOLIO_NACIONAL' => $data[16],
        'MATERNO' => $data[17],
        'NOMBRE' => $data[18],
        'PATERNO' => $data[19],
        'SEXO' => $data[20],
        'CLASIFICACION_ETARIA' => $data[21],
        'SIRILO' => $data[22],
        'DIGITO' => $data[23],
        'user_alta' => $_SESSION['id_usuario'],
        'fecha_alta' => date("Y-m-d H:i:s")
      ]
  );
  return $id;
}

static function process_cnb($data){
  $id = DB::table('GE_CNB')->insertGetId(
      [
        '﻿Consecutivo' => $data[0],
        'FUB' => $data[1],
        'Nombre' => $data[2],
        'PrimerApellido' => $data[3],
        'SegundoApellido' => $data[4],
        'Fecha de nacimiento' => $data[5],
        'Edad (En años)' => $data[6],
        'Sexo' => $data[7],
        'Lugar de Nacimiento' => $data[8],
        'CURP' => $data[9],
        'RFC' => $data[10],
        'Nacionalidad' => $data[11],
        'Fecha de Hechos' => $data[12],
        'Autoridad Inicia' => $data[13],
        'Total de reportes' => $data[14],
        'Estatus Canalizacion' => $data[15],
        'Fecha de Canalizacion' => $data[16],
        'Entidad de la Desaparicion' => $data[17],
        'Estatus Victima' => $data[18],
        'Clasificacion' => $data[19],
        'user_alta' => $_SESSION['id_usuario'],
        'fecha_alta' => date("Y-m-d H:i:s")
      ]
  );
  return $id;
}

static function process_fgj($data){
  $id = DB::table('GE_FGJ')->insertGetId(
      [
        '﻿idausente' => $data[0],
        'nombre' => $data[1],
        'apaterno' => $data[2],
        'amaterno' => $data[3],
        'edad' => $data[4],
        'dessexo' => $data[5],
        'desctipo' => $data[6],
        'descmunicipio' => $data[7],
        'colonia' => $data[8],
        'descTipoAu' => $data[9],
        'fechaausencia' => $data[10],
        'abrevTipo' => $data[11],
        'descTipo2' => $data[12],
        'apoyo' => $data[13],
        'iddenunciante' => $data[14],
        'nombre_denunciante' => $data[15],
        'apaterno_denunciante' => $data[16],
        'amaterno_denunciante' => $data[17],
        'fechaalta' => $data[18],
        'desctiporeporte' => $data[19],
        'desctipocancelacion' => $data[20],
        'fechalocalizacion' => $data[21],
        'FechaCapturaLocalizacion' => $data[22],
        'deschechos' => $data[23],
        'desclocalizado' => $data[24],
        'desclugar' => $data[25],
        'municipiolocalizacion' => $data[26],
        'numavprev' => $data[27],
        'avprev' => $data[28],
        'ausencia_fecha' => $data[29],
        'alta_fecha' => $data[30],
        'localizacion_fecha' => $data[31],
        'alta_semana' => $data[32],
        'localizacion_semana' => $data[33],
        'user_alta' => $_SESSION['id_usuario'],
        'fecha_alta' => date("Y-m-d H:i:s")
      ]
  );

  return $id;
}

static function existe($hash_file){
  $file = DB::table('GE_FileControl AS gef')
            ->select('gef.*')
            ->where('gef.hash_file', '=', $hash_file)
            ->get();
  return (isset($file[0]))?$file[0]:false;
}

static function getExtension($file, $tolower=true){
    $file = basename($file);
    $pos = strrpos($file, '.');

    if ($file == '' || $pos === false) {
        return '';
    }

    $extension = substr($file, $pos+1);
    if ($tolower) {
        $extension = strtolower($extension);
    }

    return $extension;
}

static function verificar_excel($file,$doc,$hash_file, $inputFileName){
  $pool = new \Cache\Adapter\Apcu\ApcuCachePool();
  $simpleCache = new \Cache\Bridge\SimpleCache\SimpleCacheBridge($pool);
  \PhpOffice\PhpSpreadsheet\Settings::setCache($simpleCache);

  $inputFileType = IOFactory::identify($inputFileName);/**  identificar que tipo de archivo es slx ó xlsx  **/
  $reader = IOFactory::createReader($inputFileType);/**  Crear el lector a partir del tipo de archivo identificado  **/
  $reader->setReadDataOnly(true);/**  Lo establezco como solo lectura para acelerar el proceso  **/
  $reader->setLoadAllSheets();  /**  Cargo todas las hojas del libro  **/
  $spreadsheet = $reader->load($inputFileName);/** <=============== CONSUME MUCHOS RECURSOS !!!! Cargo el libro en el objeto que acabo de crear  **/
  //print json_encode(['stat'=>$inputFileType]);exit();
  $hojas = $spreadsheet->getSheetNames();/**  Obtengo el nombre de todas las hojas del libro**/
  $registros = $spreadsheet->getActiveSheet()->toArray();/**  Convierto el objeto Spreadsheet en un Array para facilidad de uso  **/
  $filas = count($registros);/** Obtengo el numero total de registros **/

  $datos = [
      'file' => $file,
      'doc' => $doc,
      'hash_file' => $hash_file,
      'inputFileName' => $inputFileName,
      'inputFileType' => $inputFileType,
      'hojas' => $hojas,
      'registros' => $filas,
      'resp' => true
  ];
  $datos['id'] = self::insert($datos, 21);
  print json_encode($datos);
}

}

?>
