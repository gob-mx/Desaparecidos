<?php

namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gfsiniestros\Viewsolicitudes;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gfsiniestros\Polizas;
use App\Models\Gfsiniestros\Solicitudes as ModelSolicitud;

use Helpme;

class Viewer extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Wizard|index', ['only' => ['index']]);
  }

  public function index($db,$doc,$id){
    $datos = [
        'path' => $path,
        'type' => $extension,
        'breadcrumbs' => ' /  Visor / PDF '
    ];
    return view('pdf/viewer')->with('datos', $datos);
  }

}
