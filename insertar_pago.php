<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['cedula']) && !empty($_POST['cedula']) &&
    isset($_POST['checkbox']) && !empty($_POST['checkbox']) &&
    isset($_POST['banco']) && !empty($_POST['banco']) &&
    isset($_POST['bouche']) && !empty($_POST['bouche']) &&
    isset($_POST['monto']) && !empty($_POST['monto'])) {
        // Si entramos es que todo se ha realizado correctamente
		$cedula = htmlentities($_POST['cedula']);
		$cuota = htmlentities($_POST['checkbox']);
		$banco = htmlentities($_POST['banco']);
		$bouche = htmlentities($_POST['bouche']);
		$monto = htmlentities($_POST['monto']);
		$fecha = date("Y-m-d H:i:s");

		
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);

		
        // Con esta sentencia SQL insertaremos los datos en la base de datos
        
                 if(is_array($_POST['checkbox']))
                 {
                     // realizamos el ciclo
                     while(list($key,$cuota) = each($_POST['checkbox'])) 
                    {
                        mysql_query("INSERT INTO pagos (banco,bouche,monto,cedula,tipo_cuota,fecha_dep) 
                            VALUES ('{$banco}','{$bouche}','{$monto}','{$cedula}','{$cuota}','{$fecha}')",$link);
                    }
                 }
        

        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error($link);

        if(!empty($my_error)) {

            echo mysql_error();
            //header ("Location: registroest2.php?errordat");

        } else {

             header ("Location: inicio.php?successpago");

        }

    } else {

         echo mysql_error();
         //header ("Location: registroest2.php?errordb");

    }

?>