<?php
namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use App\Models\Gfsiniestros\Solicitudes;
use App\Models\Gfsiniestros\Beneficiarios;
use App\Models\Framework\Direcciones;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Helpme;

class PdfTransferencia extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:PdfTransferencia|index', ['only' => ['index']]);
  }

  public function index($id_beneficiario){

    $beneficiario = Beneficiarios::beneficiarioFullData($id_beneficiario);


    $fpdf = new customPdf('P', 'cm', 'Letter');
    $fpdf->setConfig('beneficiario',$beneficiario);
    $fpdf->SetTitle(utf8_decode("Formato para transferencia electrónica de fondos"));
    $fpdf->SetAuthor('ASSEGURO');
    $fpdf->setSourceFile("../resources/templates/transferencia.pdf");
    $fpdf->AddFont('Metropolis','','metropolis.php');
    $fpdf->SetFont('Metropolis','',10);
    $fpdf->SetFontSize(12);
    $fpdf->SetFillColor(235,227,239);
    $fpdf->SetTextColor(0,0,0);

    $fpdf->AddPage();
    $tplId1 = $fpdf->importPage(1);
    $fpdf->useTemplate($tplId1, .4, .4, 21);

    if(($beneficiario->clabe == null)||($beneficiario->banco == null)){
      $fpdf->SetXY(3,4);
      $fpdf->SetTextColor(255,0,0);
      $fpdf->SetFontSize(20);
      $fpdf->SetFillColor(255,255,255);
      $fpdf->MultiCell(16,2,'LA FORMA DE PAGO CAMBIO POR LO QUE ES NECESARIO MODIFICAR EL FORMULARIO DEL BENEFICIARIO PARA AGREGAR LOS CAMPOS BANCO Y CLABE',0,'C',true);
    }else{

        $fpdf->SetXY(14,2);
        $fpdf->MultiCell(5,.3,date("d-m-Y H:i:s"),0,'C',false);
        $fpdf->SetXY(2.8,10.5);
        $fpdf->MultiCell(16,.3,utf8_decode(strip_tags($beneficiario->nombres.' '.$beneficiario->paterno.' '.$beneficiario->materno)),0,'C',false);
        $fpdf->SetXY(2.8,12.5);
        $fpdf->MultiCell(8,.3,utf8_decode(strip_tags($beneficiario->rfc)),0,'C',false);
        $fpdf->SetXY(11,12.5);
        $fpdf->MultiCell(8,.3,utf8_decode(strip_tags($beneficiario->tel)),0,'C',false);
        $fpdf->SetXY(2.8,14.4);
        $fpdf->MultiCell(8,.3,utf8_decode(strip_tags($beneficiario->mail)),0,'C',false);
        $fpdf->SetXY(11,14.4);
        $fpdf->MultiCell(8,.3,utf8_decode(strip_tags($beneficiario->banco)),0,'C',false);

        $pos = 4.040;
        for($i=0; $i<18; $i++){
          $pos += .7;
          $fpdf->SetXY($pos,16.5);
          $fpdf->MultiCell(.5,.3,utf8_decode(strip_tags(substr($beneficiario->clabe, $i, 1))),0,'C',false);
        }

        $fpdf->SetXY(2.8,20);
        $fpdf->MultiCell(16,.3,utf8_decode(strip_tags($beneficiario->nombres.' '.$beneficiario->paterno.' '.$beneficiario->materno)),0,'C',false);
    }
    ob_start();
    $token = Helpme::token();
    $path = 'tmp/'.$token.'.pdf';
    $fpdf->Output('F', $path);
    $datos = [
        'path' => $path,
        'breadcrumbs' => ' /  PDF / Transferencia ',
        'id_beneficiario' => $id_beneficiario
    ];
    return view('pdf/pdf')->with('datos', $datos);
    ob_flush();
  }
}

class customPdf extends Fpdi
{

    var $beneficiario;
    function setConfig($var,$val)
    {
        $this->{$var} = $val;
    }

    public function Header(){}
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
