<?php

namespace App\Models\Gfsiniestros;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gfsiniestros\Solicitudes;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;

class Viewsolicitudes extends Model
{
  protected $table = 'view_solicitudes';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function obtener_solicitudes_filter(){
    $solicitud = new Viewsolicitudes();
    $dataTable = new DT(
      $solicitud->where('id', '!=', 1)->where('id_usuario','=',$_SESSION['id_usuario']),
      ['id', 'Nombre', 'Paterno', 'Materno', 'RFC', 'Forma_Pago', 'Benef']
    );

    $dataTable->setFormatRowFunction(function ($solicitud) {
      return [
        $solicitud->id ,
        $solicitud->Nombre.' '.$solicitud->Paterno.' '.$solicitud->Materno ,
        $solicitud->RFC ,
        $solicitud->Forma_Pago ,
        $solicitud->Benef ,
        self::ou1($solicitud->id)
      ];
    });
    return $dataTable->make();
  }

  static function ou1($id_solicitud){
    $sol = Solicitudes::asegurado($id_solicitud);
    $fal = Solicitudes::fallecido($id_solicitud);
    $inc = Solicitudes::contarFaltantes($id_solicitud);
    $salida = '<div class="row">';

    $salida .= '
    <div class="col-12"><a onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/list/'.$id_solicitud.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-users"></i>
    </a>
    ';

    $salida .= '
    <a onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/form_data/'.$id_solicitud.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-list-1"></i>
    </a>
    ';

    $salida .= '
    <a onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/upload/'.$id_solicitud.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-folder-3"></i>
    </a>
    ';

    $salida .= '
    <a data-function="'.$id_solicitud.'" class="sol_js_fn_06 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-speech-bubble-1"></i>
    </a></div><div class="col-12">
    ';

    if(($sol->cat_status_print == 102)&&($fal->cat_status_print == 102) && ($inc > 0)){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/list/'.$id_solicitud.'\');" data-original-title="Hace falta completar datos para '.$inc.' beneficiario(s)" data-toggle="m-tooltip" data-placement="top"  class="btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air manusize">
				<i class="fa fa-hourglass-half"></i>
			</a>
      ';
    }

    if((($sol->cat_status_print == 102)&&($fal->cat_status_print == 102)) && ($inc==0)){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'pdfreclamacion/'.$id_solicitud.'\');" data-original-title="Fto de Reclamación" data-toggle="m-tooltip" data-placement="top" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air manusize">
				<i class="fa fa-print"></i>
			</a>
      ';
    }
    $salida .= '</div></div>';

    return $salida;
  }


  static function obtener_solicitudes(){
    $solicitud = new Viewsolicitudes();
    $dataTable = new DT(
      $solicitud->where('id', '!=', 1),
      ['id', 'Nombre', 'Paterno', 'Materno', 'RFC', 'Forma_Pago', 'Benef', 'nombres', 'apellido_paterno', 'apellido_materno']
    );

    $dataTable->setFormatRowFunction(function ($solicitud) {
      return [
        $solicitud->id ,
        $solicitud->nombres.' '.$solicitud->apellido_paterno.' '.$solicitud->apellido_materno ,
        $solicitud->Nombre.' '.$solicitud->Paterno.' '.$solicitud->Materno ,
        $solicitud->RFC ,
        $solicitud->Forma_Pago ,
        $solicitud->Benef ,
        self::ou2($solicitud->id)
      ];
    });
    return $dataTable->make();
  }

  static function ou2($id_solicitud){

    $sol = Solicitudes::recuperar($id_solicitud);
    $salida = '<div class="row">';

    $salida .= '
    <div class="col-12"><a onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/listadmin/'.$id_solicitud.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-users"></i>
    </a>
    ';

    $salida .= '
    <a data-function="'.$id_solicitud.'" class="sol_js_fn_06 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-speech-bubble-1"></i>
    </a>
    ';

    if(!empty($sol->ine_fallecido)){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'viewer/AS_Solicitudes/ine_fallecido/'.$id_solicitud.'\');" data-original-title="INE" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }else{
      $salida .= '
      <a href="#" data-original-title="INE :(" data-toggle="m-tooltip" data-placement="top"  class="manusize btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
      	<i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(!empty($sol->acta_nac_fallecido)){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'viewer/AS_Solicitudes/acta_nac_fallecido/'.$id_solicitud.'\');" data-original-title="Acta Nacimiento" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a></div>
      ';
    }else{
      $salida .= '
      <a href="#" data-original-title="Acta nacimiento :(" data-toggle="m-tooltip" data-placement="top"  class="manusize btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
      	<i class="fa fa-file-pdf"></i>
      </a></div>
      ';
    }

    if(!empty($sol->acta_defuncion)){
      $salida .= '
      <div class="col-12"><a href="#" onclick="carga_archivo(\'contenedor_principal\',\'viewer/AS_Solicitudes/acta_defuncion/'.$id_solicitud.'\');" data-original-title="Acta Defunción" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a>
      ';
    }else{
      $salida .= '
      <div class="col-12"><a href="#" data-original-title="Acta Defunción :(" data-toggle="m-tooltip" data-placement="top"  class="manusize btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
      	<i class="fa fa-file-pdf"></i>
      </a>
      ';
    }

    if(!empty($sol->fto_reclamacion)){
      $salida .= '
      <a href="#" onclick="carga_archivo(\'contenedor_principal\',\'viewer/AS_Solicitudes/fto_reclamacion/'.$id_solicitud.'\');" data-original-title="Formato Reclamación" data-toggle="m-tooltip" data-placement="top" class="manusize btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air">
        <i class="fa fa-file-pdf"></i>
      </a></div>
      ';
    }else{
      $salida .= '
      <a href="#" data-original-title="Formato Reclamación :(" data-toggle="m-tooltip" data-placement="top"  class="manusize btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
      	<i class="fa fa-file-pdf"></i>
      </a></div>
      ';
    }

    $salida .= '</div>';

    return $salida;
  }
}
