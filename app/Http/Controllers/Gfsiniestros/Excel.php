<?php
namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use App\Models\Gfsiniestros\Wizard as ModelWizard;
use App\Models\Framework\Roles;
use App\Models\Framework\Usuarios;
use App\Models\Framework\Login as ModelLogin;
use Illuminate\Http\Request;
use Helpme;

class Excel extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:Excel|index', ['only' => ['index']]);
  }

  public function index()
  {
      require URL_VISTA.'excel/index.php';
  }

  public function procesar(){
    require URL_VISTA.'excel/procesar.php';
  }

  public function verifing($file){
    $inputFileName = '../uploads/excel/'.$file;
    return self::phpoffice_spreasdsheet_verifing($inputFileName);
  }

  public function process($file){
    $inputFileName = '../uploads/excel/'.$file;
    return self::phpoffice_spreasdsheet_process($inputFileName);
  }

  private function phpoffice_spreasdsheet_verifing($inputFileName){

    $hash_file = hash_file('md5', $inputFileName);
    $model_birmex = $this->loadEloquent('Fileprocess');
    $existe = $model_birmex->return_hash($hash_file);
    if(isset($existe[0]->hash_file)){
      require '../procesos/return_store.php';
    }else{
      require '../procesos/excel_verifing.php';
    }
	}

  private function phpoffice_spreasdsheet_process($inputFileName){

    $hash_file = hash_file('md5', $inputFileName);
    $model_birmex = $this->loadEloquent('Fileprocess');
    $existe = $model_birmex->return_hash($hash_file);
    if(isset($existe[0]->hash_file)){
      if($existe[0]->cat_status == 1){
        require '../procesos/excel_process.php';
      }else{
        require '../procesos/fail_verificacion.php';
      }
    }else{
      require '../procesos/no_verificado.php';
    }
	}

  public function upload_process($folder,$permisos){

    $newfldr = str_replace('|', '/', $folder);
    $upload_dir = '../uploads/'.$newfldr.'/';

    if(!is_dir($upload_dir)){
      if(!mkdir($upload_dir, 0777, true)) {
          error_log('Error al crear la estructura del directorio');
          exit();
      }
    }

    $allowed_ext = array('xls','xlsx','csv','CSV','XLS','XLSX');

    if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
      error_log('Error! Error en el metodo HTTP!'.$_SERVER['REQUEST_METHOD']);
    }

    if((
        (strpos($_FILES['file']['type'], 'text/csv') !== false) ||
        (strpos($_FILES['file']['type'], 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') !== false) ||
        (strpos($_FILES['file']['type'], 'application/vnd.ms-excel') !== false) ||
        (strpos($_FILES['file']['type'], 'application/csv') !== false)
        ) && $_FILES['file']['error'] == 0 ){
        $excel = $_FILES['file'];



      if(!in_array(self::get_extension($excel['name']),$allowed_ext)){
        error_log('Solo las extensiones '.implode(',',$allowed_ext).' son permitidas!');
      }

      $extension_or = pathinfo($excel['name']);
      $destino_final = $upload_dir.$this->help->token(6).'.'.$extension_or['extension'];
      if (file_exists($destino_final)){
        $destino_final = self::smart_rename($destino_final);
      }
      if(move_uploaded_file($excel['tmp_name'], $destino_final)){
        $elemento = pathinfo($destino_final);
        $extension = $elemento['extension'];
        $nombre = $elemento['filename'];
        $original = $nombre.'.'.$extension;
        $temporal =  $this->help->duplicatePublic($original,$newfldr);
        echo $temporal.'|'.$original;
      }
    }else{
      error_log('El forato del archivo no cumple con las condiciones previstas: '.strpos($_FILES['file']['type'], 'application/vnd.ms-excel'));
    }
  }

  public function upload_verifing($folder,$permisos){

    $newfldr = str_replace('|', '/', $folder);
    $upload_dir = '../uploads/'.$newfldr.'/';

    if(!is_dir($upload_dir)){
      if(!mkdir($upload_dir, 0777, true)) {
          error_log('Error al crear la estructura del directorio');
          exit();
      }
    }

    $allowed_ext = array('xls','xlsx','csv','CSV','XLS','XLSX');

    if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
      error_log('Error! Error en el metodo HTTP!'.$_SERVER['REQUEST_METHOD']);
    }

    if((
        (strpos($_FILES['file']['type'], 'text/csv') !== false) ||
        (strpos($_FILES['file']['type'], 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') !== false) ||
        (strpos($_FILES['file']['type'], 'application/vnd.ms-excel') !== false) ||
        (strpos($_FILES['file']['type'], 'application/csv') !== false)
        ) && $_FILES['file']['error'] == 0 ){
        $excel = $_FILES['file'];



      if(!in_array(self::get_extension($excel['name']),$allowed_ext)){
        error_log('Solo las extensiones '.implode(',',$allowed_ext).' son permitidas!');
      }

      $extension_or = pathinfo($excel['name']);
      $destino_final = $upload_dir.$this->help->token(6).'.'.$extension_or['extension'];
      if (file_exists($destino_final)){
        $destino_final = self::smart_rename($destino_final);
      }
      if(move_uploaded_file($excel['tmp_name'], $destino_final)){
        $elemento = pathinfo($destino_final);
        $extension = $elemento['extension'];
        $nombre = $elemento['filename'];
        $original = $nombre.'.'.$extension;
        $temporal =  $this->help->duplicatePublic($original,$newfldr);
        echo $temporal.'|'.$original;
      }
    }else{
      error_log('El forato del archivo no cumple con las condiciones previstas: '.strpos($_FILES['file']['type'], 'application/vnd.ms-excel'));
    }
  }

  private function get_extension($file_name){

		if($file_name){
			$ext = explode('.', $file_name);
			$ext = array_pop($ext);
			return strtolower($ext);
		}
	}
}
