<?php
namespace App\Http\Controllers\Forap;
use App\Http\Controllers\Framework\Controller;
use App\Models\Forap\Tamizaje as ModelTamizaje;
use App\Models\Framework\Roles;
use App\Models\Framework\Usuarios;
use App\Models\Framework\Login as ModelLogin;
use Illuminate\Http\Request;
use Helpme;

class Tamizaje extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:Tamizaje|index', ['only' => ['index']]);
      $this->middleware('permiso:Tamizaje|nuevo_tamizaje', ['only' => ['nuevo_tamizaje']]);
      $this->middleware('permiso:Tamizaje|expediente', ['only' => ['expediente','listaTamizajes']]);
  }

  public function nuevo_tamizaje(Request $request)
  {
    /*Aqui se valida $request->input(hijos)
    y se envia en el json como error esta mal formado*/

    $store = $request->input();

    $options = [10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,42,43,44,45,46,47,53];
    $checkbox = [38,39,40,48,49];

    $reactivos = [1,2,3,4,5,6,7,8,9,41,50,51,52,54];
    $arreglos = [41];//identifica los arreglos para convertirlos a json

    $id_evaluacion = $store['id_evaluacion'];
    ModelTamizaje::actualizar_estado_evaluacion($id_evaluacion, $store['state']);

    foreach ($store as $clave => $valor){
      $data = [
          'clave' => $clave,
          'valor' => $valor,
          'id_evaluacion' => $id_evaluacion
      ];
      if (in_array($clave, $options)) {ModelTamizaje::agregar_options($data);}
      if (in_array($clave, $checkbox)) {ModelTamizaje::agregar_checkbox($data);}
      if (in_array($clave, $reactivos)) {ModelTamizaje::agregar_reactivos($data, $arreglos);}
    }
    $riesgo = ModelTamizaje::riesgo($id_evaluacion);
    $valoracion = '';
    switch (true) {
    case ($riesgo >= 0 && $riesgo <= 12):
        $valoracion = 'RIESGO LEVE';
        break;
    case ($riesgo >= 13 && $riesgo <= 21):
        $valoracion = 'RIESGO MODERADO';
        break;
    case ($riesgo >= 22 && $riesgo <= 44):
        $valoracion = 'RIESGO SEVERO';
        break;
    case ($riesgo >= 45):
        $valoracion = 'RIESGO CRITICO';
        break;
    }
    $datos = [
        'id_evaluacion' => $id_evaluacion,
        'resp' => 'true',
        'stat' => $store['state'],
        'riesgo' => $riesgo,
        'valoracion' => $valoracion
    ];
    print json_encode($datos);
  }

  public function index()
  {

      if($_SESSION['id_rol'] == 2){
        $token = $_SESSION['url_token'];
      }else{
        $token = 'tbVhM31cvn6ZJTHXaswQopmGkx0KfRBD';
      }


      $datos = ModelTamizaje::data_tamizaje($token);

      if($datos['cat_status_evaluacion'] != 40){
      $options = ModelTamizaje::obtener_options($datos['id_evaluacion']);
      $checkbox = ModelTamizaje::obtener_checkbox($datos['id_evaluacion']);
      $obtener_reactivos = ModelTamizaje::obtener_reactivos($datos['id_evaluacion']);
      $delito = ModelTamizaje::obtener_delito($obtener_reactivos[9]['campo_unico']);
      return view('tamizaje/index')
                                ->with('options', $options)
                                ->with('checkbox', $checkbox)
                                ->with('obtener_reactivos', $obtener_reactivos)
                                ->with('delito', $delito)
                                ->with('datos', $datos);
     }else{
       return view('tamizaje/index')->with('datos', $datos);
     }
  }

  public function tamizajeFSIAP($token)
  {
    self::logear($token);
    if(isset($_SESSION['token'])){
      return view('tamizaje/start');
    }else{
      return redirect('/401');
    }
  }

  static function logear($token)
  {
    return ModelLogin::logearConToken($token);
  }




  public function expediente()
  {
    return view('tamizaje/listaTamizajes');
  }

  public function listaTamizajes($id_expediente)
  {
    print json_encode(ModelTamizaje::obtenerTamizajes($id_expediente));
  }

}
