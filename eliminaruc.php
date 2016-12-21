<?php
	include('config.php');
	$uc = $_GET['uc'];
	

  $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
    
        /*ELIMINAMOS LOS CURSOS QUE TIENE ASIGNADO EL ALUMNO*/
        $sql = "DELETE FROM unidad_curricular where uc=".$uc;
         mysql_query($sql,$link);

         echo "<script>
                      alert('La Unidad Curricular se ha Eliminado Satisfactoriamente.');
                       document.location=('registrocursos.php');
                    </script>";
 ?>
