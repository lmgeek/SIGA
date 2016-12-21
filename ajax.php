<head>
 
<title>Ejemplo sencillo de AJAX</title>
 
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
<script>
        function realizaProceso(valorCaja1, valorCaja2){
                var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
                };
 
                $.ajax({
                        data: parametros,
                        url: valorCaja1+'?'+valorCaja2,
                        type: 'get',
                        beforeSend: function () {
                                $("#resultado").html("Procesando, espere por favor...");
                        },
                        success: function (response) {
                                $("#resultado").html(response);
                                //document.getElementById("primer").style.display = "none";
                        }
                });
 
        }
 
        var estado = 0;
        
        function pasarProceso(valor1, valor2) {
 
                if (estado == 0) {
                        setTimeout(realizaProceso,2000,valor1,valor2);
                        estado = estado + 1;
                }
                else {
                        estado = 0;
                }
 
        }
</script>
 
</head>
<body>
 
<div id="primer">
Introduce valor 1
<input type="text" name="caja_texto" id="valor1" value="0" href="javascript:;" />
Introduce valor 2
<input type="text" name="caja_texto" id="valor2" value="0"
onkeyup="pasarProceso($('#valor1').val(), $('#valor2').val());return false;" value="Calcula"/>
Realizar búsqueda
<input type="button" href="javascript:;"
onMouseOver="realizaProceso($('#valor1').val(), $('#valor2').val());return false;" value="Calcula"/>
</div>
 
<span id="resultado"></span>
 
</body>
</html>