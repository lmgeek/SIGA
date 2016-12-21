<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['cedula']) && !empty($_POST['cedula']) &&
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['especialidad']) && !empty($_POST['especialidad']) &&
    isset($_POST['telf1']) && !empty($_POST['telf1']) &&
    isset($_POST['tlf2']) && !empty($_POST['tlf2']) &&
    isset($_POST['curso']) && !empty($_POST['curso'])) {
        // Si entramos es que todo se ha realizado correctamente
        $mail = htmlentities($_POST['email']);
		$especialidad = htmlentities($_POST['especialidad']);
		$cedula = htmlentities($_POST['cedula']);
		$name = htmlentities($_POST['name']);
		$telf1 = htmlentities($_POST['telf1']);
		$tlf2 = htmlentities($_POST['tlf2']);
		$curso = htmlentities($_POST['curso']);
		$cuota = "Pre-Inscripcion";
		$fecha = date("Y-m-d");

		
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		
		//Verificamos si la cedula a registrar existe en la Base de Datos
		$queEmp = "SELECT cedula FROM estudiantes WHERE cedula='$cedula'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
			//header ("Location: registroest2.php?cedula=$cedula");
			//header("Location: registroest2.php?cedula=".urlencode($cedula)); 
			//echo "El Estudiante esta registrado";
			//exit();

            // Con esta sentencia SQL insertaremos los datos en la base de datos
            mysql_query("UPDATE  estudiantes SET cedula = '{$cedula}',nombre = '{$name}',especialidad = '{$especialidad}',
                email = '{$mail}',telf1 = '{$telf1}',tlf2 = '{$tlf2}',curso = '{$curso}' WHERE cedula = '{$cedula}'",$link);

            // Ahora comprobaremos que todo ha ido correctamente
            $my_error = mysql_error($link);

            if(!empty($my_error)) {

                header ("Location: registro_est.php?errordat");

            } else {

                 header ("Location: inicio.php?success");

            }






		}

        

    } else {

         echo mysql_error();
         //header ("Location: registroest.php?errordb");

    }

?>