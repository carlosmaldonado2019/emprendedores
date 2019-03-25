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
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
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
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}else{ //Lo contrario de if en la condici�n
				
				/* close connection */
				$mysqli->close();
				return 'Registro exitoso'; //Devuelve un  mensaje exitosos de la �ltima llamada
			}			
		}
		public function consultarUnidades(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM unidades";	
			//echo $query;
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}else{ //Lo contrario de if en la condici�n
				
				/* close connection */
				$mysqli->close();
				return $resultado; //Devuelve un  mensaje exitosos de la �ltima llamada
			}			
		}
		public function consultarUnidadesId(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM unidades WHERE idUnidadAcademica=".$this->id;	
			//echo $query;
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}else{ //Lo contrario de if en la condici�n
				
				/* close connection */
				$mysqli->close();
				return $resultado; //Devuelve un  mensaje exitosos de la �ltima llamada
			}			
		}
		public function editarUnidad(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "UPDATE unidades 
							SET claveUnidadAcademica='".$this->clave."', 
								nombreUnidadAcademica='".$this->nombre."' 
						WHERE idUnidadAcademica='".$this->id."'";	
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}else{ //Lo contrario de if en la condici�n
				
				/* close connection */
				$mysqli->close();
				return "Cambio exitoso"; //Devuelve un  mensaje exitosos de la �ltima llamada
			}			
		}
		public function eliminarUnidad(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "DELETE FROM unidades WHERE idUnidadAcademica='".$this->id."'";	
			//echo $query;
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}else{ //Lo contrario de if en la condici�n
				
				/* close connection */
				$mysqli->close();
			}			
		}
	}
?>
