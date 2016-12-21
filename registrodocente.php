<?php
include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}
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

    	<form name="form1" method="post" action="insertar_docente.php">
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
                        <?php
                        if(isset($_GET['duplicado'])){ 
                        echo "
                        <div class='alert alert-success-alt alert-success' align='center'>
                                        <span class='glyphicon glyphicon-exclamation-sign'></span>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                                            ×</button>El Docente ya esta Registrado.</div>
                        "; 
                        }else{ 
                        echo ""; 
                        } 
                        ?>
                        <h3 class="text-center">
                            Registro de Docentes</h3>
                        <form class="form form-signup" role="form" >
                        <div class="form-group" title="Cedula del Docente o Facilitador">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <select class="form-control" name="nacionalidad" required>
                                    <option value="" selected>Seleccione Nacionalidad</option>
                                    <option value="V-">Venezolano (a)</option>
                                    <option value="E-">Extranjero</option>
                                </select>
                                <input name="cedula" type="text" id="cedula" class="form-control" placeholder="Cédula Ejemplo: 12345678" pattern="^[0-9]{7,9}" title="Formato Correcto 12345678 o 9876543" required maxlength="8" />
                                <!--Mensaje de Ayuda en CSS3-->
                                <div class='form-tooltip'>Debe Seleccionar la Nacionalidad, Número de C&eacutedula sin puntos.<br> Solo se permiten n&uacutemeros</div>
                            </div>
                        </div>
                        <div class="form-group" title="Nombre del Docente o Facilitador">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="name" type="text" id="name" class="form-control" placeholder="Nombre del Docente o Facilitador"  required pattern="[A-ZÑÁÉÍÓÚ\s]+" title="Solo puede contener caracteres Alfabeticos y no numericos y debe ser en MAYUSCULA no se permiten minusculas" />
                                <!--Mensaje de Ayuda en CSS3-->
                                <div class='form-tooltip'>Solo puede contener caracteres Alfabeticos y no numericos y debe ser en MAYUSCULA no se permiten minusculas</div>
                            </div>
                        </div>
                        <div class="form-group" title="Apellido del Docente o Facilitador">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="lastname" type="text" id="lastname" class="form-control" placeholder="Apellido del Docente o Facilitador"  required pattern="[A-ZÑÁÉÍÓÚ\s]+" title="Solo puede contener caracteres Alfabeticos y no numericos y debe ser en MAYUSCULA no se permiten minusculas" />
                                <!--Mensaje de Ayuda en CSS3-->
                                <div class='form-tooltip'>Solo puede contener caracteres Alfabeticos y no numericos y debe ser en MAYUSCULA no se permiten minusculas</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input name="email" type="text" id="email" class="form-control" placeholder="Correo Electrónico"  required title="Ingrese su Email o Correo Electrónico, debe contener el formato: nombrecorreo@correo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>
                                <!--Mensaje de Ayuda en CSS3-->
                                <div class='form-tooltip'>Ingrese su Email o Correo Electronico, debe contener el formato: nombrecorreo@correo.com</div>
                            </div>
                        </div>
                        <div class="form-group" title="Telefono Movil">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                                <input name="telf1" type="text" id="telf1" class="form-control" placeholder="Teléfono Casa"  required pattern="[0-9]{11}" maxlength="11" />
                                <!--Mensaje de Ayuda en CSS3-->
                                <div class='form-tooltip'>Ingrese el Telefono debe contener el formato: 02682576567</div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group" title="Especialidad">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                                <input name='especialidad' type='text' id='especialidad' class='form-control' placeholder='Especialidad'  required  pattern="[A-Za-z ]+" title="Solo puede contener caracteres Alfabeticos y no numericos">
                                <!--Mensaje de Ayuda en CSS3-->
                                <div class='form-tooltip'>Solo puede contener caracteres Alfabeticos y no numericos</div>
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                      <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Registrar Docente
                    </button>
                    
                    <button type="reset" class="btn btn-lg btn-danger btn-block">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Limpiar Campos
                    </button><br>
     </form>
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