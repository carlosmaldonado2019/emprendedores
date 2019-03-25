<?php 
    class periodos{
        var $id;
        var $periodo;
        private $datosConexionBD;

        function __construct($datosConexionBD){
			$this->datosConexionBD=$datosConexionBD;
        }
        
        public function consultaPeriodos(){
			/* conexi�n a la base de datos */
            $mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);            
			if (mysqli_connect_errno()) { //condici�n
				printf("Error de conexi�n: %s\n", mysqli_connect_error()); //Devuelve el c�digo de error de la �ltima llamada
				exit();
            }
            mysqli_set_charset($mysqli,"utf8");
            $query = "SELECT a.idPeriodo,a.periodo
                        FROM periodos as a";
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
    }
?>