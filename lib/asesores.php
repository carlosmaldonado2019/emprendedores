<?php

	class asesores
	{
		var $id;
		var $numeroEmpleado;
		var $apellidoPaterno;
		var $apellidoMaterno;
		var $nombre;
		var $correo;
		var $celular;
		var $contrasenia;
		var $correoAlternativo;
		var $unidadAcademica;
		private $datosConexionBD;
		
		 function __construct($datosConexionBD){
		 	$this->datosConexionBD=$datosConexionBD;
		 }
		 public function altaAsesor(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = 
					"INSERT INTO asesores (idAsesor, 
							numeroEmpleadoAsesor,
							apellidoPaternoAsesor,
							apellidoMaternoAsesor,
							nombreAsesor,
							sexoAsesor,
							correoAsesor,
							correoAlternativoAsesor,
							celularAsesor,
							contraseniaAsesor,
							unidadAcademicaAsesor) 
						VALUES (NULL, 
							".$this->numeroEmpleado.",
							'".$this->apellidoPaterno."',
							'".$this->apellidoMaterno."',
							'".$this->nombre."',
							'".$this->sexo."',
							'".$this->correo."',
							'".$this->correoAlternativo."',
							'".$this->celular."',
							'".$this->contrasenia."',
							".$this->unidadAcademica."
						)";	
			//echo $query;
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				/* close connection */
				$mysqli->close();
				return "Registro exitoso"; //Devuelve un  mensaje exitosos de la última llamada
			}			
		}
		public function consultarAsesores(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM asesores WHERE rolUsuario=0 ORDER BY apellidoPaternoAsesor";	
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

		public function consultarUnidades(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT * FROM unidades"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			
			/* close connection */
			$mysqli->close();
			return $resultado;
		}
		public function consultarAsesorId(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT
						a.idAsesor,
						a.numeroEmpleadoAsesor,
						a.apellidoPaternoAsesor,
						a.apellidoMaternoAsesor,
						a.nombreAsesor,
						a.sexoAsesor,
						a.correoAsesor,
						a.correoAlternativoAsesor,
						a.celularAsesor,
						a.unidadAcademicaAsesor,
						b.nombreUnidadAcademica AS nombreUnidadAcademica	
					FROM asesores 
					AS a INNER JOIN unidades AS b
						ON a.unidadAcademicaAsesor = b.claveUnidadAcademica
					WHERE idAsesor='".$this->id."'"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			
			/* close connection */
			$mysqli->close();
			return $resultado;
		}
		public function editarAsesor(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE asesores SET numeroEmpleadoAsesor=".$this->numeroEmpleado.", apellidoPaternoAsesor='".$this->apellidoPaterno."',apellidoMaternoAsesor='".$this->apellidoMaterno."',nombreAsesor='".$this->nombre."',sexoAsesor='".$this->sexo."',correoAsesor='".$this->correo."',correoAlternativoAsesor='".$this->correoAlternativo."',celularAsesor='".$this->celular."',unidadAcademicaAsesor=".$this->unidadAcademica." WHERE idAsesor='".$this->id."'"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			
			/* close connection */
			$mysqli->close();
			return "Los datos han sido actualiados con éxito";
		}
		public function eliminarAsesor(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "DELETE FROM asesores WHERE idAsesor='".$this->id."'";	
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
