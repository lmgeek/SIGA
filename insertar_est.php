<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['cedula']) && !empty($_POST['cedula']) &&
    isset($_POST['nacionalidad']) && !empty($_POST['nacionalidad']) &&
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['lastname']) && !empty($_POST['lastname']) &&
    isset($_POST['especialidad']) && !empty($_POST['especialidad']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['telf1']) && !empty($_POST['telf1']) &&
    isset($_POST['tlf2']) && !empty($_POST['tlf2']) &&
    isset($_POST['curso']) && !empty($_POST['curso']) &&
    isset($_POST['banco']) && !empty($_POST['banco']) &&
    isset($_POST['bouche']) && !empty($_POST['bouche']) &&
    isset($_POST['periodo']) && !empty($_POST['periodo']) &&
    isset($_POST['monto']) && !empty($_POST['monto'])) {
        // Si entramos es que todo se ha realizado correctamente
        $mail = htmlentities($_POST['email']);
		$especialidad = htmlentities($_POST['especialidad']);
        $ced = htmlentities($_POST['cedula']);
		$nacionalidad = htmlentities($_POST['nacionalidad']);
        $name = htmlentities($_POST['name']);
		$lastname = htmlentities($_POST['lastname']);
		$telf1 = htmlentities($_POST['telf1']);
		$tlf2 = htmlentities($_POST['tlf2']);
		$curso = htmlentities($_POST['curso']);
		$banco = htmlentities($_POST['banco']);
		$bouche = htmlentities($_POST['bouche']);
        $monto = htmlentities($_POST['monto']);
		$periodo = htmlentities($_POST['periodo']);
		$cuota = "Pre-Inscripcion";
		$fecha = date("Y-m-d H:i:s");

		$cedula  = $nacionalidad.$ced;
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		
		//Verificamos si la cedula a registrar existe en la Base de Datos
		$queEmp = "SELECT cedula FROM estudiantes WHERE cedula='$cedula'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
			//header ("Location: registroest2.php?cedula=$cedula");
			header("Location: registroest2.php?cedula=".urlencode($cedula)); 
			echo "El Estudiante esta registrado";
			exit();
		}

/*
echo $mail."<br>";
echo $especialidad."<br>";
echo $name."<br>";
echo $telf1."<br>";
echo $tlf2."<br>";
echo $curso."<br>";
echo $banco."<br>";
echo $bouche."<br>";
echo $monto."<br>";
echo $periodo."<br>";
echo $cuota."<br>";
echo $fecha."<br>";
*/


		
        // Con esta sentencia SQL insertaremos los datos en la base de datos
        mysql_query("INSERT INTO estudiantes (cedula,nombre,apellido,especialidad,email,telf1,tlf2,curso)
        VALUES ('{$cedula}','{$name}','{$lastname}','{$especialidad}','{$mail}','{$telf1}','{$tlf2}','{$curso}')",$link);

        mysql_query("INSERT INTO pagos (banco,bouche,monto,cedula,tipo_cuota,fecha_dep) 
        VALUES ('{$banco}','{$bouche}','{$monto}','{$cedula}','{$cuota}','{$fecha}')",$link);

        mysql_query("INSERT INTO inscripcion (cedula,curso,periodo) 
        VALUES ('{$cedula}','{$curso}','{$periodo}')",$link);

        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error($link);

        if(!empty($my_error)) {

            header ("Location: registroest.php?errordat");

        } else {

             header ("Location: inicio.php?success");

        }

    } else {

         echo mysql_error();
         //header ("Location: registroest.php?errordb");

    }

?>