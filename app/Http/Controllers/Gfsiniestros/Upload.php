<?php
namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use Helpme;

class Upload extends Controller
{

    public function __construct()
    {
        $this->middleware('permiso:Upload|index', ['only' => ['index']]);
        $this->middleware('permiso:Upload|dropzone', ['only' => ['dropzone']]);
    }

    public function index(){
      exit();
    }

    private function smart_rename($ruta)
    {
      if($ruta){
        $elemento = pathinfo($ruta);
        $hash = Helpme::token(3);
        $new_file = $elemento['dirname'].'/'.$elemento['filename'].'_'.$hash.'.'.$elemento['extension'];
        if (file_exists($new_file)){
          $new_file = self::smart_rename($new_file);
        }else{
          return $new_file;
        }
      }
    }

    private function get_extension($file_name)
    {
      if($file_name){
        $ext = explode('.', $file_name);
        $ext = array_pop($ext);
        return strtolower($ext);
      }
    }

    public function dropzone($folder){

        $newfldr = str_replace('|', '/', $folder);
        $upload_dir = '../storage/'.$newfldr.'/';

        if(!is_dir($upload_dir)){
          if(!mkdir($upload_dir, 0777, true)) {
              Debugbar::info('Error al crear la estructura del directorio');
              exit();
          }
        }

        if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
          Debugbar::info('Error! Error en el metodo HTTP!'.$_SERVER['REQUEST_METHOD']);
        }

        if(((strpos($_FILES['file']['type'], 'image') !== false) ||
            (strpos($_FILES['file']['type'], 'application/pdf') !== false)) && $_FILES['file']['error'] == 0 ){
          $pic = $_FILES['file'];


          /*
          $allowed_ext = array('jpg','jpeg','png','gif','pdf');

          if(!in_array(self::get_extension($pic['name']),$allowed_ext)){
            Debugbar::info('Solo las extensiones '.implode(',',$allowed_ext).' son permitidas!');
          }
          */

          $extension_or = pathinfo($pic['name']);
          $destino_final = $upload_dir.Helpme::token(6).'.'.$extension_or['extension'];
          if (file_exists($destino_final)){
            $destino_final = self::smart_rename($destino_final);
          }
          if(move_uploaded_file($pic['tmp_name'], $destino_final)){
            $elemento = pathinfo($destino_final);
            $extension = $elemento['extension'];
            $nombre = $elemento['filename'];
            $original = $nombre.'.'.$extension;
            $temporal =  Helpme::duplicatePublic($original,$newfldr);
            echo $temporal.'|'.$original;
          }
        }else{
          Debugbar::info('Algunos errores ocurrieron al actualizar el avatar: '.strpos($_FILES['file']['type'], 'image'));
        }

    }
}
