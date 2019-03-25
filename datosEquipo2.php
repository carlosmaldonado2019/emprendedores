<?php
	session_start();
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==0) {
      include('menuMaestro.php');
    }
    elseif ($_SESSION['rol']==1) {
      include('menuAlumno.php');
    }
    elseif ($_SESSION['rol']==2) {
      include('menuAdmin.php');
    }
  }
  else{
    include('menuInicio.php');
  }
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
 <br><br><br><br><br><br><br><br><br><br>
	<body>
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
        <li style="list-style-image: url('imagenes/check.png');"><?php echo $row['nombreAlumno']." ".$row['apellidoPaternoAlumno']." ".$row['apellidoMaternoAlumno'];?></li>
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
      <?php echo $descripcionEmpresa;?><br><br>
      <button><a href="output.php?t=pdf&idEquipo=<?=$_REQUEST['idEquipo'];?>">Imprimir registro</a></button>
    </p>
  </div> 
</section>
<br><br><br><br><br><br><br><br><br>
		<!-- -Comienza Footer- -->

		<footer class="container">

			<article>

        <small><strong>
        Universidad Autónoma de Baja California</strong><br>
        Facultad de Ciencias Administrativas<br>
        Campus Mexicali</small><br><br>
        <small>Dr. Francisco Meza Hernández</small><br>
        <small><strong>Coordinador de Emprendedores y Coordinación de Costos</strong></small><br><br>
        <small><strong>Correo electrónico:</strong>fmeza@uabc.edu.mx</small>
        <small><strong>Oficina:</strong>(686) 5-82-33-77 Ext. 45031</small>
        <small><strong> Celular:</strong>044 (686) 5-69-67-16</small><br>
        <small>Blvd. Río Nuevo y Eje Central s/n Zona Río Nuevo C.P. 21330 Mexicali, B.C. </small>

      </article>

		</footer>

	</body>

</html>
<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
    <script>
    $(document).ready(function(){
  $('.dropdown a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.smartmenus.js"></script>
<script type="text/javascript" src="js/jquery/jquery.smartmenus.bootstrap.js"></script>
