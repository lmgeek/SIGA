

<?php
$conn=mysqli_connect("localhost","root","","siga") ;
$consulta="select * from cursos";
$resultado=mysqli_query($conn,$consulta);
  $opciones = '<option value="0"> Elige un curso</option>';
  while( $fila=mysqli_fetch_array($resultado) )
  {
     $opciones.='<option value="'.$fila["id"].'">'.$fila["nom_curso"].'</option>';
  }
?>



<body>
  <div> Selects combinados </div>
  <div>
     <label> Marca:</label>
     <select id="marca"><?php echo $opciones; ?></select>  </div>
  <div>
     <label> Modelo:</label>
     <select id="modelo"><option value="0">Elige un modelo</option></select></div>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    $("#curso").change(function(){
    $.ajax({
      url:"conexion.php",
      type: "POST",
      data:"idcurso="+$("#curso").val(),
      success: function(opciones){
        $("#modelo").html(opciones);
      }
    })
  });
});
</script>










  











<br><br>
<body>
<div>
   <select id="primary">
      <option value="color">Color</option>
      <option value="country">Country</option>
   </select> 
   <select id="secondary">
   </select>
</div>
</body>


<script
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
var options = {
        color : ["red","green","blue"],
        country : ["Spain","Germany","France"]
}
 
$(function(){
    var fillSecondary = function(){
        var selected = $('#primary').val();
        $('#secondary').empty();
        options[selected].forEach(function(element,index){
            $('#secondary').append('<option value="'+element+'">'+element+'</option>');
        });
    }
    $('#primary').change(fillSecondary);
    fillSecondary();
});



</script>


