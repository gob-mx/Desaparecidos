<?php
namespace App\Http\Controllers\Gedefi;
use App\Http\Controllers\Framework\Controller;
use Illuminate\Http\Request;
use App\Models\Framework\Catalogo;
use App\Models\Framework\Direcciones;
use App\Models\Gedefi\Desaparecidos as ModelDesaparecidos;

use Helpme;

class Desaparecidos extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Desaparecidos|index', ['only' => ['index']]);
      //$this->middleware('permiso:Desaparecidos|upload_cbp', ['only' => ['upload_cbp']]);
      //$this->middleware('permiso:Desaparecidos|upload_cnb', ['only' => ['upload_cnb']]);
      //$this->middleware('permiso:Desaparecidos|upload_fgj', ['only' => ['upload_fgj']]);
      //$this->middleware('permiso:Desaparecidos|upload', ['only' => ['upload']]);
  }

  public function upload_cbp($file){ return ModelDesaparecidos::upload_excel($file,'cbp');}
  public function upload_cnb($file){ return ModelDesaparecidos::upload_excel($file,'cnb');}
  public function upload_fgj($file){ return ModelDesaparecidos::upload_excel($file,'fgj');}

  public function index(){exit();}

  public function upload()
  {
      $datos = [
          'date' => date("Y-m-d H:i:s")
      ];
      return view('desaparecidos/upload')->with('datos', $datos);
  }
}
