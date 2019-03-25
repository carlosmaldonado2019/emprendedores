<?php
	include('menuInicio.php');
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

		<p>RECUPERACIÓN DE CUENTA

		</p>

</section>

<br>

<section class="login">

<form  id="login" method="POST">

  <div class="form-group">
    <input type="text" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="Correo">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="celular" aria-describedby="emailHelp" placeholder="Celular">
  </div>
  <input type="submit" class="btn btn-primary" value="Aceptar"></input>
</form>
</section>
<br><br><br><br><br><br><br><br><br><br>
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
		<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery/jquery.maskedinput.js"></script>
		<script type="text/javascript">
	$(document).ready(function(){	
		$("#login").submit(function(e){ //Función de JavaScript donde recibe todos los elementos del formulario 
			$.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
				type: "POST", //tipo por donde se va a mandar los datos
				url: "views/actionRecuperacionCuenta.php",
				data:"correo="+$("#correo").val()+
				'&celular='+$("#celular").val() 
			}).done(function(result){
				if (result == 1){ //condición
					alert ("Datos correctos");
					window.location = "contrasenaNueva.php?correo="+$("#correo").val();	//Rediorecciona a otra página web
				}
				else
				{
					alert ("Datos incorrectos");
				}				
			});
		return false;
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