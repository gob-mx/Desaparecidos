<?php
namespace App\Models\Framework;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Direcciones extends Model
{
  protected $table = 'AS_Direcciones';
  protected $primaryKey = 'id';
  public $timestamps = false;

  static function getAll(){
    return Direcciones::all();
  }

  static function lugaresMex($id){
    $data = DB::table('AS_Estado_pais AS edopais')
              ->join('SPM_ciudades AS cty','edopais.id_ciudad','=','cty.id')
              ->join('SPM_estados AS edo','edopais.id_estado','=','edo.id')
              ->join('CAT_Paises AS paises','edopais.id_pais','=','paises.id')
              ->select('paises.pais', 'edo.estado', 'cty.ciudad')
              ->where('edopais.id', '=', $id)
              ->get();
    return $data[0];
  }

  static function lugaresUsa($id){
    $data = DB::table('AS_Estado_pais AS edopais')
              ->join('CAT_Estados_usa AS edo_city','edopais.id_ciudad','=','edo_city.id')
              ->join('CAT_Paises AS pais','edopais.id_pais','=','pais.id')
              ->select('pais.pais','edo_city.estado', 'edo_city.ciudad')
              ->where('edopais.id', '=', $id)
              ->get();
    return $data[0];
  }


  static function select_asentamientos($cp){
      $array = array();
      $asentamientos = DB::table('SPM_CP as cp')
                ->select('cp.id', 'cp.asentamiento')
                ->where('cp.codigo_postal', '=', $cp)
                ->get();
      if(count($asentamientos)>=1){
          $cont = 0;
          foreach ($asentamientos as $row) {
              $array[$cont]['value']=$row->id;
              $array[$cont]['valor']=$row->asentamiento;
              $cont++;
          }
      }
      return Helpme::setOption($array,null);
  }

  static function get_all($id_cp){
      $data = DB::table('SPM_CP as cp')
                ->join('SPM_estados as est','cp.id_estado','=','est.id')
                ->join('SPM_municipios as mun','cp.id_municipio','=','mun.id')
                ->join('SPM_ciudades as cty','cp.id_ciudad','=','cty.id')
                ->select('est.estado', 'mun.municipio', 'cty.ciudad')
                ->where('cp.id', '=', $id_cp)
                ->get();
      return $data[0];
  }

  static function storage_addresses($iden){

    $data = DB::table('AS_Direcciones AS asd')
              ->join('SPM_CP AS cp','asd.id_cp', '=', 'cp.id')
              ->join('SPM_estados AS edo','cp.id_estado', '=', 'edo.id')
              ->join('SPM_municipios AS mpio','cp.id_municipio', '=', 'mpio.id')
              ->join('SPM_ciudades AS cty','cp.id_ciudad', '=', 'cty.id')
              ->select('asd.id',	'asd.calle', 'asd.num_ext', 'asd.num_int', 'cp.asentamiento','cp.codigo_postal', 'edo.estado','cty.ciudad', 'mpio.municipio')
              ->where('asd.id_solicitud', '=', $iden)
              ->get();
    return $data;

  }

  static function getHumanAddress($id){

    $data = DB::table('AS_Direcciones AS asd')
              ->join('SPM_CP AS cp','asd.id_cp', '=', 'cp.id')
              ->join('SPM_estados AS edo','cp.id_estado', '=', 'edo.id')
              ->join('SPM_municipios AS mpio','cp.id_municipio', '=', 'mpio.id')
              ->join('SPM_ciudades AS cty','cp.id_ciudad', '=', 'cty.id')
              ->select('asd.id',	'asd.calle', 'asd.num_ext', 'asd.num_int', 'cp.asentamiento','cp.codigo_postal', 'edo.estado','cty.ciudad', 'mpio.municipio')
              ->where('asd.id_solicitud', '=', $id)
              ->get();
    if(isset($data[0])){
      return $data[0]->calle.' '.$data[0]->num_ext.' '.$data[0]->num_int.' '.$data[0]->asentamiento;
    }else{
      return null;
    }

  }

  static function insert($request){
    $id = DB::table('AS_Direcciones')->insertGetId(
        [
            'id_cp' => $request->input('asentamiento'),
            'id_solicitud' => $request->input('iden'),
            'calle' => $request->input('calle'),
            'num_ext' => $request->input('num_ext'),
            'num_int' => $request->input('num_int'),
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );

    $datos = [
        'id_direccion' => $id
    ];
    return $datos;
  }

  static function get_estados($id_pais,$id=null){
      $array = array();
      $cat = array();

      switch ($id_pais) {
        case 141:
            $cat = DB::table('SPM_estados AS mex')
                  ->select(	'mex.id as id', 'mex.estado as estado')
                  ->orderBy('mex.estado', 'asc')
                  ->get();
            break;
        case 65:
            $cat = DB::table('CAT_Estados_usa AS usa')
                  ->select(	'usa.clave1 as id', 'usa.estado')
                  ->groupBy('usa.estado')
                  ->orderBy('usa.estado', 'asc')
                  ->get();
            break;
      }

        $cont = 0;
        foreach ($cat as $row) {
            $array[$cont]['value']=$row->id;
            $array[$cont]['valor']=$row->estado;
            $cont++;
        }

      return Helpme::setOption($array,$id);
  }

  static function get_ciudades($id_pais,$id_estado,$id=null){
      $array = array();
      $cat = array();

      switch ($id_pais) {
        case 141:
            $cat = DB::table('SPM_CP AS cp')
                  ->join('SPM_ciudades AS cty','cp.id_ciudad', '=', 'cty.id')
                  ->join('SPM_estados AS edo','cp.id_estado', '=', 'edo.id')
                  ->select('cty.id','cty.ciudad')
                  ->where('edo.id', '=', $id_estado)
                  ->groupBy('cty.ciudad')
                  ->orderBy('cty.ciudad', 'asc')
                  ->get();
            break;
        case 65:
            $cat = DB::table('CAT_Estados_usa AS usa')
                  ->select(	'usa.id', 'usa.ciudad')
                  ->where('usa.clave1', '=', $id_estado)
                  ->orderBy('usa.ciudad', 'asc')
                  ->get();
            break;
      }

        $cont = 0;
        foreach ($cat as $row) {
            $array[$cont]['value']=$row->id;
            $array[$cont]['valor']=$row->ciudad;
            $cont++;
        }

      return Helpme::setOption($array,$id);
  }

}
