<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
  if(isset($_SESSION['login']))
  {
  	include('menuAdmin.php');
  }
  else
  {
  	include('menuInicio.php');
  }
  
  require 'lib/asesores.php';
	require 'lib/alumnos.php';
	require 'lib/periodos.php';

  $equipos = new equipos($datosConexionBD);
  $result = $equipos->consultarEmpresas();
  $asesores = new asesores($datosConexionBD);
  $result2 = $asesores->consultarUnidades();
  $alumnos =  new alumnos($datosConexionBD);
  $result3 = $alumnos->consultarCarreras();
  $grupos = new grupos($datosConexionBD);
	$result4 = $grupos->consultarGrupos();
	$periodos = new periodos($datosConexionBD);
	$result5 = $periodos->consultaPeriodos();
?>
<!DOCTYPE html>
<html lang="es-MX">
	<!-- -Construccion del HEAD- -->
	<head>
	</head>
	<!-- -Construccion del BODY- -->
	<body>
<br>

<br>

<br>

<br>

<br>

<br>

<br>

<br>

<br>

<section class="tituloRegistroMaestro">

		<p>REGISTRO DE ALUMNOS

		</p>

</section>

<br>

<section class="formRegistroMaestro">

<form  id="altaUsuario" method="POST">
	<input type="hidden" name="fecha" id="fecha" value="<?= date("h:i:a");?> <?= date("y/m/d");?>"> 
  <div class="form-group">
  <label>Matrícula</label>
    <input type="text" class="form-control" id="matricula" required>
  </div>
  <div class="form-group">
  	<label>Nombre(s)</label>
    <input type="text" class="form-control" id="nombre" required>
  </div>
  <div class="form-group">
  	<label>Apellido Paterno</label>
    <input type="text" class="form-control" id="apellidoPaterno" required>
  </div>
  <div class="form-group">
  <label>Apellido Materno</label>
    <input type="text" class="form-control" id="apellidoMaterno" required>
  </div>
  <div class="form-group">
  	<label>Correo electrónico</label>
    <input type="email" class="form-control" id="correo" autocomplete="off" required>
  </div>
  <div class="form-group">
  	<label>Contraseña</label>
    <input type="password" class="form-control" id="contrasenia" autocomplete="off" autosave="off" required>
  </div>
    <div class="form-group">
  	<label>Correo electrónico alternativo (opcional)</label>
    <input type="text" class="form-control" id="correoAlternativo" autocomplete="off" autosave="off">
  </div>
   <div class="form-group">
    <label>Unidad Académica</label><br>
  <select id='unidadAcademica' required><option selected value='' hidden>--Seleccione una opción--</option>
    <?php	
		while($row = $result2->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo	
			echo"<option value='".$row['claveUnidadAcademica']."'>".$row['nombreUnidadAcademica']." </option> ";
		}
	?>
</select>
</div>
<div class="form-group">
	 <label>Semestre</label><br>
	 <select id='semestre' required>
	  <option selected value='' hidden>--Seleccione una opción--</option>	
	  <option value="6to">6to</option>
	  <option value="7mo">7mo</option>
	  <option value="8vo">8vo</option>
	</select>
  </div>
<div class="form-group">
  	<label>Grupo</label><br>
  	<select id='grupo' required><option selected value='' hidden>--Seleccione una opción--</option>
    <?php	
		while($row = $result4->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo	
			echo"<option value='".$row['idGrupo']."'>".$row['numeroGrupo']." </option> ";
		}
	?>
	</select>
</div>
<div class="form-group">
  <label>Carrera</label><br>
  <select id='carrera' required><option selected value='' hidden>--Seleccione una opción--</option>
    <?php	
		while($row = $result3->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo	
			echo"<option value='".$row['claveCarrera']."'>".$row['nombreCarrera']." </option> ";
		}
	?>
</select>
  </div>

	<div class="form-group">
  <label>Periodo</label><br>
  <select id='periodo' required><option selected value='' hidden>--Seleccione una opción--</option>
    <?php	
		while($row = $result5->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo	
			echo"<option value='".$row['periodo']."'>".$row['periodo']." </option> ";
		}
	?>
</select>
  </div>

  <div class="form-group">
  	<label>Celular</label>
    <input type="text" class="form-control" id="celular" required>
  </div>
  <div class="form-group">
  	<label>Edad</label>
    <input type="text" class="form-control" id="edad" required>
  </div>
  <label>Género</label>
  <div class="form-group">
    <input type="radio" name="sexo" id="sexo" value="M" required> Masculino<br>
    <input type="radio" name="sexo" id="sexo" value="F" required> Femenino
  </div>
  <div class="form-group">
  <label>Tu empresa es</label><br>
  <select id='empresa' required><option selected value='' hidden>--Seleccione una opción--</option>
    <?php	
		while($row = $result->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo	
			echo"<option value='".$row['idEquipo']."'>".$row['nombreEmpresaEquipo']." </option> ";
		}
	?>
</select>
  </div>
  <br>
  <input type="submit" class="btn btn-primary" value="Registrar"></input>

</form>

</section>

		<!-- -Comienza Footer- -->



				<?php include("footer.php"); ?>



		</footer>
		<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery/jquery.maskedinput.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){	
		$("#altaUsuario").submit(function(e){ 
			var confirmar=confirm("¿Estás seguro de que tus datos son correctos? Estos datos se utilizarán para generar tu constancia");
          if(confirmar==true){
			$.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
				type: "POST", //tipo por donde se va a mandar los datos
				url: "views/actionAltaAlumnos.php",
				data:"matricula="+$("#matricula").val()+
				'&nombre='+$("#nombre").val()+
				'&apellidoPaterno='+$("#apellidoPaterno").val()+
				'&apellidoMaterno='+$("#apellidoMaterno").val()+
				'&correo='+$("#correo").val()+
				'&correoAlternativo='+$("#correoAlternativo").val()+
				'&celular='+$("#celular").val()+
				'&sexo='+$("#sexo:checked").val()+
				'&semestre='+$("#semestre").val()+
				'&carrera='+$("#carrera").val()+
				'&edad='+$("#edad").val()+
				'&empresa='+$("#empresa").val()+
				'&unidadAcademica='+$("#unidadAcademica").val()+
				'&fecha='+$("#fecha").val()+
				'&contrasenia='+$("#contrasenia").val()+
				'&grupo='+$("#grupo").val()+
				'&periodo='+$("#periodo").val()
			}).done(function(result){
				alert (result);
				location.reload();;							
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
<script type="text/javascript">
	jQuery(function($){
   $("#celular").mask("(999) 999-9999");
});
</script>
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
	</body>

</html>