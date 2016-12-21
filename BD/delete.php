
<?php
$enlace = mysql_connect('localhost', 'root', '');
if (!$enlace) {
    die('No pudo conectarse: ' . mysql_error());
}

$sql = 'DROP DATABASE siga';
if (mysql_query($sql, $enlace)) {
    echo "La base de datos borrar fue eliminada con éxito\n";
} else {
    echo 'Error al eliminar la base de datos: ' . mysql_error() . "\n";
}
?>
