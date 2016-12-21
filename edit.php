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

    <!--  VALIDACION ELIMINAR ALUMNO  -->
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
              <li class="active"><a href="inicio.php">Inicio</a></li>
              <li><a href="auditar.php">Manuales</a></li>
              <li ><a href="usuarios.php">Soporte</a></li>
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
    <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>

                        <?php 
                        if(isset($_GET['cedula']) && !empty($_GET['cedula'])){
                            $cedula = htmlentities($_GET['cedula']);

                            $query = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$cedula."'") or die(mysql_error());
                            //Verificamos que la Cedula Exista en la Base de Datos
                            if (mysql_num_rows($query)>0){

                              $row2 = mysql_fetch_array($query);
                            
                         ?>
      <form name="form1" method="post" action="editar_est.php">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <?php
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
                        <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                          <span class='glyphicon glyphicon-info-sign'></span>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                              ×</button>Registre al Alumno.
                        </div>

                        <h3 class="text-center">
                            Registro de Estudiantes</h3>
                        <form class="form form-signup" role="form" >
              
                        <div class="form-group">
                            <div class="input-group" title="Cedula">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <?php 
                                    echo "<input name='cedula' type='text' id='cedula' class='form-control' placeholder='Cedula Ejemplo: V-12345678'  required value=".$row2[0]." />";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Nombre y Apellido">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <?php 
                                echo "<input name='name' type='text' id='name' class='form-control' placeholder='Nombre y Apellido'  required value='".$row2[1]."' pattern='[A-Za-z ]+' title='Solo puede contener caracteres Alfabeticos y no numericos'>";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Nombre y Apellido">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <?php 
                                echo "<input name='lastname' type='text' id='lastname' class='form-control' placeholder='Nombre y Apellido'  required value='".$row2[2]."' pattern='[A-Za-z ]+' title='Solo puede contener caracteres Alfabeticos y no numericos'>";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Especialidad">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                                <?php 
                                echo "<input name='especialidad' type='text' id='especialidad' class='form-control' placeholder='Especialidad'  required value='".$row2[3]."' pattern='[A-Za-z ]+' title='Solo puede contener caracteres Alfabeticos y no numericos'>";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Correo">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <?php 
                                echo "<input name='email' type='text' id='email' class='form-control' placeholder='Correo Electronico'  required value=".$row2[4]." />";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Telefono Casa u Oficina">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
                                <?php 
                                echo "<input name='telf1' type='text' id='telf1' class='form-control' placeholder='Telefono Casa'  value=".$row2[5]." />";
                                 ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group" title="Telefono Movil">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                                <?php 
                                echo "<input name=tlf2 type=text id=tlf2 class=form-control placeholder=Telefono Movil  required value=".$row2[6]." />";
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                        <label>Actual</label>
                            <div class="input-group" title='Curso'>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
                                <?php

                                $query2 = mysql_query("SELECT * FROM cursos WHERE id='".$row2[7]."'") or die(mysql_error());
                                $row3 = mysql_fetch_array($query2);
                                echo "<input type=text id=curso class=form-control placeholder=Curso  required value='".$row3[1]."' />";
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                        <label>Modificar por:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
                                <?php

                                $conn=mysqli_connect("localhost","root","","siga") ;
                                $consulta="select * from cursos";
                                $resultado=mysqli_query($conn,$consulta);
                                echo "<select class='form-control' name='curso' required>";
                                while($lista=mysqli_fetch_array($resultado))
                                echo "<option  value='".$lista["id"]."'>".$lista["nom_curso"]."</option>";
                                echo  "</select>";
                                ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <table width="100%">
                        <tr>
                            <td width="50%">
                                <button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                                  <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Actualizar
                                </button>
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <a href="javascript:;" onclick="aviso('eliminarest.php?cedula=<?php echo $cedula?>'); return false;" class="btn btn-danger btn-lg">
                                  <span class="glyphicon glyphicon-trash"></span> Eliminar 
                                </a>
                            </td>
                        </tr>
                    </table>
                    <br>
                    </form><?php
                    } else {
                              echo "<script>
                                      alert('El Estudiante de la Cedula de Identidad  ".$cedula."\\nNo existe debe registrarlo');
                                       document.location=('registro_est.php');
                                    </script>";
                            }
                    } else{ 
                    header("Location:inicio.php");

                       } ?>
                </div>
                     
              </div>
          </div>
      </div>
      </form>
      </div> 


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

