<?php
include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: index.php");
exit;
}
        $link = mysql_connect($dbhost, $dbusername, $dbuserpass);
        mysql_select_db($dbname,$link) or die('No se puede seleccionar la base de datos');
        if(isset($_GET['cedula']) && !empty($_GET['cedula'])){
            $cedula = htmlentities($_GET['cedula']);
        $query = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$cedula."'") or die(mysql_error());
        $row2 = mysql_fetch_array($query);
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

    	<form name="form1" method="post" action="insertar_est2.php">
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
                              ×</button>El Estudiante ya estaba Registrado Actualice e Inscriba en el Curso.
                        </div>

                        <h3 class="text-center">
                            Registro de Estudiantes</h3>
                        <form class="form form-signup" role="form" >
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <?php 
                                    echo "<input name='cedula' type='text' id='cedula' class='form-control' placeholder='Cedula Ejemplo: V-12345678'  required value=".$row2[0]." />";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <?php 
                                echo "<input name='name' type='text' id='name' class='form-control' placeholder='Nombre y Apellido'  required value='".$row2[1]."' >";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <?php 
                                echo "<input name='email' type='text' id='email' class='form-control' placeholder='Correo Electronico'  required value=".$row2[2]." />";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
                                <?php 
                                echo "<input name='telf1' type='text' id='telf1' class='form-control' placeholder='Telefono Casa'  required value=".$row2[3]." />";
                                 ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                                <?php 
                                echo "<input name=tlf2 type=text id=tlf2 class=form-control placeholder=Telefono Movil  required value=".$row2[4]." />";
                                ?>
                            </div>
                        </div>
                        <center><h3>Ingrese Pago de Pre-Inscripcion</h3></center>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                                <select class="form-control" name="banco" id="banco" required>
                                  <option value="Banesco">Banesco</option>
                                  <option value="Bicentenari BU">Bicentenari BU</option>
                                  <option value="Banco Industrial">Banco Industrial</option>
                                  <option value="Banco del Tesoro">Banco del Tesoro</option>
                                  <option value="Banco de Mercantil">Banco de Mercantil</option>
                                  <option value="Banco de Exterior">Banco de Exterior</option>
                                  <option value="BBVA Banco Provincial">BBVA Banco Provincial</option>
                                  <option value="BFC Banco Fondo Comun">BFC Banco Fondo Comun</option>
                                  <option value="BNC Banco Nacional de Credito">BNC Banco Nacional de Credito</option>
                                  <option value="BanFanb">BanFanb</option>
                                  <option value="Banco de Venezuela">Banco de Venezuela</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="bouche" type="text" id="bouche" class="form-control" placeholder="Ingrese Numero de Bouche o Deposito"  required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input name="monto" type="text" id="monto" class="form-control" placeholder="Monto de Inscripcion"  required/>
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                        <div class="form-group">
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
                    <button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                      <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Actualizar Datos Estudiante
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
  </body>
</html>

<?php   } ?>