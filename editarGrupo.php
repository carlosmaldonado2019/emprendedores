<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
  include 'config.php';
  $grupos = new grupos($datosConexionBD);
  $grupos->id =$_REQUEST['id'];
  $result = $grupos->consultarGruposId();
  
  while ($row=$result->fetch_assoc()) {
    $id=$row['idGrupo'];
    $grupo=$row['numeroGrupo'];
    $id=$row['idGrupo'];
    $turno=$row['turnoGrupo'];
    $inscritos=$row['inscritosGrupo'];
    $periodo=$row['periodoGrupo'];
  }
?>
<!DOCTYPE html>

<html lang="es-MX">

	<!-- -Construccion del HEAD- -->

	<head>
	<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>

		<script type="text/javascript">
	$(document).ready(function(){	
		$("#altaEquipo").submit(function(e){
			var confirmar=confirm("¿Estás seguro de los datos son correctos?");
          if(confirmar==true){
			$.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
				type: "POST", //tipo por donde se va a mandar los datos
				url: "views/actionEditarGrupo.php",
				data:"id="+$("#id").val()+
        "&grupo="+$("#grupo").val()+
				'&turno='+$("#turno").val() +
				'&inscritos='+$("#inscritos").val() +
				'&periodo='+$("#periodo").val()
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

		<p>REGISTRO DE GRUPOS

		</p>

</section>

<br>

<section class="formRegistroMaestro">

<form  id="altaEquipo" method="POST">

  <div class="form-group">
  	<label>Grupo</label>
    <input type="text" class="form-control" id="grupo" value="<?=$grupo?>" required>
  </div>
  <div class="form-group">
   <label>Turno</label><br>
    <select id="turno" required>
      <option selected hidden value="<?=$turno;?>" hidden>--<?=$turno;?>--</option>
      <option value="Matutino">Matutino</option>
      <option value="Vespertino">Vespertino</option>
    </select>
  </div>
  <div class="form-group">
    <label>Cantidad de alumnos inscritos</label><br>
    <input type="number" id="inscritos" min="0" value="<?=$inscritos;?>" required>
  </div>
  <div class="form-group">
    <label>Periodo</label>
    <input type="text" class="form-control" id="periodo" value="<?=$periodo;?>" placeholder="xxxx-x" required>
  </div>
  <br>
  <input type="hidden" id="id" value="<?=$id;?>"></input>
  <input type="submit" class="btn btn-primary" value="Actualizar"></input>
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
  header("LOCATION: http://emprendedores.fcauabc.com"); //Redirección del navegador
}
?>