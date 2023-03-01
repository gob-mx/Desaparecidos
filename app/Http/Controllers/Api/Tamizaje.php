<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo as ModelCatalogo;
use App\Models\Forap\Expediente as ModelExpediente;
use App\Models\Forap\Tamizaje as ModelTamizaje;
use App\Models\Framework\Login as ModelLogin;
use App\Models\Framework\Config;
use Helpme;

class Tamizaje extends Controller
{

  public function __construct()
  {
      $this->middleware('credenciales');
  }

  public function get(){
    $datos = [
        'token' => $_SERVER ['HTTP_TOKENFSIAP'],
        'isAlive' => true
    ];
    print json_encode($datos);
  }

  public function post(Request $request){
    $body = file_get_contents('php://input');
    $expediente = json_decode($body, true);
    $tokenFSIAP = $_SERVER ['HTTP_TOKENFSIAP'];
    $url_token = ModelExpediente::guardar_expediente($expediente, $tokenFSIAP);
    if(!$url_token){
      Config::auditarApi($request,'API' ,$body, 'No existe la unidad con identificadores: '. $expediente['empleadoFiscalia']. '-' .$expediente['empleadoAgencia']. '-' .$expediente['empleadoUnidad'], 'ERROR');
      $datos = [
          'alert' => 'No existe la unidad con identificadores: '. $expediente['empleadoFiscalia']. '-' .$expediente['empleadoAgencia']. '-' .$expediente['empleadoUnidad']
      ];
    }else{
      $datos = [
          'URL' => env('APP_URL').'tamizaje/tamizajeFSIAP/'.$url_token,
          'token' => $tokenFSIAP
      ];
    }
    print json_encode($datos);
  }

  public function put(){
    $tokenFSIAP = $_SERVER ['HTTP_TOKENFSIAP'];
    $tokenData = ModelTamizaje::getToken($tokenFSIAP);
    $id_expediente = $tokenData[0]->id_expediente;
    $id_entrevistado = $tokenData[0]->id_victima;
    $evaluacion = ModelTamizaje::getEvaluacion($id_expediente, $id_entrevistado);
    $riesgo = ModelTamizaje::riesgo($evaluacion[0]->id_evaluacion);
    //ModelLogin::signout($tokenData[0]->id_usuario);
    $datos = [
        'status' => $evaluacion[0]->etiqueta,
        'riesgo' => $riesgo,
        'token' => $tokenFSIAP
    ];
    print json_encode($datos);
  }

}
