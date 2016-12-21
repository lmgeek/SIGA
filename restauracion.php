public function restaurarDatos()
	{
		permisosModelo("admi","ninguno");

		$valores = array();
		$valores[] = validacionCampo::validar($_POST["clave"], "clave", "ln", "", "", "", "", "5", "16", "no", "");
		
		if(validacionCampo::sinError($valores))
		{
			$bd_admi = new baseDatosAdministrador();
			$bd_admi->abrirConexion();
					
			$query = "select id_usuario from usuarios where id_usuario = '" . $_SESSION["usuario"]["id_usuario"] . "' and clave = '" . hash("sha256", md5($_POST["clave"])) . "'";

			$bd_admi->resultadoQuery($query);
			
			$bd_admi->cerrarConexion(); 
			
			if($bd_admi->numeroFilas() == 1)
			{
				if(!empty($_FILES['archivoRestaurar']['tmp_name']))
				{
				
					//Conectar con la base de datos
					$conexion = mysql_connect("127.0.0.1", "root", "123");
					mysql_select_db("modelo", $conexion);
					
					$sistema="show variables where variable_name= 'basedir'";
					$rs_sistema=mysql_query($sistema);
					$DirBase=mysql_result($rs_sistema,0,"value");
					$primero=substr($DirBase,0,1);
					if ($primero=="/") {
						$DirBase="mysql";
					} else {
						$DirBase=$DirBase."\bin\mysql";
					}
						$base="modelo";
						
						 $drop="DROP DATABASE $base";
						 mysql_query($drop);
						 $create="CREATE DATABASE $base";
						 mysql_query($create);
						// $db="dbmotoalcides";//$_POST['db'];
						 
						 $output=shell_exec("$DirBase -u root --password=123 ".$base." < ".$_FILES['archivoRestaurar']['tmp_name']);    // ejemplo windows
						//$output=shell_exec("/usr/bin/mysqldump -u root -proot ".$db); // ejemplo linux
					echo $output;

					return "exito";
				}
				else
				{
					validacionCampo::agregarError("archivoRestaurar", "Debe seleccionar el archivo.");
					return "errorData";
				}
			}
			else
			{
				validacionCampo::agregarError("clave", "Clave incorrecta.");
				return "errorData";
			}
		}
		else
		{
			return "errorData";
		}
	}