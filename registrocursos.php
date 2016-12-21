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
    <script>
      function eliminar(uc){
              var mensaje = "ESTAS SEGURO QUE QUIERES ELIMINAR";
        if(confirm(mensaje)){
          window.location="eliminaruc.php?uc="+uc;
        }else{
        
        }
        
      }
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
                        if(isset($_POST['id']) && !empty($_POST['id'])){
                            $id_curso = htmlentities($_POST['id']);

                            $query = mysql_query("SELECT * FROM cursos WHERE id='".$id_curso."'") or die(mysql_error());
                            //Verificamos que la Cedula Exista en la Base de Datos
                            if (mysql_num_rows($query)>0){

                              $row2 = mysql_fetch_array($query);
                            
                         ?>
                         <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>
      <form name="form1" method="post" action="actualizar_curso.php">
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
                              ×</button>Ingrese los datos a Actualizar.
                        </div>

                        <h3 class="text-center">
                            Actualizacion de Cursos</h3>
                        <form class="form form-signup" role="form" >

                        <div class="form-group">
                        <label for="">Nombre del Curso</label>
                            <div class="input-group" title="Nombre del Curso">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                                <?php 
                                    echo "<input name='name' type='text' id='name' readonly class='form-control' placeholder='Nombre del Curso'  required value='".$row2[1]."'>";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="">Ubicacion</label>
                            <div class="input-group" title="Ubicacion">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span>
                                </span>
                                <?php 
                                    echo "<input name='ubicacion' type='text' id='ubicacion' class='form-control' placeholder='Unicacion'  required value='".$row2[6]."'>";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="">Nucleo</label>
                            <div class="input-group" title="Nucleo">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span>
                                </span>
                                <?php 
                                    echo "<input name='nucleo' type='text' id='nucleo' class='form-control' placeholder='Nucleo'  required value='".$row2[7]."'>";
                                 ?>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="">Facilitador</label>
                            <div class="input-group" title="Facilitador">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                </span>
        
                                <?php

                                $conn=mysqli_connect("localhost","root","","siga") ;
                                $consulta="select * from docentes";
                                $resultado=mysqli_query($conn,$consulta);
                                echo "<select class='form-control' name='facilitador' required>";
                                while($lista=mysqli_fetch_array($resultado))
                                echo "<option  value='".$lista["cedula"]."'>".$lista["nombre"]."</option>";
                                echo  "</select>";
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="">Fecha Anterior de Inicio</label>
                         <div style="color:red;"><i><?php 
                        $source = $row2[2];
                        $date = new DateTime($source);
                        echo $date->format('d-m-Y'); ?></i></div><br>
                        <label for="">Fecha Anterior de Culminaci&oacuten</label>
                        <div style="color:red;"><i><?php 
                        $source = $row2[3];
                        $date = new DateTime($source);
                        echo $date->format('d-m-Y'); ?></i></div>
                            <div class="input-group" title="Fecha de Inicio del Curso">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input type='text' class='form-control' name='f_inicio' id='fecha' readonly='readonly' size='12' placeholder='Fecha de Inicio del Curso (Formato Dia/Mes/Año)'/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group" title="Fecha de Culminacion del Curso">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input type='text' class='form-control' name='f_culminacion' id='fecha1' readonly='readonly' size='12' placeholder='Fecha de Culminacion del Curso (Formato Dia/Mes/Año)'/>
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
                                <input type='text' class='form-control' name='duracion' id='duracion'  size='12' placeholder='Ingrese la Duracion del Curso en Horas'/>
                            </div>
                        </div>
                        <table class="table" width="90%">
                          <tr>
                            <td></td>
                            <td><b>Nro</b></td>
                            <td><b>Unidad Curricular</b></td>
                          </tr>
                          <?php $contador = 0;
                             $sql = "SELECT * FROM unidad_curricular WHERE id_curso='".$id_curso."' ";
                             $rs  = mysql_query($sql,$link);
                             if(mysql_num_rows($rs) !=0 ){
                              while($row=mysql_fetch_assoc($rs)){
                                $contador = $contador + 1;   

                                $consulta2 = mysql_query("SELECT * FROM materias WHERE id='{$row['uc']}'",$link);
                                if(mysql_num_rows($consulta2) !=0 ){
                                  $rowz=mysql_fetch_assoc($consulta2);
                                }
                                echo '<td>';
                                echo ' <img src="images/borrado.gif" onclick="eliminar('.$row['uc'].')" width="20px" title="Click para Eliminar la Unidad Curricular del Curso"/>';
                                echo '</td>';
                                echo '<td>'.$contador.'</td>';
                                echo '<td>'.$rowz['nombre'].'</td>';                                
                                echo '</tr>';
                              }
                              echo '<tr>
                                  <td><br><br></td>
                                  </tr>';
                             }else{
                              echo '<tr><td colspan=7><center><h2>No Existe Unidad Curricular Registradas a Este Curso</h2></center></td></tr>';
                             }
                             ?>
                        </table>
        
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block" name="Submit">
                      <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Actualizar Curso
                    </button><br>
                    </form></div></div>
                    <?php
                    } else {
                              header("Location: inicio.php");
                            }
                    }    else {
                    header("Location: inicio.php"); } ?>
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

