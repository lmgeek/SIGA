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
    <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>
                        <?php 
                        if(isset($_POST['nacionalidad']) && !empty($_POST['nacionalidad']) &&
                          isset($_POST['cedula']) && !empty($_POST['cedula'])){
                            $nacionalidad = htmlentities($_POST['nacionalidad']);
                            $cedula1 = htmlentities($_POST['cedula']);
                            $cedula = $nacionalidad.$cedula1;

                            $consulta = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$cedula."'") or die(mysql_error());
                            $row = mysql_fetch_array($consulta);



                            //$query2 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota1'") or die(mysql_error());
                              //  $row3 = mysql_fetch_array($query2);



                            $preinscripcion = "Pre-Inscripcion";
                            $cuota1 = "Inscripcion y 1ra Cuota";
                            $cuota2 = "2da Cuota";
                            $cuota3 = "3ra Cuota";
                            $cuota4 = "4ta Cuota";

                            
                         ?>

        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-body" id="cuenta">
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
                        <center><img src="images/banner.png" width="900" ></center><br>
                        <h3 align="center">
                            Estados de Cuenta</h3>
                           
              <b>Fecha:</b>
                <?php
                // Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
                date_default_timezone_set('UTC');
                //Imprimimos la fecha actual dandole un formato
                echo date("d/m/Y");
                ?>  
                        <form class="form form-signup" role="form" ><br>
                        <table  width="100%" class="table table-bordered text-center" border="2">
                          <tr class="active" style="font-weight:bold;">
                            <td>Nombre y Apellido</td>
                            <td>C.I N°</td>
                            <td>Pre-Inscripci&oacuten</td>
                            <td>Inscripci&oacuten y 1ra Cuota</td>
                            <td>2da Cuota</td>
                            <td>3ra Cuota</td>
                            <td>4ta Cuota</td>
                            <td>Total</td>
                          </tr>
                          <tr align="center">
                            <td>
                              <?php 
                                echo "$row[1]";
                              ?>
                            </td>
                            <td>
                              <?php 
                                echo "$row[0]";
                              ?>
                            </td>
                            <td>
                              <?php 
                              $query = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$preinscripcion'") or die(mysql_error());
                                ;

                                if ($row2 = mysql_fetch_array($query)) {
                                  echo $row2[2]." Bs.";
                                }else {
                                  echo "<b><i>No Cancelado</b></i>";
                                }
                               ?>
                            </td>
                            <td>
                              <?php 
                              $query2 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota1'") or die(mysql_error());
                                ;
                                
                                if ($row3 = mysql_fetch_array($query2)) {
                                  echo $row3[2]." Bs.";
                                }else {
                                  echo "<b><i>No Cancelado</b></i>";
                                }
                               ?>
                            </td>
                            <td>
                              <?php 
                              $query3 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota2'") or die(mysql_error());
                                ;
                                
                                if ($row4 = mysql_fetch_array($query3)) {
                                  echo $row4[2]." Bs.";
                                }else {
                                  echo "<b><i>No Cancelado</b></i>";
                                }
                               ?>
                            </td>
                            <td>
                              <?php 
                              $query4 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota3'") or die(mysql_error());
                                ;
                                
                                if ($row5 = mysql_fetch_array($query4)) {
                                  echo $row5[2]." Bs.";
                                }else {
                                  echo "<b><i>No Cancelado</b></i>";
                                }
                               ?>
                            </td>
                            <td>
                              <?php 
                              $query5 = mysql_query("SELECT * FROM pagos WHERE cedula = '".$cedula."' AND tipo_cuota = '$cuota4'") or die(mysql_error());
                                ;
                                
                                if ($row6 = mysql_fetch_array($query5)) {
                                  echo $row6[2]." Bs.";
                                }else {
                                  echo "<b><i>No Cancelado</b></i>";
                                }
                               ?>
                            </td>
                            <td>
                              <?php 
                              $suma = $row2[2]+$row3[2]+$row4[2]+$row5[2]+$row6[2];

                              echo $suma." Bs.";
                               ?>
                            </td>
                            
                          </tr>
                        </table>
                        <br>
              
                        <br>
                    </form>

                    <center>
                      <button type="button" class="btn btn-danger btn-lg" onclick="javascript:imprSelec('cuenta');function imprSelec(cuenta)
{var ficha=document.getElementById(cuenta);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);
ventimp.document.close();ventimp.print();ventimp.close();};">
                        <span class="glyphicon glyphicon-print"></span> Imprimir Estado
                      </button>
                    </center>
</div>

                    <?php   } else{ ?>

      <form name="form1" method="post" action="estados_cuenta.php">
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
                              ×</button>Ingrese la Cedula del Estudiante .
                        </div>

                        <h3 class="text-center">
                            Estados de Cuenta</h3>
                        <form class="form form-signup" role="form" >
                   <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <select class="form-control" name="nacionalidad" required>
                                    <option value="" selected>Seleccione Nacionalidad</option>
                                    <option value="V-">Venezolano (a)</option>
                                    <option value="E-">Extranjero</option>
                                </select>
                                <input name="cedula" type="text" id="cedula" class="form-control" placeholder="Cedula Ejemplo: 12345678" pattern="^[0-9]{7,9}" title="Formato Correcto 12345678 o 9876543" required maxlength="8" />
                                <!--Mensaje de Ayuda en CSS3-->
                                <div class='form-tooltip'>Debe Seleccionar la Nacionalidad, Número de C&eacutedula sin puntos.<br> Solo se permiten n&uacutemeros</div>
                            </div>
                        </div>
                    
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Estado de Cuenta
                    </button><br>
                    </form>

                    <?php   } ?>
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
    <script type="text/javascript">
function imprSelec(cuenta){
  var ficha=document.getElementById(cuenta);
  var ventimp=window.open(' ','popimpr');
  ventimp.document.write(ficha.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
}
</script>
  </body>
</html>

