<?php
/*

Se otorga el permiso para copiar, distribuir, y/o modificar este programa bajo los términos 
de la Licencia GNU de Documentación Libre (GFDL, GNU Free Documentation License) versión 2 
o posteriores publicadas por la Fundación Software Libre (FSF, Free Software Foundation).

Según esta licencia, cualquier trabajo derivado de esta documentación deberá ser notificado 
al autor, aunque la voluntad del mismo es otorgar la máxima libertad posible. 

Este programa se distribuye con la intención de ser útil, pero SIN NINGUNA GARANTÍA; incluso 
sin la garantía implícita de USABILIDAD o UTILIDAD PARA UN FIN PARTICULAR. Vea la Licencia 
Pública General GNU para más detalles.

Soporte y Updaters: http://insidephp.sytes.net
email: insidephp@gmail.com
*/
//------------------------------------------------------------------------------------------
//  Definiciones


	//  Conexión con la Base de Datos.
	
	$db_server			= "localhost"; 
	$db_name			= "gustics"; 
	$db_username		= "root"; 
	$db_password		= ""; 


	//  Acceso al script.
	
	$auth_user			= "admin";
	$auth_password 	= "123";


	//  Nombre del archivo.


	$filename 			= "gustics.sql";

//------------------------------------------------------------------------------------------
//  No tocar
	error_reporting( E_ALL & ~E_NOTICE );
	define( 'Str_VERS', "1.1.1" );
//------------------------------------------------------------------------------------------
?>
<?php 
	// Check to see if $PHP_AUTH_USER already contains info
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
		// If empty, send header causing dialog box to appear
		header('WWW-Authenticate: Basic realm="Acceso al Restore la Base de Datos"');
		header('HTTP/1.0 401 Unauthorized');
    // Defines the charset to be used
    header('Content-Type: text/html; charset=iso-8859-1');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Acceso Denegado</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
 </HEAD>
<BODY 
	bgcolor="#D5D5D5" 
	text="#000000" 
	id="all" 
	leftmargin="25" 
	topmargin="25" 
	marginwidth="25" 
	marginheight="25" 
	link="#000020" 
	vlink="#000020" 
	alink="#000020">
	<center><h1>Restore la Base de Datos</h1></center><br>
	<strong><center><p>Usuario/contraseña equivocado. Acceso denegado.</p></center>
<?php
		echo( "</strong><br><br><hr><center><small>" );
		setlocale( LC_TIME,"spanish" );
		echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
		echo( "vers." . Str_VERS . "<br>" );
		echo( "</small></center>" );
		echo( "</BODY>" );
		echo( "</HTML>" );
    exit();
	}
	else {
		if (($_SERVER['PHP_AUTH_USER'] != $auth_user ) || ($_SERVER['PHP_AUTH_PW'] != $auth_password )) {
			header('WWW-Authenticate: Basic realm="Acceso al Restore la Base de Datos"');
			header('HTTP/1.0 401 Unauthorized');
    	// Defines the charset to be used
    	header('Content-Type: text/html; charset=iso-8859-1');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Acceso Denegado</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
 </HEAD>
<BODY 
	bgcolor="#D5D5D5" 
	text="#000000" 
	id="all" 
	leftmargin="25" 
	topmargin="25" 
	marginwidth="25" 
	marginheight="25" 
	link="#000020" 
	vlink="#000020" 
	alink="#000020">
	<center><h1>Restore la Base de Datos</h1></center><br>
	<strong><center><p>Usuario/contraseña equivocado. Acceso denegado.</p></center>
<?php

			echo( "</strong><br><br><hr><center><small>" );
			setlocale( LC_TIME,"spanish" );
			echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
			echo( "vers." . Str_VERS . "<br>" );
			echo( "</small></center>" );
			echo( "</BODY>" );
			echo( "</HTML>" );
    	exit();
		}
		else {
///////  El área protegida empieza DESPUÉS de la SIGUIENTE línea  /////
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Restore la Base de Datos</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
 	<script type="text/javascript" src="/nuevo/site_media/js/jquery.min.js"></script>
<style>
#evo
{
-webkit-border-top-left-radius: 40px;
-webkit-border-bottom-left-radius: 40px;
-moz-border-radius-topleft: 40px;
-moz-border-radius-bottomleft: 40px;
border-top-left-radius: 40px;
border-bottom-left-radius: 40px;
border:1px solid;
background:silver;
padding:3em;
width:470px;
-webkit-transition: all ease;
-moz-transition: all ease;
-ms-transition: all ease;
-o-transition: all ease;
transition: all ease;
	}

#cont
{
box-shadow: 10px 10px 5px #888888; text-align:left; border:1px solid; width:500px; padding:2em; margin-bottom:2em;  -moz-border-radius:5px; background: rgb(226,226,226); /* Old browsers */
background: -moz-linear-gradient(top, rgba(226,226,226,1) 0%, rgba(219,219,219,1) 50%, rgba(209,209,209,1) 51%, rgba(254,254,254,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(226,226,226,1)), color-stop(50%,rgba(219,219,219,1)), color-stop(51%,rgba(209,209,209,1)), color-stop(100%,rgba(254,254,254,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
font-size:16;
transition: all 2s;
padding:1em;
-webkit-transition: all 2s; /* Safari */
-moz-transition: all 2s; /* mozilla*/
-o-transition: all 2s; /* opera */
}
#cont2 {text-align:left; box-shadow: 10px 10px 5px #888888; display:none; border:1px solid; width:500px; padding:2em; -moz-border-radius:5px; background: rgb(226,226,226); /* Old browsers */
background: -moz-linear-gradient(top, rgba(226,226,226,1) 0%, rgba(219,219,219,1) 50%, rgba(209,209,209,1) 51%, rgba(254,254,254,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(226,226,226,1)), color-stop(50%,rgba(219,219,219,1)), color-stop(51%,rgba(209,209,209,1)), color-stop(100%,rgba(254,254,254,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
font-size:16;

transition: all 2s;
padding:1em;
-webkit-transition: all 2s; /* Safari */
-moz-transition: all 2s; /* mozilla*/
-o-transition: all 2s; /* opera */
}

#cont2:hover, #cont:hover  
{	
padding:3em;
font-size:20;
	}
	

</style>

 
 </HEAD>
<BODY 
	bgcolor="#D5D5D5" 
	text="#000000" 
	id="all" 
	leftmargin="25" 
	topmargin="25" 
	marginwidth="25" 
	marginheight="25" 
	link="#000020" 
	vlink="#000020" 
	alink="#000020">
	<center><h1>Restore la Base de Datos</h1></center><br>
	<strong>
<?php

				echo "<center><div id='evo'><div id='cont'>";

	@set_time_limit( 0 );

	echo( "- Base de Datos: '$db_name' en '$db_server'.<br>" );
	$error = false;

	if ( !@function_exists( 'gzopen' ) ) {
		$hay_Zlib = true;
		echo( "- Tome en cuenta que el BackUp a Usar debe ir en la ruta segura con el siguiente nombre: '$filename'<br>" );
	}
	else {
		$hay_Zlib = true;
		$filename = $filename;
		echo( "- Ya que está disponible Zlib, usaré el BackUp de la Base de Datos: '$filename'<br>" );
	}

	if( !$file = @fopen( $filename,"r" ) ) { 
	    echo ("<br>- Lo siento, no encuentro o no puedo abrir: '$filename'.<br>");
	    $error = true;
	}
	else { 
	    if( fseek($file, 0, SEEK_END)==0 )
	        $filesize_comprimido = ftell( $file );
	    else { 
	       echo ("<br>- Lo siento, no puedo obtener las dimensiones de '$filename'.<br>");
	       $error = true;
	    }
	 	  fclose( $file );
	}

	if ( !$error ) {
		if( $hay_Zlib ) {
			if ( !$file = @gzopen( $filename, "rb" ) ) { 
				echo( "<br>- Lo siento, no encuentro o no puedo abrir: '$filename'.<br>" );
				$error = true;
			}
			else {
				gzrewind( $file );
			}
		}
		else {
			if ( !$file = @fopen( $filename, "rb" ) ) { 
				echo( "<br>- Lo siento, no encuentro o no puedo abrir: '$filename'.<br>" );
				$error = true;
			}
			else {
				rewind( $file );
			}
		}
	}

	if (!$error) { 
	    $dbconnection = @mysql_connect( $db_server, $db_username, $db_password ); 

	    if ($dbconnection) 
	        $db = mysql_select_db( $db_name );
	    if ( !$dbconnection || !$db ) { 
	        echo( "<br>" );
	        echo( "- Lo siento, la conexion con la Base de datos ha fallado: ".mysql_error()."<br>" );
	        $error = true;
	    }
	    else {
	        echo( "<br>" );
	        echo( "- Conexion con Base de datos Exitosa se a Realizado Restauracion de la BD.<br>" );
	    }
	}

	if (!$error) { 
		$resul =  "show tables from ".$db_name ;
		$result= mysql_query($resul);
			if (!$result || $result=='Resource id #8') {
					print "<br>- Error, no puedo obtener la lista de las tablas.<br>";
					print '<br>- MySQL Error: ' . mysql_error(). '<br>';
					$error = true;
			}
	}

	if( !$error ) { 
	    $query = "";
	    $last_query = "";
	    $total_queries = 0;
	    $total_lineas = 0;
	
			$t_start = time();

			while( 1 ) {
				if( $hay_Zlib )
					$seacabo = gzeof( $file ) OR $error;
				else
					$seacabo = feof( $file ) OR $error;
				if( $seacabo )
					break;
				if( $hay_Zlib )
					$statement = gzgets( $file );
				else
					$statement = fgets( $file );
					
	        $statement = trim( $statement );
	        $total_lineas++;
	        // no se procesan comentarios ni lineas en blanco
	        if ( $statement=="--" || $statement=="" || strpos ($statement, "#") === 0) { 
	            continue;
	        }
	        // pasa a query
	        $query .= $statement;
	        // ejecuta query si esta completo
	        if( @ereg( ";$", $statement ) ) { 
	            if ( !mysql_query( $query, $dbconnection) ) { 
	                echo(" <br>" );
	                echo("- Error en statement: $statement<br>" );
	                echo("- Query: $query<br>");
	                echo("- MySQL: ".mysql_error()."<br>" );
	                $error = true;
	                break;
	            }
	            $last_query = $query;
	            $query = "";
	            $total_queries++;
	        }
	    }

			if( $hay_Zlib )
				$file_offset = gztell($file);
	    else
	    	$file_offset = ftell($file);
		echo "</div>";
		echo "<center>";
		echo "<div id='cont2'>";
	
	    echo( "- Líneas procesadas......................... $total_lineas<br>" );
	    echo( "- Queries procesadas........................ $total_queries<br>" );
	    echo( "- Último Query procesado.................... '$last_query'<br>" );
			if( $hay_Zlib ) {
	    	echo( "- Base de Datos comprimida.................. $filesize_comprimido bytes<br>");
	    	echo( "- Base de Datos descomprimida y procesada... $file_offset bytes<br>" );
	  	}
	  	else {
	    	echo( "- Base de Datos procesada................... $file_offset bytes<br>" );
	  	}
			$t_now = time();
			$t_delta = $t_now - $t_start;
			if( !$t_delta )
				$t_delta = 1;
			$t_delta = floor(($t_delta-(floor($t_delta/3600)*3600))/60)." minutos y "
			.floor($t_delta-(floor($t_delta/60))*60)." segundos.";
			echo( "- He completado el Restore de la Base de Datos en $t_delta<br>" );
	}

	if ( $dbconnection )
	    mysql_close();
	if ( $file )
		if( $hay_Zlib )
			gzclose($file);
	   else
	    fclose($file);

	echo( "</strong><br><hr><center><small>" );
	setlocale( LC_TIME,"spanish" );
	echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );

				echo "</div></div>";
				echo "</center>";
				echo "<script>$('#cont2').fadeIn(1000);</script>";

	echo( "</small></center>" );
	echo( "</BODY>" );
	echo( "</HTML>" );

//------------------------------------------------------------------------------------------
//  END
?>


<?php
///////  El área protegida acaba ANTES de la ANTERIOR línea  /////
		}
	}
?>
