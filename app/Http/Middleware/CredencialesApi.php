<?php
namespace App\Http\Middleware;
use App\Models\Framework\Api;
use App\Models\Framework\Config;
use Closure;

class CredencialesApi
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $external_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $credenciales = base64_decode($_SERVER ['HTTP_CREDENCIALES']);
      $credencial_ex = explode(":", $credenciales);
      $consumer_key = $credencial_ex[0];
      $consumer_pass = $credencial_ex[1];
      $consumer_secret = Api::getSecret($consumer_pass, $consumer_key);
      $body = file_get_contents('php://input');
      $local_signature = hash_hmac( 'sha256', $body, $consumer_secret, false );

      if(!$consumer_secret){
        Config::auditarApi($request,'API-Middleware' ,$body, 'consumer_secret no es valida', 'ERROR');
        $datos = [
            'alert' => 'consumer_secret no es valida'
        ];
        print json_encode($datos);
        exit();
      }
      if((Api::tokenExistente($_SERVER ['HTTP_TOKEN']))&&($_SERVER ['REQUEST_METHOD'] == 'POST')){
        Config::auditarApi($request,'API-Middleware' ,$body, 'El tokenFSIAP esta duplicado', 'ERROR');
        $datos = [
            'alert' => 'El token esta duplicado'
        ];
        print json_encode($datos);
        exit();
      }
      if($external_signature == $local_signature) {
        Config::auditarApi($request,'API-Middleware' ,$body, 'Credenciales válidas', 'SUCCESS');
        return $next($request);
      } else {
        Config::auditarApi($request,'API-Middleware' ,$body, 'La firma no es: '.$local_signature, 'ERROR');
        $datos = [
            'alert' => 'La firma no es valida'
        ];
        print json_encode($datos);
        exit();
      }
    }
}
