<?php

namespace App\Models\Gfsiniestros;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;

class Viewsolicitudes extends Model
{
  protected $table = 'view_solicitudes';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function obtener_solicitudes(){
    $solicitud = new Viewsolicitudes();
    $dataTable = new DT(
      $solicitud,
      ['id', 'Nombre', 'Paterno', 'Materno', 'RFC', 'Forma_Pago', 'Benef']
    );

    $dataTable->setFormatRowFunction(function ($solicitud) {
      return [
        $solicitud->id ,
        $solicitud->Nombre ,
        $solicitud->Paterno ,
        $solicitud->Materno ,
        $solicitud->RFC ,
        $solicitud->Forma_Pago ,
        $solicitud->Benef ,
        self::ou2($solicitud->id)
      ];
    });
    return $dataTable->make();
  }

  static function ou2($id_solicitud){


    $salida = '
    <a onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/list/'.$id_solicitud.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-users"></i>
    </a>
    ';

    $salida .= '
    <a onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/form_data/'.$id_solicitud.'\');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-list-1"></i>
    </a>
    ';

    $salida .= '
    <a onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/upload/'.$id_solicitud.'\');" class="sol_js_fn_05 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-folder-3"></i>
    </a>
    ';

    return $salida;
  }
}
