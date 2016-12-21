<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<title>Emenia Demo - Uso de jQuery Data Picker</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="title" content="Demo de jQuery Data Picker" />
	<meta name="description" content="Demo de jQuery Data Picker" />
	<meta name="keywords" content="Demo, calendario, Data Picker" />
	<meta name="author" content="Emenia" />
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
 	<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});    

        $(document).ready(function() {
           $("#datepicker").datepicker();
        });
    </script>


    <script type="text/javascript">
    $(document).ready(function(){
	$("select[name=color1]").change(function(){
            alert($('select[name=color1]').val());
            $('input[name=valor1]').val($(this).val());
        });
	$("#ejemplo2").change(function(){
            alert($('select[id=ejemplo2]').val());
            $('#valor2').val($(this).val());
	});
	$(".ejemplo3").change(function(){
            alert($('select[class=ejemplo3]').val());
            $('.valor3').val($(this).val());
	});
});
    </script>
</head>
<body>
	<div id="cabecera">
		<div id="contenido-cabecera">
			<div id="logo">
				<a href="http://www.emenia.es">Emenia</a>
			</div>
			<img src="images/logo_demos.png" alt="Logo Demos" />
		</div>
	</div>	
	<div id="contenido-demo">	
		<h1>Uso de jQuery Data Picker</h1>
        
        	<form action="">
           <label> Seleccionar Fecha:</label>
	       <input type="text" name="datepicker" id="datepicker" readonly="readonly" size="12" />
           </form>

    </div>


Formulario 1
<form name="ejemplo1" action="17-jquery-change-demo1.php" method="POST">
    <select name="color1">
   <option value="0">Selecciona una opción</option>
<option value="azul">Azul</option>
<option value="rojo">Rojo</option>
</select>
<input type="text" name="valor1" size="40" value="Aquí saldrá el valor del select cuando cambie">
</form>
 
Formulario 2
<form name="ejemplo2" action="17-jquery-change-demo1.php" method="POST">
    <select name="color2" id="ejemplo2">
   <option value="0">Selecciona una opción</option>
<option value="azul">Azul</option>
<option value="rojo">Rojo</option>
</select>
<input type="text" name="valor2" size="40" id="valor2" value="Aquí saldrá el valor del select cuando cambie">
</form>
 
Formulario 3
<form name="ejemplo3" action="17-jquery-change-demo1.php" method="POST">
    <select name="color3" class="ejemplo3">
   <option value="0">Selecciona una opción</option>
<option value="azul">Azul</option>
<option value="rojo">Rojo</option>
</select>
<input type="text" name="valor3" size="40" class="valor3" value="Aquí saldrá el valor del select cuando cambie">
</form>




<frameset rows="100%,*" frameborder="NO" border="0" framespacing="0">
  <frame src="llamaphp.php" name="arriba" id="arriba">
  <frame src="" name="abajo" id="abajo" scrolling="NO" noresize>
</frameset>
<noframes>


		
</body>
</html>