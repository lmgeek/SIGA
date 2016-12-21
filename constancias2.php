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
                            $ced = htmlentities($_POST['cedula']);
                            $cedula = $nacionalidad.$ced;

                            $query = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$cedula."'") or die(mysql_error());
                            //Verificamos que la Cedula Exista en la Base de Datos
                            if (mysql_num_rows($query)>0){

                              $row2 = mysql_fetch_array($query);
                              
                            
                         if(empty($_POST['constancia'])){ 
                                header("Location:constancias.php?error");
                        }else{ $constancia = htmlentities($_POST['constancia']);
                            if ($constancia == "estudio") {

$url = "constancia-estudio.php?cedula=".$cedula;

header("Location:".$url);


/* echo "
<div style='text-align: left; border: none;'>    
<object type='application/pdf' data=".$url." width='1000' height='1100' id='pdf'> 
<param name='src' value=".$url." /> 
<p style='text-align:center; width: 60%;'>Adobe Reader no se encuentra o la versi&oacute;n no es compatible, utiliza el icono para ir a la p&aacute;gina de descarga <br /> 
<a href='http://get.adobe.com/es/reader/' onclick='this.target='_blank''>
<img src='reader_icon_special.jpg' alt='Descargar Adobe Reader' width='32' height='32' style='border: none;' /></a> 
</p> 
</object> 
</div>";
*/
                            }else{

$url = "constancia-culminacion.php?cedula=".$cedula;

header("Location:".$url);

/*
 echo "
<div style='text-align: left; border: none;'>    
<object type='application/pdf' data=".$url." width='1000' height='1100' id='pdf'> 
<param name='src' value=".$url." /> 
<p style='text-align:center; width: 60%;'>Adobe Reader no se encuentra o la versi&oacute;n no es compatible, utiliza el icono para ir a la p&aacute;gina de descarga <br /> 
<a href='http://get.adobe.com/es/reader/' onclick='this.target='_blank''>
<img src='reader_icon_special.jpg' alt='Descargar Adobe Reader' width='32' height='32' style='border: none;' /></a> 
</p> 
</object> 
</div>";
*/
                            }
                        } 

                        } else {
                                  echo "<script>
                                          alert('El Estudiante de la Cedula de Identidad  ".$cedula."\\nNo existe debe registrarlo');
                                           document.location=('registroest.php');
                                        </script>";
                                }
                        } else{ 
                        /*if(isset($_GET['error'])){ 
                        echo "
                        <div class='alert alert-danger-alt alert-dismissable' align='center'>
                                        <span class='glyphicon glyphicon-exclamation-sign'></span>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                                            ×</button>Error, no ha introducido todos los datos.</div>
                        "; 
                        }else{ 
                        echo ""; 
                        }  */   
                   

  

                 // header("Location:inicio.php");

                }








     ?>