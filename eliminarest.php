<?php
include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}
        $link = mysql_connect($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link) or die('No se puede seleccionar la base de datos');
        
	$cedula = $_GET['cedula'];
	
        /*ELIMINAMOS LOS CURSOS QUE TIENE ASIGNADO EL ALUMNO*/
        $sql1 = "DELETE FROM `siga`.`estudiantes` WHERE `estudiantes`.`cedula` ='{$cedula}'";
         mysql_query($sql1,$link);
          /*ELIMINAMOS LOS CURSOS QUE TIENE ASIGNADO EL ALUMNO*/
        $sql2 = "DELETE FROM `siga`.`estudiantes` WHERE `estudiantes`.`cedula` ='{$cedula}'";
         mysql_query($sql2,$link);
	$sql = "DELETE FROM `siga`.`estudiantes` WHERE `estudiantes`.`cedula` ='{$cedula}'";
         mysql_query($sql,$link);
         echo "<script>
                      alert('El Aspirante se ha Eliminado Satisfactoriamente.');
                       document.location=('inicio.php?successdelete');
                    </script>";
 ?>