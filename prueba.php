<input type="button" value="Print this page" onClick="window.print()">
<?php

$conn=mysqli_connect("localhost","root","","siga") ;
$consulta="select * from cursos";
$resultado=mysqli_query($conn,$consulta);
echo "<select>";
while($lista=mysqli_fetch_array($resultado))
echo "<option  value='".$lista["id"]."'>".$lista["nom_curso"]."</option>";
echo  "</select>";
 ?>

 <iframe src="manual.pdf" style="width:700px; height:700px;" frameborder="0"> </iframe>