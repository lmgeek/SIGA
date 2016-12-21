<?php 
/* DATOS QUE CAMBIAN EN CADA INSTALACIÓN DE LA APLICACIÓN. */
  $usuario = "root";
  $clave = "";
  $servidor = "localhost";
  $baseDeDatos = "gustics";
/* AQUÍ TERMINAN LOS DATOS QUE CAMBIAN EN CADA INSTALACIÓN DE LA APLICACIÓN. */

/* Se conecta con la base de datos elegida. */
  $conexion = mysql_connect($servidor,$usuario,$clave) or die(mysql_error());
  @mysql_select_db($baseDeDatos,$conexion);

/* Se establece el nombre del fichero de la copia, incluyendo la fecha en curso. */
  $fechaDeLaCopia = "_".date("dmY");	
  $ficheroDeLaCopia = $baseDeDatos.$fechaDeLaCopia.".sql";

/* Se genera el encabezamiento de la copia y se graba en el fichero correspondiente (el sql). */
  $encabezamientoDeLaCopia = "# Copia de la base de datos creada el: ".date("d-m-Y")."\n# BBDD: $baseDeDatos \r\n";
  $manejadorDelFicheroDeLaCopia = fopen($ficheroDeLaCopia,"a+b");
  fwrite($manejadorDelFicheroDeLaCopia, $encabezamientoDeLaCopia); 
  fclose($manejadorDelFicheroDeLaCopia);     
 
/* Se genera una matriz con los nombres de las tablas que componen la BBDD. */
  $matrizDeTablas = array();
  $indiceDeLaMatrizDeTablas = 0;
  $listadoDeTablas = mysql_list_tables($baseDeDatos);
  for($recorridoDeTablas=0; $recorridoDeTablas<mysql_num_rows($listadoDeTablas); $recorridoDeTablas++){ 	
    $nombreDeTabla = mysql_tablename($listadoDeTablas,$recorridoDeTablas);
    if ($nombreDeTabla <>"") {
      $matrizDeTablas[$indiceDeLaMatrizDeTablas] = mysql_tablename($listadoDeTablas,$recorridoDeTablas);
/* Cada vez que se agrega un nombre de tabla a la matriz, se incrementa el índice de la misma, de modo
que, al terminar, tendremos el número total de tablas que conforman la BBDD. */
	  $indiceDeLaMatrizDeTablas++;
    }
  }
  

/* A continuación se recorre cada tabla obteniendo su estructura y sus contenidos.
A partir de esta información se genera la cadena de texto SQL necesaria que se incorporará
al archivo SQL de la copia. Para lograr esto se usa un bucle for en el que la variable de
control itera entre cero y el número de tablas de la BBDD menos uno. Este número viene
determinado por el índice de la matriz que se creó en el apartado anterior. */ 
  for ($recorridoDeTablas = 0; $recorridoDeTablas < $indiceDeLaMatrizDeTablas; $recorridoDeTablas++){
/* Empezamos el recorrido por la tabla en curso declarando una variable llamada $autoincrementado.
Inicialmente, en cada iteración (es decir, cada tabla), esta vale "". Si en la estructura aparece algún campo
con el atributo auto_increment, el nombre de dicho campo se almacenará en esta variable. De este modo, si
no es identificado el campo como clave, se podrá definir con esta propiedad, ya que así lo exige la
sintaxis de MySQL. En cada iteración se limpia el contenido de esta variable, para que no quede
constancia del recorrido de la tabla anterior.*/
    $autoincrementado="";
    $nombreDeTabla=$matrizDeTablas[$recorridoDeTablas];
/* Se agrega a la consulta SQL el borrado de la tabla (si existe) y su posterior re-creación. */
    $cadenaSQL = "";
    $cadenaSQL .= "DROP TABLE IF EXISTS $nombreDeTabla; \n";
    $cadenaSQL .= "CREATE TABLE $nombreDeTabla (\n";

/* A continuación se ejecuta una consulta que lee la lista de campos de la tabla en curso y se obtiene un cursor.
Al hacer una consulta como esta, para cada campo se obtiene una matriz asociativa con los siguientes elementos:
    - Elemento "Field": contiene el nombre del campo.
	- Elemento "Type": contiene el tipo de campo y su longitud.
	- Elemento "Default": si el campo tiene un valor por defecto, este aparece aquí, si no, este elemento tiene el valor "".
	- Elemento "Null": si el campo admite el valor Null, este elemento contiene "YES".
	- Elemento "Extra": si el campo tiene algún atributo adicional, este aparece aquí.*/
    $hacerConsultaDeLecturaDeEstructura = mysql_query("SHOW FIELDS FROM $nombreDeTabla",$conexion);
/* El cursor obtenido se recorre mediante un bucle, recuperando los datos de cada
campo y agregándolos a la consulta SQL que se almacenará en el fichero de la copia. */
    while($row = mysql_fetch_array($hacerConsultaDeLecturaDeEstructura)) {
      $cadenaSQL .= "    $row[Field] $row[Type]"; // Se agrega el nombre del campo y su tipo.
      if ($row["Default"] != "") $cadenaSQL .= " DEFAULT '$row[Default]'"; // Si hay un valor por defecto, se agrega también.
      if ($row["Null"] != "YES") $cadenaSQL .= " NOT NULL"; // Si no se admite el vlalor NULL, se agrega la correspondiente especificación.
      if ($row[Extra] != "") $cadenaSQL .= " $row[Extra]"; // Si hay alguna propiedad extraordinaria, como, por ejemplo, auto-increment, se agrega a la descripción del campo.
      if (strstr (strtolower($row[Extra]),"auto_increment")) $autoincrementado=$row[Field];
	  $cadenaSQL .= ",\n"; // La descripción de cada campo se termina con una coma y un salto de línea
    }

/* En el último campo de la lista se elimina la coma y el salto de línea, mediante una expresión
regular aplicada a la cadena SQL.*/
    $cadenaSQL = ereg_replace(",\n$","", $cadenaSQL);

/* A continuación se hace una consulta para recuperar la lista de campos clave de la tabla,
obteniéndose un cursor como resultado de la ejecución de la consulta. Al igual que ocurre con el
caso anterior, cada campo clave genera una matriz asociativa con varios elementos que lo definen:
    - Elemento "Key_name": define si el campo es una clave, y si es PRIMARY.
	- Elemento "Non_unique": Si el campo no es clave primaria, determina si puede haber contenidos repetidos.
	- Elemento "Column_name": Si el campo es algún tipo de índice, aquí se almacena el nombre del mismo.*/
	$hacerConsultaDeLecturaDeEstructura = mysql_query("SHOW KEYS FROM $nombreDeTabla",$conexion);
    while($row = mysql_fetch_array($hacerConsultaDeLecturaDeEstructura)){
      $nombreDeIndice=$row[Key_name];
      if(($nombreDeIndice != "PRIMARY") && ($row[Non_unique] == 0)) $nombreDeIndice="UNIQUE|$nombreDeIndice";
      if(!isset($listaDeIndices[$nombreDeIndice])) $listaDeIndices[$nombreDeIndice] = array();
      $listaDeIndices[$nombreDeIndice][] = $row[Column_name];
    }
/* Se agregan los índices a la cadena SQL que contendrá la copiade la base de datos.*/
    $autoIncluido=FALSE;
    while(list($tipoDeIndice, $columnas) = @each($listaDeIndices)){
      $cadenaSQL .= ",\n";
      if($tipoDeIndice == "PRIMARY") $cadenaSQL .= "   PRIMARY KEY (" . implode($columnas, ", ") . ")";
      else if (substr($tipoDeIndice,0,6) == "UNIQUE") $cadenaSQL .= "   UNIQUE ".substr($tipoDeIndice,7)." (" . implode($columnas, ", ") . ")";
      else $cadenaSQL .= "   KEY $tipoDeIndice (" . implode($columnas, ", ") . ")";
	  if (implode($columnas, ", ")==$autoincrementado) $autoIncluido=TRUE;
	}
    if (!$autoIncluido && $autoincrementado>"") $cadenaSQL .= ",\n   KEY $autoincrementado (" . $autoincrementado . ")";
		
// Se cierra la estructura de la tabla, acabando con un salto de línea.
    $cadenaSQL .= "\n); \n";
/* Ya se ha creado la parte de la consulta para la estructura de la tabla en curso.
A continuación se graba en el fichero.*/
    $manejadorDelFicheroDeLaCopia = fopen($ficheroDeLaCopia,"a+b"); 
    fwrite($manejadorDelFicheroDeLaCopia, "# Tabla: ".$nombreDeTabla."\n\r".$cadenaSQL); 
    fclose($manejadorDelFicheroDeLaCopia);


/* Se inicia la recuperación del contenido de la tabla en curso. */
/* Cada inserción genera una línea de datos que se incorporará a la consulta SQL
para ser almacenada en el fichero. Lo primero que hacemos es limpiar la línea de datos
para que no quede nada de la iteración anterior. */
    unset($lineaDeDatos);

    if ($nombreDeTabla>""){ //Si el nombre de la tabla es válido.
/* Se empieza recuperando todos los registros de la tabla. */
      $hacerConsultaDeLecturaDeDatos=mysql_query("SELECT * FROM $nombreDeTabla", $conexion); 
      $totalDeRegistros= mysql_num_rows ($hacerConsultaDeLecturaDeDatos); // Se obtiene el total de registros.
      $totalDeCampos = mysql_num_fields($hacerConsultaDeLecturaDeDatos); // Se onbtiene el total de campos.
/* Mediante un bucle se recorren todos los registros de la tabla. */
	  for ($cuentaDeRegistros=0;$cuentaDeRegistros<$totalDeRegistros;$cuentaDeRegistros++){
        $matrizDeDatos=mysql_fetch_array($hacerConsultaDeLecturaDeDatos);
        $lineaDeDatos.="INSERT INTO $nombreDeTabla ("; //Se añade la sentencia SQL para incorporar un registro.
 /* Mediante un bucle se añaden los nombres de los campos. */
		for ($cuentaDeCampos = 0; $cuentaDeCampos < $totalDeCampos;$cuentaDeCampos++){
          $nombreDeCampo = mysql_field_name($hacerConsultaDeLecturaDeDatos, $cuentaDeCampos); 
/* Si no es el último campo, se añade una coma y un espacio en blanco. */
		  if($cuentaDeCampos == ($totalDeCampos - 1)){ 
            $lineaDeDatos.= $nombreDeCampo; 
          } else { 
            $lineaDeDatos.= $nombreDeCampo.",";
          }
        }
/* Formada la lista de campos, se añade la cláusula VALUES para incorporar los valores. */
		$lineaDeDatos.=") VALUES (";
/* Mediante un bucle se añaden los valores, escapando los caracteres que sean necesarios. */
		for ($cuentaDeCampos=0;$cuentaDeCampos < $totalDeCampos;$cuentaDeCampos++){ 
          if($cuentaDeCampos == ($totalDeCampos - 1)){ 
            $lineaDeDatos.="'".addslashes($matrizDeDatos[$cuentaDeCampos])."'"; 
          } else { 
            $lineaDeDatos.="'".addslashes($matrizDeDatos[$cuentaDeCampos])."',";
          }
/* Se añade un salto de línea, para pasar a la siguiente línea de datos */
        } 
        $lineaDeDatos.= ");\n"; 
      } 
      $lineaDeDatos.= "\n";
    }
/* Se incorpora la línea de datos al fichero de la consulta SQL. */
    $manejadorDelFicheroDeLaCopia = fopen($ficheroDeLaCopia,"a+b"); 
    fwrite($manejadorDelFicheroDeLaCopia, $lineaDeDatos); 
    fclose($manejadorDelFicheroDeLaCopia);	
  }
/* Aqui termina el bucle que recorre cada una de las tablas, recuperando su estructura y contenidos y
generando la correspondiente consulta SQL, además de grabarla en el fichero correspondiente. */

/* A continuación se envía al navegador del cliente el fichero de copia como descargable. */
  header('Content-type: text/x-delimtext;');
  header('Content-Disposition: attachment; filename="'.$ficheroDeLaCopia.'"');
/* El proceso de lectura es necesario para que se descargue el fichero con su contenido.
Si no, se descarga con el nombre correcto, pero sin contenido. */
  readfile($ficheroDeLaCopia);
/* Para terminar, se elimina el fichero en el servidor. */
  unlink ($ficheroDeLaCopia);
?>
