<?php

	class equipos
	{
		var $asesor;
		var $nombre;
		var $nombrePS;
		var $descripcion;
		var $clase;
		var $giro;
		var $periodo;
		var $tipo;
		var $empresa;
		var $carrera;
		var $contador;
		var $id;
		var $stand;

		private $datosConexionBD;
		
		 function __construct($datosConexionBD){
		 	$this->datosConexionBD=$datosConexionBD;
		 }
		 public function altaEquipo(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = 
					"INSERT INTO equipos (idEquipo, 
							asesorEquipo,
							nombreEmpresaEquipo,
							nombrePSEquipo,
							descripcionEmpresaEquipo,
							tipoEmpresaEquipo,
							claseEmpresaEquipo,
							carreraEquipo,
							periodoEmpresaEquipo,
							standEquipo) 
						VALUES (NULL, 
							".$this->asesor.",
							'".$this->nombre."',
							'".$this->nombrePS."',
							'".$this->descripcion."',
							'Disciplinario',
							'".$this->clase."',
							'".$this->carrera."',
							'".$this->periodo."',
							'Pendiente'
						)";	
			//echo $query;
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				/* close connection */
				$mysqli->close();
				return 'Registro exitoso'; //Devuelve un  mensaje exitosos de la última llamada
			}			
		}

		public function consultarEquipos(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT COUNT(*) AS totalIntegrantesEquipo,
						   equipos.idEquipo,
					       equipos.nombreEmpresaEquipo,
					       equipos.nombrePSEquipo,
					       equipos.descripcionEmpresaEquipo,
					       equipos.claseEmpresaEquipo,
					       equipos.periodoEmpresaEquipo,
					       equipos.standEquipo,
					       asesores.apellidoPaternoAsesor AS paternoAsesor,
					       asesores.apellidoMaternoAsesor AS maternoAsesor,
					       asesores.nombreAsesor AS nombreAsesor
					FROM alumnos
					INNER JOIN equipos ON alumnos.empresaAlumno=equipos.idEquipo
					INNER JOIN asesores ON equipos.asesorEquipo=asesores.idAsesor
					WHERE equipos.periodoEmpresaEquipo='".$this->periodo."'
					GROUP BY equipos.nombreEmpresaEquipo
					ORDER BY asesores.apellidoPaternoAsesor
					 "; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			
			/* close connection */
			$mysqli->close();
			return $resultado;
		}
		public function consultarEmpresas(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT periodoEmpresaEquipo FROM equipos ORDER BY periodoEmpresaEquipo ASC";	
			//echo $query;
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				while($row = $resultado->fetch_assoc()) {
					$this->periodo=$row['periodoEmpresaEquipo'];
				}
				$query = "SELECT * FROM equipos WHERE periodoEmpresaEquipo='".$this->periodo."' ORDER BY nombreEmpresaEquipo ASC";	
				//echo $query;
				$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
				if (!$resultado) { //condición
					 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
				}else{ //Lo contrario de if en la condición
					/* close connection */
				$mysqli->close();
				return $resultado; //Devuelve un  mensaje exitosos de la última llamada
				}			
			}			
		}
		public function consultarEquiposAsesor(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT * FROM equipos WHERE asesorEquipo='".$_SESSION['id']."'"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			
			/* close connection */
			$mysqli->close();
			return $resultado;
		}
		public function consultaCarreras(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT * FROM carreras"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			
			/* close connection */
			$mysqli->close();
			return $resultado;
		}
		public function consultarEquipoId(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT 
						equipos.idEquipo,
						equipos.nombreEmpresaEquipo,
						equipos.nombrePSEquipo,
						equipos.descripcionEmpresaEquipo,
						equipos.claseEmpresaEquipo,
						equipos.periodoEmpresaEquipo,
						equipos.standEquipo,
						equipos.totalIntegrantesEquipo,
						asesores.apellidoPaternoAsesor AS apellidoPaternoAsesor,
						asesores.apellidoMaternoAsesor AS apellidoMaternoAsesor,
						asesores.nombreAsesor AS nombreAsesor,
						equipos.carreraEquipo,
						carreras.nombreCarrera AS nombreCarrera
					 FROM equipos
					 INNER JOIN asesores ON 
						equipos.asesorEquipo = asesores.idAsesor
					 INNER JOIN carreras ON 
						equipos.carreraEquipo = carreras.claveCarrera
					WHERE idEquipo='".$this->id."'"; 
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			
			/* close connection */
			$mysqli->close();
			return $resultado;
		}

		public function actualizarEquipo(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE equipos 
					  SET nombreEmpresaEquipo='".$this->nombre."', 
					  	  nombrePSEquipo='".$this->nombrePS."',
					  	  descripcionEmpresaEquipo='".$this->descripcion."',
					  	  claseEmpresaEquipo='".$this->clase."',
					  	  carreraEquipo='".$this->carrera."',
					  	  periodoEmpresaEquipo='".$this->periodo."'
					  WHERE idEquipo='".$this->id."'"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return "Los datos han sido actualizados con éxito";
			}
		}
		public function actualizarStand(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE equipos 
					  SET standEquipo='".$this->stand."'
					  WHERE idEquipo='".$this->id."'"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			
			/* close connection */
			$mysqli->close();
			return "";
		}
		public function consultarAsesorEquipo(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT  
									a.idEquipo,
									a.nombreEmpresaEquipo, 
									b.nombreAsesor AS nombreAsesor,
									b.apellidoPaternoAsesor AS apellidoPaternoAsesor,
									b.apellidoMaternoAsesor AS apellidoMaternoAsesor,
									b.unidadAcademicaAsesor AS unidadAcademica,
									a.descripcionEmpresaEquipo,
									a.nombrePSEquipo,
									a.periodoEmpresaEquipo,
									a.claseEmpresaEquipo
								FROM equipos 
								AS a INNER JOIN asesores AS b ON 
								a.asesorEquipo = b.idAsesor
								WHERE a.idEquipo = '".$this->id."'";
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}

		public function cambioTipoEquipo(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM alumnos WHERE empresaAlumno=".$this->empresa;	
			//echo $query;
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}
			else
			{ 
				while($row = $resultado->fetch_assoc()) {
					if ($row['carreraAlumno']!=$this->carrera) 
					{
						$this->contador++;
					}
				}
				if ($this->contador>0) 
				{
					$query = "UPDATE equipos SET 
								tipoEmpresaEquipo='Multidisciplinario'
							WHERE idEquipo=".$this->empresa; //sentencia para mostrar todos los resgistros de una tabla
					$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
					if (!$resultado) { //condición
						printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
					}
					else
					{
						/* close connection */
						$mysqli->close();
					}
				}
				else
				{
					$query = "UPDATE equipos SET 
								tipoEmpresaEquipo='Disciplinario'
							WHERE idEquipo=".$this->empresa; //sentencia para mostrar todos los resgistros de una tabla
					$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
					if (!$resultado) { //condición
						printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
					}
					else
					{
						/* close connection */
						$mysqli->close();
					}
				}
			}			
		}
		public function consultarPeriodosEquipos(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT DISTINCT periodoEmpresaEquipo FROM equipos";	
			//echo $query;
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				/* close connection */
				$mysqli->close();
				return $resultado; //Devuelve un  mensaje exitosos de la última llamada
			}			
		}
		public function eliminarEquipo(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "DELETE FROM equipos WHERE idEquipo='".$this->id."'";	
			//echo $query;
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				/* close connection */
				$mysqli->close();
			}			
		}
	}
?>
