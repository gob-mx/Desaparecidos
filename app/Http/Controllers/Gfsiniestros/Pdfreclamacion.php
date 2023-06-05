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
      $this->middleware('permiso:PdfReclamacion|index', ['only' => ['index']]);
  }

  public function index($id_solicitud){
    $asegurado = Solicitudes::aseguradoFullData($id_solicitud);

    if($asegurado->pais_fall == 141){
      $lugar_fallecimiento = Direcciones::lugaresMex($asegurado->fal_id);
    }elseif($asegurado->pais_fall == 65){
      $lugar_fallecimiento = Direcciones::lugaresUsa($asegurado->fal_id);
    }

    if($asegurado->pais_nac == 141){
      $lugar_nacimiento = Direcciones::lugaresMex($asegurado->nac_id);
    }elseif($asegurado->pais_nac == 65){
      $lugar_nacimiento = Direcciones::lugaresUsa($asegurado->nac_id);
    }

    $beneficiarios = Beneficiarios::getArrayBeneficiarios($id_solicitud);


    $fpdf = new customPdf('P', 'cm', 'Letter');
    $fpdf->setConfig('asegurado',$asegurado);
    $fpdf->setConfig('lugar_nacimiento',$lugar_nacimiento);
    $fpdf->setConfig('lugar_fallecimiento',$lugar_fallecimiento);
    $fpdf->SetTitle(utf8_decode("Formato de reclamación"));
    $fpdf->SetAuthor('ASSEGURO');
    $fpdf->setSourceFile("../resources/templates/reclamacion.pdf");
    $fpdf->AddFont('Metropolis','','metropolis.php');
    $fpdf->SetFont('Metropolis','',8);
    $fpdf->SetFillColor(235,227,239);
    $fpdf->SetTextColor(0,0,0);
    $fpdf->SetFontSize(8);

    $ben_num = count($beneficiarios);
    $pages = number_format(ceil($ben_num/4),0);
    $ciclos = 0;
    $ben_print = 0;
    $ben_rest = $ben_num;

    for($i=0; $i<$pages; $i++){
      $fpdf->AddPage();
      $tplId1 = $fpdf->importPage(1);
      $fpdf->useTemplate($tplId1, .4, .4, 21);
      $print_ord = ($ben_rest >= 4)?4:$ben_rest;

      for($k=0; $k<$print_ord; $k++){

        $beneficiario = Beneficiarios::beneficiarioFullData($beneficiarios[$k+($i*4)]->id_beneficiario);
        switch ($k) {case 0:$gap=2.2;break;case 1:$gap=2.17;break;case 2:$gap=2.15;break;case 3:$gap=2.16;break;}

        $fpdf->SetXY(5.5,18.2+($k*$gap));
        $fpdf->MultiCell(7,.3,utf8_decode(strip_tags($beneficiario->paterno.' '.$beneficiario->materno.' '.$beneficiario->nombres)),0,'L',false);

        $fpdf->SetXY(17.7,18.2+($k*$gap));
        $fpdf->MultiCell(7,.3,utf8_decode(strip_tags(substr($beneficiario->fecha_nac, -2, 1))),0,'L',false);
        $fpdf->SetXY(18.2,18.2+($k*$gap));
        $fpdf->MultiCell(7,.3,utf8_decode(strip_tags(substr($beneficiario->fecha_nac, -1))),0,'L',false);
        $fpdf->SetXY(18.7,18.2+($k*$gap));
        $fpdf->MultiCell(7,.3,utf8_decode(strip_tags(substr($beneficiario->fecha_nac, -5, 1))),0,'L',false);
        $fpdf->SetXY(19.1,18.2+($k*$gap));
        $fpdf->MultiCell(7,.3,utf8_decode(strip_tags(substr($beneficiario->fecha_nac, -4, 1))),0,'L',false);
        $fpdf->SetXY(19.5,18.2+($k*$gap));
        $fpdf->MultiCell(7,.3,utf8_decode(strip_tags(substr($beneficiario->fecha_nac, -8, 1))),0,'L',false);
        $fpdf->SetXY(19.9,18.2+($k*$gap));
        $fpdf->MultiCell(7,.3,utf8_decode(strip_tags(substr($beneficiario->fecha_nac, -7, 1))),0,'L',false);
        $fpdf->SetXY(2.5,18.7+($k*$gap));
        $fpdf->MultiCell(11,.3,utf8_decode(strip_tags($beneficiario->d_calle.' '.$beneficiario->d_num_ext.' - '.$beneficiario->d_num_int.', '.$beneficiario->d_asenta.', '.$beneficiario->d_ciudad.', '.$beneficiario->d_estado.' CP-'.$beneficiario->d_cp)),0,'L',false);
        $fpdf->SetXY(16,18.7+($k*$gap));
        $fpdf->MultiCell(11,.3,utf8_decode(strip_tags($beneficiario->tel)),0,'L',false);
        $fpdf->SetAutoPageBreak(false);
        $fpdf->SetXY(2,19.3+($k*$gap));
        $fpdf->MultiCell(11,.3,utf8_decode(strip_tags($beneficiario->rfc)),0,'L',false);
        $fpdf->SetXY(5.4,19.3+($k*$gap));
        $fpdf->MultiCell(11,.3,utf8_decode(strip_tags($beneficiario->curp)),0,'L',false);
        $fpdf->SetXY(9.5,19.3+($k*$gap));
        $fpdf->MultiCell(11,.3,utf8_decode(strip_tags($beneficiario->parent)),0,'L',false);
        $fpdf->SetFontSize(5);
        $fpdf->SetXY(15.1,19.1+($k*$gap));
        $fpdf->MultiCell(5.3,.2,utf8_decode(strip_tags($beneficiario->ocupa)),0,'L',false);
        $fpdf->SetFontSize(8);
        $fpdf->SetXY(1.4,19.8+($k*$gap));
        $fpdf->MultiCell(11,.3,utf8_decode(strip_tags($beneficiario->mail)),0,'L',false);
        $fpdf->SetXY(5.5,19.8+($k*$gap));
        $fpdf->MultiCell(11,.3,utf8_decode(strip_tags($beneficiario->nacion)),0,'L',false);
        $fpdf->SetXY(9.2,19.8+($k*$gap));
        $fpdf->MultiCell(11,.3,utf8_decode(strip_tags($beneficiario->giro)),0,'L',false);
        $ben_print++;

      }
      $ciclos++;
      $ben_rest = $ben_num - ($ciclos*4);
    }

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

    var $asegurado;
    var $lugar_nacimiento;

    //$fpdf->setConfig('status',$status);
    function setConfig($var,$val)
    {
        $this->{$var} = $val;
    }

    public function Header(){

      $asegurado = $this->asegurado;
      $lugar_nacimiento = $this->lugar_nacimiento;
      $lugar_fallecimiento = $this->lugar_fallecimiento;

      $this->SetXY(3.2,4.2);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->no_polizas)),0,'L',false);
      $this->SetXY(11,4.2);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->tipo_seguro)),0,'L',false);
      $this->SetXY(6.5,4.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->grupo_y_colectivo)),0,'L',false);
      $this->SetXY(17,4.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->no_certificado)),0,'L',false);
      $this->SetXY(6,5.8);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->Paterno.' '.$asegurado->Materno.' '.$asegurado->Nombre)),0,'L',false);
      $this->SetXY(7,6.3);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->dom_calle.' '.$asegurado->dom_num_ext.' - '.$asegurado->dom_num_int.', '.$asegurado->dom_asenta)),0,'L',false);
      $this->SetXY(14,6.3);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->dom_cty)),0,'L',false);
      $this->SetXY(1.5,6.9);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->dom_edo)),0,'L',false);
      $this->SetXY(6,6.9);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->dom_cp)),0,'L',false);
      $this->SetXY(10,6.9);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->telefono)),0,'L',false);
      $this->SetXY(15,6.9);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->afiliacion_imss_issste)),0,'L',false);
      $this->SetXY(2,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->RFC)),0,'L',false);
      $this->SetXY(5.45,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->curp)),0,'L',false);
      $this->SetXY(11.35,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->FechaNac, -2, 1))),0,'L',false);
      $this->SetXY(11.8,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->FechaNac, -1))),0,'L',false);
      $this->SetXY(12.3,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->FechaNac, -5, 1))),0,'L',false);
      $this->SetXY(12.7,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->FechaNac, -4, 1))),0,'L',false);
      $this->SetXY(13.1,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->FechaNac, -8, 1))),0,'L',false);
      $this->SetXY(13.6,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->FechaNac, -7, 1))),0,'L',false);
      $this->SetXY(14,7.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($lugar_nacimiento->ciudad.'/'.$lugar_nacimiento->estado)),0,'L',false);
      $this->SetXY(1.5,7.95);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->Nacionalidad)),0,'L',false);
      $this->SetXY(5.5,7.95);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->ocupacion)),0,'L',false);
      $this->SetXY(15,7.95);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->antiguedad_en_empresa.' años')),0,'L',false);
      $this->SetXY(8,8.4);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->empresa_trabajo)),0,'L',false);
      $this->SetXY(7,8.9);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->otras_empresas)),0,'L',false);
      $this->SetXY(4,13.6);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($lugar_fallecimiento->ciudad.' / '.$lugar_fallecimiento->estado.' / '.$lugar_fallecimiento->pais)),0,'L',false);
      $this->SetXY(17.55,13.6);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_fallecimiento, -2, 1))),0,'L',false);
      $this->SetXY(18.05,13.6);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_fallecimiento, -1))),0,'L',false);
      $this->SetXY(18.50,13.6);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_fallecimiento, -5, 1))),0,'L',false);
      $this->SetXY(18.95,13.6);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_fallecimiento, -4, 1))),0,'L',false);
      $this->SetXY(19.35,13.6);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_fallecimiento, -8, 1))),0,'L',false);
      $this->SetXY(19.8,13.6);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_fallecimiento, -7, 1))),0,'L',false);
      $this->SetXY(4,14.1);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->causa_fallecimiento)),0,'L',false);
      $this->SetXY(7,14.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->agencia_servicio_funerario)),0,'L',false);
      $this->SetXY(17.55,14.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_servicios_funerarios, -2, 1))),0,'L',false);
      $this->SetXY(18.05,14.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_servicios_funerarios, -1))),0,'L',false);
      $this->SetXY(18.50,14.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_servicios_funerarios, -5, 1))),0,'L',false);
      $this->SetXY(18.95,14.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_servicios_funerarios, -4, 1))),0,'L',false);
      $this->SetXY(19.35,14.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_servicios_funerarios, -8, 1))),0,'L',false);
      $this->SetXY(19.8,14.7);
      $this->MultiCell(7,.3,utf8_decode(strip_tags(substr($asegurado->fecha_servicios_funerarios, -7, 1))),0,'L',false);
      $this->SetXY(8.1,15.2);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->edificio_fallecimiento)),0,'L',false);
      $this->SetXY(9.7,15.8);
      $this->MultiCell(7,.3,utf8_decode(strip_tags($asegurado->violento)),0,'L',false);


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
