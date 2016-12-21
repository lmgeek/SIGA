<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['ubicacion']) && !empty($_POST['ubicacion']) &&
    isset($_POST['nucleo']) && !empty($_POST['nucleo']) &&
    isset($_POST['facilitador']) && !empty($_POST['facilitador']) &&
    isset($_POST['f_inicio']) && !empty($_POST['f_inicio']) &&
    isset($_POST['f_culminacion']) && !empty($_POST['f_culminacion']) &&
    isset($_POST['periodo']) && !empty($_POST['periodo']) &&
    isset($_POST['duracion']) && !empty($_POST['duracion'])) {
        // Si entramos es que todo se ha realizado correctamente
		$name = htmlentities($_POST['name']);
        $ubicacion = htmlentities($_POST['ubicacion']);
		$nucleo = htmlentities($_POST['nucleo']);
		$facilitador = htmlentities($_POST['facilitador']);
		$f_inicio = htmlentities($_POST['f_inicio']);
		$f_culminacion = htmlentities($_POST['f_culminacion']);
		$periodo = htmlentities($_POST['periodo']);
        $duracion = htmlentities($_POST['duracion']);

$finicio = date("Y-m-d",strtotime($f_inicio));
$fculminacion = date("Y-m-d",strtotime($f_culminacion));
$fechaactual = date("Y");
$completa=$fechaactual."-".$periodo;


		
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);

		
		//Verificamos si la cedula a registrar existe en la Base de Datos
		$queEmp = "SELECT * FROM cursos WHERE nom_curso='$name'";
		$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		if($totEmp > 0){

			// Con esta sentencia SQL insertaremos los datos en la base de datos
              mysql_query("UPDATE cursos SET F_inicio = '{$finicio}',F_culmi = '{$fculminacion}',periodo = '{$completa}',
                                duracion = '{$duracion}',ubicacion = '{$ubicacion}',nucleo = '{$nucleo}',facilitador = '{$facilitador}'
                                WHERE nom_curso = '{$name}'",$link);


                // Ahora comprobaremos que todo ha ido correctamente
                $my_error = mysql_error($link);

                if(!empty($my_error)) {

                    header ("Location: registrocursos.php?errordat");

                } else {

                     header ("Location: inicio.php?successcurso");

                }
            
			
		} else {
            //header ("Location: registroest2.php?cedula=$cedula");
            header("Location: cursos.php?nuevocurso"); 
             exit();
        }

		
        

    } else {

         echo mysql_error();

    }

?>