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
  
  include 'config.php';
  require 'lib/asesores.php';
  $asesores = new asesores($datosConexionBD);
  $result = $asesores->consultarUnidades();
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
		<p>REGISTRO DE ASESORES
		</p>
</section>
<br>
<section class="formRegistroMaestro">
<form  id="altaUsuario" method="POST">
  <div class="form-group">
    <label>Número de empleado</label>
    <input type="text" class="form-control" id="numeroEmpleado" required>
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
    <input type="password" class="form-control" id="contrasenia" autocomplete="off" required>
  </div>
  <div class="form-group">
  	<label>Correo electrónico alternativo (opcional)</label>
    <input type="email" class="form-control" id="correoAlternativo" autocomplete="off">
  </div>
  <div class="form-group">
  	<label>Celular</label>
    <input type="text" class="form-control" id="celular" required>
  </div>
  <div class="form-group">
    <label>Género</label><br>
    <input type="radio" name="sexo" id="sexo" value="M" required> Masculino<br>
    <input type="radio" name="sexo" id="sexo" value="F" required> Femenino
  </div>
  <div class="form-group">
    <label>Unidad Académica</label><br>
  <select id='unidadAcademica' required><option selected value='' hidden>--Seleccione una opción--</option>
    <?php	
		while($row = $result->fetch_assoc()) { //while es un ciclo, fetch_assoc recupera una fila de resultados como un array asociativo	
			echo"<option value='".$row['claveUnidadAcademica']."'>".$row['nombreUnidadAcademica']." </option> ";
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
<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){ 
    $("a#pdf").click(function(e){
      window.print();
    });
  });        <script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="js/jquery/jquery.maskedinput.js"></script>
        <script type="text/javascript">
    $(document).ready(function(){ 
    $("#altaUsuario").submit(function(e){ 
      var confirmar=confirm("¿Estás seguro de que tus datos son correctos? Estos datos se utilizarán para generar tu constancia");
          if(confirmar==true){
            $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
              type: "POST", //tipo por donde se va a mandar los datos
              url: "views/actionAltaAsesor.php",
              data:"numeroEmpleado="+$("#numeroEmpleado").val()+
              '&nombre='+$("#nombre").val()+
              '&apellidoPaterno='+$("#apellidoPaterno").val()+
              '&apellidoMaterno='+$("#apellidoMaterno").val()+
              '&correo='+$("#correo").val()+
              '&correoAlternativo='+$("#correoAlternativo").val()+
              '&celular='+$("#celular").val()+
              '&sexo='+$("#sexo:checked").val()+
              '&unidadAcademica='+$("#unidadAcademica").val()+
              '&contrasenia='+$("#contrasenia").val()
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