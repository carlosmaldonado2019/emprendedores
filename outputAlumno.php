<?php
session_start();
include 'config.php';
require 'lib/alumnos.php';
$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'excel';
$extension = '.xls';
$id=$_REQUEST['id'];
$alumnos = new alumnos($datosConexionBD);
$alumnos->id =$id;
$result = $alumnos->consultarAlumnoId();
while($row = $result->fetch_assoc()) {
      $matricula = $row['matriculaAlumno'];
      $apellidoPaterno = $row['apellidoPaternoAlumno']; 
      $apellidoMaterno = $row['apellidoMaternoAlumno'];
      $nombre =  $row['nombreAlumno'];
      $correo = $row['correoAlumno'];
      $correoAlternativo = $row['correoAlternativoAlumno'];
      $celular = $row['celularAlumno'];
      $carrera = $row['carreraAlumno'];
      $nombreCarrera = $row['nombreCarrera'];
      $unidadAcademica = $row['unidadAcademicaAlumno'];
      $nombreUnidadAcademica = $row['nombreUnidadAcademica'];
      $sexo = $row['sexoAlumno'];
      $edad = $row['edadAlumno'];
      $empresa = $row['empresaAlumno'];
      $nombreEmpresa = $row['nombreEmpresa'];
      $contrasenia= $row['contraseniaAlumno'];
      $turno = $row['turnoAlumno'];
      $semestre = $row['semestreAlumno'];
      $grupo = $row['grupoAlumno'];
    }
$html="<meta charset='utf-8'>

		<p>
			<img style='width:780px;height:240px;' src='imagenes/Constancia Alumnos 2018-2 Header.JPG'>
		</p>
		<div style='margin-left:170px;width:480px;text-align:center;font-size:22px;'>
			$nombre $apellidoPaterno $apellidoMaterno
		</div
		<p>
			<img style='width:780px;height:275px;' src='imagenes/Constancia Alumnos 2018-2 Footer.JPG'>
		</p>";

require_once 'lib/dompdf/dompdf_config.inc.php';
$dompdf = new DOMPDF();
$dompdf->set_paper("letter", "landscape");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("constancia.pdf");
?>