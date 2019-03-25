<?php
    include('menuAdmin.php');
    include 'config.php';
    require 'lib/alumnos.php';
    $alumnos = new alumnos($datosConexionBD);
    $equipos->id =$_REQUEST['idEquipo'];
    $alumnos->id =$_REQUEST['idEquipo'];
    $result = $equipos->consultarAsesorEquipo();
    $result2 = $alumnos->consultarIntegrantes();

    while($row = $result->fetch_assoc()) {
      $nombreEmpresa=strtoupper($row['nombreEmpresaEquipo']);
      $descripcionEmpresa=strtoupper($row['descripcionEmpresaEquipo']);
      $nombreProducto=strtoupper($row['nombrePSEquipo']);
      $nombreAsesor=strtoupper($row['nombreAsesor']);
      $apellidoPaternoAsesor=strtoupper($row['apellidoPaternoAsesor']);
      $apellidoMaternoAsesor=strtoupper($row['apellidoMaternoAsesor']);
    }

?>

<!DOCTYPE html>

<html lang="es-MX">

	<!-- -Construccion del HEAD- -->

	<head>
  	<script type="text/javascript">
    $(document).ready(function(){ 
      $("#actualizarEquipo").submit(function(e){ //Función de JavaScript donde recibe todos los elementos del formulario 
        $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
          type: "POST", //tipo por donde se va a mandar los datos
          url: "views/actionActualizarEquipo.php",
          data:"id="+$("#id").val()+
          '&asesor='+$("#asesor").val()+
          '&nombre='+$("#nombre").val() +
          '&nombrePS='+$("#nombrePS").val() +
          '&descripcion='+$("#descripcion").val() + 
          '&clase='+$("#clase").val() +
          '&giro='+$("#giro").val()+
          '&periodo='+$("#periodo").val()
        }).done(function(result){
          alert ("Los datos han sido actualizados con éxito");
          location.href="principalMaestro.php";  
        });
      return false;
      });
    });
  </script>
	</head>

	<!-- -Construccion del BODY- -->
	<body>
<br><br><br><br><br><br><br><br><br>
<section class="tituloEquipo">
		<p><?=$nombreEmpresa;?></p>
</section>
<section class="datosEquipo">
  <div class="form-group">
    <label style="color: #39b54a;">Maestro asesor</label><br>
    <?php echo $nombreAsesor." ".$apellidoPaternoAsesor." ".$apellidoMaternoAsesor;?>
    <br><br>
    <label style="color: #39b54a;">Integrantes del equipo</label>
    <br>
    <ul>
      <?php
        while($row = $result2->fetch_assoc()) {
      ?>
        <li style="list-style-image: url('imagenes/check.png');"><?php echo strtoupper($row['nombreAlumno'])." ".strtoupper($row['apellidoPaternoAlumno'])." ".strtoupper($row['apellidoMaternoAlumno']);?></li>
      <?php
      }
      ?>
    </ul>
    <br>
    <label style="color: #39b54a;">Nombre del producto/servicio</label>
    <p>
      <?php echo $nombreProducto;?>
    </p>
    <br>
    <label style="color: #39b54a;">Descripción del producto/servicio</label>
    <p>
      <?php echo $descripcionEmpresa;?>
    </p>
  </div> 
</section>
		<!-- -Comienza Footer- -->

		<footer class="container">

			<article>

				<small>Bulevar Río Nuevo, Agualeguas, 21090 Mexicali, B.C.</small>

				<small>Teléfono: 01 686 582 3334</small>

				<small>Correo electrónico: ejemplo@ejemplo.com</small>

			</article>

		</footer>

	</body>

</html>
