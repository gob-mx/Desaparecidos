<?php
namespace App\Http\Middleware;
use App\Models\Framework\Config;
use Closure;

class Permisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,  $rol)
    {
          //el $rol trae el par de permiso, ejemplo: Catalogo|index
          //si no existe la sesion
          if(!isset($_SESSION['token'])){
              return redirect()->intended(env('APP_URL').'/login');
              //return redirect()->action('Framework\Login@index');
              exit();
          }
          //si existe la sesion, el rol del usuario tiene permisos pero no ha aceptado los terminos y condiciones
          if((isset($_SESSION['token']))&&(in_array($rol,$_SESSION['permisos']))&&($_SESSION['tyc'] != 'SI')){
              return redirect()->action('Framework\Login@tyc');
              exit();
          }
          //si existe la sesion, el rol del usuario tiene permisos pero debe cambiar su contraseña
          if((isset($_SESSION['token']))&&(in_array($rol,$_SESSION['permisos']))&&($_SESSION['pass_chge'] == 10)){
              return redirect()->action('Framework\Login@pass_chge');
              exit();
          }
          //si existe la sesion, pero el rol del usuario no tiene permisos
          if((isset($_SESSION['token']))&&(!in_array($rol,$_SESSION['permisos']))){
              return redirect()->action('Framework\Login@error403');
              exit();
          }
          //si existe la sesion, el rol del usuario tiene permisos, ya acepto los terminos y condiciones y no debe cambiar contraseña
          if((isset($_SESSION['token']))&&(in_array($rol,$_SESSION['permisos']))&&($_SESSION['tyc'] == 'SI')&&($_SESSION['pass_chge'] == 11)){
              $_SESSION['hora_acceso']=time();
              Config::updateLogin($request, $rol);
              return $next($request);
          }
          //Se usa en getCatalogoSecundario del controlador Catalogo y aplica a todos los roles por ello true
          if((isset($_SESSION['token']))&&($rol == true)){
              $_SESSION['hora_acceso']=time();
              Config::updateLogin($request, $rol);
              return $next($request);
          }

          return $next($request);
    }
}
