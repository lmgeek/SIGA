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
    <style type="text/css">
    .text-rotation{
        display: block;
            -webkit-transform:rotate(-90deg);
            -moz-transform:rotare(-90deg);
        font-weight: bold;
        font-size:10px;
    }
    </style>
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
   <?php 
  /* $query = mysql_query("SELECT * FROM estudiantes") or die(mysql_error());
                            //Verificamos que la Cedula Exista en la Base de Datos
                            if (mysql_num_rows($query)>0){
                    $row = mysql_fetch_array($query);
}*/

                     ?>
      <?php
     
          if(isset($_POST['curso']) && !empty($_POST['curso']) &&
              isset($_POST['periodo']) && !empty($_POST['periodo'])){

              $curso1 = $_POST['curso'];
              $periodo = $_POST['periodo'];


              $consulta = mysql_query("SELECT * FROM cursos WHERE id = '{$curso1}'") or die(mysql_error());
                //Verificamos que existan valores
              if (mysql_num_rows($consulta)>0){
                $curso = mysql_fetch_array($consulta);
              }

              
      ?> 
        <div class="row" style="margin-top:5px;" id="listado">
        <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>

          <center>
            <img src="images/banner.png" alt="" width="1000" height="100">
          </center>
          
            <h4 align="left"><b>PROYECTO: CAPACITACI&OacuteN PEDAG&OacuteGICA PARA PROFESIONALES NO DOCENTES LAPSO <?php echo $periodo; ?>, <br>PERIODO DESDE: <?php echo $curso['F_inicio']."  HASTA: ".$curso['F_culmi']; ?><br><br></b></h4>
            <b>HORA: <?php  echo date("H:i:s a"); ?></b>

            <table width="100%" class=" table-striped table-hover " border="1">
                <tr style="font-weight: bold;" align="center">
                    <td rowspan="3">Nro.</td>
                    <td rowspan="3">CEDULA DE IDENTIDAD</td>
                    <td rowspan="3">APELLIDOS Y NOMBRES</td>
                    <td colspan="15" align="center">EXPERIENCIA DE APRENDIZAJE</td>
                </tr>
                <tr align="center">
                    <td colspan="2" height="100px"><div class="text-rotation">JORNADA DE INICIACION</div></td>
                    <td colspan="2"><div class="text-rotation">ETICA PROFESIONAL</div></td>
                    <td colspan="2"><div class="text-rotation">ESTRATEGIAS<br>Y MEDIOS<br>INSTRUCCIONALES</div></td>
                    <td colspan="2"><div class="text-rotation">TEORIAS DEL APRENDIZAJE</div></td>
                    <td colspan="2"><div class="text-rotation">PLANIF.<br>SITUAC.<br>APRENDIZ.</div></td>
                    <td colspan="2"><div class="text-rotation">EVALUACION<br>DE LOS<br>APRENDIZAJES</div></td>
                    <td colspan="2"><div class="text-rotation">ENSAYO DIDACTICO</div></td>
                    <td rowspan="2"><div class="text-rotation">PROMEDIO</div></td>
                </tr>
                <tr style="font-weight: bold;" align="center">
                    <td>HR</td>
                    <td>CAL</td>
                    <td>HR</td>
                    <td>CAL</td>
                    <td>HR</td>
                    <td>CAL</td>
                    <td>HR</td>
                    <td>CAL</td>
                    <td>HR</td>
                    <td>CAL</td>
                    <td>HR</td>
                    <td>CAL</td>
                    <td>HR</td>
                    <td>CAL</td>
                </tr>
            

                

<?php 
$contador = 0;
/*
"SELECT `estudiantes.cedula`, `estudiantes.nombre`, `notas.nota1`, `notas.nota2`, `notas.nota3`, `notas.nota4`, `notas.nota5`, `notas.nota6`, `notas.nota7` WHERE `estudiantes.cedula`=`notas.cedula`, `notas.curso`=`cursos.nom_curso`,`cursos.F_inicio`='{$desde}' AND `cursos.F_culmi`='{hasta}'";

"SELECT `estudiantes`.`cedula`, `estudiantes`.`nombre`, `notas`.`nota1`, `notas`.`nota2`, `notas`.`nota3`, `notas`.`nota4`, `notas`.`nota5`, `notas`.`nota6`, `notas`.`nota7` FROM `estudiantes`,`notas` WHERE `estudiantes`.`cedula`=`notas`.`cedula` AND `notas`.`curso`=`cursos`.`nom_curso` AND `cursos`.`F_inicio`='1015-10-26' AND `cursos`.`F_culmi`='2015-10-31'";

*/


$query = mysql_query("SELECT `estudiantes`.`cedula`, `estudiantes`.`nombre`, `estudiantes`.`apellido`, `notas`.`nota1`, `notas`.`nota2`, `notas`.`nota3`, `notas`.`nota4`, `notas`.`nota5`, `notas`.`nota6`, `notas`.`nota7` FROM `estudiantes`,`notas`, `cursos` WHERE `estudiantes`.`cedula`=`notas`.`cedula` AND`notas`.`curso`=`cursos`.`nom_curso`") or die(mysql_error());
                            //Verificamos que la Cedula Exista en la Base de Datos
                            if (mysql_num_rows($query)>0){
                    
                    while($row = mysql_fetch_array($query)){
        
                      $promedio = ($row['nota1']+$row['nota2']+$row['nota3']+$row['nota4']+$row['nota5']+$row['nota6']+$row['nota7'])/7;
                            $contador = $contador + 1;
                echo '<tr align="center">
                    <td><b>'.$contador.'</b></td>
                    <td>'.$row['cedula'].'</td>
                    <td>'.$row['apellido'].", ".$row['nombre'].'</td>

                    <td><b>6</b></td>

                    <td>'.$row['nota1'].'</td>
                    <td><b>18</b></td>

                    <td>'.$row['nota2'].'</td>
                    <td><b>24</b></td>

                    <td>'.$row['nota3'].'</td>
                    <td><b>24</b></td>

                    <td>'.$row['nota4'].'</td>
                    <td><b>24</b></td>

                    <td>'.$row['nota5'].'</td>
                    <td><b>24</b></td>

                    <td>'.$row['nota6'].'</td>
                    <td><b>40</b></td>

                    <td>'.$row['nota7'].'</td>
                    <td><b>'.number_format($promedio,2,",",".").'</b></td>
                </tr>';
                    }
}





 ?>

<tr align="center" style="font-weight: bold;">
    <td colspan="3">COORDINADOR DEL NUCLEO ACADEMICO FALCON</td>
    <td colspan="6">COORDINADOR LOCAL DE EXTENSION</td>
    <td colspan="10">COORDINADOR LOCAL DE CONTROL DE ESTUDIOS</td>
</tr>
<tr align="center" style="font-weight: bold;">
    <td colspan="3">Dr. VICTOR CAPIELO<br><br>_______________________________<br>FIRMA</td>
    <td colspan="6">PROF. JOS&Eacute A. MARTINEZ V.<br><br>_______________________________<br>FIRMA</td>
    <td colspan="10">PROF. FRANKLIN GARCIA (E)<br><br>_______________________________<br>FIRMA</td>
</tr>


</table>

            <br>
            <button type="button" class="btn btn-danger btn-lg" onclick="javascript:imprSelec('listado');function imprSelec(listado)
            {var ficha=document.getElementById(listado);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();ventimp.print();ventimp.close();};">
                        <span class="glyphicon glyphicon-print"></span> Imprimir Listado
                      </button>
                        


                                                 <?php
                    }else{ 
      ?>
      <form name="form1" method="post" action="calificaciones.php">
      <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                   
                        <div class='alert alert-success-alt alert-success text-center' style='font-size:2em;'>
                          <span class='glyphicon glyphicon-info-sign'></span>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true' tittle='Cerrar'>
                              ×</button>Seleccione el curso y el Periodo para ver Reporte.
                        </div>

                        <h3 class="text-center">
                            Listado de Participantes Inscritos</h3>
                        <form class="form form-signup" role="form" >
                    <div class="col-lg-6"  >
                        <label for="">Curso</label>
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
                    <div class="col-lg-3"  >
                        <label for="">Periodo</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
                            <?php

                            $consulta="select * from cursos";
                            $resultado=mysqli_query($conn,$consulta);
                            echo "<select class='form-control' name='periodo' required>";
                            while($lista=mysqli_fetch_array($resultado))
                            echo "<option  value='".$lista["periodo"]."'>".$lista["periodo"]."</option>";
                            echo  "</select>";
                            ?>
                        </div>
                    </div>
                    
                      <div class="col-md-2" style="margin-top:15px;" >
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                          <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar
                        </button>
                      </div>
                    </div>
                            <br>
                    </form><?php 
      } 
      ?>
        



             
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
    <script type="text/javascript" src="js/funcion.js"></script>
    <script type="text/javascript" src="js/funcion.js"></script>
  </body>
</html>

