<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
  include 'config.php';
  include 'lib/carreras.php';
  $carreras = new carreras($datosConexionBD);
  $carreras->id =$_REQUEST['id'];
  $result = $carreras->consultarCarrerasId();

  require 'lib/unidades.php';
  $unidades = new unidades($datosConexionBD);
  $result2 = $unidades->consultarUnidades();
  
  while ($row=$result->fetch_assoc()) {
    $id=$row['idCarrera'];
    $clave=$row['claveCarrera'];
    $nombre=$row['nombreCarrera'];
    $abreviatura=$row['abreviaturaCarrera'];
    $nombreUnidadAcademica=$row['nombreUnidadAcademica'];
    $claveUnidadAcademica=$row['claveUnidadAcademica'];
  }
?>
<!DOCTYPE html>

<html lang="es-MX">

	<!-- -Construccion del HEAD- -->

	<head>
	<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>

		<script type="text/javascript">
	$(document).ready(function(){	
		$("#altaCarrera").submit(function(e){
			var confirmar=confirm("¿Estás seguro de que los datos son correctos?");
          if(confirmar==true){
			$.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
				type: "POST", //tipo por donde se va a mandar los datos
				url: "views/actionEditarCarrera.php",
				data:"id="+$("#id").val()+
        "&clave="+$("#clave").val()+
				'&nombre='+$("#nombre").val() +
				'&abreviatura='+$("#abreviatura").val() +
				'&unidad='+$("#unidad").val()
			}).done(function(result){
				alert (result);
				location.reload();	
			});
		return false;
		 }
        else
        {
          return false;
        }
		});
	});
</script>
	</head>

	<!-- -Construccion del BODY- -->
<br><br><br><br><br><br><br><br><br><br>
	<body>
<section class="tituloRegistroMaestro">

		<p>REGISTRO DE CARRERAS

		</p>

</section>

<br>

<section class="formRegistroMaestro">

<form  id="altaCarrera" method="POST">
  <div class="form-group">
  	<label>Clave</label>
    <input type="text" class="form-control" id="clave" value="<?=$clave;?>" required>
  </div>
  <div class="form-group">
    <label>Nombre</label><br>
    <input type="text" class="form-control" id="nombre" value="<?=$nombre;?>" required>
  </div>
  <div class="form-group">
    <label>Abreviatura</label>
    <input type="text" class="form-control" id="abreviatura" value="<?=$abreviatura;?>" required>
  </div>
  <div class="form-group">
   <label>Unidad Académica</label><br>
    <select id="unidad" required>
      <option selected hidden value="<?=$claveUnidadAcademica;?>" hidden>--<?=$nombreUnidadAcademica;?>--</option>
      <?php     
          while($row = $result2->fetch_assoc()) {
           echo"<option value='".$row['claveUnidadAcademica']."'>".$row['nombreUnidadAcademica']." </option> ";
            }
      ?>
    </select>
  </div>
  <br>
  <input type="hidden" id="id" value="<?=$id;?>"></input>
  <input type="submit" class="btn btn-primary" value="Registrar"></input>
</form>
</section>

		<!-- -Comienza Footer- -->

		<footer class="container">

			<article>
<small><strong>
				Universidad Autónoma de Baja California</strong><br>
				Facultad de Ciencias Administrativas<br>
				Campus Mexicali</small><br><br>
				<small>Dr. Francisco Meza Hernández</small><br>
				<small><strong>Coordinador de Emprendedores y Coordinación de Costos</strong></small><br><br>
				<small><strong>Correo electrónico: </strong>fmeza@uabc.edu.mx</small>
				<small><strong>Oficina: </strong>(686) 5-82-33-77 Ext. 45031</small>
				<small><strong> Celular: </strong>044 (686) 5-69-67-16</small><br><br>
                                <small><strong> Dudas: </strong>Dra. Sandra Julieta Saldivar Gonzalez</small><br>
                                <small><strong>Coordinadora de la Maestr&iacute;a en Gestion de Tecnologias de informaci&oacute;n y Comunicaci&oacute;n</strong></small><br><br>
                                <small><strong>Correo electrónico: </strong>yuly@uabc.edu.mx</small>
				<small><strong>Celular: </strong>(686) 221-6149</small><br><br>

				<small>Blvd. Río Nuevo y Eje Central s/n Zona Río Nuevo C.P. 21330 Mexicali, B.C. </small>

			</article>

		</footer>

	</body>

</html>
<?php
	 }
  else
  {
    echo "Acceso denegado";
  }
}else{
  header("LOCATION: http://fcauabc.com/emprendedores/"); //Redirección del navegador
}
?>