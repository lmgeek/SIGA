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
              <li><a href="inicio.php">Inicio</a></li>
              <li class="active"><a href="auditar.php">Manuales</a></li>
              <li><a href="usuarios.php">Soporte</a></li>
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

<div class="jumbotron" >
	
	<div class="row">
		<!--<center>
		<div class="col-lg-3" style="margin:20px;">
			<form action="BD/respaldo.php">
				<button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                 	 <span lass="glyphicon glyphicon-search" aria-hidden="true"></span> Respaldar Base de Datos
             	</button>
			</form>
		</div>

		<div class="col-lg-3" style="margin:20px;">
			<form action="BD/restore.php">
				<button type="submit" class="btn btn-lg btn-primary btn-block btn-success" name="Submit">
                  	<span lass="glyphicon glyphicon-search" aria-hidden="true"></span> Restaurar Base de Datos
             	</button>
			</form>
		</div>
		</center>

		<div class="col-lg-3" style="margin:20px;">
			
				<button type="submit" onclick="myFunction()" class="btn btn-lg btn-primary btn-block btn-danger" name="Submit">
                  	<span lass="glyphicon glyphicon-search" aria-hidden="true"></span> Eliminar Base de Datos
             	</button>
			
		</div>
		</center>-->


    <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>


	</div>


		<div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                      <span class='glyphicon glyphicon-certificate'></span>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                ×</button>Ac&aacute podr&aacute visualizar el Manual de Sistema, el cual solo podr&aacute ser entendido por un Desarrollador, puesto que solo se nombra con palabras t&eacutecnicas lo que ocurre en todo el sistema.
       </div>

	<div style='text-align: left; border: none;'>    
		<object type='application/pdf' data="manual_sistema.pdf" width='1000' height='1100' id='pdf'> 
			<param name='src' value="manual_sistema.pdf" /> 
			<p style='text-align:center; width: 60%;'>Adobe Reader no se encuentra o la versi&oacute;n no es compatible, utiliza el icono para ir a la p&aacute;gina de descarga <br /> 
			<a href='http://get.adobe.com/es/reader/' onclick='this.target='_blank''>
			<img src='reader_icon_special.jpg' alt='Descargar Adobe Reader' width='32' height='32' style='border: none;' /></a> 
			</p> 
		</object> 
	</div>

</div>



<script>
function myFunction() {
    var r = confirm("¿Esta segudo que desea Eliminar la Base de Datos?");
    if (r == true) {
        window.location="BD/delete.php";
    } else {
        window.location="#";
    }
}
</script>


</div>


    </div> <!-- /container -->

    <br><br>
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