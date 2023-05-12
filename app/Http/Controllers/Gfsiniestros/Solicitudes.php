<?php

namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gfsiniestros\Viewsolicitudes;
use App\Models\Framework\Catalogo;
use App\Models\Gfsiniestros\Polizas;
use App\Models\Gfsiniestros\Solicitudes as ModelSolicitud;

use Helpme;

class Solicitudes extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Wizard|index', ['only' => ['index']]);
  }

  public function index()
  {
    exit();
  }

  public function listado_solicitudes()
  {
       print json_encode(Viewsolicitudes::obtener_solicitudes());
  }

  public function modal_add_solicitud()
  {

      $forma_pago = Catalogo::selectCatalog('Metodo pago',null);
      $datos = [
          'forma_pago' => $forma_pago
      ];

      return view('modales/wizard/nueva_solicitud')->with('datos', $datos);
  }

  public function buscar(Request $request)
  {
    $res = Polizas::buscar($request);
    print json_encode($res);
  }

  public function insertar(Request $request)
  {
    $res = ModelSolicitud::insertar($request);
    print json_encode($res);
  }

}
