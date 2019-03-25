<?php

	class carreras
	{
		var $id;
		var $clave;
		var $nombre;
		var $abreviatura;
		var $unidad;
		
		private $datosConexionBD;
		
		 function __construct($datosConexionBD){
		 	$this->datosConexionBD=$datosConexionBD;
		 }
		 public function altaCarrera(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = 
					"INSERT INTO carreras (claveCarrera, 
							nombreCarrera,
							abreviaturaCarrera,
							claveUACarrera
							) 
						VALUES ('".$this->clave."', 
							'".$this->nombre."',
							'".$this->abreviatura."',
							'".$this->unidad."'
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
		public function consultarCarreras(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = 
					"SELECT * FROM carreras";
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
		 public function consultarCarrerasId(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = 
					"SELECT carreras.idCarrera,
							carreras.claveCarrera,
							carreras.nombreCarrera,
							carreras.abreviaturaCarrera,
							unidades.claveUnidadAcademica,
							unidades.nombreUnidadAcademica
					FROM carreras
					INNER JOIN unidades ON carreras.claveUACarrera=unidades.claveUnidadAcademica
					WHERE carreras.idCarrera=".$this->id;	
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
		public function eliminarCarrera(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "DELETE FROM carreras WHERE idCarrera='".$this->id."'";	
			//echo $query;
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				/* close connection */
				$mysqli->close();
			}			
		}
		public function editarCarrera(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "UPDATE carreras 
							SET claveCarrera='".$this->clave."', 
								nombreCarrera='".$this->nombre."',
								abreviaturaCarrera='".$this->abreviatura."',
								claveUACarrera='".$this->unidad."'
						WHERE idCarrera='".$this->id."'";	
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				/* close connection */
				$mysqli->close();
				return "Cambio exitoso"; //Devuelve un  mensaje exitosos de la última llamada
			}			
		}
	}
?>
