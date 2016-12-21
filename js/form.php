<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Selects dependientes con jQuery.</title>
        <script type="text/javascript" src="jquery-1.4.2.min.js"></script>
        <script language="JavaScript" type="text/JavaScript">
            $(document).ready(function(){
                $("#curso").change(function(event){
                    var id = $("#curso").find(':selected').val();
                    $("#periodo").load('genera-select.php?id='+id);
                });
            });
        </script>
    </head>

    <body>
        <form>
            <?php

    $conn=mysqli_connect("localhost","root","","siga") ;
    $consulta="select * from cursos";
    $resultado=mysqli_query($conn,$consulta);
    echo "<select class='form-control' name='curso' id='curso' required>";
    while($list=mysqli_fetch_array($resultado))
    echo "<option  value='".$list["id"]."'>".$list["nom_curso"]."</option>";
    echo  "</select>";
    ?>

            <select name="periodo" id="periodo">

            </select>
        </form>
    </body>
</html>