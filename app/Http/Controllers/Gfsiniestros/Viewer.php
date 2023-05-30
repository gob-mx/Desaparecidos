<?php
namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use App\Models\Gfsiniestros\Solicitudes;
use App\Models\Gfsiniestros\Beneficiarios;
use Illuminate\Http\Request;
use Helpme;

class Viewer extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Wizard|index', ['only' => ['index']]);
  }

  public function index($db,$doc,$id){
    switch ($db) {
        case 'AS_Solicitudes':
            $res = Solicitudes::recuperar($id);
            break;
        case 'AS_Beneficiarios':
            $res = Beneficiarios::recuperar($id);
            break;
    }
    $path = 'tmp/'.Helpme::duplicatePublic($res->$doc,'documentos');
    $ext = explode('.', $res->$doc)[1];
    $extension = strtolower($ext);
    $datos = [
        'path' => $path,
        'type' => $extension,
        'breadcrumbs' => ' /  Visor / '.strtoupper($ext)
    ];
    return view('pdf/viewer')->with('datos', $datos);
  }

}
