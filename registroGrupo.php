<?php
	session_start(); // Iniciar una nueva sesión o reanudar la existente
	if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
		if ($_SESSION['rol']==2) {
	include('menuAdmin.php');
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
				url: "views/actionAltaGrupo.php",
				data:"grupo="+$("#grupo").val()+
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
    <input type="hidden" class="form-control" id="asesor" aria-describedby="emailHelp" value="<?=$_SESSION['id'];?>">
  </div>
  <div class="form-group">
  	<label>Grupo</label>
    <input type="text" class="form-control" id="grupo" required>
  </div>
  <div class="form-group">
   <label>Turno</label><br>
    <select id="turno" required>
      <option selected hidden value="" hidden>--Seleccione una opción--</option>
      <option value="Matutino">Matutino</option>
      <option value="Vespertino">Vespertino</option>
    </select>
  </div>
  <div class="form-group">
    <label>Cantidad de alumnos inscritos</label><br>
    <input type="number" id="inscritos" min="0" required>
  </div>
  <div class="form-group">
    <label>Periodo</label>
    <input type="text" class="form-control" id="periodo" placeholder="xxxx-x" required>
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