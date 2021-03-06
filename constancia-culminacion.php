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

    $query2 = mysql_query("SELECT * FROM cursos WHERE id='".$row[7]."'") or die(mysql_error());
      $row1 = mysql_fetch_array($query2);

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

    //Page header
    public function Header() {
        // Logo1
        $image_file = K_PATH_IMAGES.'../images/banner.png';
        $this->Image($image_file, 20, 10, 180, '', 'PNG', '', 'T', false, 00, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('times', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(30, 30, 30);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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


// set font
$pdf->SetFont('times', '', 13);

// add a page
$pdf->AddPage();

// create some HTML content
$html = '
<br><br>
<h1 align="center">CONSTANCIA DE CULMINACION</h1>
<br>
<p style="text-indent: 40px;" align="justify">
Quien Suscribe, <b>Dr. Víctor Capielo, Jefe del Núcleo Académico Falcon, de la Universidad Pedagógica Experimental Libertador
del Instituto de Mejoramiento Profesional del Magisterio,</b> por medio de la presente hace constar que el ciudadano(a):</p>

<br><p> </p><br>
<h1 align="center">'.$row[1].' '.$row[2].'</h1>
<br><p> </p><br>

<p style="text-indent: 40px;" align="justify">
Titular de la Cédula de Identidad <b>N° '.$row[0].',</b> culminó y aprobó sus estudios en el <b>SUBPROGRAMA '.$row1[1].',</b> con un 
total de <b>'.$row1[5].' Horas</b> de acuerdo a los requisitos exigidos por la <b>Comisión Revisora Local de Expedientes</b> para dar 
cumplimiento a lo dispuesto en el <b>Reglamento y Normas</b> para el otorgamiento de <b>Certificados en la República Bolivariana de 
Venezuela.</b></p>

<p style="text-indent: 40px;" align="justify">
Constancia que se Expide a peticón de la parte interesada en Santa Ana de Coro, a los '.$dia[date('d')-1].' días del mes de '.$meses[date('n')-1].' del '.$anio.'.</p>

<br><p> </p><br><br><p> </p><br>
<img src="images/footer.png"/>

';



// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);


//$pdf->MultiCell(80, 0, "Dr. Víctor Capielo
//	Jefe del Núcleo Académico Falcón
//	UPEL-IMPM.\n", 0, 'J', 0, 1, '', '', true, 0);

$pdf->Ln(2);




// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Constancia_Estudio.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+





} else {
  header("Location:inicio.php");
}
