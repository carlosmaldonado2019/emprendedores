<?php

	class grupos
	{
		var $id;
		var $grupo;
		var $turno;
		var $inscritos;
		var $periodo;
		
		private $datosConexionBD;
		
		 function __construct($datosConexionBD){
		 	$this->datosConexionBD=$datosConexionBD;
		 }
		 public function altaGrupo(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM grupos WHERE numeroGrupo='".$this->grupo."' AND periodoGrupo='".$this->periodo."'";	
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}
			else
			{ 
				$row = $resultado->fetch_assoc(); 
				if (count($row) == 0){ 
					$query = 
							"INSERT INTO grupos (idGrupo, 
									numeroGrupo,
									turnoGrupo,
									inscritosGrupo,
									periodoGrupo
									) 
								VALUES (NULL, 
									'".$this->grupo."',
									'".$this->turno."',
									'".$this->inscritos."',
									'".$this->periodo."'
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
				else
				{
					return 'El grupo ya ha sido registrado anteriormente';
				}
			}			
		}
		 public function consultarGrupos(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT periodoGrupo FROM grupos ORDER BY periodoGrupo ASC";	
			//echo $query;
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}else{ //Lo contrario de if en la condici�n
				
				while($row = $resultado->fetch_assoc()) {
					$this->periodo=$row['periodoGrupo'];
				}
				$query = "SELECT * FROM grupos WHERE periodoGrupo='".$this->periodo."' ORDER BY numeroGrupo ASC";	
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
		}
		public function consultarPeriodosGrupos(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT DISTINCT periodoGrupo FROM grupos";	
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
		public function consultarGruposId(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM grupos WHERE idGrupo=".$this->id;	
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
		public function editarGrupo(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "UPDATE grupos
							SET numeroGrupo='".$this->grupo."',
								turnoGrupo='".$this->turno."',
								inscritosGrupo='".$this->inscritos."',
								periodoGrupo='".$this->periodo."'
						 WHERE idGrupo=".$this->id;	
			//echo $query;
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}else{ //Lo contrario de if en la condici�n
				
				/* close connection */
				$mysqli->close();
				return "Cambio exitoso";
			}			
		}
		public function eliminarGrupo(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "DELETE FROM grupos WHERE idGrupo='".$this->id."'";	
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
