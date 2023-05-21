<?php

namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Gfsiniestros\Viewbeneficiarios;
use App\Models\Framework\Catalogo;
use App\Models\Gfsiniestros\Polizas;
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

  public function form_data($id_beneficiario, $id_solicitud)
  {
        $select_nacionalidades = Catalogo::SelectNacionalidades();
        $select_paises = Catalogo::SelectPaises();
        $parentesco = Catalogo::selectCatalog('Parentesco',null);
        $estados = Catalogo::SelectEstados();
        $actividades = Catalogo::selectCatalog('Actividades', null);
        $ocupaciones = Catalogo::SelectOcupaciones();
        $beneficiario = ModelBeneficiarios::beneficiario($id_beneficiario);
        $titular = ModelSolicitud::titular($id_solicitud);
        $datos = [
            'id_beneficiario' => $id_beneficiario,
            'id_solicitud' => $id_solicitud,
            'nacionalidades' => $select_nacionalidades,
            'paises' => $select_paises,
            'parentesco' => $parentesco,
            'estados' => $estados,
            'ocupaciones' => $ocupaciones,
            'beneficiario' => $beneficiario,
            'titular' => $titular,
            'actividades' => $actividades
        ];
        return view('beneficiarios/form_data')->with('datos', $datos);
  }

  public function index()
  {
    exit();
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

  public function listado_beneficiarios($id_solicitud)
  {
       print json_encode(Viewbeneficiarios::obtener_beneficiarios($id_solicitud));
  }

  public function datos($id_beneficiario)
  {
      $datos = [
          'id_solicitud' => '$id_solicitud',
          'titular' => '$titular'
      ];
      return view('beneficiarios/datos')->with('datos', $datos);
  }

}
