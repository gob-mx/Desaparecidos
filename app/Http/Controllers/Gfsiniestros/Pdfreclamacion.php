<?php
namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use App\Models\Gfsiniestros\Solicitudes;
use App\Models\Gfsiniestros\Beneficiarios;
use App\Models\Framework\Direcciones;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Helpme;

class PdfReclamacion extends Controller
{

  public function __construct()
  {
      //$this->middleware('permiso:Pdf|index', ['only' => ['index']]);
  }

  public function index($id_solicitud){
    $asegurado = Solicitudes::aseguradoFullData($id_solicitud);

    if($asegurado->pais_fall == 141){
      $lugar_fallecimiento = Direcciones::lugaresMex($asegurado->fal_id);
    }elseif($asegurado->pais_fall == 65){
      $lugar_fallecimiento = Direcciones::lugaresUsa($asegurado->fal_id);
    }

    if($asegurado->pais_nac == 141){
      $luga_nacimiento = Direcciones::lugaresMex($asegurado->nac_id);
    }elseif($asegurado->pais_nac == 65){
      $luga_nacimiento = Direcciones::lugaresUsa($asegurado->nac_id);
    }

    $beneficiarios = Beneficiarios::getArrayBeneficiarios($id_solicitud);


    $fpdf = new customPdf('P', 'cm', 'Letter');
    $fpdf->setConfig('status',42);
    $fpdf->SetTitle(utf8_decode("Formato de reclamación"));
    $fpdf->SetAuthor('ASSEGURO');
    $fpdf->setSourceFile("../resources/templates/reclamacion.pdf");
    $fpdf->AddFont('Metropolis','','Metropolis-Bold.php');
    $fpdf->SetFont('Metropolis','',8);
    $fpdf->SetFillColor(235,227,239);
    $fpdf->SetTextColor(0,0,0);

    $fpdf->AddPage();
    $tplId1 = $fpdf->importPage(1);
    $fpdf->useTemplate($tplId1, .4, .4, 21);

    ob_start();
    $token = Helpme::token();
    $path = 'tmp/'.$token.'.pdf';
    $fpdf->Output('F', $path);
    $datos = [
        'path' => $path,
        'breadcrumbs' => '/ PDF / Reclamación',
        'id_solicitud' => $id_solicitud
    ];
    return view('pdf/pdf')->with('datos', $datos);
    ob_flush();
  }
}

class customPdf extends Fpdi
{

    var $status;

    //$fpdf->setConfig('status',$status);
    function setConfig($var,$val)
    {
        $this->{$var} = $val;
    }

    public function Header(){
      if($this->status !== 42){
        $this->SetTextColor(230,230,230);
        $this->SetFontSize(80);
        $this->RotatedText(3,20,'B O R R A D O R',45);
      }
    }
    public function Footer(){}

      var $angle=0;

    function Rotate($angle,$x=-1,$y=-1)
    {
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0)
        {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }

    function _endpage()
    {
        if($this->angle!=0)
        {
            $this->angle=0;
            $this->_out('Q');
        }
        parent::_endpage();
    }
    function RotatedText($x,$y,$txt,$angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle,$x,$y);
        $this->Text($x,$y,$txt);
        $this->Rotate(0);
    }

    function RotatedImage($file,$x,$y,$w,$h,$angle)
    {
        //Image rotated around its upper-left corner
        $this->Rotate($angle,$x,$y);
        $this->Image($file,$x,$y,$w,$h);
        $this->Rotate(0);
    }

}
