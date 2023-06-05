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

class Solicitudes extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:Solicitudes|index', ['only' => ['index']]);
      $this->middleware('permiso:Solicitudes|datos_asegurado', ['only' => ['datos_asegurado']]);
      $this->middleware('permiso:Solicitudes|listado_solicitudes', ['only' => ['listado_solicitudes']]);
      $this->middleware('permiso:Solicitudes|listado_solicitudes_filter', ['only' => ['listado_solicitudes_filter']]);
      $this->middleware('permiso:Solicitudes|modal_add_solicitud', ['only' => ['modal_add_solicitud']]);
      $this->middleware('permiso:Solicitudes|modal_crm', ['only' => ['modal_crm']]);
      $this->middleware('permiso:Solicitudes|add_mensaje', ['only' => ['add_mensaje']]);
      $this->middleware('permiso:Solicitudes|modal_edit_solicitud', ['only' => ['modal_edit_solicitud']]);
      $this->middleware('permiso:Solicitudes|buscar', ['only' => ['buscar']]);
      $this->middleware('permiso:Solicitudes|insertar', ['only' => ['insertar']]);
      $this->middleware('permiso:Solicitudes|listado', ['only' => ['listado']]);
      $this->middleware('permiso:Solicitudes|listadofilter', ['only' => ['listadofilter']]);
      $this->middleware('permiso:Solicitudes|upload', ['only' => ['upload']]);
      $this->middleware('permiso:Solicitudes|update_ine', ['only' => ['update_ine']]);
      $this->middleware('permiso:Solicitudes|update_act_nac', ['only' => ['update_act_nac']]);
      $this->middleware('permiso:Solicitudes|update_act_def', ['only' => ['update_act_def']]);
      $this->middleware('permiso:Solicitudes|update_fto_rec', ['only' => ['update_fto_rec']]);
      $this->middleware('permiso:Solicitudes|form_data', ['only' => ['form_data']]);
  }

  public function update_ine($id_solicitud,$file){ return ModelSolicitud::update_document_sol($id_solicitud,$file,'ine_fallecido');}
  public function update_act_nac($id_solicitud,$file){ return ModelSolicitud::update_document_sol($id_solicitud,$file,'acta_nac_fallecido');}
  public function update_act_def($id_solicitud,$file){ return ModelSolicitud::update_document_sol($id_solicitud,$file,'acta_defuncion');}
  public function update_fto_rec($id_solicitud,$file){ return ModelSolicitud::update_document_sol($id_solicitud,$file,'fto_reclamacion');}

  public function index()
  {
    exit();
  }

  public function datos_asegurado(Request $request){
    print json_encode(ModelSolicitud::datos_asegurado($request));
  }

  public function form_data($id_solicitud)
  {     $titular = ModelSolicitud::titular($id_solicitud);
        $solicitud = ModelSolicitud::recuperar($id_solicitud);
        $poliza = ModelSolicitud::polizaData($solicitud->id_poliza);
        $asegurado = ModelSolicitud::asegurado($id_solicitud);
        $fallecido = ModelSolicitud::fallecido($id_solicitud);
        $tipo_seguro = Catalogo::selectCatalog('Tipo seguro',$asegurado->cat_tipo_seguro);
        $select_ocupaciones = Catalogo::SelectOcupaciones($asegurado->id_ocupacion);
        $fallece_en = Catalogo::selectCatalog('Edificio Fallecimiento',$fallecido->cat_edificio_fallecimiento);
        $humanAddress1 = Direcciones::getHumanAddress($asegurado->id_domicilio_cuando_fallecio);
        $humanAddress2 = Direcciones::getHumanAddress($asegurado->id_domicilio_empresa);
        $select_nacionalidades = Catalogo::SelectNacionalidades($asegurado->id_nacionalidad);

        $estado_pais1 = ModelSolicitud::estado_pais($asegurado->id_ciudad_lugar_nacimiento);
        $select_paises1 = Catalogo::SelectPaises($estado_pais1['id_pais']);
        $select_estados1 = Direcciones::get_estados($estado_pais1['id_pais'],$estado_pais1['id_estado']);
        $select_ciudades1 = Direcciones::get_ciudades($estado_pais1['id_pais'],$estado_pais1['id_estado'],$estado_pais1['id_ciudad']);

        $estado_pais2 = ModelSolicitud::estado_pais($fallecido->id_lugar_fallecimiento);
        $select_paises2 = Catalogo::SelectPaises($estado_pais2['id_pais']);
        $select_estados2 = Direcciones::get_estados($estado_pais2['id_pais'],$estado_pais2['id_estado']);
        $select_ciudades2 = Direcciones::get_ciudades($estado_pais2['id_pais'],$estado_pais2['id_estado'],$estado_pais2['id_ciudad']);


        $datos = [
            'id_solicitud' => $id_solicitud,
            'humanAddress1' => $humanAddress1,
            'humanAddress2' => $humanAddress2,
            'paises1' => $select_paises1,
            'estados1' => $select_estados1,
            'ciudades1' => $select_ciudades1,
            'paises2' => $select_paises2,
            'estados2' => $select_estados2,
            'ciudades2' => $select_ciudades2,
            'nacionalidades' => $select_nacionalidades,
            'ocupaciones' => $select_ocupaciones,
            'fallece_en' => $fallece_en,
            'titular' => $titular,
            'tipo_seguro' => $tipo_seguro,
            'no_poliza' => $poliza->no_poliza,
            'certificado' => $poliza->certificado,
            'asegurado' => $asegurado,
            'fallecido' => $fallecido,
            'estado_pais1' => $estado_pais1,
            'telefono' => $asegurado->telefono
        ];
        return view('solicitudes/form_data')->with('datos', $datos);
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

  public function listado()
  {
       return view('solicitudes/listado');
  }

  public function listadofilter()
  {
       return view('solicitudes/listadofilter');
  }

  public function listado_solicitudes()
  {
       print json_encode(Viewsolicitudes::obtener_solicitudes());
  }

  public function listado_solicitudes_filter()
  {
       print json_encode(Viewsolicitudes::obtener_solicitudes_filter());
  }

  public function modal_add_solicitud()
  {
      $forma_pago = Catalogo::selectCatalog('Metodo pago',null);
      $datos = [
          'forma_pago' => $forma_pago
      ];

      return view('modales/solicitudes/nueva_solicitud')->with('datos', $datos);
  }

  public function modal_crm($id_solicitud)
  {
      $mensajes = ModelSolicitud::getMessages($id_solicitud);
      $datos = [
          'id_solicitud' => $id_solicitud,
          'mensajes' => $mensajes
      ];

      return view('modales/solicitudes/crm')->with('datos', $datos);
  }

  public function add_mensaje(Request $request){
    print json_encode(ModelSolicitud::add_mensaje($request));
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
    $rep = ModelSolicitud::repetido($res['id_poliza']);
    if($rep){
      $datos = [
          'success' => false,
          'mensaje' => 'Ya existe una solicitud en trámite para este Titular'
      ];
      print json_encode($datos);
    }else{
      print json_encode($res);
    }
  }

  public function insertar(Request $request)
  {
    $rep = ModelSolicitud::repetido($request->input('id_poliza'));
    if($rep){
      $datos = [
          'success' => false,
          'mensaje' => 'Ya existe una solicitud en trámite para este Titular'
      ];
      print json_encode($datos);
    }else{
      $res = ModelSolicitud::insertar($request);
      print json_encode($res);
    }
  }

}
