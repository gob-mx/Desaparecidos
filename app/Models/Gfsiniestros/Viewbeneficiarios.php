<?php

namespace App\Models\Gfsiniestros;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
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
        self::ou2($beneficiarios->id, $beneficiarios->id_solicitud)
      ];
    });
    return $dataTable->make();
  }

  static function ou2($id_beneficiario, $id_solicitud){


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
    <a data-function="'.$id_beneficiario.'" class="sol_js_fn_06 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-edit"></i>
    </a>
    ';

    $salida .= '
    <a data-function="'.$id_beneficiario.'" class="sol_js_fn_07 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-delete-1"></i>
    </a>
    ';

    return $salida;
  }
}
