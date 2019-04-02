<?php

	class usuarios{
		var $correo;
		var $contrasenia;
		var $celular;
		private $datosConexionBD;

		//Declaramos el m�todo constructor
		 function __construct($datosConexionBD){
		 	$this->datosConexionBD=$datosConexionBD;
		 }
		public function loginUsuario(){
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit(); //salir
			}
			$query ="SELECT * FROM asesores WHERE correoAsesor='".$this->correo."'"; //Sentencia para consultar un ususario por su correo
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos
			if (!$resultado) { //condici�n
					 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
				}else{
					$row = $resultado->fetch_assoc(); //fetch_assoc recupera una fila de resultados como un array asociativo
					if (count($row) > 0){ //condici�n

						if ($row['contraseniaAsesor'] ==$this->contrasenia){ //row muestra el resultado de un campo al realizar una consulta-->
							$_SESSION['login'] = true;
							$_SESSION['rol'] =$row['rolUsuario'];
							$_SESSION['id'] =$row['idAsesor'];
							$_SESSION['nombre'] =$row['nombreAsesor'];
							return 1;
						}else{
							echo 'Contrase�a incorrecta'; //La funcion echo sirve para imprimir una cadena
						}
					}else{
						$query ="SELECT * FROM alumnos WHERE correoAlumno='".$this->correo."'"; //Sentencia para consultar un ususario por su correo
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos
			if (!$resultado) { //condici�n
					 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
				}else{
					$row = $resultado->fetch_assoc(); //fetch_assoc recupera una fila de resultados como un array asociativo
					if (count($row) > 0){ //condici�n

						if ($row['contraseniaAlumno'] ==$this->contrasenia){ //row muestra el resultado de un campo al realizar una consulta-->

							$_SESSION['login'] = true;
							$_SESSION['rol'] =$row['rolUsuario'];
							$_SESSION['id'] =$row['idAlumno'];
							$_SESSION['nombre'] =$row['nombreAlumno'];
							$_SESSION['constancia'] =$row['constanciaAlumno'];
							$_SESSION['constanciaEquipo'] =$row['constanciaEquipo'];
							return 1;
						}else{
							echo 'Contrase�a incorrecta'; //La funcion echo sirve para imprimir una cadena
						}
					}else{
						echo 'El correo no existe'; //La funcion echo sirve para imprimir una cadena
					}
					}
					/* close connection */
					$mysqli->close();
				}
			}
			}
			public function recuperacionCuenta(){
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit(); //salir
			}
				$query ="SELECT * FROM asesores WHERE correoAsesor = '".$this->correo."'"; //Sentencia para consultar un ususario por su correo
				$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos
				if (!$resultado)
				{
					 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
				}
				else
				{
					$row = $resultado->fetch_assoc(); //fetch_assoc recupera una fila de resultados como un array asociativo
					if (count($row) > 0)
					{
						if ($row['celularAsesor'] ==$this->celular)
						{
							return 1; //La funcion echo sirve
							/* close connection */
							$mysqli->close();
						}
						else
						{
							return 2;
							/* close connection */
							$mysqli->close();
						}
					}
					else
					{
						$query ="SELECT * FROM alumnos WHERE correoAlumno = '".$this->correo."'";
						$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos
						if (!$resultado)
						{
							 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
						}
						else
						{
							$row = $resultado->fetch_assoc(); //fetch_assoc recupera una fila de resultados como un array asociativo
							if (count($row) > 0)
							{
								if ($row['celularAlumno'] ==$this->celular)
								{
									return 1; //La funcion echo sirve
									/* close connection */
									$mysqli->close();
								}
								else
								{
									return 2;
									/* close connection */
									$mysqli->close();
								}
							}
							else
							{
								return 2;
								/* close connection */
								$mysqli->close();
							}
						}
					}
				}
			}
			public function cambioContrasenia(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query ="SELECT * FROM asesores WHERE correoAsesor = '".$this->correo."'"; //Sentencia para consultar un ususario por su correo
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos
			if (!$resultado)
			{
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}
			else
			{
				$row = $resultado->fetch_assoc(); //fetch_assoc recupera una fila de resultados como un array asociativo
				if (count($row) > 0)
				{
					$query = "UPDATE asesores 
								SET contraseniaAsesor='".$this->contrasenia."' 
							WHERE correoAsesor = '".$this->correo."'"; //sentencia para mostrar todos los resgistros de una tabla
					$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos
					if (!$resultado) { //condici�n
						printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
					}
					else
					{
						/* close connection */
						$mysqli->close();
					}
				}
				else
				{
					$query ="SELECT * FROM alumnos WHERE correoAlumno = '".$this->correo."'";
					$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos
					if (!$resultado)
					{
						 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
					}
					else
					{
						$row = $resultado->fetch_assoc(); //fetch_assoc recupera una fila de resultados como un array asociativo
						if (count($row) > 0)
						{
							$query = "UPDATE alumnos 
								SET contraseniaAlumno='".$this->contrasenia."' 
							WHERE correoAlumno = '".$this->correo."'"; //sentencia para mostrar todos los resgistros de una tabla
							$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos
							if (!$resultado) { //condici�n
								printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
							}
							else
							{
								/* close connection */
								$mysqli->close();
							}
						}
						else
						{
							$mysqli->close();
						}
					}
				}
			}
		}
	}
?>