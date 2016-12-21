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
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
      $(document).ready(function () {
        var d = new Date();
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];
        today = monthNames[d.getMonth()] + ' ' + d.getDate() + ' ' + d.getFullYear();

        $('#to').attr('disabled', 'disabled');
        $('#from').datepicker({
            defaultDate: "+1d",
            minDate: 1,
            maxDate: "+3M",
            dateFormat: 'dd/mm/yy',
            showOtherMonths: true,
            changeMonth: true,
            selectOtherMonths: true,
            required: true,
            showOn: "focus",
            numberOfMonths: 1,
        });

        $('#from').change(function () {
            var from = $('#from').datepicker('getDate');
            var date_diff = Math.ceil((from.getTime() - Date.parse(today)) / 86400000);
            var maxDate_d = date_diff+180+'d';
            date_diff = date_diff + 'd';
            $('#to').val('').removeAttr('disabled').removeClass('hasDatepicker').datepicker({
                dateFormat: 'dd/mm/yy',
                minDate: date_diff,
                maxDate: maxDate_d
            });
        });

        $('#to').keyup(function () {
            $(this).val('');
            alert('Please select date from Calendar');
        });
        $('#from').keyup(function () {
            $('#from,#to').val('');
            $('#to').attr('disabled', 'disabled');
            alert('Please select date from Calendar');
        });

    });
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
                        if(isset($_GET['nuevocurso'])){ 
                        
                        ?>
               <form name="form2" method="post" action="insertar_curso.php">
        <div class="row">
        <!--Boton Volver atras-->
    <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                          <span class='glyphicon glyphicon-info-sign'></span>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                              ×</button>Ingrese los datos a Registrar.
                        </div>

                        <h3 class="text-center">
                            Registrar Nuevo Cursos</h3>

                        <div class="form-group">
                            <div class="input-group" title="Nombre del Curso">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                                <input name='name' type='text' id='name' class='form-control' placeholder='Nombre del Curso'  required >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Ubicacion">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span>
                                </span>
                                <input name='ubicacion' type='text' id='ubicacion' class='form-control' value='UPEL'  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Nucleo">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span>
                                </span>
                                <input name='nucleo' type='text' id='nucleo' class='form-control' placeholder='Nucleo'  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Facilitador">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                </span>
        
                                <?php

                                $conn=mysqli_connect("localhost","root","","siga") ;
                                $consulta="SELECT * FROM docentes ORDER BY nombre ASC";
                                $resultado=mysqli_query($conn,$consulta);
                                echo "<select class='form-control' name='facilitador' required>";
                                while($lista=mysqli_fetch_array($resultado))
                                echo "<option  value='".$lista["cedula"]."'>".$lista["nombre"]."</option>";
                                echo  "</select>";
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                        
                            <div class="input-group" title="Fecha de Inicio del Curso">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input type="text" id="from" class='form-control' name='f_inicio' readonly='readonly' size='12' placeholder='Fecha de Inicio del Curso (Formato Dia/Mes/Año)'/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group" title="Fecha de Culminacion del Curso">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input type="text" id="to" class='form-control' name='f_culminacion' readonly='readonly' size='12' placeholder='Fecha de Culminacion del Curso, Debe Seleccionar primero la Fecha de Inicio del Curso'/>
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group" title="Periodo">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              <input type="text" class="form-control" name="periodo" placeholder="Periodo (Debe agregar solamente el numero de periodo, el año se agregara automaticamente por defecto)" required size="1" maxlength="1"/>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" title="Duracion del Curso">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input type='text' class='form-control' name='duracion' id='duracion'  size='12' placeholder='Ingrese la Duración del Curso en Horas'/>
                            </div>
                        </div>
        
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                      <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Registrar Curso
                    </button><br>
                    </div>
                     
        </div>
    </div>
</div>
</form></div>

                        <?php 
                    }else if(isset($_GET['actualizarcurso'])){ 

                        ?>

                        <div class="row">
                  <!--Boton Volver atras-->
    <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>
                        <form name="form1" method="post" action="registrocursos.php">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                          <span class='glyphicon glyphicon-info-sign'></span>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                              ×</button>Seleccione el curso a Modificar
                        </div>

                        <h3 class="text-center">
                            Actualizaci&oacuten de Cursos</h3>
                        <form class="form form-signup" role="form" >
              
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
                                <?php

                                $conn=mysqli_connect("localhost","root","","siga") ;
                                $consulta="select * from cursos";
                                $resultado=mysqli_query($conn,$consulta);
                                echo "<select class='form-control' name='id' required>";
                                while($lista=mysqli_fetch_array($resultado))
                                echo "<option  value='".$lista["id"]."'>".$lista["nom_curso"]."</option>";
                                echo  "</select>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                      <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Siguitente
                    </button><br>
     </form>
                </div>
                     
        </div>
    </div>
</div>
</form>
                </div>

                <?php
                    
                      } else{ 
                        ?>
                        
                        <div class="row">
                        <!--Boton Volver atras-->
    <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">

                      <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                        <span class='glyphicon glyphicon-info-sign'></span>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                            ×</button>Registro y Activacion de Cursos.
                      </div>

                      <h3 class="text-center">
                          Seleccione la Opcion que desea realizar</h3>
                    </div>
                      <a href="cursos.php?nuevocurso" class="btn btn-lg btn-primary btn-block">
                      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                      Registrar Curso Nuevo</a>

                      <a href="cursos.php?actualizarcurso" class="btn btn-lg btn-primary btn-block">
                      <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                      Actualizar Curso</a>

                      <a href="registro_uc.php" class="btn btn-lg btn-success btn-block">
                      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                      Registrar Unidad Curricular a Curso</a>
                </div>
            </div>
            </div></div>

                        <?php  } ?>


        


  </div><!-- /container -->

  </div>
  
  <div id="footer" align="center">
  <span class="copy-left">©</span> Copyleft UPEL<br> WebMasters: Rivas Luis, Bermudez Eleazar, Rojas Victor
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funcion.js"></script>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/calendario.js"></script>
    <script type="text/javascript">
      $(function(){
        $("#fecha").datepicker();
        $("#fecha1").datepicker();
        $("#fecha2").datepicker({
          changeMonth:true,
          changeYear:true,
        });
        $("#fecha3").datepicker({
          changeMonth:true,
          changeYear:true,
          showOn: "button",
          buttonImage: "css/images/ico.png",
          buttonImageOnly: true,
          showButtonPanel: true,
        })
      })
    </script>

  </body>
</html>