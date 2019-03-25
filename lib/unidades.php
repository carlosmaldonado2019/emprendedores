<?php

	class unidades
	{
		var $id;
		var $clave;
		var $nombre;
		
		private $datosConexionBD;
		
		 function __construct($datosConexionBD){
		 	$this->datosConexionBD=$datosConexionBD;
		 }
		 public function altaUnidad(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = 
					"INSERT INTO unidades (claveUnidadAcademica, 
							nombreUnidadAcademica
							) 
						VALUES ('".$this->clave."', 
							'".$this->nombre."'
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
		public function consultarUnidades(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM unidades";	
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
		public function consultarUnidadesId(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM unidades WHERE idUnidadAcademica=".$this->id;	
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
		public function editarUnidad(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "UPDATE unidades 
							SET claveUnidadAcademica='".$this->clave."', 
								nombreUnidadAcademica='".$this->nombre."' 
						WHERE idUnidadAcademica='".$this->id."'";	
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				/* close connection */
				$mysqli->close();
				return "Cambio exitoso"; //Devuelve un  mensaje exitosos de la última llamada
			}			
		}
		public function eliminarUnidad(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "DELETE FROM unidades WHERE idUnidadAcademica='".$this->id."'";	
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
