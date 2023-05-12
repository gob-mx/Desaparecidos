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
  }

  public function index()
  {
    exit();
  }

  public function form()
  {
       return view('wizard/listado');
  }
  public function nuevo_registro()
  {
    $datos = [
        'resp' => 'true'
    ];
    print json_encode($datos);
  }
}
