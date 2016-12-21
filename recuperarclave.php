<!--Author: Anna Carolina Diaz Riera-->
<?php
$data_root = $_SERVER[DOCUMENT_ROOT];
$email=$_POST['email']; 
include ($data_root . "config.php");//Llamada de la BD
$res = mysql_query("SELECT * FROM usuarios WHERE email='$email'");

if (mysql_num_rows($res)==0) { 
 
 header("Location:registrarse.php"); 
} 
else { 
	
 
$res=mysql_query("SELECT * FROM usuarios WHERE email='$email'");
$row=mysql_fetch_assoc($res); 
$claveusuario=$row['password']; 

foreach ($_POST as $campo=>$str){
$valor_campo = strip_tags("$str");
$valor_campo = trim("$valor_campo");
$$campo =  $valor_campo ;
//echo "$campo<br>";
if ($valor_campo == ""){
$mensaje_error .= "El campo <b>$campo</b> es de uso obligatorio<br />";
$error = 1;
}
}

if (!empty($email)){
## advertir que 2,4 --> para aceptar nuevos dominios (.info, etc)
$control_mail="^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,4}$";
if(!eregi($control_mail,$email)){
$mensaje_error .= "La <b>sintáxis de tu email</b> no es válida<br />\n";
$error = 1;
}
}

if ($error == 1){
$salida_errores= <<< HTML
Se han producido los siguientes errores:<br /><br />
$mensaje_error
<br />

HTML;
echo $salida_errores;
exit;
}else{
	
$texto = strip_tags("$comentario");	
// enviamos el email de recuperacion 
$header = &#39;From: xxxxx@nombredominio.com&#39; ."\r\n";
$header .= &#39;Reply-to: noresponder@cross-home.com&#39; ."\r\n";
$header .= "X-Mailer:PHP" .phpversion ()."\r\n";
$header .= "Mime-Version:1.0 \r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

$asunto = "Recuperación de la Clave" ;
$contenido = "
Estimado(a) cliente $nombreusuario, su clave es: $claveusuario

Motivo de la recomendación
$texto

**********************************************************************

Porfavor no respondas este mensaje, si no conoces el origen.
La administración de www.nombredominio.com
";
$mail = mail($email,$asunto,$contenido,$header);
if($email){ 
echo "Gracias. $nombres";
}
else
{
echo "Error al envia. Podría haber problemas con el servidor, intente más tarde por favor";
 } 
  
 } 
}
?> 

<script type="text/javascript">
              location.href="http://www.nombredominio.com/registro2.php"; 
</script>