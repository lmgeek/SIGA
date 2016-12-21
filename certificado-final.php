<?php

include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}

        $link = mysql_connect($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link) or die('No se puede seleccionar la base de datos');

//Verificamos que ha recibido la Cedula
if(isset($_GET['cedula']) && !empty($_GET['cedula'])){

    $cedula = htmlentities($_GET['cedula']);
    

    $query = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$cedula."'") or die(mysql_error());
    //Verificamos que la Cedula Exista en la Base de Datos
    mysql_num_rows($query);

      $row = mysql_fetch_array($query);

    $query2 = mysql_query("SELECT * FROM cursos WHERE id='".$row['curso']."'") or die(mysql_error());
      $row1 = mysql_fetch_array($query2);

      $desde = date('d-m-Y',strtotime($row1[2]));
      $hasta = date('d-m-Y',strtotime($row1[3]));
      $horas = $row1[5];
      $curso = $row1['nom_curso'];

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');


//Captura de Fecha Actual Separada 
$dia = array("Un","Dos","Tres","Cuatro","Cinco","Seis","Siete","Ocho","Nueve","Diez","Once","Doce","Trece","Catorce","Quince",
	"Dieciseis","Diecisiete","Dieciocho","Diecinueve","Veinte","Veintiun","Veintidos","Veintitres","Veinticuatro","Veinticinco",
	"Veintiseis","Veintisiete","Veintiocho","Veintinueve","Treinta","Treinta y un");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$anio = date("Y"); 

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    

    
}

// create new PDF document
$pdf = new MYPDF('L', "mm", 'letter');



// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(30, 30, 30);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


$pdf->SetFont('helvetica', '', 13);

// remove default header
$pdf->setPrintHeader(false);

// add a page
$pdf->AddPage();


// -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'../images/certificado-upel.png';
$pdf->Image($img_file, 0, 0, 295, 200, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();

$pdf->Ln(70);

// Print a text
$html = '
<style>
p {
        color: #000;
        font-family: helvetica;
        font-size: 10pt;
        margin-left: 280px;
    }
 {
    visibility: hidden;
}
</style>


<h1 align="center">'.$row[1]." ".$row[2].'<br>'.$row[0].'</h1>
<br><h1 align="center"><i>'.$curso.'</i></h1><br>
<br><p> </p><br>
<br><p> </p><br>


<p align="center" hidden><b>CORO - EDO - FALCÓN</b><font size="15px" >..................................</font>
<b>'.$desde.' HASTA '.$hasta.'</b><font size="15px" >..........................</font>
<b>'.$horas.'HORAS.</b></p>';
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Certificado__'.$cedula.'.pdf');

//============================================================+
// END OF FILE
//============================================================+





} else {
  header("Location:inicio.php");
}
?>