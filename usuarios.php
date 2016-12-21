<?php
include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
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
  <style type="text/css">


     .media
    {
        /*box-shadow:0px 0px 4px -2px #000;*/
        margin: 20px 0;
        padding:30px;
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

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
<div class="row">


    <div class="col-lg-6" id="col5">
        <center><h3>Creadores</h3></center>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object dp img-circle" src="images/eleazar.jpg" style="width: 100px;height:100px;">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Bermudez Eleazar</h4>
                <h4 class="media-heading">C.I V.- 23.673.747<br>Email: <a href="mailto:eleazarjesus44@gmail.com">eleazarjesus44@gmail.com</a><br>Tel&eacutefono: 0424-6319224<small><br> Desarrollador</small></h4>
                <hr style="margin:8px auto">

                <span class="label label-default">HTML5/CSS3</span>
                <span class="label label-default">jQuery</span>
                <span class="label label-info">Php</span>
            </div>
        </div>

        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object dp img-circle" src="images/luis.jpg" style="width: 100px;height:100px;">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Rivas Luis </h4>
                <h4 class="media-heading">C.I V.- 24.788.519<br>Email: <a href="mailto:ljrp993@gmail.com">ljrp993@gmail.com</a><br>Tel&eacutefono: 0414-6618654<small><br> Desarrollador</small></h4>
                <hr style="margin:8px auto">

                <span class="label label-default">HTML5/CSS3</span>
                <span class="label label-default">jQuery</span>
                <span class="label label-info">Php</span>
            </div>
        </div>

        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object dp img-circle" src="images/victor.jpg" style="width: 100px;height:100px;">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Rojas Victor</h4>
                <h4 class="media-heading">C.I V.- 24.581.825<br>Email: <a href="mailto:victorrojas5557@gmail.com">victorrojas5557@gmail.com</a><br>Tel&eacutefono: 0414-0603782<small><br> Desarrollador</small></h4>
                <hr style="margin:8px auto">

                <span class="label label-default">HTML5/CSS3</span>
                <span class="label label-default">jQuery</span>
                <span class="label label-info">Php</span>
            </div>
        </div>

    </div>
    <div class="col-lg-5" id="col5" style="margin-left: 50px;">
        <center><h3>Tutores</h3></center>
        <div class="media">

            <div class="media-body text-center">
                <h4 class="media-heading">Lcda. Yenifer Medina </h4>
                <hr style="margin:8px auto"><small><br> Tutora Guia</small></h4>
            </div>
        </div>
        <div class="media">

            <div class="media-body text-center">
                <h4 class="media-heading">Ing. Esmeralda Ayala </h4>
                <hr style="margin:8px auto"><small><br> Tutora</small></h4>

            </div>
        </div>
<img src="images/logo-pnfi.jpg" width="100%"><br><br>
            <img src="images/logo-uptag.png" width="100%" style="margin-bottom: 9px;">

    </div>
</div>
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