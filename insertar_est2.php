<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['cedula']) && !empty($_POST['cedula']) &&
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['especialidad']) && !empty($_POST['especialidad']) &&
    isset($_POST['telf1']) && !empty($_POST['telf1']) &&
    isset($_POST['tlf2']) && !empty($_POST['tlf2']) &&
    isset($_POST['curso']) && !empty($_POST['curso']) &&
    isset($_POST['banco']) && !empty($_POST['banco']) &&
    isset($_POST['bouche']) && !empty($_POST['bouche']) &&
    isset($_POST['monto']) && !empty($_POST['monto'])) {
        // Si entramos es que todo se ha realizado correctamente
        $mail = htmlentities($_POST['email']);
		$especialidad = htmlentities($_POST['especialidad']);
		$cedula = htmlentities($_POST['cedula']);
		$name = htmlentities($_POST['name']);
		$telf1 = htmlentities($_POST['telf1']);
		$tlf2 = htmlentities($_POST['tlf2']);
		$curso = htmlentities($_POST['curso']);
		$banco = htmlentities($_POST['banco']);
		$bouche = htmlentities($_POST['bouche']);
		$monto = htmlentities($_POST['monto']);
		$cuota = "Inscripcion";
		$fecha = date("Y-m-d");

		
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);

		
        // Con esta sentencia SQL insertaremos los datos en la base de datos

        mysql_query("INSERT INTO pagos (banco,bouche,monto,cedula,tipo_cuota,fecha_dep) 
        VALUES ('{$banco}','{$bouche}','{$monto}','{$cedula}','{$cuota}','{$fecha}')",$link);

        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error($link);

        if(!empty($my_error)) {

            echo mysql_error();
            //header ("Location: registroest2.php?errordat");

        } else {

             header ("Location: inicio.php?success");

        }

    } else {

         echo mysql_error();
         //header ("Location: registroest2.php?errordb");

    }

?>