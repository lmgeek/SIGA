<?php
include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}
        $link = mysql_connect($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link) or die('No se puede seleccionar la base de datos');
        
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>.::SIGA - UPEL::.</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script language="JavaScript">
        function aviso(url){
        if (!confirm("ALERTA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) {
        return false;
        }
        else {
        document.location = url;
        return true;
        }
        }
        </script>


  </head>

  <body>

  <img src="images/banner.gif" width="100%" height="150px">
    <br>
    <div class="container" style="padding-top: 10px;">
    <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation" style="padding:30px;">
        <div class="container-fluid">
          <div class="navbar-header" style="margin-top:-18px;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="images/siga.png" alt="Sistema de Gestion Academica" width="120px">
                </a>
            </div>

          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
              <li><a href="inicio.php">Inicio</a></li>
              <li><a href="auditar.php">Manuales</a></li>
              <li class="active"><a href="usuarios.php">Soporte</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="">Fecha:
                <?php
                // Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
                date_default_timezone_set('UTC');
                //Imprimimos la fecha actual dandole un formato
                echo date("d/m/Y");
                ?></a><li id="clock"></li></li>
              <li><a href="cerrar.php"><button type="submit" class="btn btn-sm btn-danger btn-block" >
                      <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesion
                    </button></a></li>
            </ul>
          </div><!--/.nav-collapse -->

        </div><!--/.container-fluid -->
      </div>
<!--/End Menu -->
<div class="jumbotron">
    <div class="container">
    <!--Boton Volver atras-->
    <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>
      <form name="form1" method="post" action="insertar_est.php">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <?php
                    //Valida los errores que se generen en la consulta, si existe algun error de insercin o de conexio 
                    //a la DB.
                        if(isset($_GET['errordat'])){ 
                        echo "
                        <div class='alert alert-danger-alt alert-dismissable' align='center'>
                                        <span class='glyphicon glyphicon-exclamation-sign'></span>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                                            ×</button>Ha habido un error al insertar los valores.</div>
                        "; 
                        }else{ 
                        echo ""; 
                        } 
                        ?>
                        <?php
                        if(isset($_GET['errordb'])){ 
                        echo "
                        <div class='alert alert-danger-alt alert-dismissable' align='center'>
                                        <span class='glyphicon glyphicon-exclamation-sign'></span>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                                            ×</button>Error, no ha introducido todos los datos.</div>
                        "; 
                        }else{ 
                        echo ""; 
                        }


                    


                    ?>
                        
                    <form name="form1" method="post" action="insertar_est.php">
                        <h3 class="text-center">
                            Lista de Estudiantes</h3>
                        <form class="form form-signup" role="form" >

                    <table width="100%" class="table">
                        <tr align="center">
                            <td></td>
                            <td><b>Cédula</b></td>
                            <td><b>Nombres</b></td>
                            <td><b>Apellidos</b></td>
                            <td><b>Especialidad</b></td>
                            <td><b>Correo</b></td>
                            <td><b>Teléfono Casa</b></td>
                            <td><b>Teléfono Movil</b></td>
                            <td><b>Curso</b></td>
                        </tr>
                        <?php 
                        $contador = 0;
 $sql = "SELECT * FROM estudiantes order by apellido";
 $rs  = mysql_query($sql,$link);
 if(mysql_num_rows($rs) !=0 ){
    while($row=mysql_fetch_assoc($rs)){
        $class="odd";
        $contador = $contador + 1;   
        if($contador%2){$class="even";}

$query2 = mysql_query("SELECT * FROM cursos WHERE id='".$row['curso']."'") or die(mysql_error());
$row2 = mysql_fetch_array($query2);

            echo '<tr class="'.$class.'">';
            echo '<td>';
            ?><a href="javascript:;" onclick="aviso('eliminarest.php?cedula=<?php echo $row["cedula"]?>'); return false;"><img src="images/delete.png" width="20px"/></a>
            <a href="edit.php?cedula=<?php echo $row["cedula"]?>"><img src="images/edit.png"  width="20px"/></a>
            <?php
            echo '</td>';
            echo '<td>'.$row['cedula'].'</td>';
            echo '<td>'.$row['nombre'].'</td>';
            echo '<td>'.$row['apellido'].'</td>';
            echo '<td>'.$row['especialidad'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.$row['telf1'].'</td>';
            echo '<td>'.$row['tlf2'].'</td>';
            echo '<td>'.$row2['nom_curso'].'</td>';
            echo '</tr>';
    }


}


                     ?>

                    </table>


              </form></form></div></div></div></form>      

</div>
      </div>

    </div> <!-- /container -->

    <div id="footer" align="center">
  <span class="copy-left">©</span> Copyleft UPEL<br> WebMasters: Rivas Luis, Bermudez Eleazar, Rojas Victor
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funcion.js"></script>
  </body>
</html>