<?php
 if(isset($_POST["curso"]))
 {
    $conn2=mysqli_connect("localhost","root","","siga") ;
$consulta2="select * from cursos  where id = ".$_POST["curso"];
$resultado2=mysqli_query($conn2,$consulta2);
  
    while( $fila2=mysqli_fetch_array($resultado2 )
    {
       $opciones.='<option value="'.$fila2["periodo"].'">'.$fila2["periodo"].'</option>';
    }
     echo $opciones;
 }
?>
