<?php
include('config.php');
if($_SESSION["logeado"] == "SI"){
header ("Location: inicio.php");
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
    <meta name="description" content="">
    <meta name="author" content="">
    <title>.::SIGA - UPEL::.</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>
  <img src="images/banner.gif" width="100%" height="150px">
<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">
                        <img src="images/siga.jpg" width="50%" align="center"><br>
                        Sistema de Gestion Academica</h5>
                    <form class="form form-signup" role="form" method="post" action="entrar.php">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" name="username"  id="username" placeholder="Usuario" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary btn-block" name="Submit">
                    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Iniciar Sesion
                </button>
               <br>
               <p style="text-align:center;"><a href="registrarse.php">¿Nuevo Usuario? Registrate!</a><br>
               <a href="recuperar.php">¿Recuperar Contrase&ntildea?</a></p>
               </form>
            </div>
         <?php
if(isset($_GET['errorpass'])){ 
echo "
<div class='alert alert-danger-alt alert-dismissable'>
                <span class='glyphicon glyphicon-certificate'></span>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                    ×</button>Datos Incorrectos, Vuelva a intentarlo.</div>
"; 
}else{ 
echo ""; 
} 
?>
<?php
if(isset($_GET['nopass'])){ 
echo "
<div class='alert alert-danger-alt alert-dismissable'>
                <span class='glyphicon glyphicon-certificate'></span>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                    ×</button>No ha introducido una contraseña.</div>
"; 
}else{ 
echo ""; 
} 
?>
<?php
if(isset($_GET['logout'])){ 
echo "
<div class='alert alert-danger-alt alert-dismissable'>
                <span class='glyphicon glyphicon-certificate'></span>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                    ×</button>Ha cerrado sesion correctamente.</div>
"; 
}else{ 
echo ""; 
} 
?>
<?php
if(isset($_GET['success'])){ 
echo "
<div class='alert alert-success-alt alert-success'>
                <span class='glyphicon glyphicon-certificate'></span>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                    ×</button>Listo! Tu registro fue hecho satisfactoriamente.</div>
"; 
}else{ 
echo ""; 
} 
?>
        </div>
    </div>
</div>
</div> 

<div id="footer" align="center">
  <span class="copy-left">©</span> Copyleft UPEL<br> WebMasters: Rivas Luis, Bermudez Eleazar, Rojas Victor
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
