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
	$db_name				= "tienda2"; 
	$db_username		= "root"; 
	$db_password		= "toor"; 


	//  Acceso al script.
	
	$auth_user			= "lmgeek";
	$auth_password 	= "LMGeeK";


	//  Nombre del archivo.

	$filename 			= "tienda2.sql";


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
		header('WWW-Authenticate: Basic realm="Acceso al Dump y Download la Base de Datos"');
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
	<center><h1>Vaciado y Descarga de la Base de Datos</h1></center><br>
	<strong><center><p>Usuario/contraseña equivocado. Acceso denegado.</p></center>
<?php
		echo( "</strong><br><br><hr><center><small>" );
		setlocale( LC_TIME,"spanish" );
		echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
		echo( "</small></center>" );
		echo( "</BODY>" );
		echo( "</HTML>" );
    exit();
	}
	else {
		if (($_SERVER['PHP_AUTH_USER'] != $auth_user ) || ($_SERVER['PHP_AUTH_PW'] != $auth_password )) {
			header('WWW-Authenticate: Basic realm="Acceso al Dump y Download la Base de Datos"');
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
	<center><h1>Vaciado y Descarga de la Base de Datos</h1></center><br>
	<strong><center><p>Usuario/contraseña equivocado. Acceso denegado.</p></center>
<?php
			echo( "</strong><br><br><hr><center><small>" );
			setlocale( LC_TIME,"spanish" );
			echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
			echo( "</small></center>" );
			echo( "</BODY>" );
			echo( "</HTML>" );
    	exit();
		}
		else {
///////  El área protegida empieza DESPUÉS de la SIGUIENTE línea  /////
?>
<?php
//------------------------------------------------------------------------------------------
//  Funciones

	error_reporting( E_ALL & ~E_NOTICE );

	function fetch_table_dump_sql($table, $fp = 0) {
		$tabledump = "--\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "-- Table structure for table `$table`\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "--\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = query_first("SHOW CREATE TABLE $table");
		strip_backticks($tabledump['Create Table']);
		$tabledump = "DROP TABLE IF EXISTS $table;\n" . $tabledump['Create Table'] . ";\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = "--\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "-- Dumping data for table `$table`\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "--\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = "LOCK TABLES $table WRITE;\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$rows = query("SELECT * FROM $table");
		$numfields=mysql_num_fields($rows);
		while ($row = fetch_array($rows, DBARRAY_NUM)) {
			$tabledump = "INSERT INTO $table VALUES(";
			$fieldcounter = -1;
			$firstfield = 1;
			// campos
			while (++$fieldcounter < $numfields) {
				if( !$firstfield) {
					$tabledump .= ', ';
				}
				else {
					$firstfield = 0;
				}
				if( !isset($row["$fieldcounter"])) {
					$tabledump .= 'NULL';
				}
				else {
					$tabledump .= "'" . mysql_real_escape_string($row["$fieldcounter"]) . "'";
				}
			}
			$tabledump .= ");\n";
			if( !$hay_Zlib ) 
				fwrite($fp, $tabledump);
			else
				gzwrite($fp, $tabledump);	
		}
		free_result($rows);
		$tabledump = "UNLOCK TABLES;\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
	}

	function strip_backticks(&$text) {
		return $text;
	}

	function fetch_array($query_id=-1) {
		if( $query_id!=-1) {
			$query_id=$query_id;
		}
		$record = mysql_fetch_array($query_id);
		return $record;
	}

	function problemas($msg) {
		$errdesc = mysql_error();
    $errno = mysql_errno();
    $message  = "<br>";
    $message .= "- Ha habido un problema accediendo a la Base de Datos<br>";
    $message .= "- Error $appname: $msg<br>";
    $message .= "- Error mysql: $errdesc<br>";
    $message .= "- Error número mysql: $errno<br>";
    $message .= "- Script: ".getenv("REQUEST_URI")."<br>";
    $message .= "- Referer: ".getenv("HTTP_REFERER")."<br>";

		echo( "</strong><br><br><hr><center><small>" );
		setlocale( LC_TIME,"spanish" );
		echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
		echo( "</small></center>" );
		echo( "</BODY>" );
		echo( "</HTML>" );
		die("");
  }

	function free_result($query_id=-1) {
    if( $query_id!=-1) {
      $query_id=$query_id;
    }
    return @mysql_free_result($query_id);
  }

  function query_first($query_string) {
    $res = query($query_string);
    $returnarray = fetch_array($res);
    free_result($res);
    return $returnarray;
  }

	function query($query_string) {
    $query_id = mysql_query($query_string);
    if( !$query_id) {
      problemas("Invalid SQL: ".$query_string);
    }
    return $query_id;
  }


//------------------------------------------------------------------------------------------
//  Main
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
	<title>Vaciado y Descaga dela Base de Datos</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<center><h1>Vaciado y Descarga de la Base de Datos</h1></center>
<br>
<strong>
<?php
	@set_time_limit( 0 );

				echo "<center><div id='evo'><div id='cont'>";

	echo( "- Base de Datos: '$db_name' en '$db_server'.<br>" );
	$error = false;
	$tablas = 0;

	if( !@function_exists( 'gzopen' ) ) {
		$hay_Zlib = false;
		echo( "<script>alert('Error Archivo Zlib, Su Base de Datos sera guardada sin comprimir, como ".$filename."');</script>" );
	}
	else {
		$filename = $filename . ".gz";
		$hay_Zlib = true;
		echo( "<script>alert('Carga de Zlib Exitoza, Base de datos comprimida, como ".$filename."');</script>" );
	}
	
	if( !$error ) { 
	    $dbconnection = @mysql_connect( $db_server, $db_username, $db_password ); 
	    if( $dbconnection) 
	        $db = mysql_select_db( $db_name );
	    if( !$dbconnection || !$db ) { 
	        echo( "<br>" );
	        echo( "- La conexion con la Base de datos ha fallado: ".mysql_error()."<br>" );
	        $error = true;
	    }
	    else {
	        echo( "<br>" );
	        echo( "- Conexion con la Base de datos exitosa.<br><br>" );
	    }
	}
				echo "<center>";
				echo "</div>";

	if( !$error ) { 
		//  MySQL versión
		$result = mysql_query( 'SELECT VERSION() AS version' );
		if( $result != FALSE && @mysql_num_rows($result) > 0 ) {
			$row   = mysql_fetch_array($result);
		} else {
			$result = @mysql_query( 'SHOW VARIABLES LIKE \'version\'' );
			if( $result != FALSE && @mysql_num_rows($result) > 0 ){
				$row   = mysql_fetch_row( $result );
			}
		}
		if(! isset($row) ) {
			$row['version'] = '3.21.0';
		}
	}

	if( !$error ) { 
		$el_path = getenv("REQUEST_URI");
		$el_path = substr($el_path, strpos($el_path, "/"), strrpos($el_path, "/"));

		$resul =  "show tables from ".$db_name ;
		$result= mysql_query($resul);
		if( !$result ) {
			echo "<script>alert('Error, no puedo obtener la lista de las tablas');</script>";
			print '- MySQL Error: ' . mysql_error(). '<br><br>';
			$error = true;
		}
		else {
			$t_start = time();
			
			if( !$hay_Zlib ) 
				$filehandle = fopen( $filename, 'w' );
			else
				$filehandle = gzopen( $filename, 'w6' );	//  nivel de compresión
				
			if( !$filehandle ) {
				$el_path = getenv("REQUEST_URI");
				$el_path = substr($el_path, strpos($el_path, "/"), strrpos($el_path, "/"));
				echo( "<br>" );
				echo( "<script>alert('No he podido crear ".$filename." en ".$el_path."/ Por favor, asegúrese de que dispone de privilegios de escritura');</script>" );
			}
			else {					
				$tabledump = "-- Dump de la Base de Datos\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				setlocale( LC_TIME,"spanish" );
				$tabledump = "-- Fecha: " . strftime( "%A %d %B %Y - %H:%M:%S", time() ) . "\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "--\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Version: " . Str_VERS . ", del " . Str_DATE . ", insidephp@gmail.com\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Soporte y Updaters: http://insidephp.sytes.net\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "--\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Host: `$db_server`    Database: `$db_name`\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- ------------------------------------------------------\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Server version	". $row['version'] . "\n\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	

				$result = query( 'SHOW tables' );
				while( $currow = fetch_array($result, DBARRAY_NUM) ) {
					fetch_table_dump_sql( $currow[0], $filehandle );
					fwrite( $filehandle, "\n" );
					if( !$hay_Zlib ) 
						fwrite( $filehandle, "\n" );
					else
						gzwrite( $filehandle, "\n" );
						$tablas++;
				}
				$tabledump = "\n-- Dump de la Base de Datos Completo.";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				if( !$hay_Zlib ) 
					fclose( $filehandle );
				else
					gzclose( $filehandle );
	
				$t_now = time();
				$t_delta = $t_now - $t_start;
				if( !$t_delta )
					$t_delta = 1;
				$t_delta = floor(($t_delta-(floor($t_delta/3600)*3600))/60)." minutos y "
				.floor($t_delta-(floor($t_delta/60))*60)." segundos.";
				echo "<center>";
				echo "<div id='cont2'>";
				echo( "- Tiempo de Respuesta - $tablas tablas en $t_delta<br>" );
				echo( "<br>" );
				echo( "- El Dump de la Base de Datos está completo.<br><br>" );
				echo( "- La Ruta del Archivo generado es: $el_path/$filename<br>" );
				echo( "<br>" );
				echo( "- Puede bajársela directamente: </strong><a href=\"$filename\">$filename</a>" );
				$size = filesize($filename);
				$size = number_format( $size );
				$size = str_replace( ",",".",$size );
				echo( "&nbsp;&nbsp;&nbsp;<small>($size bytes)</small><br>" );

				
			}
		}
	}

	if( $dbconnection )
	    mysql_close();

	echo( "</strong><br><hr><center><small>" );
	setlocale( LC_TIME,"spanish" );
	echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
				echo "</div></div>";
				echo "</center>";
				echo "<script>$('#cont2').fadeIn(1000);</script>";

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
