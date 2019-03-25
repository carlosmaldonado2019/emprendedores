<?php
	session_start(); // Iniciar una nueva sesión o reanudar la existente
	if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
  	if ($_SESSION['rol']==0) {
        include('menuMaestro.php');
      }
      elseif ($_SESSION['rol']==2) {
        include('menuAdmin.php');
      }
  if ($_SESSION['rol']==0 || $_SESSION['rol']==2) {
  require 'lib/asesores.php';
  $equipos = new equipos($datosConexionBD);
  $result = $equipos->consultaCarreras();
  $asesores = new asesores($datosConexionBD);
  $result2 = $asesores->consultarAsesores();
?>
<!DOCTYPE html>

<html lang="es-MX">

	<!-- -Construccion del HEAD- -->

	<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>

		<script type="text/javascript">
	$(document).ready(function(){	
		$("#altaEquipo").submit(function(e){
      var e = $("#nombre").val();

			var confirmar=confirm("¿Estás seguro de los datos son correctos? Estos datos serán utilizados para generar constancias");
          if(confirmar==true){
			$.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
				type: "POST", //tipo por donde se va a mandar los datos
				url: "views/actionAltaEquipo.php",
				data:"asesor="+$("#asesor").val()+
				'&nombre='+ encodeURIComponent($("#nombre").val()) +
				'&nombrePS='+encodeURIComponent($("#nombrePS").val()) +
				'&descripcion='+$("#descripcion").val() + 
				'&clase='+$("#clase").val() +
				'&periodo='+$("#periodo").val() +
        '&carrera='+$("#carrera").val()
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

		<p>REGISTRO DE EQUIPOS

		</p>

</section>

<br>

<section class="formRegistroMaestro">

<form  id="altaEquipo" method="POST">
  <div class="form-group">
  	<label>Nombre de la empresa</label>
    <input type="text" class="form-control" id="nombre" required>
  </div>
  <div class="form-group">
  	<label>Nombre del producto o servicio</label>
    <input type="text" class="form-control" id="nombrePS" required>
  </div>
  <div class="form-group">
    <label>Descripción del producto o servicio</label>
    <input type="text" class="form-control" id="descripcion" required>
  </div>
  <div class="form-group">
   <label>Categoría del producto o servicio</label>
   <br>
    <select id="clase" required>
    	<option selected hidden value="">--Seleccione una opción--</option>
    	<option value="Tecnologìas de informaciòn y comunicaciòn (TIC)">TICs</option>
      <option value="Agroindustria e Industria Alimenticia">Agroindustria e Industria Alimenticia</option>
    	<option value="Ciencias de la salud y Farmacèutica">Ciencias de la salud y Farmac&eacuteutica</option>
    	<option value="Proyectos industriales y Tecnològicos">Proyectos industriales y Tecnol&oacutegicos</option>
    	<option value="Medio Ambiente, Desarrollo Sustentable y Energìa">Medio Ambiente, Desarrollo Sustentable y Energ&iacutea</option>
        <option value="Artìsticos y Culturales">Art&iacutesticos � Culturales</option>
        <option value="Proyectos de Servicios">Proyectos de Servicios</option>
     </select>
  </div>
  <div class="form-group">
   <label>Carrera del equipo</label><br>
    <select id="carrera" required>
      <option selected value="" hidden>--Seleccione una opción--</option>
      <?php 
      while($row = $result->fetch_assoc()) {?>
      <option value="<?php echo $row['claveCarrera']; ?>"><?php echo $row['nombreCarrera']; ?></option>
      <?php } ?>
    </select>
  </div>
   <div class="form-group">
   <label>Periodo</label><br>
    <select id="periodo" required>
    	<option selected hidden value="">--Seleccione una opción--</option>
    	<option value="2018-1">2018-1</option>
      <option value="2018-2">2018-2</option>
      <option value="2018-2">2019-1</option>
    </select>
  </div>
   <?php
  if ($_SESSION['rol']==2) {
  ?>
    <div class="form-group">
     <label>Asesor del equipo</label><br>
      <select id="asesor" required>
        <option selected value="" hidden>--Seleccione una opción--</option>
        <?php 
        while($row = $result2->fetch_assoc()) {
        ?>
        <option value="<?php echo $row['idAsesor']; ?>"><?php echo $row['apellidoPaternoAsesor']." ".$row['apellidoMaternoAsesor']." ".$row['nombreAsesor']; ?></option>
        <?php } ?>
      </select>
    </div>
  <?php
  }
  else
  {
 ?>
  <div class="form-group">
    <input type="hidden" class="form-control" id="asesor" aria-describedby="emailHelp" value="<?=$_SESSION['id'];?>">
  </div>
  <?php
  }
  ?>
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