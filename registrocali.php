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
                            $ced = htmlentities($_POST['cedula']);

                            $cedula = $nacionalidad.$ced;

                            $query = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$cedula."'") or die(mysql_error());
                            //Verificamos que la Cedula Exista en la Base de Datos
                            if (mysql_num_rows($query)>0){

                              $row2 = mysql_fetch_array($query);
                            
                         ?>
      <form name="form1" method="post" action="insertar_notas.php">
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
                              ×</button>Ingrese Notas.
                        </div>

                        <h3 class="text-center">
                            Registro de Calificaciones</h3>
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
                            <div class="input-group" title="Nombre">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <?php 
                                echo "<input name='name' type='text' id='name' class='form-control' placeholder='Nombre y Apellido'  required value='".$row2[1]."' >";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Apellido">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <?php 
                                echo "<input name='lastaname' type='text' id='lastname' class='form-control' placeholder='Nombre y Apellido'  required value='".$row2[2]."' >";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Especialidad">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                                <?php 
                                echo "<input name='especialidad' type='text' id='name' class='form-control' placeholder='Especialidad'  required value='".$row2[3]."' >";
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
                                echo "<input name='telf1' type='text' id='telf1' class='form-control' placeholder='Telefono Casa'  value='".$row2[5]."' />";
                                 ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group" title="Telefono Movil">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                                <?php 
                                echo "<input name=tlf2 type=text id=tlf2 class=form-control placeholder=Telefono Movil  required value='".$row2[6]."' />";
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title='Curso'>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
                                <?php

                                $query2 = mysql_query("SELECT * FROM cursos WHERE id='".$row2[7]."'") or die(mysql_error());
                                $row3 = mysql_fetch_array($query2);
                                echo "<input name=curso type=text id=curso class=form-control placeholder=Curso  required value='".$row3[1]."' />";
                                echo "<input name=periodo type=hidden id=periodo class=form-control placeholder=Nota  required value='".$row3['periodo']."' />";
                                ?>
                            </div>
                        </div>
                        <center><h3>Ingrese la(s) Calificaci&oacuten(es)</h3></center>

                        <?php 
                        $cedula = $row2[0];

                         ?>
                        
                        <div class="form-group">

                            <div class="input-group form-control text-center" title="Ingrese la cuota a cancelar">
                                <div class='alert alert-danger-alt alert-dismissable' align='center'>
                                        <span class='glyphicon glyphicon-exclamation-sign'></span>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                                            ×</button>Las Notas no pueden ser Ceros, si los deja en blanco o coloca Cero (0) automaticamente se tomara como Cero (0), posteriormente podra actualizar teniendo los debidos soportes requeridos.</div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"> <b>Jornadas de Iniciaci&oacuten</b></span></span>
                                                <?php
                                                $notas = mysql_query("SELECT nota1 FROM notas WHERE cedula='".$cedula."'") or die(mysql_error()); 
                                                //Verificamos que la Cedula Exista en la Base de Datos
                                                if (mysql_num_rows($notas)>0){
                                                  $nota = mysql_fetch_array($notas);
                                                  echo "<input type='text' class=form-control placeholder=Nota  name='nota1'  value='".$nota['nota1']."' />";
                                                }else{
                                                    echo "<input name='nota1' type='text' id='nota1' class='form-control' placeholder='Nota'  pattern='[0-9]{2}'/>";
                                                }


                                                 ?>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"> <b>Estrat. y Medios Instruccionales</b></span></span>
                                               <?php 
                                               $notas3 = mysql_query("SELECT nota3 FROM notas WHERE cedula='".$cedula."'") or die(mysql_error());
                                                //Verificamos que la Cedula Exista en la Base de Datos
                                                if (mysql_num_rows($notas3)>0){
                                                  $nota3 = mysql_fetch_array($notas3);
                                                  echo "<input type='text' class=form-control placeholder=Nota  name='nota3'  value='".$nota3['nota3']."' />";
                                                }else{
                                                    echo "<input name='nota3' type='text' id='nota3' class='form-control' placeholder='Nota'  pattern='[0-9]{2}'/>";
                                                }


                                                 ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"> <b>Planif. Situac. Aprendiz.</b></span></span>
                                                <?php 
                                                $notas5 = mysql_query("SELECT nota5 FROM notas WHERE cedula='".$cedula."'") or die(mysql_error());
                                                //Verificamos que la Cedula Exista en la Base de Datos
                                                if (mysql_num_rows($notas5)>0){
                                                  $nota5 = mysql_fetch_array($notas5);
                                                  echo "<input type='text' class=form-control placeholder=Nota  name='nota5'  value='".$nota5['nota5']."' />";
                                                }else{
                                                    echo "<input name='nota5' type='text' id='nota5' class='form-control' placeholder='Nota'  pattern='[0-9]{2}'/>";
                                                }


                                                 ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"> <b>Ensayo Did&aacutectico</b></span></span>
                                                <?php 
                                                $notas7 = mysql_query("SELECT nota7 FROM notas WHERE cedula='".$cedula."'") or die(mysql_error());
                                                //Verificamos que la Cedula Exista en la Base de Datos
                                                if (mysql_num_rows($notas7)>0){
                                                  $nota7 = mysql_fetch_array($notas7);
                                                  echo "<input type='text' class=form-control placeholder=Nota  name='nota7'  value='".$nota7['nota7']."' />";
                                                }else{
                                                    echo "<input name='nota7' type='text' id='nota7' class='form-control' placeholder='Nota'  pattern='[0-9]{2}'/>";
                                                }


                                                 ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"> <b>&Eacutetica Profesional</b></span></span>
                                                <?php 
                                                $notas2 = mysql_query("SELECT nota2 FROM notas WHERE cedula='".$cedula."'") or die(mysql_error());
                                                //Verificamos que la Cedula Exista en la Base de Datos
                                                if (mysql_num_rows($notas2)>0){
                                                  $nota2 = mysql_fetch_array($notas2);
                                                  echo "<input type='text' class=form-control placeholder=Nota  name='nota2'  value='".$nota2['nota2']."' />";
                                                }else{
                                                    echo "<input name='nota2' type='text' id='nota2' class='form-control' placeholder='Nota'  pattern='[0-9]{2}'/>";
                                                }


                                                 ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"> <b>Teorias del Aprendizaje</b></span></span>
                                                <?php 
                                                $notas4 = mysql_query("SELECT nota4 FROM notas WHERE cedula='".$cedula."'") or die(mysql_error());
                                                //Verificamos que la Cedula Exista en la Base de Datos
                                                if (mysql_num_rows($notas4)>0){
                                                  $nota4 = mysql_fetch_array($notas4);
                                                  echo "<input type='text' class=form-control placeholder=Nota  name='nota4'  value='".$nota4['nota4']."' />";
                                                }else{
                                                    echo "<input name='nota4' type='text' id='nota4' class='form-control' placeholder='Nota'  pattern='[0-9]{2}'/>";
                                                }


                                                 ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"> <b>Evaluaci&oacuten de los Aprendizajes</b></span></span>
                                                <?php 
                                                $notas6 = mysql_query("SELECT nota6 FROM notas WHERE cedula='".$cedula."'") or die(mysql_error());
                                                //Verificamos que la Cedula Exista en la Base de Datos
                                                if (mysql_num_rows($notas6)>0){
                                                  $nota6 = mysql_fetch_array($notas6);
                                                  echo "<input type='text' class=form-control placeholder=Nota  name='nota6'  value='".$nota6['nota6']."' />";
                                                }else{
                                                    echo "<input name='nota6' type='text' id='nota6' class='form-control' placeholder='Nota'  pattern='[0-9]{2}'/>";
                                                }


                                                 ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"> <b>Promedio</b></span></span>
                                                <?php 
                                                $notas8 = mysql_query("SELECT * FROM notas WHERE cedula='".$cedula."'") or die(mysql_error());
                                                //Verificamos que la Cedula Exista en la Base de Datos
                                                if (mysql_num_rows($notas8)>0){
                                                  $nota8 = mysql_fetch_array($notas8);

                                                  $promedio = ($nota8['nota1']+$nota8['nota2']+$nota8['nota3']+$nota8['nota4']+$nota8['nota5']+$nota8['nota6']+$nota8['nota7'])/7;

                                                  echo "<b><input type='text' class=form-control placeholder=Nota   readonly value='".number_format($promedio,2,",",".")." Ptos' /><b>";
                                                }else{
                                                    echo "<input name='promedio' type='text' id='nota1' class='form-control' placeholder='Promedio'  readonly/>";
                                                }


                                                 ?>
                                            </div>
                                        </div>
                                    </div>
                                

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                      <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Registrar Notas
                    </button><br>
                    </form>
                    <?php
                    } else {
                              echo "<script>
                                      alert('El Estudiante de la Cedula de Identidad  ".$cedula."\\nNo existe debe registrarlo');
                                       document.location=('registro_est.php');
                                    </script>";
                            }
                    } else{ ?>

      <form name="form1" method="post" action="registrocali.php">
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
                              ×</button>Ingrese la Cedula del Estudiante para registrar Notas.
                        </div>

                        <h3 class="text-center">
                            Registro de Calificaciones</h3>
                        <form class="form form-signup" role="form" >
                        <div class="form-group">
                            <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <select class="form-control" name="nacionalidad" required>
                                        <option value="">Seleccione Nacionalidad</option>
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
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Estudiante
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
    <script type="text/javascript" src="js/funcion.js"></script>
  </body>
</html>

