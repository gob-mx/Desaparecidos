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

  static function ou2($id){


    $salida = '
    <a data-function="'.$id.'" class="usr_js_fn_03 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-cogwheel"></i>
    </a>
    ';
    if(9 == 9){
        $salida .= '
        <a data-function="'.$id.'" id="usr_js_fn_07" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
          <i class="flaticon-lock"></i>
        </a>
        ';
    }

    if(Helpme::tiene_permiso('Login|auditoria')){
      $salida .= '
      <a data-function="'.$id.'" class="usr_js_fn_09 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
        <i class="flaticon-eye"></i>
      </a>
      ';
    }

    return $salida;
  }
}
