<?php
namespace App\Http\Controllers\Forap;
use App\Http\Controllers\Framework\Controller;
use App\Models\Forap\Tamizaje as ModelTamizaje;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Helpme;

class Pdf extends Controller
{

  public function __construct()
  {
      $this->middleware('permiso:Pdf|index', ['only' => ['index']]);
  }

  public function index($id_evaluacion){
    $options = ModelTamizaje::obtener_options($id_evaluacion);
    $checkbox = ModelTamizaje::obtener_checkbox($id_evaluacion);
    $obtener_reactivos = ModelTamizaje::obtener_reactivos($id_evaluacion);
    $delito = ModelTamizaje::obtener_delito($obtener_reactivos[9]['campo_unico']);

    $fpdf = new customPdf('P', 'cm', 'Letter');
    $fpdf->SetTitle(utf8_decode("Valoración de riesgo en mujeres víctimas de violencia de pareja"));
    $fpdf->SetAuthor('FGJCDMX');
    $fpdf->setSourceFile("../resources/templates/format.pdf");
    $fpdf->AddFont('Metropolis','','Metropolis-Bold.php');
    $fpdf->SetFont('Metropolis','',8);
    $fpdf->SetFillColor(235,227,239);
    $fpdf->SetTextColor(0,0,0);

    $fpdf->AddPage();
    $tplId1 = $fpdf->importPage(1);
    $fpdf->useTemplate($tplId1, .4, .4, 21);
    $riesgo = 0;

    $fpdf->Text(6, 3.85, utf8_decode($obtener_reactivos[1]['campo_unico']));
    $fpdf->Text(18, 4.35, utf8_decode($obtener_reactivos[2]['campo_unico']));
    $fpdf->Text(3, 4.35, utf8_decode($obtener_reactivos[3]['campo_unico']));
    $fpdf->Text(3, 4.87, utf8_decode($obtener_reactivos[4]['campo_unico']));
    $fpdf->Text(13, 4.87, utf8_decode($obtener_reactivos[5]['campo_unico']));


    $fpdf->Text(4.5, 6.08, utf8_decode($obtener_reactivos[6]['campo_unico']));
    $fpdf->Text(17.5, 6.08, utf8_decode($obtener_reactivos[7]['campo_unico']));
    $fpdf->Text(5.4, 6.6, utf8_decode($obtener_reactivos[8]['campo_unico']));

    $fpdf->SetFontSize(7);
    $fpdf->SetXY(12.4,6.4);
    $fpdf->MultiCell(8, .3, utf8_decode($delito), 0, 'L',false);
    $fpdf->SetFontSize(8);


    //VIOLENCIA EXTREMA

    //1. Agresion con quimicos armas blancas u otros objetos
    if(isset($options[10]) && $options[10]['val_opc'] != 0){
        $fpdf->Rect(1.4, 12.94, 7.1, .781, 'F');
        $fpdf->SetXY(1.6,13);
        $fpdf->SetMargins(1.8, .5 , 13);
        $fpdf->Write(.3, utf8_decode('1. '.strip_tags($options[10]['reactivo'])));

        $fpdf->Rect(8.54, 12.94, 2.34, .781, 'F');
        $fpdf->SetXY(8.5,13);
        $fpdf->SetMargins(8.5, .5 , 10.5);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[10]['nombre'])));
        $riesgo = $riesgo + $options[10]['val_opc'];
    }

    //6. Amordazar o privar de la libertad
    if(isset($options[11]) && $options[11]['val_opc'] != 0){
        $fpdf->Rect(10.91, 12.94, 7.09, .781, 'F');
        $fpdf->SetXY(11.5,13.2);
        $fpdf->SetMargins(11, .5 , 3);
        $fpdf->Write(.3, utf8_decode('6. '.strip_tags($options[11]['reactivo'])));

        $fpdf->Rect(18.04, 12.94, 2.35, .781, 'F');
        $fpdf->SetXY(18,13);
        $fpdf->SetMargins(18, .5 , 1);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[11]['nombre'])));
        $riesgo = $riesgo + $options[11]['val_opc'];
    }

    //2. Apuñalar zonas vitales
    if(isset($options[12]) && $options[12]['val_opc'] != 0){
        $fpdf->Rect(1.4, 13.753, 7.1, .781, 'F');
        $fpdf->SetXY(1.6,14);
        $fpdf->SetMargins(1.8, .5 , 13);
        $fpdf->Write(.3, utf8_decode('2. '.strip_tags($options[12]['reactivo'])));

        $fpdf->Rect(8.54, 13.753, 2.34, .781, 'F');
        $fpdf->SetXY(8.5,13.85);
        $fpdf->SetMargins(8.5, .5 , 10.5);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[12]['nombre'])));
        $riesgo = $riesgo + $options[12]['val_opc'];
    }

    //7. Violacion
    if(isset($options[13]) && $options[13]['val_opc'] != 0){
        $fpdf->Rect(10.91, 13.753, 7.09, .781, 'F');
        $fpdf->SetXY(11.5,14);
        $fpdf->SetMargins(11, .5 , 3);
        $fpdf->Write(.3, utf8_decode('7. '.strip_tags($options[13]['reactivo'])));

        $fpdf->Rect(18.04, 13.753, 2.35, .781, 'F');
        $fpdf->SetXY(18,13.9);
        $fpdf->SetMargins(18, .5 , 1);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[13]['nombre'])));
        $riesgo = $riesgo + $options[13]['val_opc'];
    }

    //3.  Quemaduras de segundo o tercer grado
    if(isset($options[14]) && $options[14]['val_opc'] != 0){
        $fpdf->Rect(1.4, 14.572, 7.1, .781, 'F');
        $fpdf->SetXY(1.6,14.8);
        $fpdf->SetMargins(1.8, .5 , 13);
        $fpdf->Write(.3, utf8_decode('3. '.strip_tags($options[14]['reactivo'])));

        $fpdf->Rect(8.54, 14.572, 2.34, .781, 'F');
        $fpdf->SetXY(8.5,14.67);
        $fpdf->SetMargins(8.5, .5 , 10.5);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[14]['nombre'])));
        $riesgo = $riesgo + $options[14]['val_opc'];
    }

    //8.   Aborto prematuro
    if(isset($options[15]) && $options[15]['val_opc'] != 0){
        $fpdf->Rect(10.91, 14.572, 7.09, .781, 'F');
        $fpdf->SetXY(11.5,14.8);
        $fpdf->SetMargins(11, .5 , 3);
        $fpdf->Write(.3, utf8_decode('8. '.strip_tags($options[15]['reactivo'])));

        $fpdf->Rect(18.04, 14.572, 2.35, .781, 'F');
        $fpdf->SetXY(18,14.7);
        $fpdf->SetMargins(18, .5 , 1);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[15]['nombre'])));
        $riesgo = $riesgo + $options[15]['val_opc'];
    }

    //4. Lesiones con arma de fuego
    if(isset($options[16]) && $options[16]['val_opc'] != 0){
        $fpdf->Rect(1.4, 15.390, 7.1, .781, 'F');
        $fpdf->SetXY(1.6,15.6);
        $fpdf->SetMargins(1.8, .5 , 13);
        $fpdf->Write(.3, utf8_decode('4. '.strip_tags($options[16]['reactivo'])));

        $fpdf->Rect(8.54, 15.390, 2.34, .781, 'F');
        $fpdf->SetXY(8.5,15.47);
        $fpdf->SetMargins(8.5, .5 , 10.5);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[16]['nombre'])));
        $riesgo = $riesgo + $options[16]['val_opc'];
    }

    // 9. Intento de asfixia o estrangulamiento
    if(isset($options[17]) && $options[17]['val_opc'] != 0){
        $fpdf->Rect(10.91, 15.390, 7.09, .781, 'F');
        $fpdf->SetXY(11.5,15.6);
        $fpdf->SetMargins(11, .5 , 3);
        $fpdf->Write(.3, utf8_decode('9. '.strip_tags($options[17]['reactivo'])));

        $fpdf->Rect(18.04, 15.390, 2.35, .781, 'F');
        $fpdf->SetXY(18,15.5);
        $fpdf->SetMargins(18, .5 , 1);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[17]['nombre'])));
        $riesgo = $riesgo + $options[17]['val_opc'];
    }

    // 5. Lesiones que pusieron en riesgo su vida
    if(isset($options[18]) && $options[18]['val_opc'] != 0){
        $fpdf->Rect(1.4, 16.208, 7.1, .781, 'F');
        $fpdf->SetXY(1.6,16.4);
        $fpdf->SetMargins(1.8, .5 , 13);
        $fpdf->Write(.3, utf8_decode('5. '.strip_tags($options[18]['reactivo'])));

        $fpdf->Rect(8.54, 16.208, 2.34, .781, 'F');
        $fpdf->SetXY(8.5,16.27);
        $fpdf->SetMargins(8.5, .5 , 10.5);
        $fpdf->Write(.3, utf8_decode(strip_tags($options[18]['nombre'])));
        $riesgo = $riesgo + $options[18]['val_opc'];
    }


    // 10. Ninguna opción: no aplica por que solo se usa para setear el conjunto vacio
    //if(isset($options[17])){
    //    $fpdf->Rect(10.91, 16.208, 7.09, .781, 'F');
    //    $fpdf->Rect(18.04, 16.208, 2.35, .781, 'F');
    //}

    //ANTECEDENTES VIOLENCIA PSICOLÓGICA, FÍSICA Y SEXUAL

    // 1. ¿Ha solicitado medidas de protección o presentado alguna denuncia previa contra él?
    if(isset($options[19]) && $options[19]['val_opc'] != 0){
        $fpdf->Rect(1.37, 18.53, 8.17, .878, 'F');
        $fpdf->SetXY(1.6,18.7);
        $fpdf->SetMargins(1.8, .5 , 12);
        $fpdf->Write(.3, utf8_decode('1. '.strip_tags($options[19]['reactivo'])));

        $fpdf->Rect(9.58, 18.53, 8.31, .878, 'F');
        $fpdf->SetXY(9.6,18.5);
        $fpdf->Cell(8.3, .9, utf8_decode(strip_tags($options[19]['nombre'])), 0, 1, 'C');

        $fpdf->Rect(17.95, 18.53, 2.45, .878, 'F');
        $fpdf->SetXY(17.95,18.5);
        $fpdf->Cell(2.4, .9, utf8_decode(strip_tags($options[19]['val_opc'])), 0, 1, 'C');
        $riesgo = $riesgo + $options[19]['val_opc'];
    }

    // 2.  ¿Con qué frecuencia su pareja o expareja le agredió física o psicológicamente, en el último año?
    if(isset($options[20]) && $options[20]['val_opc'] != 0){
        $fpdf->Rect(1.37, 19.44, 8.17, .878, 'F');
        $fpdf->SetXY(1.6,19.6);
        $fpdf->SetMargins(1.8, .5 , 12);
        $fpdf->Write(.3, utf8_decode('2. '.strip_tags($options[20]['reactivo'])));

        $fpdf->Rect(9.58, 19.44, 8.31, .878, 'F');
        $fpdf->SetXY(9.6,19.43);
        $fpdf->Cell(8.3, .9, utf8_decode(strip_tags($options[20]['nombre'])), 0, 1, 'C');

        $fpdf->Rect(17.95, 19.44, 2.45, .878, 'F');
        $fpdf->SetXY(17.95,19.43);
        $fpdf->Cell(2.4, .9, utf8_decode(strip_tags($options[20]['val_opc'])), 0, 1, 'C');
        $riesgo = $riesgo + $options[20]['val_opc'];
    }


    // 3. En el último año, ¿las agresiones se han incrementado?
    if(isset($options[21]) && $options[21]['val_opc'] != 0){
        $fpdf->Rect(1.37, 20.35, 8.17, .878, 'F');
        $fpdf->SetXY(1.6,20.55);
        $fpdf->SetMargins(1.8, .5 , 12);
        $fpdf->Write(.3, utf8_decode('3. '.strip_tags($options[21]['reactivo'])));

        $fpdf->Rect(9.58, 20.35, 8.31, .878, 'F');
        $fpdf->SetXY(9.6,20.4);
        $fpdf->Cell(8.3, .9, utf8_decode(strip_tags($options[21]['nombre'])), 0, 1, 'C');

        $fpdf->Rect(17.95, 20.35, 2.45, .878, 'F');
        $fpdf->SetXY(17.95,20.4);
        $fpdf->Cell(2.4, .9, utf8_decode(strip_tags($options[21]['val_opc'])), 0, 1, 'C');
        $riesgo = $riesgo + $options[21]['val_opc'];

    }

    // 4. ¿Qué tipo de lesiones le causaron las agresiones físicas recibidas en este último año?
    if(isset($options[22]) && $options[22]['val_opc'] != 0){
        $fpdf->Rect(1.37, 21.27, 8.17, .878, 'F');
        $fpdf->SetXY(1.6,21.4);
        $fpdf->SetMargins(1.8, .5 , 12);
        $fpdf->Write(.3, utf8_decode('4. '.strip_tags($options[22]['reactivo'])));

        $fpdf->Rect(9.58, 21.27, 8.31, .878, 'F');
        $fpdf->SetXY(9.6,21.3);
        $fpdf->MultiCell(8.3,.4,utf8_decode(strip_tags($options[22]['nombre'])),0,'C',false);

        $fpdf->Rect(17.95, 21.27, 2.45, .878, 'F');
        $fpdf->SetXY(17.95,21.25);
        $fpdf->Cell(2.4, .9, utf8_decode(strip_tags($options[22]['val_opc'])), 0, 1, 'C');
        $riesgo = $riesgo + $options[22]['val_opc'];
    }

    // 5. ¿Usted conoce si su pareja o expareja tiene antecedentes de haber agredido físicamente a sus ex parejas?
    if(isset($options[23]) && $options[23]['val_opc'] != 0){
        $fpdf->Rect(1.37, 22.181, 8.17, .878, 'F');
        $fpdf->SetXY(1.6,22.2);
        $fpdf->SetFontSize(7);
        $fpdf->MultiCell(7.9,.4,'5. '.utf8_decode(strip_tags($options[23]['reactivo'])),0,'L',false);
        $fpdf->SetFontSize(8);

        $fpdf->Rect(9.58, 22.181, 8.31, .878, 'F');
        $fpdf->SetXY(9.6,22.5);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[23]['nombre'])),0,'C',false);


        $fpdf->Rect(17.95, 22.181, 2.45, .878, 'F');
        $fpdf->SetXY(17.95,22.25);
        $fpdf->Cell(2.4, .9, utf8_decode(strip_tags($options[23]['val_opc'])), 0, 1, 'C');
        $riesgo = $riesgo + $options[23]['val_opc'];
    }

    // 6. ¿Su pareja o expareja ejerce violencia contra sus hijos/as, familiares u otras personas?
    if(isset($options[24]) && $options[24]['val_opc'] != 0){
        $fpdf->Rect(1.37, 23.1, 8.17, .878, 'F');
        $fpdf->SetXY(1.6,23.1);
        $fpdf->MultiCell(7.9,.4,'6. '.utf8_decode(strip_tags($options[24]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.58, 23.1, 8.31, .878, 'F');
        $fpdf->SetXY(9.6,23.4);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[24]['nombre'])),0,'C',false);

        $fpdf->Rect(17.95, 23.1, 2.45, .878, 'F');
        $fpdf->SetXY(17.95,23.15);
        $fpdf->Cell(2.4, .9, utf8_decode(strip_tags($options[24]['val_opc'])), 0, 1, 'C');
        $riesgo = $riesgo + $options[24]['val_opc'];
    }

    // 7. ¿Su pareja o expareja le ha obligado alguna vez a tener relaciones sexuales?
    if(isset($options[25]) && $options[25]['val_opc'] != 0){
        $fpdf->Rect(1.37, 24.025, 8.17, .868, 'F');
        $fpdf->SetXY(1.6,24.1);
        $fpdf->MultiCell(7.9,.4,'7. '.utf8_decode(strip_tags($options[25]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.58, 24.025, 8.31, .868, 'F');
        $fpdf->SetXY(9.6,24.4);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[25]['nombre'])),0,'C',false);

        $fpdf->Rect(17.95, 24.025, 2.45, .868, 'F');
        $fpdf->SetXY(17.95,24.15);
        $fpdf->Cell(2.4, .9, utf8_decode(strip_tags($options[25]['val_opc'])), 0, 1, 'C');
        $riesgo = $riesgo + $options[25]['val_opc'];
    }


    $fpdf->AddPage();
    $tplId2 = $fpdf->importPage(2);
    $fpdf->useTemplate($tplId2, .4, .4, 21);

    //AMENAZAS
    // 7. ¿Su pareja o expareja le ha amenazado de muerte? ¿De qué manera le ha amenazado?
    if(isset($options[26]) && $options[26]['val_opc'] != 0){
        $fpdf->Rect(1.39, 4.58, 8.12, .868, 'F');
        $fpdf->SetXY(1.6,4.6);
        $fpdf->MultiCell(7.9,.4,'7. '.utf8_decode(strip_tags($options[26]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.56, 4.58, 8.32, .868, 'F');
        $fpdf->SetXY(9.6,4.6);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[26]['nombre'])),0,'C',false);

        $fpdf->Rect(17.95, 4.58, 2.45, .868, 'F');
        $fpdf->SetXY(17.95,4.9);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[26]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[26]['val_opc'];
    }

    // 8. ¿Usted cree que su pareja o expareja la pueda matar?
    if(isset($options[27]) && $options[27]['val_opc'] != 0){
        $fpdf->Rect(1.39, 5.50, 8.12, .868, 'F');
        $fpdf->SetXY(1.6,5.6);
        $fpdf->MultiCell(7.9,.4,'8. '.utf8_decode(strip_tags($options[27]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.56, 5.50, 8.32, .868, 'F');
        $fpdf->SetXY(9.6,5.75);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[27]['nombre'])),0,'C',false);

        $fpdf->Rect(17.95, 5.50, 2.45, .868, 'F');
        $fpdf->SetXY(17.95,5.75);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[27]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[27]['val_opc'];
    }

    //CONTROL EXTREMO HACIA LA PAREJA O EXPAREJA

    //9. ¿Usted considera que su pareja o expareja es celoso?
    if(isset($options[28]) && $options[28]['val_opc'] != 0){
        $fpdf->Rect(1.39, 7.71, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,7.75);
        $fpdf->MultiCell(7.9,.4,'9. '.utf8_decode(strip_tags($options[28]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 7.71, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,8);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[28]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 7.71, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,8);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[28]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[28]['val_opc'];
    }

    //10. ¿Su pareja o expareja le ha dicho o cree que usted le engaña?
    if(isset($options[29]) && $options[29]['val_opc'] != 0){
        $fpdf->Rect(1.39, 8.62, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,8.65);
        $fpdf->MultiCell(7.9,.4,'10. '.utf8_decode(strip_tags($options[29]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 8.62, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,8.85);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[29]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 8.62, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,8.85);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[29]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[29]['val_opc'];
    }


    //11. ¿Su pareja o expareja la controla? ¿De qué forma lo hace?
    if(isset($options[30]) && $options[30]['val_opc'] != 0){
        $fpdf->Rect(1.39, 9.538, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,9.6);
        $fpdf->MultiCell(7.9,.4,'11. '.utf8_decode(strip_tags($options[30]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 9.538, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,9.8);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[30]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 9.538, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,9.8);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[30]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[30]['val_opc'];
    }

    //12. ¿Su pareja o expareja desconfía de usted o la acosa? ¿Cómo le muestra su desconfianza o acoso?
    if(isset($options[31]) && $options[31]['val_opc'] != 0){
        $fpdf->Rect(1.39, 10.46, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,10.5);
        $fpdf->MultiCell(7.9,.4,'12. '.utf8_decode(strip_tags($options[31]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 10.46, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,10.5);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[31]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 10.46, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,10.7);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[31]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[31]['val_opc'];
    }

    //13. ¿Su pareja o expareja utiliza a sus hijos/as para mantenerla a usted bajo control?
    if(isset($options[32]) && $options[32]['val_opc'] != 0){
        $fpdf->Rect(1.39, 11.375, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,11.45);
        $fpdf->MultiCell(7.9,.4,'13. '.utf8_decode(strip_tags($options[32]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 11.375, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,11.7);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[32]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 11.375, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,11.7);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[32]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[32]['val_opc'];
    }

    //CIRCUNSTANCIAS AGRAVANTES

    //14. ¿Le ha dicho a su pareja que quiere separse de él? En caso de que haberlo hecho, ¿cómo reaccionó él?
    if(isset($options[33]) && $options[33]['val_opc'] != 0){
        $fpdf->Rect(1.39, 13.65, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,13.7);
        $fpdf->MultiCell(7.9,.4,'14. '.utf8_decode(strip_tags($options[33]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 13.65, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,13.7);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[33]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 13.65, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,13.9);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[33]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[33]['val_opc'];
    }

    //15. ¿Actualmente vive usted con su pareja?
    if(isset($options[34]) && $options[34]['val_opc'] != 0){
        $fpdf->Rect(1.39, 14.563, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,14.85);
        $fpdf->MultiCell(7.9,.4,'15. '.utf8_decode(strip_tags($options[34]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 14.563, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,14.65);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[34]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 14.563, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,14.85);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[34]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[34]['val_opc'];
    }

    //16. ¿Su pareja es consumidor habitual de alcohol o drogas? (Diario, semanal, mensual)
    if(isset($options[35]) && $options[35]['val_opc'] != 0){
        $fpdf->Rect(1.39, 15.477, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,15.5);
        $fpdf->MultiCell(7.9,.4,'16. '.utf8_decode(strip_tags($options[35]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 15.477, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,15.75);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[35]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 15.477, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,15.75);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[35]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[35]['val_opc'];
    }

    //17. ¿Su pareja o expareja posee o tiene acceso a un arma de fuego?
    if(isset($options[36]) && $options[36]['val_opc'] != 0){
        $fpdf->Rect(1.39, 16.393, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,16.4);
        $fpdf->MultiCell(7.9,.4,'17. '.utf8_decode(strip_tags($options[36]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 16.393, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,16.6);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[36]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 16.393, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,16.6);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[36]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[36]['val_opc'];
    }

    //18. ¿Su pareja o expareja usa o ha usado un arma de fuego?
    if(isset($options[37]) && $options[37]['val_opc'] != 0){
        $fpdf->Rect(1.39, 17.31, 8.0, .868, 'F');
        $fpdf->SetXY(1.6,17.4);
        $fpdf->MultiCell(7.9,.4,'18. '.utf8_decode(strip_tags($options[37]['reactivo'])),0,'L',false);

        $fpdf->Rect(9.45, 17.31, 8.45, .868, 'F');
        $fpdf->SetXY(9.6,17.6);
        $fpdf->MultiCell(8.1,.4,utf8_decode(strip_tags($options[37]['nombre'])),0,'C',false);

        $fpdf->Rect(17.94, 17.31, 2.47, .868, 'F');
        $fpdf->SetXY(17.95,17.6);
        $fpdf->MultiCell(2.4, .4, utf8_decode(strip_tags($options[37]['val_opc'])), 0, 'C',false);
        $riesgo = $riesgo + $options[37]['val_opc'];
    }

    $fpdf->SetXY(17.95,18.6);
    $fpdf->SetFontSize(14);
    $fpdf->MultiCell(2.4, .4, $riesgo, 0, 'C',false);
    $fpdf->SetFontSize(8);

    //Leve
    if(($riesgo <= 12)&&($riesgo >= 0)){
      $porcentaje = ($riesgo*100)/12;
      $posicion = ((($porcentaje*475)/100)+100)/100;
    }
    //moderado
    if(($riesgo <= 21)&&($riesgo >= 13)){
      $porcentaje = (($riesgo-12)*100)/9;
      $posicion = (((($porcentaje*478)/100))/100)+5.75;
    }
    //severo
    if(($riesgo <= 44)&&($riesgo >= 22)){
      $porcentaje = (($riesgo-21)*100)/23;
      $posicion = (((($porcentaje*477)/100))/100)+10.53;
    }
    //crítico
    if(($riesgo <= 65)&&($riesgo >= 45)){
      $porcentaje = (($riesgo-44)*100)/21;
      $posicion = (((($porcentaje*470)/100))/100)+15.3;
    }
    if($riesgo > 65){
      $posicion = 20;
    }
    $fpdf->Image('../resources/templates/arrow_up.png', $posicion, 22.45, -150, -200, 'PNG');





    $fpdf->AddPage();
    $tplId3 = $fpdf->importPage(3);
    $fpdf->useTemplate($tplId3, .4, .4, 21);

    //GRUPO PRIORITARIO
    //Está embarazada
    if(isset($checkbox[38][111])){
        $fpdf->Rect(1.37, 6.07, 9.51, .595, 'F');
        $fpdf->SetXY(1.6,6.2);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[38][111]['nombre'])),0,'L',false);
    }
    //Mujer trans
    if(isset($checkbox[38][113])){
        $fpdf->Rect(10.93, 6.07, 9.48, .596, 'F');
        $fpdf->SetXY(11.35,6.2);
        $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($checkbox[38][113]['nombre'])),0,'L',false);
    }
    //Tiene hijas o hijos menores de 18 años
    if(isset($checkbox[38][117])){
        $fpdf->Rect(1.37, 6.705, 9.51, .595, 'F');
        $fpdf->SetXY(1.6,6.8);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[38][117]['nombre'])),0,'L',false);
    }
    //Migrante o extranjera
    if(isset($checkbox[38][115])){
        $fpdf->Rect(10.93, 6.705, 9.48, .596, 'F');
        $fpdf->SetXY(11.35,6.8);
        $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($checkbox[38][115]['nombre'])),0,'L',false);
    }

    //Dio a luz en los últimos 6 meses
    if(isset($checkbox[38][114])){
        $fpdf->Rect(1.37, 7.34, 9.51, .595, 'F');
        $fpdf->SetXY(1.6,7.5);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[38][114]['nombre'])),0,'L',false);
    }
    //Tiene una discapacidad
    if(isset($checkbox[38][116])){
        $fpdf->Rect(10.93, 7.34, 9.48, .596, 'F');
        $fpdf->SetXY(11.35,7.5);
        $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($checkbox[38][116]['nombre'])),0,'L',false);
    }

    //Tiene bajo su cuidado personas mayores o con discapacidad
    if(isset($checkbox[38][120])){
        $fpdf->Rect(1.37, 7.975, 9.51, .595, 'F');
        $fpdf->SetXY(1.6,8.1);
        $fpdf->SetFontSize(7);
        $fpdf->MultiCell(9.2,.35,utf8_decode(strip_tags($checkbox[38][120]['nombre'])),0,'L',false);
        $fpdf->SetFontSize(8);
    }
    //Indígena
    if(isset($checkbox[38][118])){
        $fpdf->Rect(10.93, 7.975, 9.48, .596, 'F');
        $fpdf->SetXY(11.35,8.1);
        $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($checkbox[38][118]['nombre'])),0,'L',false);
    }
    //Se encuentra desempleada
    if(isset($checkbox[38][112])){
        $fpdf->Rect(1.37, 8.61, 9.51, .595, 'F');
        $fpdf->SetXY(1.6,8.7);
        $fpdf->MultiCell(9.2,.35,utf8_decode(strip_tags($checkbox[38][112]['nombre'])),0,'L',false);
    }
    //Trabajadora sexual
    if(isset($checkbox[38][119])){
        $fpdf->Rect(10.93, 8.61, 9.48, .596, 'F');
        $fpdf->SetXY(11.35,8.7);
        $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($checkbox[38][119]['nombre'])),0,'L',false);
    }

    //PERSONA CON DISCAPACIDAD
    //Física
    if(isset($checkbox[39][122])){
        $fpdf->Rect(1.37, 10.55, 4.72, .595, 'F');
        $fpdf->SetXY(1.4,10.7);
        $fpdf->MultiCell(4.6,.35,utf8_decode(strip_tags($checkbox[39][122]['nombre'])),0,'C',false);
    }
    //Sensorial
    if(isset($checkbox[39][123])){
        $fpdf->Rect(6.12, 10.55, 4.73, .595, 'F');
        $fpdf->SetXY(6.2,10.7);
        $fpdf->MultiCell(4.6,.35,utf8_decode(strip_tags($checkbox[39][123]['nombre'])),0,'C',false);
    }
    //Psicosocial
    if(isset($checkbox[39][124])){
        $fpdf->Rect(10.90, 10.55, 4.73, .596, 'F');
        $fpdf->SetXY(11,10.7);
        $fpdf->MultiCell(4.6,.4,utf8_decode(strip_tags($checkbox[39][124]['nombre'])),0,'C',false);
    }
    //Intelectual
    if(isset($checkbox[39][125])){
        $fpdf->Rect(15.68, 10.55, 4.71, .596, 'F');
        $fpdf->SetXY(15.7,10.7);
        $fpdf->MultiCell(4.6,.4,utf8_decode(strip_tags($checkbox[39][125]['nombre'])),0,'C',false);
    }

    //EMBARAZO
    //Le ha golpeado en partes del cuerpo que no sea su vientre
    $fpdf->SetFontSize(7);
    if(isset($checkbox[40][127])){
        $fpdf->Rect(1.35, 12.51, 4.71, .595, 'F');
        $fpdf->SetXY(1.4,12.5);
        $fpdf->MultiCell(4.6,.3,utf8_decode(strip_tags($checkbox[40][127]['nombre'])),0,'C',false);
    }
    //Le ha golpeado en el vientre
    if(isset($checkbox[40][128])){
        $fpdf->Rect(6.11, 12.51, 4.72, .595, 'F');
        $fpdf->SetXY(6.2,12.7);
        $fpdf->MultiCell(4.6,.3,utf8_decode(strip_tags($checkbox[40][128]['nombre'])),0,'C',false);
    }
    //Le ha obligado a tomar alguna sustancia que pone o puso en riesgo su embarazo
    if(isset($checkbox[40][129])){
        $fpdf->Rect(10.90, 12.51, 5.65, .596, 'F');
        $fpdf->SetXY(11,12.5);
        $fpdf->MultiCell(5.5,.3,utf8_decode(strip_tags($checkbox[40][129]['nombre'])),0,'C',false);
    }
    $fpdf->SetFontSize(8);
    //Ninguna
    if(isset($checkbox[40][130])){
        $fpdf->Rect(16.60, 12.51, 3.78, .596, 'F');
        $fpdf->SetXY(16.6,12.7);
        $fpdf->MultiCell(3.8,.3,utf8_decode(strip_tags($checkbox[40][130]['nombre'])),0,'C',false);
    }

    //SITUACIÓN DE HIJAS O HIJOS
    //4. Número de hijas o hijos menores de 18 años y rangos de edad:
    if(isset($obtener_reactivos[41]) && ($obtener_reactivos[41] != null)){
        $fpdf->SetXY(8.5,13.9);
        $hijos_array = json_decode($obtener_reactivos[41]['campo_unico']);
        $hijos = count($hijos_array);
        $fpdf->MultiCell(3.8,.3,$hijos,0,'C',false);

        $rango1 = 0;    $rango2 = 0;    $rango3 = 0;    $rango4 = 0;
        foreach($hijos_array as $key => $value){
          switch($hijos_array[$key]->Edad){
            case ($hijos_array[$key]->Edad >= 0 and $hijos_array[$key]->Edad <= 2):
                $rango1++;
                break;
            case ($hijos_array[$key]->Edad > 2 and $hijos_array[$key]->Edad <= 5):
                $rango2++;
                break;
            case ($hijos_array[$key]->Edad >= 6 and $hijos_array[$key]->Edad <= 11):
                $rango3++;
                break;
            case ($hijos_array[$key]->Edad >= 12 and $hijos_array[$key]->Edad < 18):
                $rango4++;
                break;
          }
        }

        if($rango1 > 0){
            $fpdf->Rect(10.90, 13.82, 2.36, .596, 'F');
            $fpdf->SetXY(11,14);
            $fpdf->MultiCell(2.25,.3,utf8_decode('0 a 2 años'),0,'C',false);
        }
        if($rango2 > 0){
            $fpdf->Rect(13.33, 13.82, 2.29, .596, 'F');
            $fpdf->SetXY(13.25,14);
            $fpdf->MultiCell(2.4,.3,utf8_decode('2 a 5 años'),0,'C',false);
        }
        if($rango3 > 0){
            $fpdf->Rect(15.66, 13.82, 2.29, .596, 'F');
            $fpdf->SetXY(15.7,14);
            $fpdf->MultiCell(2.25,.3,utf8_decode('6 a 11 años'),0,'C',false);
        }
        if($rango4 > 0){
            $fpdf->Rect(18.01, 13.82, 2.37, .596, 'F');
            $fpdf->SetXY(18,14);
            $fpdf->MultiCell(2.25,.3,utf8_decode('12 a 17 años'),0,'C',false);
        }


        $select1 = 0;    $select2 = 0;    $select3 = 0;    $select4 = 0;    $select5 = 0;
        foreach($hijos_array as $key => $value2){
          switch($value2->guardia_custodia){
            case ($value2->guardia_custodia == 'Se decidió guardia y custodia a favor de la madre'):
                $select1++;
                break;
            case ($value2->guardia_custodia == 'Se decidió guardia y custodia a favor del padre'):
                $select2++;
                break;
            case ($value2->guardia_custodia == 'Se decidió guardia y custodia a favor de otros familiares'):
                $select3++;
                break;
            case ($value2->guardia_custodia == 'No existe decisión de algún órgano jurisdiccional'):
                $select4++;
                break;
            case ($value2->guardia_custodia == 'Se decidió guardia y custodia compartida'):
                $select5++;
                break;
          }
        }

        //5. ¿Algún juzgado de lo familiar determinó quién debe tener la guardia y custodia de las niñas, niños o adolescentes?
        if($select1 > 0){
            $fpdf->Rect(10.90, 14.46, 9.48, .596, 'F');
            $fpdf->SetXY(10.9,14.6);
            $fpdf->MultiCell(9.6,.3,utf8_decode('Se decidió guardia y custodia a favor de la madre'),0,'L',false);
        }
        if($select2 > 0){
            $fpdf->Rect(10.90, 15.096, 9.48, .547, 'F');
            $fpdf->SetXY(10.9,15.2);
            $fpdf->MultiCell(9.6,.3,utf8_decode('Se decidió guardia y custodia a favor del padre'),0,'L',false);
        }
        if($select3 > 0){
            $fpdf->Rect(10.90, 15.683, 9.48, .547, 'F');
            $fpdf->SetXY(10.9,15.8);
            $fpdf->MultiCell(9.6,.3,utf8_decode('Se decidió guardia y custodia a favor de otros familiares'),0,'L',false);
        }
        if($select4 > 0){
            $fpdf->Rect(10.90, 16.28, 9.48, .600, 'F');
            $fpdf->SetXY(10.9,16.4);
            $fpdf->MultiCell(9.6,.3,utf8_decode('No existe decisión de algún órgano jurisdiccional'),0,'L',false);
        }
        if($select5 > 0){
            $fpdf->Rect(10.90, 16.94, 9.48, .600, 'F');
            $fpdf->SetXY(10.9,17);
            $fpdf->MultiCell(9.6,.3,utf8_decode('Se decidió guardia y custodia compartida'),0,'L',false);
        }
    }

    //6. ¿Su pareja o expareja le imposibilita poder convivir o ver a sus hijas/hijos?
    if(isset($options[42])){
       $fpdf->SetFontSize(7);
       //Su pareja no le permite ver a sus hijas/hijos y no hay guardia y custodia dictada por algún juez de lo familiar
       if($options[42]['id_opcion'] == 131){
            $fpdf->Rect(10.90, 17.60, 9.48, .8, 'F');
            $fpdf->SetXY(11.35,17.6);
            $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($options[42]['nombre'])),0,'L',false);
        }
        //La guardia y custodia es a favor del padre u otro familiar paterno, pero le imposibilita las convivencias con sus hijos o hijas
        if($options[42]['id_opcion'] == 132){
            $fpdf->Rect(10.90, 18.46, 9.48, .73, 'F');
            $fpdf->SetXY(11.35,18.45);
            $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($options[42]['nombre'])),0,'L',false);
        }
       //No hay problemas para la convivencia con sus hijas/hijos
       if($options[42]['id_opcion'] == 133){
            $fpdf->Rect(10.90, 19.24, 9.48, .74, 'F');
            $fpdf->SetXY(11.35,19.2);
            $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($options[42]['nombre'])),0,'L',false);
       }
       $fpdf->SetFontSize(8);
    }

    //CONTEXTO DE CONVIVENCIA CON PAREJA O EXPAREJA
    //7. ¿Actualmente vive con su pareja o expareja?
    if(isset($options[43])){
      //no
      if($options[43]['id_opcion'] == 134){
          $fpdf->Rect(15.66, 20.655, 4.71, .596, 'F');
          $fpdf->SetXY(15.7,20.75);
          $fpdf->MultiCell(4.6,.4,utf8_decode(strip_tags($options[43]['nombre'])),0,'C',false);
      }
      //si
      if($options[43]['id_opcion'] == 135){
          $fpdf->Rect(10.88, 20.655, 4.73, .596, 'F');
          $fpdf->SetXY(11,20.75);
          $fpdf->MultiCell(4.6,.4,utf8_decode(strip_tags($options[43]['nombre'])),0,'C',false);
      }
    }

    //8. ¿De quién es propiedad la casa donde habita con su pareja o expareja?
    if(isset($options[44])){
      $fpdf->SetFontSize(7);
      //Es de su propiedad o de alguno de sus familiares de usted
      if($options[44]['id_opcion'] == 136){
          $fpdf->Rect(10.88, 21.3, 9.48, .596, 'F');
          $fpdf->SetXY(11.35,21.4);
          $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($options[44]['nombre'])),0,'L',false);
      }
      //Es de su pareja o expareja
      if($options[44]['id_opcion'] == 137){
          $fpdf->Rect(10.88, 21.949, 9.48, .53, 'F');
          $fpdf->SetXY(11.35,22);
          $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($options[44]['nombre'])),0,'L',false);
      }
      //Pertenece a la familia de su pareja o expareja
      if($options[44]['id_opcion'] == 138){
          $fpdf->Rect(10.88, 22.54, 9.48, .53, 'F');
          $fpdf->SetXY(11.35,22.6);
          $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($options[44]['nombre'])),0,'L',false);
      }
      //La casa donde habita es rentada por usted o su pareja o expareja
      if($options[44]['id_opcion'] == 139){
          $fpdf->Rect(10.88, 23.12, 9.48, .6, 'F');
          $fpdf->SetXY(11.35,23.2);
          $fpdf->MultiCell(9.,.4,utf8_decode(strip_tags($options[44]['nombre'])),0,'L',false);
      }
      $fpdf->SetFontSize(8);
    }

    //CONTEXTO DE CONVIVENCIA CON PAREJA O EXPAREJA
    //9. Seleccione los espacios que su pareja o expareja comparte con usted
    if(isset($options[45])){
      $fpdf->SetFontSize(7);
      //Vive en la misma colonia donde vive su pareja/expareja o familiares de él
      if($options[45]['id_opcion'] == 140){
          $fpdf->Rect(10.88, 23.79, 9.48, .6, 'F');
          $fpdf->SetXY(10.9,23.8);
          $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[45]['nombre'])),0,'L',false);
      }
      //Trabaja en el mismo espacio laboral que su pareja/expareja
      if($options[45]['id_opcion'] == 141){
          $fpdf->Rect(10.88, 24.43, 9.48, .52, 'F');
          $fpdf->SetXY(10.9,24.4);
          $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[45]['nombre'])),0,'L',false);
      }
      //Acude a la misma escuela que su pareja/expareja
      if($options[45]['id_opcion'] == 142){
          $fpdf->Rect(10.88, 25.02, 9.48, .53, 'F');
          $fpdf->SetXY(10.9,25);
          $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[45]['nombre'])),0,'L',false);
      }
      //Su pareja/expareja frecuenta la colonia donde usted vive, trabaja o estudia.
      if($options[45]['id_opcion'] == 143){
          $fpdf->Rect(10.88, 25.6, 9.48, .6, 'F');
          $fpdf->SetXY(10.9,25.6);
          $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[45]['nombre'])),0,'L',false);
      }
      $fpdf->SetAutoPageBreak(false);// para imprimir la ultima opcion que quedo fuera de margen
      //Ninguna de las anteriores
      if($options[45]['id_opcion'] == 144){
          $fpdf->Rect(10.88, 26.25, 9.48, .6, 'F');
          $fpdf->SetXY(10.9,26.3);
          $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[45]['nombre'])),0,'L',false);
      }
      $fpdf->SetFontSize(8);
    }

    $fpdf->AddPage();
    $tplId4 = $fpdf->importPage(4);
    $fpdf->useTemplate($tplId4, .4, .4, 21);

    //SITUACIÓN ECONÓMICA Y PATRIMONIAL
    //10. ¿Cuenta con ingresos propios para cubrir los gastos del hogar, alimentos y, en su caso, manutención de sus hijos?
    if(isset($options[46])){
        //No cuenta con ingresos propios y depende económicamente de su pareja o expareja
        if($options[46]['id_opcion'] == 145){
            $fpdf->Rect(10.93, 3.43, 9.48, .76, 'F');
            $fpdf->SetXY(10.9,3.52);
            $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[46]['nombre'])),0,'L',false);
        }
        //Cuenta con ingresos mínimos, pero depende de la aportación económica de su pareja o expareja
        if($options[46]['id_opcion'] == 146){
            $fpdf->Rect(10.93, 4.24, 9.48, .68, 'F');
            $fpdf->SetXY(10.9,4.3);
            $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[46]['nombre'])),0,'L',false);
        }
        //Cuenta con ingresos propios, pero su pareja se queda con la totalidad o gran parte de éstos
        if($options[46]['id_opcion'] == 147){
            $fpdf->Rect(10.93, 4.97, 9.48, .72, 'F');
            $fpdf->SetXY(10.9,5);
            $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[46]['nombre'])),0,'L',false);
        }
        //Cuenta con ingresos propios y los maneja de manera autónoma
        if($options[46]['id_opcion'] == 148){
            $fpdf->Rect(10.93, 5.74, 9.48, .70, 'F');
            $fpdf->SetXY(10.9,5.8);
            $fpdf->MultiCell(9.5,.3,utf8_decode(strip_tags($options[46]['nombre'])),0,'L',false);
        }
    }

    //11. ¿Su pareja, expareja o familiar de él controla o tiene en su posesión objetos personales
    //de su propiedad (documentos de identidad, objetos de higiene personal y ropa, u otros objetos necesarios para trabajar)?
    //Si
    if(isset($options[47])){
      if($options[47]['id_opcion'] == 149){
          $fpdf->Rect(10.93, 6.5, 9.48, .72, 'F');
          $fpdf->SetXY(11,6.6);
          $fpdf->MultiCell(9,.3,utf8_decode(strip_tags($options[47]['nombre'])),0,'L',false);
      }
      //no
      if($options[47]['id_opcion'] == 150){
          $fpdf->Rect(10.93, 7.28, 9.48, .72, 'F');
          $fpdf->SetXY(11,7.4);
          $fpdf->MultiCell(9,.3,utf8_decode(strip_tags($options[47]['nombre'])),0,'L',false);
      }
      //Cuales? no se muestra por que no lo contemple en el formulario
      //if($options[47]['id_opcion'] == 148){<=======NO existe ID
      //    $fpdf->Rect(10.93, 8.05, 9.48, .63, 'F');
      //    $fpdf->SetXY(11,8.1);
      //    $fpdf->MultiCell(9,.3,utf8_decode(strip_tags($options[47]['nombre'])),0,'L',false);
      //}
    }

    //OTROS FACTORES DE RIESGO
    //12. Seleccione los juicios o procedimientos iniciados contra su pareja, expareja o algún de familiar de él:
    //Denuncia por violencia familiar
    if(isset($checkbox[48][151])){
        $fpdf->Rect(10.95, 9.46, 9.49, .79, 'F');
        $fpdf->SetXY(11,9.7);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[48][151]['nombre'])),0,'L',false);
    }
    //Denuncia por algún delito violento (lesiones, amenazas, daño a la propiedad, despojo)
    if(isset($checkbox[48][152])){
        $fpdf->Rect(10.95, 10.3, 9.49, .67, 'F');
        $fpdf->SetXY(11,10.5);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[48][152]['nombre'])),0,'L',false);
    }
    //Juicio por guardia y custodia / alimentos
    if(isset($checkbox[48][153])){
        $fpdf->Rect(10.95, 11.03, 9.49, .69, 'F');
        $fpdf->SetXY(11,11.2);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[48][153]['nombre'])),0,'L',false);
    }
    //Divorcio
    if(isset($checkbox[48][154])){
        $fpdf->Rect(10.95, 11.79, 9.49, .67, 'F');
        $fpdf->SetXY(11,11.9);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[48][154]['nombre'])),0,'L',false);
    }
    //Otro. ¿Cuál?
    if(isset($checkbox[48][155])){
        $fpdf->Rect(10.95, 12.51, 9.49, .6, 'F');
        $fpdf->SetXY(11,12.6);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[48][155]['nombre'])),0,'L',false);
    }

    //13. ¿Su pareja o expareja cuenta con alguna de las siguientes características?
    if(isset($checkbox[49][157])){
        $fpdf->Rect(10.95, 13.16, 9.49, .78, 'F');
        $fpdf->SetXY(11,13.4);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[49][157]['nombre'])),0,'L',false);
    }
    if(isset($checkbox[49][158])){
        $fpdf->Rect(10.95, 13.99, 9.49, .68, 'F');
        $fpdf->SetXY(11,14.2);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[49][158]['nombre'])),0,'L',false);
    }
    if(isset($checkbox[49][159])){
        $fpdf->Rect(10.95, 14.72, 9.49, .7, 'F');
        $fpdf->SetXY(11,14.9);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[49][159]['nombre'])),0,'L',false);
    }
    if(isset($checkbox[49][160])){
        $fpdf->Rect(10.95, 15.47, 9.49, .68, 'F');
        $fpdf->SetXY(11,15.7);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($checkbox[49][160]['nombre'])),0,'L',false);
    }

    //14. Número de personas y familias que viven donde habita
    //¿Cuánta gente vive en su casa?
    if(isset($obtener_reactivos[50])){
        $fpdf->Rect(10.95, 16.2, 9.49, .78, 'F');
        $fpdf->SetXY(11,16.4);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($obtener_reactivos[50]['reactivo'])).":    " .$obtener_reactivos[50]['campo_unico'].' Persona(s)',0,'L',false);
    }
    //¿Cuántos cuartos tiene su casa?
    if(isset($obtener_reactivos[51])){
        $fpdf->Rect(10.95, 17.03, 9.49, .66, 'F');
        $fpdf->SetXY(11,17.2);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($obtener_reactivos[51]['reactivo'])).":    " .$obtener_reactivos[51]['campo_unico'].' Cuarto(s)',0,'L',false);
    }
    //¿Cuántas familias viven en el mismo predio/casa?:
    if(isset($obtener_reactivos[52])){
        $fpdf->Rect(10.95, 17.77, 9.49, .7, 'F');
        $fpdf->SetXY(11,18);
        $fpdf->MultiCell(9.2,.4,utf8_decode(strip_tags($obtener_reactivos[52]['reactivo'])).":    " .$obtener_reactivos[52]['campo_unico'].' Familia(s)',0,'L',false);
    }

    //15. ¿Cuenta con apoyo de familiares y/o amigas(o)?
    if(isset($options[53])){
        //Tiene familiares o amigas(os) que conocen de la situación de violencia en que se encuentra
        if($options[53]['id_opcion'] == 162){
          $fpdf->Rect(10.92, 19.36, 9.51, .77, 'F');
          $fpdf->SetXY(11,19.4);
          $fpdf->MultiCell(9.2,.3,utf8_decode(strip_tags($options[53]['nombre'])),0,'L',false);
        }
        //Cuenta con familiares o amigas(os) que conocen y le apoyan durante la situación de violencia
        if($options[53]['id_opcion'] == 163){
          $fpdf->Rect(10.92, 20.18, 9.51, .69, 'F');
          $fpdf->SetXY(11,20.2);
          $fpdf->MultiCell(9.2,.3,utf8_decode(strip_tags($options[53]['nombre'])),0,'L',false);
        }
        //No cuenta con familiares o amigas(os) que le brinden apoyo o conozcan de su situación de violencia
        if($options[53]['id_opcion'] == 164){
          $fpdf->Rect(10.92, 20.92, 9.51, .7, 'F');
          $fpdf->SetXY(11,21);
          $fpdf->MultiCell(9.2,.3,utf8_decode(strip_tags($options[53]['nombre'])),0,'L',false);
        }
    }

    //Observaciones
    if(isset($obtener_reactivos[54])){
      $fpdf->SetXY(5,22.25);
      $fpdf->MultiCell(14.9,.3,utf8_decode(strip_tags($obtener_reactivos[54]['campo_unico'])),0,'L',false);
    }

    ob_start();
    $token = Helpme::token();
    $path = 'tmp/'.$token.'.pdf';
    $fpdf->Output('F', $path);
    $datos = [
        'path' => $path
    ];
    return view('pdf/pdf')->with('datos', $datos);
    ob_flush();
  }
}

class customPdf extends Fpdi
{
    var $firma;

    //$fpdf->setConfig('firma',$firma);
    function setConfig($var,$val)
    {
        $this->{$var} = $val;
    }

    public function Header(){}
    public function Footer(){}

}
