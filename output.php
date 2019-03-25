<?php
	include 'config.php';
    require 'lib/equipos.php';
    require 'lib/alumnos.php';
    $equipos = new equipos($datosConexionBD);
    $alumnos = new alumnos($datosConexionBD);
    $equipos->id =$_REQUEST['idEquipo'];
    $alumnos->id =$_REQUEST['idEquipo'];
    $result = $equipos->consultarAsesorEquipo();
    $result2 = $alumnos->consultarDatosIntegrantes();

    while($row = $result->fetch_assoc()) {
      $idEquipo=$row['idEquipo'];
      $nombreEmpresa=$row['nombreEmpresaEquipo'];
      $descripcionEmpresa=$row['descripcionEmpresaEquipo'];
      $nombreProducto=$row['nombrePSEquipo'];
      $nombreAsesor=$row['nombreAsesor'];
      $apellidoPaternoAsesor=$row['apellidoPaternoAsesor'];
      $apellidoMaternoAsesor=$row['apellidoMaternoAsesor'];
      $unidadAcademica=$row['unidadAcademica'];
      $periodoEmpresa=$row['periodoEmpresaEquipo'];
      $rubroEmpresa=$row['claseEmpresaEquipo'];

      if ($unidadAcademica==10) 
      {
      	$unidadAcademica="FACULTAD DE CIENCIAS AGRÍCOLAS";
      }
      elseif ($unidadAcademica==90) 
      {
      	$unidadAcademica="FACULTAD DE CIENCIAS ADMINISTRATIVAS";
      }
    }
$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'excel';

$extension = '.xls';

require_once 'lib/dompdf/dompdf_config.inc.php';

    

    $dompdf = new DOMPDF();

    $dompdf->set_paper("letter", "landscape");

    $html="<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>

    <div style='width:605px;'>
    		<div style='width:135px;display:inline-block;text-align:center; position:center;'><img src='imagenes/logoUABC.jpg' style='width:70px;height:70px;'>

    		</div>
			<div style='width:400px;display:inline-block;vertical-align:middle;'><p style='text-align:center;margin-left:60px;'>
				<strong>UNIVERSIDAD AUT&Oacute;NOMA DE BAJA CALIFORNIA</strong><br>
				FACULTAD DE CIENCIAS ADMINISTRATIVAS<br><br>
				<strong>Expo Emprendedora</strong><br>
				<small>Semestre $periodoEmpresa</small><br>
					<i>Ficha de registro empresarial</i><br>
			</div>	
			<img src='imagenes/emprendedores.jpg' style='width:70px;height:60px;margin-left:145px;'>
	</div>
	<div style='width:510px;text-align:right;margin-left:235px;'>
		<p>
			<div style='font-weight:bold;font-size:10pt;'>Facultad: $unidadAcademica</div> <br>
			<div style='font-weight:bold;font-size:10pt;'>Asesor: $nombreAsesor $apellidoPaternoAsesor $apellidoMaternoAsesor</div><br>
			<div style='font-weight:bold;font-size:10pt;'>Grupo:</div><br>
			<div style='font-weight:bold;font-size:10pt;'>Periodo: $periodoEmpresa</div><br>
		</p>
	</div>
	<div style='width:510px;height:20px;text-align:left; position:relative;margin-left:30px;'>
		<p>
			<div style='font-size:10pt;'>Folio: $idEquipo</div> <br>
			<div style='font-size:10pt;'>Nombre de la empresa: $nombreEmpresa</div><br>
			<div style='font-size:10pt;'>Nombre del producto o servicio: $nombreProducto</div><br>
			<div style='font-size:10pt;'>Descripción del servicio: $descripcionEmpresa</div><br>
			<div style='font-size:10pt;'>Categor&iacute;: $rubroEmpresa</div><br>
		</p>
	</div>

	<br><br>

	<div style='width:535px;text-align:center; position:relative;margin-left:30px;'>

		<table style='border:.3px solid #000000;border-collapse:unset;margin:0px auto; text-align:center;width:535px; border:none;'> 
			<thead> 
			  <tr> 
					<th style='border:.3px solid #000000;border-collapse:collapse;font-size:8px;'>Matricula</th> 
					<th style='border:.3px solid #000000;border-collapse:collapse;width:95px;font-size:8px;'>Nombre Completo</th> 
					<th style='border:.3px solid #000000;border-collapse:collapse;font-size:8px;'>Carrera</th>
					<th style='border:.3px solid #000000;border-collapse:collapse;font-size:8px;'>Grupo</th>
					<th style='border:.3px solid #000000;border-collapse:collapse;font-size:8px;'>Sexo</th>  
					<th style='border:.3px solid #000000;border-collapse:collapse;font-size:8px;'>Correo</th>
					<th style='border:.3px solid #000000;border-collapse:collapse;font-size:8px;'>Celular</th>   
					<th style='border:.3px solid #000000;border-collapse:collapse;font-size:8px;'>Firma</th>
				</tr> 
			</thead>
			<tbody>	
			";
		 while($row = $result2->fetch_assoc())
		 {
		$html.="<tr>	

							<td style='border:.3px solid #000000;border-collapse:collapse;width:40px;text-align:center;font-size:8px; '>".$row['matriculaAlumno']."</td>			  

						  	<td style='border:.3px solid #000000;border-collapse:collapse;width:205px;font-size:8px; '>".$row['apellidoPaternoAlumno']." ".$row['apellidoMaternoAlumno']." ".$row['nombreAlumno']."</td>

						  	<td style='border:.3px solid #000000;border-collapse:collapse;width:120;font-size:8px; height:25px;'>".$row['nombreCarrera']."</td>

						  	<td style='border:.3px solid #000000;border-collapse:collapse;width:20;font-size:8px; '>".$row['grupoAlumno']."</td>

						  	<td style='border:.3px solid #000000;border-collapse:collapse;width:15;font-size:8px; '>".$row['sexoAlumno']." </td>

						  	<td style='border:.3px solid #000000;border-collapse:collapse;width:60;font-size:8px; '>".$row['correoAlumno']."</td>
						  	<td style='border:.3px solid #000000;border-collapse:collapse;width:55;font-size:8px; '>".$row['celularAlumno']."</td>
						  	<td style='border:.3px solid #000000;border-collapse:collapse;width:100;font-size:8px; '>&nbsp;&nbsp;&nbsp;</td>

						  </tr>";
		}

		$html.="

			</tbody>	
			<tfoot>
			 	<tr>
                  <th colspan=8 style='border:none;'>
                  	<div style='width:50%; margin:100px auto;'>
						<div style='border-top: 1px solid #000; width: 100%;'></div>
						<strong>$nombreAsesor $apellidoPaternoAsesor $apellidoMaternoAsesor</strong><br>
						<small>Firma del docente</small>
					</div>
				  </th>
				</tr>
				<tr>
				  <th colspan=8 style='border:none; height:20px;'><small>Esta ficha de Registro Empresarial deberá ser entregada por el docente a la coordinación de emprendedores.</small></th>
               	</tr>
			</tfoot>
			</table>
			
			</div>

				";

    $dompdf->load_html($html);

    $dompdf->render();

    $dompdf->stream("Registro.pdf");

 ?>

