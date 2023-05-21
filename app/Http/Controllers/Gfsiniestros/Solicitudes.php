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

  public function update_ine($id_solicitud,$file){ return ModelSolicitud::update_document_sol($id_solicitud,$file,'ine_fallecido');}
  public function update_act_nac($id_solicitud,$file){ return ModelSolicitud::update_document_sol($id_solicitud,$file,'acta_nac_fallecido');}
  public function update_act_def($id_solicitud,$file){ return ModelSolicitud::update_document_sol($id_solicitud,$file,'acta_defuncion');}
  public function update_fto_rec($id_solicitud,$file){ return ModelSolicitud::update_document_sol($id_solicitud,$file,'fto_reclamacion');}

  public function index()
  {
    exit();
  }

  public function upload($id_solicitud)
  {
      $solicitud = ModelSolicitud::recuperar($id_solicitud);
      $titular = ModelSolicitud::titular($id_solicitud);

      $datos = [
          'id_solicitud' => $id_solicitud,
          'ine_fallecido' => $solicitud['ine_fallecido'],
          'acta_nac_fallecido' => $solicitud['acta_nac_fallecido'],
          'acta_defuncion' => $solicitud['acta_defuncion'],
          'fto_reclamacion' => $solicitud['fto_reclamacion'],
          'titular' => $titular
      ];
      return view('solicitudes/upload')->with('datos', $datos);
  }

  public function form_data($id_solicitud)
  {     $select_estados = Catalogo::SelectEstados();
        $select_nacionalidades = Catalogo::SelectNacionalidades();
        $select_ocupaciones = Catalogo::SelectOcupaciones();
        $fallece_en = Catalogo::selectCatalog('Edificio Fallecimiento',67);
        $titular = ModelSolicitud::titular($id_solicitud);
        $tipo_seguro = Catalogo::selectCatalog('Tipo seguro',null);
        $select_paises = Catalogo::SelectPaises();
        $datos = [
            'id_solicitud' => $id_solicitud,
            'estados' => $select_estados,
            'paises' => $select_paises,
            'nacionalidades' => $select_nacionalidades,
            'ocupaciones' => $select_ocupaciones,
            'fallece_en' => $fallece_en,
            'titular' => $titular,
            'tipo_seguro' => $tipo_seguro
        ];
        return view('solicitudes/form_data')->with('datos', $datos);
  }

  public function listado()
  {
       return view('solicitudes/listado');
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

      return view('modales/solicitudes/nueva_solicitud')->with('datos', $datos);
  }

  public function modal_edit_solicitud($id_solicitud)
  {
      $solicitud = ModelSolicitud::solicitudGet($id_solicitud);
      $solicitud = json_decode($solicitud, true);

      //dd($solicitud);
      $forma_pago = Catalogo::selectCatalog('Metodo pago',66);
      $datos = [
          'forma_pago' => $forma_pago,
          'solicitud' => $solicitud[0],
      ];

      return view('modales/solicitudes/editar_solicitud')->with('datos', $datos);
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
