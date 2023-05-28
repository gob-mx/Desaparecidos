<?php

namespace App\Models\Gfsiniestros;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use App\Models\Gfsiniestros\Beneficiarios;
use App\Models\Gfsiniestros\Solicitudes;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;

class Viewbeneficiarios extends Model
{
  protected $table = 'view_beneficiarios';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function obtener_beneficiarios($id_solicitud){
    $beneficiarios = new Viewbeneficiarios();
    $dataTable = new DT(
      $beneficiarios->where('id_solicitud', '=', $id_solicitud),
      ['id', 'nombres', 'ap_paterno', 'ap_materno', 'parentesco', 'id_solicitud']
    );

    $dataTable->setFormatRowFunction(function ($beneficiarios) {
      return [
        $beneficiarios->id,
        $beneficiarios->nombres.' '.$beneficiarios->ap_paterno.' '.$beneficiarios->ap_materno ,
        $beneficiarios->parentesco,
        self::ou1($beneficiarios->id, $beneficiarios->id_solicitud, $beneficiarios->nombres.' '.$beneficiarios->ap_paterno.' '.$beneficiarios->ap_materno)
      ];
    });
    return $dataTable->make();
  }

  static function ou1($id_beneficiario, $id_solicitud, $name){

    $ben = Beneficiarios::getDatosBeneficiario($id_beneficiario);
    $sol = Solicitudes::recuperar($id_solicitud);

    $salida = '
    <a onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/form_data/'.$id_beneficiario.'/'.$id_solicitud.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-list-1"></i>
    </a>
    ';

    $salida .= '
    <a onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/upload/'.$id_beneficiario.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-folder-3"></i>
    </a>
    ';

    $salida .= '
    <a data-function="'.$id_beneficiario.'" class="ben_js_fn_02 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-edit"></i>
    </a>
    ';

    $salida .= '
    <a data-function="'.$id_beneficiario.'" data-name="'.$name.'"  class="ben_js_fn_03 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-delete-1"></i>
    </a>
    ';

    if($ben->cat_status_print == 102){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdfpldext/'.$id_beneficiario.'\');" data-original-title="PDL para Extranjeros" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
				<i class="fa fa-print"></i>
			</a>
      ';
    }

    if($ben->cat_status_print == 102){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdfpld/'.$id_beneficiario.'\');" data-original-title="PDL" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
				<i class="fa fa-print"></i>
			</a>
      ';
    }

    if(($ben->cat_status_print == 102)&&($sol->cat_forma_pago == 66)){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato de transferencia" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
				<i class="fa fa-print"></i>
			</a>
      ';
    }

    return $salida;
  }

  static function obtener_beneficiarios_admin($id_solicitud){
    $beneficiarios = new Viewbeneficiarios();
    $dataTable = new DT(
      $beneficiarios->where('id_solicitud', '=', $id_solicitud),
      ['id', 'nombres', 'ap_paterno', 'ap_materno', 'parentesco', 'id_solicitud']
    );

    $dataTable->setFormatRowFunction(function ($beneficiarios) {
      return [
        $beneficiarios->id,
        $beneficiarios->nombres.' '.$beneficiarios->ap_paterno.' '.$beneficiarios->ap_materno ,
        $beneficiarios->parentesco,
        self::ou2($beneficiarios->id, $beneficiarios->id_solicitud)
      ];
    });
    return $dataTable->make();
  }

  static function ou2($id_beneficiario, $id_solicitud){

    if(1==0){
      $salida = '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }else{
      $salida = '
      <a href="#" data-original-title="No se ha cargado" data-toggle="m-tooltip" data-placement="top"  class="manusize btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
      	<i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(1==1){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdftransferencia/'.$id_beneficiario.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    return $salida;
  }
}
