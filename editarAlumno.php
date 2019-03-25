<?php

	session_start(); // Iniciar una nueva sesión o reanudar la existente
	if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==1) {
    	include('menuAlumno.php');
        include 'config.php';
      require 'lib/asesores.php';
      require 'lib/alumnos.php';
      require 'lib/grupos.php';
    	$equipos = new equipos($datosConexionBD);
    	$result = $equipos->consultarEmpresas();
    	$asesores = new asesores($datosConexionBD);
    	$result2 = $asesores->consultarUnidades();
    	$grupos = new grupos($datosConexionBD);
      $result5 = $grupos->consultarGrupos();
    	$alumnos = new alumnos($datosConexionBD);
    	$alumnos->id =$_SESSION['id'];
    	$result3 = $alumnos->consultarCarreras();
    	$result4 = $alumnos->consultarAlumnoId();
    }
    else if ($_SESSION['rol']==2) {
      include('menuAdmin.php');
      require 'lib/asesores.php';
      require 'lib/alumnos.php';
      $equipos = new equipos($datosConexionBD);
      $result = $equipos->consultarEmpresas();
      $asesores = new asesores($datosConexionBD);
      $result2 = $asesores->consultarUnidades();
      $grupos = new grupos($datosConexionBD);
      $result5 = $grupos->consultarGrupos();
      $alumnos = new alumnos($datosConexionBD);
      $alumnos->id =$_REQUEST['id'];
      $result3 = $alumnos->consultarCarreras();
      $result4 = $alumnos->consultarAlumnoId();
    }
    if ($_SESSION['rol']==1 || $_SESSION['rol']==2 ) {
    while($row = $result4->fetch_assoc()) {

      $id = $row['idAlumno']; 
      $matricula = $row['matriculaAlumno'];
      $apellidoPaterno = $row['apellidoPaternoAlumno']; 
      $apellidoMaterno = $row['apellidoMaternoAlumno'];
      $nombre = $row['nombreAlumno'];
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
      $semestre = $row['semestreAlumno'];
      $grupo = $row['grupoAlumno'];
      $numeroGrupo = $row['numeroGrupo'];
    }
?>

<!DOCTYPE html>
<html lang="es-MX">
	<!-- -Construccion del HEAD- -->
	<head>
      <script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
      <script type="text/javascript" src="js/jquery/jquery.maskedinput.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){	
				$("#altaUsuario").submit(function(e){ 
		      var confirmar=confirm("¿Estás seguro de que tus datos son correctos? Estos datos serán utilizados para generar tu constancia");
		          if(confirmar==true){
					$.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
						type: "POST", //tipo por donde se va a mandar los datos
						url: "views/actionEditarAlumno.php",
				        data:"id="+$("#id").val()+
            '&matricula='+$("#matricula").val()+
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
						'&grupo='+$("#grupo").val()
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
<script type="text/javascript">
  jQuery(function($){
   $("#celular").mask("(999) 999-9999");
});
</script>
	</head>

	<!-- -Construccion del BODY- -->
  <br><br><br><br><br><br><br><br><br><br>

	<body>
<section class="tituloRegistroMaestro">

		<p>EDITAR MI INFORMACIÓN

		</p>

</section>

<br>

<section class="formRegistroMaestro">

<form  id="altaUsuario" method="POST">
<div class="form-group">
  <input type="hidden" name="id" id="id" value="<?= $id; ?>"></input> 
  
  <label>Matrícula</label>
    <input type="text" class="form-control" id="matricula" value="<?= $matricula; ?>"required>
  </div>
  <div class="form-group">
    <label>Nombre(s)</label>
    <input type="text" class="form-control" id="nombre" value="<?= $nombre; ?>" required>
  </div>
  <div class="form-group">
    <label>Apellido Paterno</label>
    <input type="text" class="form-control" id="apellidoPaterno" value="<?= $apellidoPaterno; ?>" required>
  </div>
  <div class="form-group">
  <label>Apellido Materno</label>
    <input type="text" class="form-control" id="apellidoMaterno" value="<?= $apellidoMaterno; ?>" required>
  </div>
  <div class="form-group">
    <label>Correo electrónico</label>
    <input type="email" class="form-control" id="correo" value="<?= $correo; ?>" required>
  </div>
    <div class="form-group">
    <label>Correo electrónico alternátivo (opcional)</label>
    <input type="text" class="form-control" id="correoAlternativo" value="<?= $correoAlternativo; ?>">
  </div>
   <div class="form-group">
    <label>Unidad Académica</label><br>
  <select id='unidadAcademica' required><option selected hidden value="<?= $unidadAcademica; ?>" >--<?= $nombreUnidadAcademica; ?>--</option>
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
    <option selected hidden value="<?= $semestre; ?>" >--<?= $semestre; ?>--</option>
    <option value="6to">6to</option>
    <option value="7mo">7mo</option>
    <option value="8vo">8vo</option>
  </select>
  </div>
<div class="form-group">
  	<label>Grupo</label><br>
  	<select id='grupo' required><option selected hidden value="<?= $grupo; ?>" >--<?= $numeroGrupo; ?>--</option>
    <?php	
		while($row = $result5->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo	
			echo"<option value='".$row['idGrupo']."'>".$row['numeroGrupo']." </option> ";
		}
	?>
	</select>
</div>
<div class="form-group">
  <label>Carrera</label><br>
  <select id='carrera' required><option selected hidden value="<?= $carrera; ?>" >--<?= $nombreCarrera; ?>--</option>
    <?php 
    while($row = $result3->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo 
      echo"<option value='".$row['claveCarrera']."'>".$row['nombreCarrera']." </option> ";
    }
  ?>
</select>
  </div>
  <div class="form-group">
    <label>Celular</label>
    <input type="text" class="form-control" id="celular" value="<?= $celular; ?>" required>
  </div>
  <div class="form-group">
    <label>Edad</label>
    <input type="text" class="form-control" id="edad" value="<?= $edad; ?>" required>
  </div>
  <label>Género</label>
  <div class="form-group">
   <?php
    if ($sexo=="M") 
    {
    ?>
      <input type="radio" name="sexo" id="sexo" value="M" checked required>  Masculino<br>
      <input type="radio" name="sexo" id="sexo" value="F" required> Femenino
    <?php
    }
    else if ($sexo=="F") 
    {
    ?>
      <input type="radio" name="sexo" id="sexo" value="M" required> Masculino<br>
      <input type="radio" name="sexo" id="sexo" value="F" checked required> Femenino
    <?php
    }
    ?>
  </div>
  <div class="form-group">
  <label>Tú empresa es</label><br>
  <select id='empresa' required><option selected hidden value="<?= $empresa; ?>" >--<?= $nombreEmpresa; ?>--</option>
    <?php 
    while($row = $result->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo  
      echo"<option value='".$row['idEquipo']."'>".$row['nombreEmpresaEquipo']." </option> ";
    }
  ?>
</select>
  </div>
  <br>
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