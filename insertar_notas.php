<?php
include('config.php');
    // Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
    if(isset($_POST['cedula']) && !empty($_POST['cedula']) &&
    isset($_POST['curso']) && !empty($_POST['curso']) &&
    isset($_POST['periodo']) && !empty($_POST['periodo'])) {
        // Si entramos es que todo se ha realizado correctamente
        $cedula = htmlentities($_POST['cedula']);
        $curso = htmlentities($_POST['curso']);
		$periodo = htmlentities($_POST['periodo']);
		$fecha = date("Y-m-d");
            $nota1 = htmlentities($_POST['nota1']);
            $nota2 = htmlentities($_POST['nota2']);
            $nota3 = htmlentities($_POST['nota3']);
            $nota4 = htmlentities($_POST['nota4']);
            $nota5 = htmlentities($_POST['nota5']);
            $nota6 = htmlentities($_POST['nota6']);
            $nota7 = htmlentities($_POST['nota7']);
        

		
        $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link);

	
echo $nota1."<br>".$nota2."<br>".$periodo."<br>";

        $query1 = mysql_query("SELECT nota1 FROM notas WHERE cedula='".$cedula."'",$link) or die(mysql_error());
        $query2 = mysql_query("SELECT nota2 FROM notas WHERE cedula='".$cedula."'",$link) or die(mysql_error());
        $query3 = mysql_query("SELECT nota3 FROM notas WHERE cedula='".$cedula."'",$link) or die(mysql_error());
        $query4 = mysql_query("SELECT nota4 FROM notas WHERE cedula='".$cedula."'",$link) or die(mysql_error());
        $query5 = mysql_query("SELECT nota5 FROM notas WHERE cedula='".$cedula."'",$link) or die(mysql_error());
        $query6 = mysql_query("SELECT nota6 FROM notas WHERE cedula='".$cedula."'",$link) or die(mysql_error());
        $query7 = mysql_query("SELECT nota7 FROM notas WHERE cedula='".$cedula."'",$link) or die(mysql_error());
                            //Verificamos que la Cedula Exista en la Base de Datos
                            mysql_num_rows($query1);
                            $row1 = mysql_fetch_array($query1);

                            mysql_num_rows($query2);
                            $row2 = mysql_fetch_array($query2);

                            mysql_num_rows($query3);
                            $row3 = mysql_fetch_array($query3);

                            mysql_num_rows($query4);
                            $row4 = mysql_fetch_array($query4);

                            mysql_num_rows($query5);
                            $row5 = mysql_fetch_array($query5);

                            mysql_num_rows($query6);
                            $row6 = mysql_fetch_array($query6);

                            mysql_num_rows($query7);
                            $row7 = mysql_fetch_array($query7);

                          


if($row1['nota1']==0){
            //echo $nota1;
        
            mysql_query("INSERT INTO `siga`.`notas` (`cedula`, `curso`, `periodo`, `nota1`, `nota2`,
                                     `nota3`, `nota4`, `nota5`, `nota6`, `nota7`, `promedio`)
                                     VALUES ('{$cedula}','{$curso}','{$periodo}','{$nota1}',
                                     NULL, NULL, NULL, NULL, NULL, NULL, NULL)",$link);

            // Ahora comprobaremos que todo ha ido correctamente
            $my_error = mysql_error($link);

            if(!empty($my_error)) {

                echo mysql_error();
                //header ("Location: registroest2.php?errordat");

            } else {

                 header ("Location: inicio.php?successnota");

            }
        }

        if($row2['nota2']==0){
        
            mysql_query("UPDATE notas SET nota1 = '{$nota1}', nota2 = '{$nota2}'
                                             WHERE cedula = '{$cedula}'",$link);

            // Ahora comprobaremos que todo ha ido correctamente
            $my_error = mysql_error($link);

            if(!empty($my_error)) {

                echo mysql_error();
                //header ("Location: registroest2.php?errordat");

            } else {

                 header ("Location: inicio.php?successnota");

            }
        }


        if($row3['nota3']==0){
        
            mysql_query("UPDATE notas SET nota1 = '{$nota1}', nota2 = '{$nota2}', nota3 = '{$nota3}'
                                             WHERE cedula = '{$cedula}'",$link);

            // Ahora comprobaremos que todo ha ido correctamente
            $my_error = mysql_error($link);

            if(!empty($my_error)) {

                echo mysql_error();
                //header ("Location: registroest2.php?errordat");

            } else {

                 header ("Location: inicio.php?successnota");

            }
        }


        if($row4['nota4']==0){
            
            mysql_query("UPDATE notas SET nota1 = '{$nota1}', nota3 = '{$nota2}', nota3 = '{$nota3}',
                                          nota4 = '{$nota4}' WHERE cedula = '{$cedula}'",$link);

            // Ahora comprobaremos que todo ha ido correctamente
            $my_error = mysql_error($link);

            if(!empty($my_error)) {

                echo mysql_error();
                //header ("Location: registroest2.php?errordat");

            } else {

                 header ("Location: inicio.php?successnota");

            }
        }

        if($row5['nota5']==0){
            
            mysql_query("UPDATE notas SET nota1 = '{$nota1}', nota3 = '{$nota2}', nota3 = '{$nota3}',
                                          nota4 = '{$nota4}', nota5 = '{$nota5}'
                                           WHERE cedula = '{$cedula}'",$link);

            // Ahora comprobaremos que todo ha ido correctamente
            $my_error = mysql_error($link);

            if(!empty($my_error)) {

                echo mysql_error();
                //header ("Location: registroest2.php?errordat");

            } else {

                 header ("Location: inicio.php?successnota");

            }
        }

        if($row6['nota6']==0){
            
            mysql_query("UPDATE notas SET nota1 = '{$nota1}', nota3 = '{$nota2}', nota3 = '{$nota3}',
                                          nota4 = '{$nota4}', nota5 = '{$nota5}', nota6 = '{$nota16}'
                                           WHERE cedula = '{$cedula}'",$link);

            // Ahora comprobaremos que todo ha ido correctamente
            $my_error = mysql_error($link);

            if(!empty($my_error)) {

                echo mysql_error();
                //header ("Location: registroest2.php?errordat");

            } else {

                 header ("Location: inicio.php?successnota");

            }
        }

        if($row7['nota7']==0){
            

            mysql_query("UPDATE notas SET nota1 = '{$nota1}', nota3 = '{$nota2}', nota3 = '{$nota3}',
                                          nota4 = '{$nota4}', nota5 = '{$nota5}', nota6 = '{$nota16}',
                                          nota7 = '{$nota7}' WHERE cedula = '{$cedula}'",$link);

            // Ahora comprobaremos que todo ha ido correctamente
            $my_error = mysql_error($link);

            if(!empty($my_error)) {

                echo mysql_error();
                //header ("Location: registroest2.php?errordat");

            } else {

                 header ("Location: inicio.php?successnota");

            }
        }
        



    } else {

         echo mysql_error();
         //header ("Location: registroest2.php?errordb");
         echo "string";

    }

?>