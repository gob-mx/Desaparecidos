<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo as ModelCatalogo;
use App\Models\Forap\Expediente as ModelExpediente;
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

  public function post(){
    $body = file_get_contents('php://input');
    $expediente = json_decode($body, true);
    $tokenFSIAP = $_SERVER ['HTTP_TOKENFSIAP'];
    $url_token = ModelExpediente::guardar_expediente($expediente, $tokenFSIAP);
    $datos = [
        'URL' => env('APP_URL').'tamizaje/tamizajeFSIAP/'.$url_token,
        'token' => $tokenFSIAP
    ];
    print json_encode($datos);
  }

  public function put(){
    $datos = [
        'status' => 'Se completó el tamizaje',
        'riesgo' => '44',
        'token' => $_SERVER ['HTTP_TOKENFSIAP']
    ];
    print json_encode($datos);
  }

}
