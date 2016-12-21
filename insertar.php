<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['cedula']) && !empty($_POST['cedula']) &&
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password']) &&
    isset($_POST['pregunta1']) && !empty($_POST['pregunta1']) &&
    isset($_POST['pregunta2']) && !empty($_POST['pregunta2']) &&
    isset($_POST['resp1']) && !empty($_POST['resp1']) &&
    isset ($_POST['resp2']) && !empty($_POST['resp2'])) {
        // Si entramos es que todo se ha realizado correctamente
		$password = md5($_POST['password']);
		$username = htmlentities($_POST['username']);
		$mail = htmlentities($_POST['email']);
		$cedula = htmlentities($_POST['cedula']);
		$name = htmlentities($_POST['name']);
		$pregunta1 = htmlentities($_POST['pregunta1']);
		$pregunta2 = htmlentities($_POST['pregunta2']);
		$resp1 = htmlentities($_POST['resp1']);
		$resp2 = htmlentities($_POST['resp2']);
		$tipousu = "admin";

		
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		
		//Verificamos si la cedula a registrar existe en la Base de Datos
		$queEmp = "SELECT username FROM usuarios WHERE cedula='$cedula'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
		echo "Nombre de usuario no disponible";
		exit();
		}

		//Verificamos si el usuario a registrar existe en la Base de Datos
		$queEmp = "SELECT username FROM usuarios WHERE username='$username'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
		echo "Nombre de usuario no disponible";
		exit();
		}
		
		//Verificamos si el correo a registrar existe en la Base de Datos
		$queEmp = "SELECT email FROM usuarios WHERE email='$mail'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
		echo "El mail ingresado no esta disponible";
		exit();
		}
		
        // Con esta sentencia SQL insertaremos los datos en la base de datos
        mysql_query("INSERT INTO usuarios (cedula,nombre,username,password,email,tipo_usu,pregunta1,resp1,pregunta2,resp2)
        VALUES ('{$cedula}','{$name}','{$username}','{$password}','{$mail}','{$tipousu}','{$pregunta1}','{$resp1}','{$pregunta2}','{$resp2}')",$link);

        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error($link);

        if(!empty($my_error)) {

            header ("Location: registrarse.php?errordat");

        } else {

             header ("Location: index.php?success");

        }

    } else {

         header ("Location: registrarse.php?errordb");

    }

?>