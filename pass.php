<?php
 include('config.php');
 $link = mysql_connect ($dbhost, $dbusername, $dbuserpass);
 mysql_select_db($dbname,$link);


?>
<!DOCTYPE html>
<html lang="es">
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

                    if(isset($_GET['id']) && !empty($_GET['id']) &&
				    isset($_GET['mail']) && !empty($_GET['mail'])){

						

						$id = htmlentities($_GET['id']);
						$mail = htmlentities($_GET['mail']);

						if(isset($_POST['button']) && !empty($_POST['button'])){
							$pass = md5($_POST['pass']);
							if($_POST['button']){
								if(isset($id) && isset($mail)){
									
									$queEmp = "SELECT * FROM usuarios WHERE email='$mail'";
									$resEmp = mysql_query($queEmp, $link) or die(mysql_error());
									$totEmp = mysql_num_rows($resEmp);
									if($totEmp == 0){
										echo "El mail ingresado no existe";
										exit();
									}
									
									$row = mysql_fetch_assoc($resEmp);
									$hash = md5(md5($row['username']).md5($row['password']));
									
									if($hash == $id){
										$sql = "UPDATE usuarios SET password='".$pass."' WHERE email='$mail'";
										mysql_query($sql,$link);
										echo "
											<div class='alert alert-success-alt alert-success text-center' style='font-size:1.5em;'>
												<span class='glyphicon glyphicon-certificate'></span>
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
												×</button>Listo! Tu Contrase&ntildea fue cambiado satisfactoriamente.</div>
											";
										echo "<a href='index.php' class='btn btn-lg btn-primary btn-block'>Iniciar Sesion</a>";
										exit();			
									}
								}
							}
						}
					?>
					<form class="form form-signup" role="form" id="form1" name="form1" method="post" action="pass.php?id=<?=$id?>&mail=<?=$mail?>">
					  <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" class="form-control" name="pass"  id="pass" placeholder="Nueva Clave" />
                        </div>
                    </div>
					  <br />
					  <br />
					  	<button type="submit" name="button" id="button" value="Guardar" class="btn btn-lg btn-primary btn-block" >
		                    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Guardar
		                </button>
					</form>

					<?php 
					} else {
						header ("Location: index.php");
					}
					?>
                    
                </div>
                
                <br>
   
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





