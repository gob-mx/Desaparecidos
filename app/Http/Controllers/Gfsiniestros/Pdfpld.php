<?php
namespace App\Http\Controllers\Gfsiniestros;
use App\Http\Controllers\Framework\Controller;
use App\Models\Gfsiniestros\Solicitudes;
use App\Models\Gfsiniestros\Beneficiarios;
use App\Models\Framework\Direcciones;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Helpme;

class PdfPld extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:PdfPld|index', ['only' => ['index']]);
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
    $fpdf->SetTitle(utf8_decode("PLD"));
    $fpdf->SetAuthor('ASSEGURO');
    $fpdf->setSourceFile("../resources/templates/pld.pdf");
    $fpdf->AddFont('Metropolis','','metropolis.php');
    $fpdf->SetFont('Metropolis','',10);
    $fpdf->SetFillColor(235,227,239);
    $fpdf->SetTextColor(0,0,0);

    $fpdf->AddPage();
    $tplId1 = $fpdf->importPage(1);
    $fpdf->useTemplate($tplId1, .4, .4, 21);

    $fpdf->SetXY(5,5.8);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->paterno)),0,'L',false);
    $fpdf->SetXY(15,5.8);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->materno)),0,'L',false);
    $fpdf->SetXY(4,6.4);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->nombres)),0,'L',false);
    $fpdf->SetXY(5.5,7);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->fecha_nac)),0,'L',false);
    $fpdf->SetXY(15.1,7);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($lugar_nacimiento->pais)),0,'L',false);
    $fpdf->SetXY(6.8,7.6);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($lugar_nacimiento->estado)),0,'L',false);
    $fpdf->SetXY(15.1,7.6);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->nacion)),0,'L',false);
    $fpdf->SetXY(9,8.2);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->ocupa)),0,'L',false);
    $fpdf->SetXY(5.5,8.8);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->tel)),0,'L',false);
    $fpdf->SetXY(13.3,8.8);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->mail)),0,'L',false);


    $pos = 2.80;
    for($i=0; $i<18; $i++){
      $pos += .485;
      $fpdf->SetXY($pos,9.4);
      $fpdf->MultiCell(.5,.3,utf8_decode(strip_tags(substr($beneficiario->curp, $i, 1))),0,'C',false);
    }

    $pos = 13.31;
    for($i=0; $i<15; $i++){
        if(substr($beneficiario->rfc, $i, 1) !== '-'){
          $pos += .508;
          $fpdf->SetXY($pos,9.4);
          $fpdf->MultiCell(.5,.3,utf8_decode(strip_tags(substr($beneficiario->rfc, $i, 1))),0,'C',false);
        }
    }


    if($beneficiario->efirma){
      $fpdf->SetXY(12.6,9.95);
      $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->efirma)),0,'L',false);
    }

    $fpdf->SetXY(3.35,11);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_calle)),0,'L',false);

    $fpdf->SetXY(13,11);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_num_ext)),0,'L',false);

    if($beneficiario->d_num_int){
      $fpdf->SetXY(18,11);
      $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_num_int)),0,'L',false);
    }

    $fpdf->SetXY(3.35,11.6);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_asenta)),0,'L',false);

    $fpdf->SetXY(17,11.6);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_cp)),0,'L',false);

    $fpdf->SetXY(5.5,12.2);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_mun)),0,'L',false);

    $fpdf->SetXY(15,12.2);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_ciudad)),0,'L',false);

    $fpdf->SetXY(5.5,12.8);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->d_estado)),0,'L',false);

    $fpdf->SetXY(14,12.8);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags('Estados Unidos Mexicanos')),0,'L',false);

    $fpdf->SetXY(2.2,22.5);
    $fpdf->MultiCell(7,.3,date("d-m-Y H:i:s"),0,'L',false);

    $fpdf->SetXY(6.6,22.5);
    $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->nombres.' '.$beneficiario->paterno.' '.$beneficiario->materno)),0,'C',false);







    ob_start();
    $token = Helpme::token();
    $path = 'tmp/'.$token.'.pdf';
    $fpdf->Output('F', $path);
    $datos = [
        'path' => $path,
        'breadcrumbs' => ' /  PDF / PLD ',
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
