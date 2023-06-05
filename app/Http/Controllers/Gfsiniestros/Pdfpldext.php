<?php
namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use App\Models\Gfsiniestros\Solicitudes;
use App\Models\Gfsiniestros\Beneficiarios;
use App\Models\Framework\Direcciones;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Helpme;

class PdfPldExt extends Controller
{

  public function __construct()
  {
    $this->middleware('permiso:PdfPldExt|index', ['only' => ['index']]);
  }

  public function index($id_beneficiario){

    $beneficiario = Beneficiarios::beneficiarioFullData($id_beneficiario);
    if($beneficiario->pais_nac == 141){
      $lugar_nacimiento = Direcciones::lugaresMex($beneficiario->id_nac);
    }elseif($beneficiario->pais_nac == 65){
      $lugar_nacimiento = Direcciones::lugaresUsa($beneficiario->id_nac);
    }

    $fpdf = new customPdf('P', 'cm', 'Letter');
    $fpdf->setConfig('status',42);
    $fpdf->SetTitle(utf8_decode("PLD-EXTRANJEROS"));
    $fpdf->SetAuthor('ASSEGURO');
    $fpdf->setSourceFile("../resources/templates/pldext.pdf");
    $fpdf->AddFont('Metropolis','','metropolis.php');
    $fpdf->SetFont('Metropolis','',10);
    $fpdf->SetFillColor(235,227,239);
    $fpdf->SetTextColor(0,0,0);

    $fpdf->AddPage();
    $tplId1 = $fpdf->importPage(1);
    $fpdf->useTemplate($tplId1, .4, .4, 21);

    $fpdf->SetXY(5,5.5);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->paterno.' '.$beneficiario->materno)),0,'L',false);
    $fpdf->SetXY(4,6.1);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->nombres)),0,'L',false);
    $fpdf->SetXY(5.5,6.7);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->fecha_nac)),0,'L',false);
    $fpdf->SetXY(15.1,6.7);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($lugar_nacimiento->pais)),0,'L',false);
    $fpdf->SetXY(6.8,7.3);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($lugar_nacimiento->estado)),0,'L',false);
    $fpdf->SetXY(15.1,7.3);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->nacion)),0,'L',false);
    $fpdf->SetXY(9,7.9);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->ocupa)),0,'L',false);
    $fpdf->SetXY(5.5,8.5);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->tel)),0,'L',false);
    $fpdf->SetXY(13.3,8.5);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->mail)),0,'L',false);
    $fpdf->SetXY(2,9.1);
    $fpdf->MultiCell(10,.3,utf8_decode(strip_tags($beneficiario->curp)),0,'C',false);
    $fpdf->SetXY(14,9.1);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->rfc)),0,'C',false);
    $fpdf->SetXY(3.35,10.2);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_calle)),0,'L',false);
    $fpdf->SetXY(13,10.2);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_num_ext)),0,'L',false);

    if($beneficiario->d_num_int){
      $fpdf->SetXY(18,10.2);
      $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_num_int)),0,'L',false);
    }

    $fpdf->SetXY(3.35,10.8);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_asenta)),0,'L',false);
    $fpdf->SetXY(15,10.8);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_cp)),0,'L',false);
    $fpdf->SetXY(5.5,11.4);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_mun)),0,'L',false);
    $fpdf->SetXY(15,11.4);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_ciudad)),0,'L',false);
    $fpdf->SetXY(5.5,12);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_estado)),0,'L',false);
    $fpdf->SetXY(13,12);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags('Estados Unidos Mexicanos')),0,'L',false);


    $fpdf->SetXY(4,13);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags('Direccion en el extranjero')),0,'L',false);
    $fpdf->SetXY(6.5,13.6);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags('Estado ciudad o poblacion')),0,'L',false);
    $fpdf->SetXY(14.6,13.6);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags('Estados Unidos de América')),0,'L',false);


    $fpdf->SetXY(1.6,22.5);
    $fpdf->MultiCell(4,.3,date("d-m-Y H:i:s"),0,'C',false);
    $fpdf->SetXY(6.6,22.5);
    $fpdf->MultiCell(6,.3,utf8_decode(strip_tags($beneficiario->nombres.' '.$beneficiario->paterno.' '.$beneficiario->materno)),0,'C',false);


    ob_start();
    $token = Helpme::token();
    $path = 'tmp/'.$token.'.pdf';
    $fpdf->Output('F', $path);
    $datos = [
        'path' => $path,
        'breadcrumbs' => ' /  PDF / PLD Extranjero ',
        'id_beneficiario' => $id_beneficiario
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
