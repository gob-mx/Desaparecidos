<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo as ModelCatalogo;
use App\Models\Framework\Login as ModelLogin;
use App\Models\Framework\Config;
use Helpme;

class Ws extends Controller
{

  public function __construct()
  {
      $this->middleware('credenciales');
  }

  public function get(){
    $datos = [
        'token' => $_SERVER ['HTTP_TOKEN'],
        'isAlive' => true
    ];
    print json_encode($datos);
  }

  public function post(Request $request){
    $datos = [
        'token' => $_SERVER ['HTTP_TOKEN'],
        'isAlive' => true
    ];
    print json_encode($datos);
  }

  public function put(){
    $datos = [
        'token' => $_SERVER ['HTTP_TOKEN'],
        'isAlive' => true
    ];
    print json_encode($datos);
  }

}
