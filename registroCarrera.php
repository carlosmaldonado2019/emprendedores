<?php
	session_start(); // Iniciar una nueva sesión o reanudar la existente
	if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
		if ($_SESSION['rol']==2) {
	include('menuAdmin.php');
  require 'lib/unidades.php';
  $unidades = new unidades($datosConexionBD);
  $result = $unidades->consultarUnidades();
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
				url: "views/actionAltaCarrera.php",
				data:"clave="+$("#clave").val()+
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
    <input type="text" class="form-control" id="clave" required>
  </div>
  <div class="form-group">
    <label>Nombre</label><br>
    <input type="text" class="form-control" id="nombre" required>
  </div>
  <div class="form-group">
    <label>Abreviatura</label>
    <input type="text" class="form-control" id="abreviatura" required>
  </div>
  <div class="form-group">
   <label>Unidad Académica</label><br>
    <select id="unidad" required>
      <option selected hidden value="" hidden>--Seleccione una opción--</option>
      <?php     
          while($row = $result->fetch_assoc()) {
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
  });
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