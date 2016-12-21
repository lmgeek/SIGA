<?php
session_start();
include('../conexion.php');
$entro=isset($_SESSION['usuario']) ? $_SESSION['usuario']:NULL;
if($entro=='')
{ 
    ?>
    <script type="text/javascript">
      alert('Por favor incie sesion');
      location.href='../index.php';
    </script>
    <?php
}
?>
<script language="JavaScript" type="text/javascript">
 <!--

function show5(){
if (!document.layers&&!document.all&&!document.getElementById)
return

 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()

var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12

 if (minutes<=9)
 minutes="0"+minutes
 if (seconds<=9)
 seconds="0"+seconds

myclock="<font size='5' face='Arial' ><b><font size='1'></font></br>"+hours+":"+minutes+":"
 +seconds+" "+dn+"</b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
document.getElementById("liveclock").innerHTML=myclock
setTimeout("show5()",1000)
 }


window.onload=show5
 //-->
 </script>

</head>

<body class="thrColLiqHdr" >

<div id="container" >
<div id="header">
  <div id="sidebar2" >
     <div align="center">    



<table width="200" border="0" align="right">
  <tr>
    <td align="right"></td>
    </tr>
  <tr>
    <td align="right"> <span id="liveclock"> </span></td>
    </tr>
</table>

 </div>
  </div>
  
  <div align="center"></div>
  <div id="mainContent"> 

      <div align="center">
        <?php
    if (!isset ($_FILES["ficheroDeCopia"])){ 
	  $contenidoDeFormulario="  <form action='restaurar.php' method='post' enctype='multipart/form-data' name='formularioDeRestauracion'";
	  $contenidoDeFormulario.="id='formularioDeRestauracion'>\n";
      $contenidoDeFormulario.="    <table width='600' border='0' class=''>\n";
      $contenidoDeFormulario.="      <tbody class=''>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td height='40' colspan='4' class=''><h2>Restauraci&oacute;n de la Base de Datos de la Biblioteca</h2> </td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td width='82' class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td colspan='2' class=''>Indique el origen del archivo de copia: </td>\n";
      $contenidoDeFormulario.="          <td width='60' class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td colspan='2' class=''><input type='file' name='ficheroDeCopia' id='ficheroDeCopia'";
      $contenidoDeFormulario.="size='50'></td>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td colspan='2' class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="        <tr>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="          <td width='204' align='center' class=''><input name='envio' type='submit' ";
      $contenidoDeFormulario.="id='envio' value='Aceptar'></td>\n";
      $contenidoDeFormulario.="          <td width='226' align='center' class=''><input name='regreso' type='button' ";
	  $contenidoDeFormulario.="onClick='javascript:botonCancelar();'";
      $contenidoDeFormulario.="id='regreso' value='Cancelar'></td>\n";
      $contenidoDeFormulario.="          <td class=''>&nbsp;</td>\n";
      $contenidoDeFormulario.="        </tr>\n";
      $contenidoDeFormulario.="      </tbody>\n";
      $contenidoDeFormulario.="    </table>\n";
      $contenidoDeFormulario.="  </form>\n";

      echo ($contenidoDeFormulario);
    } else {

      $archivoRecibido=$_FILES["ficheroDeCopia"][tmp_name];
      $destino="./ficheroParaRestaurar.sql";
	  if (!@move_uploaded_file ($archivoRecibido, $destino)){
        die ("EL PROCESO HA FALLADO. INTENTELO DE NUEVO. <br><br><br><br><br><br>
          <a href='restaurar.php'><img src='img/FLECHA.png' width='20%'></a>" );
    
	 ?>
   <img src="img/FLECHA.png">

<script>
alert (' "EL PROCESO HA FALLADO. INTENTELO DE NUEVO."....');
window.location='restaurar.php'
</script>
<?
	 }


      $usuario = "root";
      $clave = "";
      $servidor = "localhost";
      $baseDeDatos = "inventario";

      $conexion = mysql_connect($servidor,$usuario,$clave) or die(mysql_error());
      @mysql_select_db($baseDeDatos,$conexion);


      $manejadorDeFichero=fopen ("ficheroParaRestaurar.sql", "r");

      $consultaSQL="";
      while (!feof($manejadorDeFichero)){
        $lectura=fgets($manejadorDeFichero);

        if (substr ($lectura,0,2)=="# " || $lectura=="\n") continue;
		$longitudLeida=strlen ($lectura)-1;
      $lectura=chop($lectura);

        $consultaSQL.=$lectura;
        if (substr($lectura, $longitudLeida-2, 1)==";" || substr($lectura, $longitudLeida-1, 1)==";"){
         mysql_query($consultaSQL,$conexion);
          if (mysql_errno()!=0){ 
            $mensajeDeError="SE HA PRODUCIDO EL ERROR SIGUIENTE<br>";
            $mensajeDeError.=mysql_errno()."***".mysql_error()."<br>";
            $mensajeDeError.="NO SE HA PODIDO COMPLETAR LA OPERACIÓN.";
            die ($mensajeDeError);
          }
          $consultaSQL="";
        }
      }
      fclose ($manejadorDeFichero); 
	  unlink ("ficheroParaRestaurar.sql");
    
	 ?>

<script>
alert (' "EL PROCESO HA FINALIZADO EXITOSAMENTE"....');
window.location='restaurar.php'
</script>
<?
	}
  ?>
    </div>
</div>
    <!-- Este elemento de eliminacion siempre debe ir inmediatamente despuÃ©s del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />

<!-- end #container --></div>
</body>
</html>