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
<!--
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">-->

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
       .media
    {
        /*box-shadow:0px 0px 4px -2px #000;*/
        margin: .5px 0;
    }
    .dp
    {
        border:10px solid #eee;
        transition: all 0.2s ease-in-out;
    }
    .dp:hover
    {
        border:2px solid #eee;
        transform:rotate(360deg);
        -ms-transform:rotate(360deg);  
        -webkit-transform:rotate(360deg);  
        /*-webkit-font-smoothing:antialiased;*/
    }
    </style>
  </head>
  <body>
    <br>
        <div class="container">

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
              <li><a href="usuarios.php">Soporte</a></li>
 <!--             <li><i class="fa fa-creative-commons"></i></li>-->
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

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      <?php
      if(isset($_GET['success'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! El Estudiante ha sido Registrado satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>
      <?php
      if(isset($_GET['successpago'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! Pago Registrado satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>
      <?php
      if(isset($_GET['successcurso'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! Curso Actualizado satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>
      <?php
      if(isset($_GET['successcursos'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! Curso Registrado satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>
      <?php
      if(isset($_GET['successdocente'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! Docente Registrado satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>
      <?php
      if(isset($_GET['successnota'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! Nota(s) Registrada(s) satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>
      <?php
      if(isset($_GET['successperiodo'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! Periodo Acad&eacutemico Registrado satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>
      <?php
      if(isset($_GET['successdelete'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! El Estudiante se ha Eliminado satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>
      <?php
      if(isset($_GET['successuc'])){ 
      echo "
      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                          ×</button>Listo! La Unidad Curricular se registro al curso satisfactoriamente.</div>
      "; 
      }else{ 
      echo ""; 
      } 
      ?>

        <center><h1>Sistema de Gesti&oacuten Acad&eacutemica</h1></center>
        <div class="row" style="margin-left:150px;">
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="registro_est.php">
                      <img class="media-object dp img-circle" src="images/perfil_egresado.png" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:30px;">
                      <center><h4 class="media-heading">Registrar Estudiante </h4></center>
                  </div>
            </div>
          </div>
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="listar.php">
                      <img class="media-object dp img-circle" src="images/listar.png" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:30px;">
                      <center><h4 class="media-heading">Listar Estudiantes</h4></center>
                  </div>
            </div>
          </div>
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="editar.php">
                      <img class="media-object dp img-circle" src="images/editar.png" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:30px;">
                      <center><h4 class="media-heading">Editar Estudiante </h4></center>
                  </div>
            </div>
          </div>
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="insertar_periodo.php">
                      <img class="media-object dp img-circle" src="images/periodo.png" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:30px;">
                      <center><h4 class="media-heading">Registrar Periodo Acad&eacutemico </h4></center>
                  </div>
            </div>
          </div>
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="registropago.php">
                      <img class="media-object dp img-circle" src="images/caja.jpg" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:30px;">
                      <center><h4 class="media-heading">Registrar Pago </h4></center>
                  </div>
            </div>
          </div>
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="registrocali.php">
                      <img class="media-object dp img-circle" src="images/calificaciones.jpg" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:30px;">
                      <center><h4 class="media-heading">Registro de Calificaciones </h4></center>
                  </div>
            </div>
          </div>
        

        <div class="row" style="margin-left:150px;">
          
          </div>
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="cursos.php">
                      <img class="media-object dp img-circle" src="images/Cursos.jpg" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:40px;">
                      <center><h4 class="media-heading">Registrar Cursos </h4></center>
                  </div>
            </div>
        </div>
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="registrodocente.php">
                      <img class="media-object dp img-circle" src="images/docentes.jpg" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:40px;">
                      <center><h4 class="media-heading">Registrar Docentes</h4></center>
                  </div>
            </div>
          </div>
          <div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="reportes.php">
                      <img class="media-object dp img-circle" src="images/siga.jpg" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:30px;">
                      <center><h4 class="media-heading">Reportes </h4></center>
                  </div>
            </div>
          </div>
          <!--<div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="certificados.php">
                      <img class="media-object dp img-circle" src="images/certificado.jpg" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:40px;">
                      <center><h4 class="media-heading">Certificados </h4></center>
                  </div>
            </div>
          </div>-->
          
          
        </div>

        <div class="row" style="margin-left:150px;">
          
          
          <!--<div class="col-lg-3" id="col3" >
            <div class="media">
                  <a class="pull-left" href="manual.php">
                      <img class="media-object dp img-circle" src="images/siga.jpg" style="width: 100px;height:100px;">
                  </a>
                  <div class="media-body" style="margin-top:30px;">
                      <center><h4 class="media-heading">Manual de Usuario </h4></center>
                  </div>
            </div>
          </div>

        </div>-->


      </div>

    </div> <!-- /container -->
<div id="footer" align="center">
  <span class="copy-left">©</span> Copyleft UPEL<br> WebMasters: Rivas Luis, Bermudez Eleazar, Rojas Victor
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funcion.js"></script>
  </body>
</html>