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
      //$this->middleware('permiso:Wizard|index', ['only' => ['index']]);
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
        $select_paises1 = Catalogo::SelectPaises($beneficiarioData->id_pais_nacimiento);
        $select_paises2 = Catalogo::SelectPaises($beneficiarioData->id_pais_residencia);
        $estados = Catalogo::SelectEstados($beneficiarioData->id_estado_pais_nac);
        $actividades = Catalogo::selectCatalog('Actividades', $beneficiarioData->cat_giro_actividad);
        $ocupaciones = Catalogo::SelectOcupaciones($beneficiarioData->id_ocupacion);
        $beneficiario = ModelBeneficiarios::beneficiario($id_beneficiario);
        $parentesco = Catalogo::selectCatalog('Parentesco',$beneficiarioData->cat_parentesco);
        $titular = ModelSolicitud::titular($id_solicitud);
        $humanAddress1 = Direcciones::getHumanAddress($beneficiarioData->id_direccion);
        $humanBank = ModelBeneficiarios::getBankName($beneficiarioData->id_banco);
        $datos = [
            'humanAddress' => $humanAddress1,
            'id_beneficiario' => $id_beneficiario,
            'id_solicitud' => $id_solicitud,
            'nacionalidades' => $select_nacionalidades,
            'paises1' => $select_paises1,
            'paises2' => $select_paises2,
            'banco' => $humanBank,
            'parentesco' => $parentesco,
            'estados' => $estados,
            'ocupaciones' => $ocupaciones,
            'beneficiario' => $beneficiario,
            'titular' => $titular,
            'actividades' => $actividades,
            'beneficiarioData' => $beneficiarioData
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
      $datos = [
          'id_solicitud' => $id_solicitud,
          'titular' => $titular
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
