<body style="background:#000;">
<?php
// Configura los datos de tu cuenta
include('config.php');

// Conectar a la base de datos
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die('No se puede seleccionar la base de datos');

if ($_POST['username']) {
//Comprobacion del envio del nombre de usuario y password
$username=htmlentities($_POST['username']);
$password=md5($_POST['password']);
if ($password==NULL) {
header ("Location: index.php?nopass");
exit();
}else{	
$query = mysql_query("SELECT username,password FROM usuarios WHERE username = '$username'") or die(mysql_error());
$data = mysql_fetch_array($query);
if($data['password'] != $password) {
//echo "No a introducido una contrasenia correcta";
header ("Location: index.php?errorpass");
exit();
}else{
$query = mysql_query("SELECT username,password FROM usuarios WHERE username = '$username'") or die(mysql_error());
$row = mysql_fetch_array($query);
$username2 = $row['username'];
$_SESSION["s_username"] = $row['username'];
$_SESSION["logeado"] = "SI";

/* Si aceptamos recordar los datos */
if($_POST['recordar']){

						if ($HTTP_X_FORWARDED_FOR == "")
					{
						$ip = getenv(REMOTE_ADDR);
					}
					else
					{
						$ip = getenv(HTTP_X_FORWARDED_FOR);
					}
	$id_extreme = md5(uniqid(rand(), true));
	$id_extreme2 = $username2."%".$id_extreme."%".$ip;
	setcookie('id_extreme', $id_extreme2, time()+7776000,'/');
	$query = mysql_query("UPDATE usuarios SET id_extreme='".$id_extreme."' WHERE username='".$username2."'") or die(mysql_error());
}

header ("Location: inicio.php");
}
}
}
?> 
</body>