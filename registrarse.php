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

  <body>
  <img src="images/banner.gif" width="100%" height="150px">
    <br>
    <div class="container" style="padding-top: 50px;">
    <div class="container">
    	<form name="form1" method="post" action="insertar.php">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <?php
if(isset($_GET['success'])){ 
echo "
<div class='alert alert-success-alt alert-success' align='center'>
                <span class='glyphicon glyphicon-certificate'></span>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                    ×</button>Listo! Tu registro fue hecho satisfactoriamente.</div>
"; 
}else{ 
echo ""; 
} 
?>
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
                        <h5 class="text-center">
                            Registro de Usuarios</h5>
                        <form class="form form-signup" role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="cedula" type="text" id="cedula" class="form-control" placeholder="Cedula Ejemplo: V-12345678" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="name" type="text" id="name" class="form-control" placeholder="Nombre y Apellido" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input name="email" type="text" id="email" class="form-control" placeholder="Correo Electronico" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="username" type="text" id="username" class="form-control" placeholder="Usuario" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="password" type="password" id="password" class="form-control" placeholder="Contraseña" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="pregunta1" type="text" id="pregunta1" class="form-control" placeholder="Pregunta Secreta 1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="resp1" type="text" id="resp1" class="form-control" placeholder="Respuesta Secreta 1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="pregunta2" type="text" id="pregunta2" class="form-control" placeholder="Pregunta Secreta 2" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="resp2" type="text" id="resp2" class="form-control" placeholder="Respuesta Secreta 2" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-block" name="Submit">
                      <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Registrar
                    </button>
                    
                    <button type="reset" class="btn btn-sm btn-danger btn-block">
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

    </div> <!-- /container -->

    <div id="footer" align="center">
  <span class="copy-left">©</span> Copyleft UPEL<br> WebMasters: Rivas Luis, Bermudez Eleazar, Rojas Victor
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>