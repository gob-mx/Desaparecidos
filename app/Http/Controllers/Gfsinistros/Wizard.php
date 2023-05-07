<?php
namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use App\Models\Gfsiniestros\Wizard as ModelWizard;
use App\Models\Framework\Roles;
use App\Models\Framework\Usuarios;
use App\Models\Framework\Login as ModelLogin;
use Illuminate\Http\Request;
use Helpme;

class Wizard extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:Wizard|index', ['only' => ['index']]);
      $this->middleware('permiso:Wizard|nuevo_registro', ['only' => ['nuevo_registro']]);
  }

  public function index()
  {
    exit();
  }

  public function form()
  {
       return view('wizard/mainform');
  }

  public function nuevo_registro()
  {
    $datos = [
        'id_evaluacion' => 'aqui',
        'resp' => 'algo',
        'stat' => 'mas',
        'show_pdf' => 'que',
        'riesgo' => 'enviar',
        'valoracion' => 'para poner'
    ];
    print json_encode($datos);
  }
}
