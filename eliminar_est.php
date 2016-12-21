<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_GET['cedula']) && !empty($_GET['cedula'])){
    	$cedula = htmlentities($_GET['cedula']);

    	$link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);

    	echo $cedula;
    	//Con esta sentencia eliminaremos al estudiante de la base de datos, pero como usamos varias tablas lo hacemos
    	//de manera recursiva y lo eliminamos de todas las tablas
    	$sql2 = "DELETE FROM pagos WHERE cedula = ".$cedula;
    	mysql_query($sql2,$link);

    	$sql3 = "DELETE FROM inscripcion WHERE cedula = ".$cedula;
    	mysql_query($sql3,$link);

    	$sql1 = "DELETE FROM estudiante  WHERE cedula = ".$cedula;
		mysql_query($sql1,$link);


    	// Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error($link);

        //if(!empty($my_error)) {

        //    header ("Location: editar.php?errordat");

        //} else {

        //     header ("Location: inicio.php?successdelete");

       // }

    } else {

         echo mysql_error();

    }

?>





