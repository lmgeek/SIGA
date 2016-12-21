<?php
include('config.php');
if($_SESSION["logeado"] == "SI"){
header ("Location: index.php");
exit;
}
 $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
 mysql_select_db($dbname,$link);


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
                    <h3 class="text-center">Recuperar Contrase&ntildea</h3>
                    <?php

                    if(isset($_POST['button']) && !empty($_POST['button'])){

						if($_POST['button']){
							if($_POST['mail']){
								
								$mail = htmlentities($_POST['mail']);
								
								$link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
						        mysql_select_db($dbname,$link);
								
								$queEmp = "SELECT * FROM usuarios WHERE email='$mail'";
								$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
								$totEmp = mysql_num_rows($resEmp);
								if($totEmp == 0){
									echo "El mail ingresado no existe";
									exit();
								}		
								
								$row = mysql_fetch_assoc($resEmp);
								$hash = md5(md5($row['username']).md5($row['password']));


//Recuperar Contrase&ntildea
								
								echo "<br>";

								echo "<a href='pass.php?id=".$hash."&mail=".$mail."' class='btn btn-lg btn-primary btn-block'>Recuperar Clave</a>";
												                 
												                
							}
						}
					} else {

                     ?>
                    <form class="form form-signup" role="form" id="form1" name="form1" method="post" action="recuperar.php">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="text" class="form-control" name="mail"  id="mail" placeholder="Correo Electronico" />
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" id="button" value="Recuperar Clave" class="btn btn-lg btn-primary btn-block" >
                    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Verificar Datos
                </button>
                <br>
                <?php 
					}
				?>
               </form>
            </div>

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


