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
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM grupos WHERE numeroGrupo='".$this->grupo."' AND periodoGrupo='".$this->periodo."'";	
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
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
					$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
					if (!$resultado) { //condición
						 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
					}else{ //Lo contrario de if en la condición
						
						/* close connection */
						$mysqli->close();
						return 'Registro exitoso'; //Devuelve un  mensaje exitosos de la última llamada
					}			
				}
				else
				{
					return 'El grupo ya ha sido registrado anteriormente';
				}
			}			
		}
		 public function consultarGrupos(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT periodoGrupo FROM grupos ORDER BY periodoGrupo ASC";	
			//echo $query;
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				while($row = $resultado->fetch_assoc()) {
					$this->periodo=$row['periodoGrupo'];
				}
				$query = "SELECT * FROM grupos WHERE periodoGrupo='".$this->periodo."' ORDER BY numeroGrupo ASC";	
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
		public function consultarPeriodosGrupos(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT DISTINCT periodoGrupo FROM grupos";	
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
		public function consultarGruposId(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "SELECT * FROM grupos WHERE idGrupo=".$this->id;	
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
		public function editarGrupo(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
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
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el código de error de la última llamada
			}else{ //Lo contrario de if en la condición
				
				/* close connection */
				$mysqli->close();
				return "Cambio exitoso";
			}			
		}
		public function eliminarGrupo(){			
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condición
			    return (printf("Error de conexión: %s\n", mysqli_connect_error())); //Devuelve el código de error de la última llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "DELETE FROM grupos WHERE idGrupo='".$this->id."'";	
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
