<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['nacionalidad']) && !empty($_POST['nacionalidad']) &&
        isset($_POST['cedula']) && !empty($_POST['cedula']) &&
        isset($_POST['name']) && !empty($_POST['name']) && 
        isset($_POST['lastname']) && !empty($_POST['lastname']) && 
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['telf1']) && !empty($_POST['telf1']) && 
        isset($_POST['especialidad']) && !empty($_POST['especialidad'])){


        $cedula         = $_POST['nacionalidad'].$_POST['cedula'];
        $name           = $_POST['name'];
        $lastname           = $_POST['lastname'];
        $mail           = $_POST['email'];
        $telf1          = $_POST['telf1'];
        $especialidad   = $_POST['especialidad'];
        date("Y");
		
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		
		//Verificamos si la cedula a registrar existe en la Base de Datos
		$queEmp = "SELECT * FROM `docentes` WHERE `cedula` LIKE '%{$cedula}%' ";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
			//header ("Location: registroest2.php?cedula=$cedula");
			header("Location: registrodocente.php?duplicado"); 
			echo "El Docente esta registrado";
			exit();
		}

		
        // Con esta sentencia SQL insertaremos los datos en la base de datos
        mysql_query("INSERT INTO docentes (cedula,nombre,apellido,correo,tlf,especialidad)
        VALUES ('{$cedula}','{$name}','{$lastname}','{$mail}','{$telf1}','{$especialidad}')",$link);

        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error($link);

        if(!empty($my_error)) {

            header ("Location: registrodocente.php?errordat");

        } else {

             header ("Location: inicio.php?successdocente");

        }

}else{

    header ("Location: inicio.php");
}

?>