<?php
namespace App\Http\Middleware;
use App\Models\Framework\Api;
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
      if(!$consumer_secret){
        $datos = [
            'alert' => 'consumer_secret no es valida'
        ];
        print json_encode($datos);
        exit();
      }
      if((Api::tokenExistente($_SERVER ['HTTP_TOKENFSIAP']))&&($_SERVER ['REQUEST_METHOD'] == 'POST')){
        $datos = [
            'alert' => 'El tokenFSIAP esta duplicado'
        ];
        print json_encode($datos);
        exit();
      }
      $body = file_get_contents('php://input');
      $local_signature = hash_hmac( 'sha256', $body, $consumer_secret, false );
      if($external_signature == $local_signature) {
        return $next($request);
      } else {
        //echo 'tu firma es esta: '.$external_signature.' se esperaba esta: '.$local_signature;
        //echo ' estas credenciales se recibieron: consumer_key: '.$credencial_ex[0].'  consumer_pass: '.$credencial_ex[1];
        echo 'Firma esperada: '.$local_signature;
        exit();
        //return redirect('/401');
      }
    }
}
