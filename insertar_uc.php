<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['curso']) && !empty($_POST['curso']) &&
    isset($_POST['uc']) && !empty($_POST['uc'])) {
        // Si entramos es que todo se ha realizado correctamente
        $curso = htmlentities($_POST['curso']);
        $uc = htmlentities($_POST['uc']);

		
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);
		
		//Verificamos si la unidad curricular a registrar existe en la Base de Datos
		$queEmp = "SELECT uc FROM unidad_curricular WHERE uc='$uc'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){
			//header ("Location: registroest2.php?cedula=$cedula");
			echo "<script>
                      alert('La Unidad Curricular ya se encuentra registrada.');
                       window.history.back();
                    </script>";
			exit();
		}

		
        // Con esta sentencia SQL insertaremos los datos en la base de datos
        mysql_query("INSERT INTO unidad_curricular (id_curso,uc) VALUES ('{$curso}','{$uc}')",$link);


        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error($link);

        if(!empty($my_error)) {

            header ("Location: registro_uc.php?errordat");

        } else {

             header ("Location: inicio.php?successuc");

        }

    } else {

         echo mysql_error();

    }

?>