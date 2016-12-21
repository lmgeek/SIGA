 <?php 

include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}

        $link = mysql_connect($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link) or die('No se puede seleccionar la base de datos');

                        if(isset($_POST['nacionalidad']) && !empty($_POST['nacionalidad']) &&
                          isset($_POST['cedula']) && !empty($_POST['cedula'])){
                            $nacionalidad = htmlentities($_POST['nacionalidad']);
                            $cedula1 = htmlentities($_POST['cedula']);
                            $cedula = $nacionalidad.$cedula1;

                            $consulta = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$cedula."'") or die(mysql_error());
                            $row = mysql_fetch_array($consulta);


                            //$query2 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota1'") or die(mysql_error());
                              //  $row3 = mysql_fetch_array($query2);



                            $preinscripcion = "Pre-Inscripcion";
                            $cuota1 = "Inscripcion y 1ra Cuota";
                            $cuota2 = "2da Cuota";
                            $cuota3 = "3ra Cuota";
                            $cuota4 = "4ta Cuota";


                            $query = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$preinscripcion'") or die(mysql_error());
                                ;

                                if ($row2 = mysql_fetch_array($query)) {
                                  $cuota0 = $row2[2]." Bs.";
                                }else {
                                  $cuota0 = "<b><i>No Cancelado</b></i>";
                                }


                               $query2 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota1'") or die(mysql_error());
                                ;
                                
                                if ($row3 = mysql_fetch_array($query2)) {
                                  $pago1 = $row3[2]." Bs.";
                                }else {
                                   $pago1 = "<b><i>No Cancelado</b></i>";
                                }

                            $query3 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota2'") or die(mysql_error());
                                ;
                                
                                if ($row4 = mysql_fetch_array($query3)) {
                                  $pago2 = $row4[2]." Bs.";
                                }else {
                                  $pago2 = "<b><i>No Cancelado</b></i>";
                                }
                            $query4 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota3'") or die(mysql_error());
                                ;
                                
                                if ($row5 = mysql_fetch_array($query4)) {
                                  $pago3 = $row5[2]." Bs.";
                                }else {
                                  $pago3 = "<b><i>No Cancelado</b></i>";
                                }

                            $query5 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota4'") or die(mysql_error());
                                ;
                                
                                if ($row6 = mysql_fetch_array($query5)) {
                                  $pago4 = $row6[2]." Bs.";
                                }else {
                                  $pago4 = "<b><i>No Cancelado</b></i>";
                                }

                               // $suma = $row2[2]+$row3[2]+$row4[2]+$row5[2]+$row6[2];

                // Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
                date_default_timezone_set('UTC');
                $fecha = date("d/m/Y");

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

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
$pdf->SetFont('helvetica', '', 13);

// add a page
$pdf->AddPage();

// create some HTML content
$html = '
<br><br>
<h1 align="center">ESTADO DE CUENTAh1>
<br>
<b>Fecha:</b> '.$fecha.'<br><br>
<form class="form form-signup" role="form" ><br>
                        <table  width="100%" class="table table-bordered text-center" border="2">
                          <tr class="active" style="font-weight:bold;">
                            <td>Nombre y Apellido</td>
                            <td>C.I N°</td>
                            <td>Pre-Inscripci&oacuten</td>
                            <td>Inscripci&oacuten y 1ra Cuota</td>
                            <td>2da Cuota</td>
                            <td>3ra Cuota</td>
                            <td>4ta Cuota</td>
                            <td>Total</td>
                          </tr>

                          <tr align="center">
                            <td>
                              '.$row[1].' '.$row[2].'
                            </td>
                            <td>
                              '.$row[0].'
                            </td>
                            <td>
                              '.$cuota0.'
                            </td>
                            <td>
                              '.$pago1.'
                            </td>
                            <td>
                              '.$pago2.'
                            </td>
                            <td>
                              '.$pago3.'
                            </td>
                            <td>
                              '.$pago4.'
                            </td>
                            <td>
                               Bs.
                            </td>
                            
                          </tr>
                        </table>
';



// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);


//$pdf->MultiCell(80, 0, "Dr. Víctor Capielo
//  Jefe del Núcleo Académico Falcón
//  UPEL-IMPM.\n", 0, 'J', 0, 1, '', '', true, 0);

$pdf->Ln(2);




// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Constancia_Estudio.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


}else{
  header("Location:inicio.php");
}