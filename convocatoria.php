<?php
	session_start();
  if(isset($_SESSION['login'])){ //condici�n, isset determina si una variable est� definida
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
?>
<!DOCTYPE html>

<html lang="es-MX">
<style type="text/css">
	body{overflow: hidden;}
</style>
	<!-- -Construccion del BODY- -->
	<body>

	<br><br><br><br><br><br><br>

<form>

		<section  class="contenedorBanner1 container">
			<iframe name="convocatoria" style="width: 100%; height: 650px" src="Convocatoria XXVIII Expo Emprendedora.pdf"></iframe>

</form>

			
		</section>
		<!-- -Comienza Footer- -->
		<?php
		include('footer.php');
		?>
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
	</body>
</html>