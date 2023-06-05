<?php

namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gfsiniestros\Viewbeneficiarios;
use App\Models\Framework\Catalogo;
use App\Models\Gfsiniestros\Polizas;
use App\Models\Framework\Direcciones;
use App\Models\Gfsiniestros\Solicitudes as ModelSolicitud;
use App\Models\Gfsiniestros\Beneficiarios as ModelBeneficiarios;

use Helpme;

class Beneficiarios extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:Beneficiarios|index', ['only' => ['index']]);
      $this->middleware('permiso:Beneficiarios|datos_beneficiario', ['only' => ['datos_beneficiario']]);
      $this->middleware('permiso:Beneficiarios|modal_add_beneficiario', ['only' => ['modal_add_beneficiario']]);
      $this->middleware('permiso:Beneficiarios|addBeneficiario', ['only' => ['addBeneficiario']]);
      $this->middleware('permiso:Beneficiarios|modal_edit_beneficiario', ['only' => ['modal_edit_beneficiario']]);
      $this->middleware('permiso:Beneficiarios|editBeneficiario', ['only' => ['editBeneficiario']]);
      $this->middleware('permiso:Beneficiarios|listado_beneficiarios', ['only' => ['listado_beneficiarios']]);
      $this->middleware('permiso:Beneficiarios|listado_beneficiarios_admin', ['only' => ['listado_beneficiarios_admin']]);
      $this->middleware('permiso:Beneficiarios|list', ['only' => ['list']]);
      $this->middleware('permiso:Beneficiarios|listadmin', ['only' => ['listadmin']]);
      $this->middleware('permiso:Beneficiarios|update_poliza_designacion', ['only' => ['update_poliza_designacion']]);
      $this->middleware('permiso:Beneficiarios|update_comprobante_domicilio', ['only' => ['update_comprobante_domicilio']]);
      $this->middleware('permiso:Beneficiarios|update_comprobante_domicilio_extranjero', ['only' => ['update_comprobante_domicilio_extranjero']]);
      $this->middleware('permiso:Beneficiarios|update_ine', ['only' => ['update_ine']]);
      $this->middleware('permiso:Beneficiarios|update_fto_pld', ['only' => ['update_fto_pld']]);
      $this->middleware('permiso:Beneficiarios|update_fto_transferencia', ['only' => ['update_fto_transferencia']]);
      $this->middleware('permiso:Beneficiarios|update_estado_cuenta', ['only' => ['update_estado_cuenta']]);
      $this->middleware('permiso:Beneficiarios|update_cedula_fiscal', ['only' => ['update_cedula_fiscal']]);
      $this->middleware('permiso:Beneficiarios|update_curp', ['only' => ['update_curp']]);
      $this->middleware('permiso:Beneficiarios|update_comprobante_fiel', ['only' => ['update_comprobante_fiel']]);
      $this->middleware('permiso:Beneficiarios|form_data', ['only' => ['form_data']]);
      $this->middleware('permiso:Beneficiarios|delete', ['only' => ['delete']]);
  }

  public function update_poliza_designacion($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'poliza_designacion');}
  public function update_comprobante_domicilio($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'comprobante_domicilio');}
  public function update_comprobante_domicilio_extranjero($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'comprobante_domicilio_extranjero');}
  public function update_ine($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'ine');}
  public function update_fto_pld($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'fto_pld');}
  public function update_fto_transferencia($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'fto_transferencia');}
  public function update_estado_cuenta($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'estado_cuenta');}
  public function update_cedula_fiscal($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'cedula_fiscal');}
  public function update_curp($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'curp');}
  public function update_comprobante_fiel($id_beneficiario,$file){ return ModelBeneficiarios::update_document_ben($id_beneficiario,$file,'comprobante_fiel');}

  public function datos_beneficiario(Request $request){
    print json_encode(ModelBeneficiarios::datos_beneficiario($request));
  }

  public function form_data($id_beneficiario, $id_solicitud)
  {
        $beneficiarioData = ModelBeneficiarios::getDatosBeneficiario($id_beneficiario);
        $select_nacionalidades = Catalogo::SelectNacionalidades($beneficiarioData->id_nacionalidad);
        $select_paises2 = Catalogo::SelectPaises($beneficiarioData->id_pais_residencia);
        $estados = Catalogo::SelectEstados($beneficiarioData->id_estado_pais_nac);
        $actividades = Catalogo::selectCatalog('Actividades', $beneficiarioData->cat_giro_actividad);
        $ocupaciones = Catalogo::SelectOcupaciones($beneficiarioData->id_ocupacion);
        $beneficiario = ModelBeneficiarios::beneficiario($id_beneficiario);
        $parentesco = Catalogo::selectCatalog('Parentesco',$beneficiarioData->cat_parentesco);
        $titular = ModelSolicitud::titular($id_solicitud);
        $humanAddress1 = Direcciones::getHumanAddress($beneficiarioData->id_direccion);
        $humanBank = ModelBeneficiarios::getBankName($beneficiarioData->id_banco);

        $estado_pais1 = ModelSolicitud::estado_pais($beneficiarioData->id_estado_pais_nac);
        $select_paises1 = Catalogo::SelectPaises($estado_pais1['id_pais']);
        $select_estados1 = Direcciones::get_estados($estado_pais1['id_pais'],$estado_pais1['id_estado']);
        $select_ciudades1 = Direcciones::get_ciudades($estado_pais1['id_pais'],$estado_pais1['id_estado'],$estado_pais1['id_ciudad']);

        $solicitud = ModelSolicitud::recuperar($id_solicitud);

        $datos = [
            'humanAddress' => $humanAddress1,
            'id_beneficiario' => $id_beneficiario,
            'id_solicitud' => $id_solicitud,
            'nacionalidades' => $select_nacionalidades,
            'paises1' => $select_paises1,
            'estados1' => $select_estados1,
            'ciudades1' => $select_ciudades1,
            'paises2' => $select_paises2,
            'banco' => $humanBank,
            'parentesco' => $parentesco,
            'estados' => $estados,
            'ocupaciones' => $ocupaciones,
            'beneficiario' => $beneficiario,
            'titular' => $titular,
            'actividades' => $actividades,
            'beneficiarioData' => $beneficiarioData,
            'forma_pago' => $solicitud->cat_forma_pago
        ];
        return view('beneficiarios/form_data')->with('datos', $datos);
  }

  public function addBeneficiario(Request $request){
    print json_encode(ModelBeneficiarios::addBeneficiario($request));
  }

  public function editBeneficiario(Request $request){
    print json_encode(ModelBeneficiarios::editBeneficiario($request));
  }

  public function upload($id_beneficiario)
  {
      $beneficiario = ModelBeneficiarios::recuperar($id_beneficiario);
      $beneficiario2 = ModelBeneficiarios::beneficiario($id_beneficiario);
      $titular = ModelSolicitud::titular($beneficiario['id_solicitud']);

      $datos = [
          'id_beneficiario' => $id_beneficiario,
          'poliza_designacion' => $beneficiario['poliza_designacion'],
          'comprobante_domicilio' => $beneficiario['comprobante_domicilio'],
          'comprobante_domicilio_extranjero' => $beneficiario['comprobante_domicilio_extranjero'],
          'ine' => $beneficiario['ine'],
          'fto_pld' => $beneficiario['fto_pld'],
          'fto_transferencia' => $beneficiario['fto_transferencia'],
          'estado_cuenta' => $beneficiario['estado_cuenta'],
          'cedula_fiscal' => $beneficiario['cedula_fiscal'],
          'curp' => $beneficiario['curp'],
          'comprobante_fiel' => $beneficiario['comprobante_fiel'],
          'beneficiario' => $beneficiario2,
          'titular' => $titular,
          'id_solicitud' => $beneficiario['id_solicitud']
      ];
      return view('beneficiarios/upload')->with('datos', $datos);
  }

  public function modal_edit_beneficiario($id_beneficiario)
  {
      $beneficiario = ModelBeneficiarios::getDatosBeneficiario($id_beneficiario);
      $parentesco = Catalogo::selectCatalog('Parentesco',$beneficiario->cat_parentesco);
      $datos = [
          'id_beneficiario' => $id_beneficiario,
          'parentesco' => $parentesco,
          'beneficiario' => $beneficiario
      ];

      return view('modales/beneficiarios/edit_beneficiario')->with('datos', $datos);
  }

  public function modal_add_beneficiario($id_solicitud)
  {
      $parentesco = Catalogo::selectCatalog('Parentesco',null);
      $datos = [
          'id_solicitud' => $id_solicitud,
          'parentesco' => $parentesco
      ];

      return view('modales/beneficiarios/nuevo_beneficiario')->with('datos', $datos);
  }

  public function index()
  {
    exit();
  }

  public function delete($id_beneficiario)
  {
      print json_encode(ModelBeneficiarios::eliminarBeneficiario($id_beneficiario));
  }

  public function list($id_solicitud)
  {
      $titular = ModelSolicitud::titular($id_solicitud);
      $solicitud = ModelSolicitud::recuperar($id_solicitud);
      $datos = [
          'id_solicitud' => $id_solicitud,
          'titular' => $titular,
          'solicitud' => $solicitud
      ];
      return view('beneficiarios/listado')->with('datos', $datos);
  }

  public function listadmin($id_solicitud)
  {
      $titular = ModelSolicitud::titular($id_solicitud);
      $datos = [
          'id_solicitud' => $id_solicitud,
          'titular' => $titular
      ];
      return view('beneficiarios/listadoadmin')->with('datos', $datos);
  }

  public function listado_beneficiarios($id_solicitud)
  {
       print json_encode(Viewbeneficiarios::obtener_beneficiarios($id_solicitud));
  }

  public function listado_beneficiarios_admin($id_solicitud)
  {
       print json_encode(Viewbeneficiarios::obtener_beneficiarios_admin($id_solicitud));
  }

}
