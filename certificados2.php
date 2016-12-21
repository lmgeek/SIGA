<?php 

include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}
        $link = mysql_connect($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link) or die('No se puede seleccionar la base de datos');
     


                        if(isset($_POST['nacionalidad']) && !empty($_POST['nacionalidad']) &&
                          isset($_POST['cedula']) && !empty($_POST['cedula']) 
                            ){


                            $nacionalidad = htmlentities($_POST['nacionalidad']);
                            $cedula1 = htmlentities($_POST['cedula']);

                            $cedula = $nacionalidad.$cedula1;
                            

                            $query = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$cedula."'") or die(mysql_error());
                            //Verificamos que la Cedula Exista en la Base de Datos
                            if (mysql_num_rows($query)>0){

                              $row2 = mysql_fetch_array($query);

$url = "certificado-final.php?cedula=".$cedula;

header("Location:".$url);
                 
                        } else {
                                  echo "<script>
                                          alert('El Estudiante de la Cedula de Identidad  ".$cedula."\\nNo existe debe registrarlo');
                                           document.location=('registroest.php');
                                        </script>";
                                }
                        } else{ 
                       header("Location:inicio.php");
                        }




                    ?>