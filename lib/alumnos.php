<?php

	class alumnos
	{
		var $id;
		var $matricula;
		var $apellidoPaterno;
		var $apellidoMaterno;
		var $nombre;
		var $correo;
		var $celular;
		var $contrasenia;
		var $edad;
		var $sexo;
		var $carrera;
		var $empresa;
		var $turno;
		var $semestre;
		var $correoAlternativo;
		var $unidadAcademica;
		var $fecha;
		var $grupo;
		var $periodo;
		var $contador;
		var $totalIntegrantes;
		private $datosConexionBD;
		
		function __construct($datosConexionBD){
			$this->datosConexionBD=$datosConexionBD;
		}
		public function altaAlumno(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = 
					"INSERT INTO alumnos (idAlumno, 
							matriculaAlumno,
							apellidoPaternoAlumno,
							apellidoMaternoAlumno,
							nombreAlumno,
							correoAlumno,
							correoAlternativoAlumno,
							celularAlumno,
							carreraAlumno,
							unidadAcademicaAlumno,
							sexoAlumno,
							edadAlumno,
							empresaAlumno,
							contraseniaAlumno,
							semestreAlumno,
							grupoAlumno,
							fechaRegistroAlumno,
							periodoAlumno) 
						VALUES (NULL, 
							'".$this->matricula."',
							'".$this->apellidoPaterno."',
							'".$this->apellidoMaterno."',
							'".$this->nombre."',
							'".$this->correo."',
							'".$this->correoAlternativo."',
							'".$this->celular."',
							'".$this->carrera."',
							".$this->unidadAcademica.",
							'".$this->sexo."',
							'".$this->edad."',
							".$this->empresa.",
							'".$this->contrasenia."',
							'".$this->semestre."',
							'".$this->grupo."',
							'".$this->fecha."',
							'".$this->periodo."'
						)";	
			$resultado = $mysqli->query($query); 
			if (!$resultado) 
			{ 
				 return (printf ("Errormessage: %s\n", $mysqli->error)); 
			}
			else
			{ 
				$query = "SELECT COUNT(idAlumno) AS totalAlumnos FROM alumnos WHERE empresaAlumno=".$this->empresa."";
            	$resultado = $mysqli->query($query);
            	while($row = $resultado->fetch_assoc()) { 
					$this->totalIntegrantes = $row['totalAlumnos'];
				}
	            if (!$resultado) {
	                     return (printf ("Errormessage: %s\n", $mysqli->error));
	            }
	            else
	            {
	            	$query =
					"UPDATE equipos SET totalIntegrantesEquipo=".$this->totalIntegrantes." WHERE idEquipo=".$this->empresa."";
					$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
					if (!$resultado) { //condici�n
				 		return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
					}
					else
					{ 				
						/* close connection */
						$mysqli->close();
						return 'Registro exitoso';
					}
	            }
			}			
		}

		public function consultarAlumnoId(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT
						a.idAlumno,
						a.matriculaAlumno,
						a.apellidoPaternoAlumno,
						a.apellidoMaternoAlumno,
						a.nombreAlumno,
						a.sexoAlumno,
						a.correoAlumno,
						a.correoAlternativoAlumno,
						a.celularAlumno,
						a.unidadAcademicaAlumno,
						b.nombreUnidadAcademica AS nombreUnidadAcademica,
						a.carreraAlumno,
						c.nombreCarrera AS nombreCarrera,
						a.edadAlumno,
						a.empresaAlumno,
						d.nombreEmpresaEquipo AS nombreEmpresa,
						a.semestreAlumno,
						a.grupoAlumno,
						e.numeroGrupo AS numeroGrupo
					FROM alumnos 
					AS a INNER JOIN unidades AS b
						ON a.unidadAcademicaAlumno = b.claveUnidadAcademica
						INNER JOIN carreras AS c
						ON a.carreraAlumno = c.claveCarrera
						LEFT OUTER JOIN equipos AS d
						ON a.empresaAlumno = d.idEquipo
						INNER JOIN grupos AS e
						ON a.grupoAlumno = e.idGrupo
					WHERE idAlumno='".$this->id."'";
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
				public function consultarAlumnoNoId(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT
						alumnos.idAlumno,
						alumnos.matriculaAlumno,
						alumnos.apellidoPaternoAlumno,
						alumnos.apellidoMaternoAlumno,
						alumnos.nombreAlumno,
						equipos.nombreEmpresaEquipo AS nombreEmpresa,
						alumnos.constanciaAlumno,
						alumnos.constanciaEquipo
					FROM alumnos 
						INNER JOIN equipos ON equipos.idEquipo=alumnos.empresaAlumno
					WHERE equipos.periodoEmpresaEquipo='".$this->periodo."'";
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
		public function updateConstancia(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE alumnos SET constanciaAlumno='si' WHERE matriculaAlumno = '".$this->matricula."' "; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			
			/* close connection */
			$mysqli->close();
			return '';
		}
		public function updateConstanciaDos(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE alumnos SET constanciaAlumno='no' WHERE matriculaAlumno = '".$this->matricula."' "; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			
			/* close connection */
			$mysqli->close();
			return '';
		}
		public function updateConstanciaTres(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE alumnos SET constanciaEquipo='si' WHERE matriculaAlumno = '".$this->matricula."' "; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			
			/* close connection */
			$mysqli->close();
			return '';
		}
		public function updateConstanciaCuatro(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE alumnos SET constanciaEquipo='no' WHERE matriculaAlumno = '".$this->matricula."' "; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			
			/* close connection */
			$mysqli->close();
			return '';
		}
		public function editarAlumno(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE alumnos SET 
						matriculaAlumno='".$this->matricula."',
						apellidoPaternoAlumno='".$this->apellidoPaterno."',
						apellidoMaternoAlumno='".$this->apellidoMaterno."',
						nombreAlumno='".$this->nombre."',
						correoAlumno='".$this->correo."',
						correoAlternativoAlumno='".$this->correoAlternativo."',
						celularAlumno='".$this->celular."',
						carreraAlumno='".$this->carrera."',
						unidadAcademicaAlumno='".$this->unidadAcademica."',
						sexoAlumno='".$this->sexo."',
						edadAlumno='".$this->edad."',
						empresaAlumno=".$this->empresa.",
						semestreAlumno='".$this->semestre."',
						grupoAlumno='".$this->grupo."' 
					WHERE idAlumno='".$this->id."'"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return "Los datos se han actualizado con �xito";
			}
		}
		public function consultarCarreras(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT * FROM carreras"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			
			/* close connection */
			$mysqli->close();
			return $resultado;
		}
		public function consultarDatosIntegrantes(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT
						a.matriculaAlumno,
						a.apellidoPaternoAlumno,
						a.apellidoMaternoAlumno,
						a.nombreAlumno,
						a.sexoAlumno,
						a.correoAlumno,
						a.correoAlternativoAlumno,
						a.celularAlumno,
						a.unidadAcademicaAlumno,
						b.nombreUnidadAcademica AS nombreUnidadAcademica,
						a.carreraAlumno,
						c.nombreCarrera AS nombreCarrera,
						c.abreviaturaCarrera AS abreviaturaCarrera,
						a.empresaAlumno,
						d.nombreEmpresaEquipo AS nombreEmpresa,
						a.semestreAlumno,
						e.numeroGrupo AS grupoAlumno
					FROM alumnos 
					AS a INNER JOIN unidades AS b
						ON a.unidadAcademicaAlumno = b.claveUnidadAcademica
						INNER JOIN carreras AS c
						ON a.carreraAlumno = c.claveCarrera
						INNER JOIN equipos AS d
						ON a.empresaAlumno = d.idEquipo
						INNER JOIN grupos AS e
						ON a.grupoAlumno = e.idGrupo
					WHERE empresaAlumno='".$this->id."'
					ORDER BY a.apellidoPaternoAlumno";
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
		public function consultarIntegrantes(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT * FROM alumnos WHERE empresaAlumno='".$this->id."'"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			
			/* close connection */
			$mysqli->close();
			return $resultado;
		}
		public function registrarIntegrantes(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT COUNT(idAlumno) AS totalAlumnos FROM alumnos WHERE empresaAlumno=".$this->id."";
            $resultado = $mysqli->query($query);
            while($row = $resultado->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo
				//Declaramos las variables de los atributos de mi clase usuario
			$this->totalIntegrantes = $row['totalAlumnos'];
			}
            if (!$resultado) {
                     return (printf ("Errormessage: %s\n", $mysqli->error));
            }
            
				$query =
					"UPDATE equipos SET totalIntegrantesEquipo=".$this->totalIntegrantes." WHERE idEquipo=".$this->id."";
			//echo $query;
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				 return (printf ("Errormessage: %s\n", $mysqli->error)); //Devuelve el c�digo de error de la �ltima llamada
			}
			else{ //Lo contrario de if en la condici�n
				
				/* close connection */
				$mysqli->close();
				return 'Registro exitoso';
			}
		}
		public function actualizarGrupo(){
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "UPDATE alumnos 
					  SET grupoAlumno='".$this->grupo."'
					  WHERE matriculaAlumno='".$this->matricula."'"; //sentencia para mostrar todos los resgistros de una tabla
			$resultado = $mysqli->query($query); //env�a una �nica consulta a la base de datos 
			if (!$resultado) { //condici�n
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el c�digo de error de la �ltima llamada
			}
			
			/* close connection */
			$mysqli->close();
			return "";
		}
		public function eliminarAlumno(){			
			/* conexi�n a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);			
			/* check connection */
			if (mysqli_connect_errno()) { //condici�n
			    return (printf("Error de conexi�n: %s\n", mysqli_connect_error())); //Devuelve el c�digo de error de la �ltima llamada
			    exit(); //salir
			}
			mysqli_set_charset($mysqli,"utf8");
				$query = "DELETE FROM alumnos WHERE idAlumno='".$this->id."'";	
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
