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
              <li class="active"><a href="inicio.php">Inicio</a></li>
              <li><a href="auditar.php">Manuales</a></li>
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

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      <!--Boton Volver atras-->
    <input type="button" style="cursor: pointer;" class="btn btn-danger" onclick="javascript:window.history.back();" value="REGRESAR" /> <br><br>
      
      
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

      <div class="row" style="margin-top:50px;" id="listado">
          <center>
            <img src="images/banner.png" alt="" width="1000" height="100">
          </center>
          <br><br>
            <h3 align="center"><b>LISTADO DE PARTICIPANTES INSCRITOS</b></h3>
            <br>
            <table class="table table-hover table-bordered" width="100%" border=".5">
              <tr>
                <td width="15%">PROGRAMA:</td>
                <td width="25%"><b>EXTENSION</b></td>
                <td width="25%">ENTIDAD ACADEMICA:</td>
                <td width="25%"></td>
              </tr>
              <tr>
                  <td>SUBPROGRAMA:</td>
                  <td colspan="3"><b><?php echo $curso['nom_curso']; ?></b></td>
              </tr>
              <tr>
                  <td>GRUPO:</td>
                  <td></td>
                  <td>LAPSO:</td>
                  <td><b><?php echo $periodo; ?></b></td>
              </tr>
            </table>
            <br>



            <table  width="100%" class="table table-striped table-hover table-bordered" border="1">
                <tr align="center" bgcolor="34,7,0,0">
                    <td>N°</td>
                    <td>NOMBRES Y APELLIDOS</td>
                    <td>C.I. N°</td>
                    <td>PERFIL PROFESIONAL<br>(ESPECIALIDAD)</td>
                    <td>OBSERVACIÓN</td>
                </tr>

            <?php 

            $contador = 0;
            $query = mysql_query("SELECT * FROM inscripcion WHERE periodo='".$periodo."'
                                  AND curso='".$curso1."'") or die(mysql_error());
            if (mysql_num_rows($query)>0){
              while($row=mysql_fetch_array($query)){
                $contador = $contador + 1;
                $cedula = $row['cedula'];

                $query2 = mysql_query("SELECT * FROM estudiantes WHERE cedula='".$row['cedula']."'") or die(mysql_error());
                if (mysql_num_rows($query2)>0){
                  $row2=mysql_fetch_array($query2);
                }
                  echo '<tr>';
                  echo '<td align=center>'.$contador.'</td>';
                  echo '<td align=center>'.$row2['nombre'].'</td>';
                  echo '<td align=center>'.$row['cedula'].'</td>';
                  echo '<td align=center>'.$row2['especialidad'].'</td>'; 
                  echo "<td align=center> </td>";
                  echo "</tr>";
              }
            }else{
              echo '<tr><td colspan=7><center>No Existe Registros</center></td></tr>';
             }



          //End issett No Borrar Luis

             ?>
                    
                      </table>
                    
                    <table width="100%">
                      <tr align="center">
                        <td width="50%">
                            <br>
                            ELABORADO POR: (FUNCIONARIO(A)<br>
                            ADMINISTRATIVO ADSCRITO A LA<br> 
                            COORDINACION LOCAL DE EXTENSION)
                        </td>
                        <td width="50%">
                          CONFORMADO POR: (COORDINADOR)A) LOCAL DE<br> EXTENSION)
                        </td>
                      </tr>
                      <tr align="center">
                        <td><br><br><br><br><br>FIRMA</td>
                        <td><br><br><br><br><br>FIRMA</td>
                      </tr>
                    </table>

            <div class="row text-center">
              <button type="button" class="btn btn-danger btn-lg" onclick="javascript:imprSelec('listado');function imprSelec(listado)
            {var ficha=document.getElementById(listado);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();ventimp.print();ventimp.close();};">
                        <span class="glyphicon glyphicon-print"></span> Imprimir Listado
                      </button>
            </div>
      </div>
<br><br><br><br><br><br>
      <?php 
      }else{ 
      ?>
      <form name="form1" method="post" action="participantes.php">
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

                $consulta="SELECT * FROM periodos";
                $resultado=mysqli_query($conn,$consulta);
                echo "<select class='form-control' name='periodo' required>";
                while($lista=mysqli_fetch_array($resultado))
                echo "<option  value='".$lista["periodo"]."'>".$lista["periodo"]."</option>";
                echo  "</select>";
                ?>
            </div>
                    </div>
                      <div class="col-lg-2" style="margin-top:15px;" >
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                          <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar
                        </button>
                      </div>
                    </div>
                            <br>
                    </form>

                    <?php 
      } 
      ?>
        



             
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
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funcion.js"></script>
  </body>
</html>