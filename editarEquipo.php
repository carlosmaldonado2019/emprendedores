<?php
	session_start(); // Iniciar una nueva sesión o reanudar la existente
	if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==0) {
  	  include('menuMaestro.php');
      include 'config.php';
  	  $equipos = new equipos($datosConexionBD);
      $equipos->id =$_REQUEST['idEquipo'];
      $result = $equipos->consultarEquipoId();
      $result2 = $equipos->consultaCarreras();
    }
    elseif ($_SESSION['rol']==2) {
      include('menuAdmin.php');
      include 'config.php';
      $equipos = new equipos($datosConexionBD);
      $equipos->id =$_REQUEST['idEquipo'];
      $result = $equipos->consultarEquipoId();
      $result2 = $equipos->consultaCarreras();
    }
    if ($_SESSION['rol']==0 || $_SESSION['rol']==2 ) {
    while($row = $result->fetch_assoc()) {
      $asesor = $row['asesorEquipo'];
      $nombreEmpresa = $row['nombreEmpresaEquipo']; 
      $nombrePS = $row['nombrePSEquipo'];
      $descripcionEmpresa = $row['descripcionEmpresaEquipo'];
      $tipoEmpresa = $row['tipoEmpresaEquipo'];
      $claseEmpresa = $row['claseEmpresaEquipo'];
      $carreraEmpresa = $row['carreraEquipo'];
      $periodoEmpresa = $row['periodoEmpresaEquipo'];
      $nombreCarrera = $row['nombreCarrera'];
    }

?>

<!DOCTYPE html>

<html lang="es-MX">

	<!-- -Construccion del HEAD- -->

	<head>
        <script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>

  	<script type="text/javascript">
    $(document).ready(function(){ 
      $("#actualizarEquipo").submit(function(e){ 
        var confirmar=confirm("¿Estás seguro de los datos son correctos? Estos datos serán utilizados para generar constancias");
          if(confirmar==true){
        $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
          type: "POST", //tipo por donde se va a mandar los datos
          url: "views/actionActualizarEquipo.php",
          data:"id="+$("#id").val()+
          '&asesor='+$("#asesor").val() +
          '&nombre='+$("#nombre").val() +
          '&nombrePS='+$("#nombrePS").val() +
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

		<p>EDITAR EQUIPO

		</p>

</section>

<br>

<section class="formRegistroMaestro">

<form  id="actualizarEquipo" method="POST">

  <div class="form-group">
    <input type="hidden" class="form-control" id="id" aria-describedby="emailHelp" value="<?=$_REQUEST['idEquipo'];?>">
  </div>
  <div class="form-group">
    <label>Nombre de la empresa</label>
    <input type="text" class="form-control" id="nombre" value="<?=$nombreEmpresa;?>" required>
  </div>
  <div class="form-group">
    <label>Nombre del producto o servicio</label>
    <input type="text" class="form-control" id="nombrePS" value="<?=$nombrePS;?>" required>
  </div>
  <div class="form-group">
    <label>Descripción del producto o servicio</label>
    <input type="text" class="form-control" id="descripcion" value="<?=$descripcionEmpresa;?>" required>
  </div>
  <div class="form-group">
   <label>Rubro del producto o servicio</label>
   <br>
    <select id="clase" required>
      <option selected hidden value="<?=$claseEmpresa;?>" >--<?=$claseEmpresa;?>--</option>
      <option value="SERVICIOS">SERVICIOS</option>
      <option value="COMERCIAL">COMERCIAL</option>
      <option value="SOCIAL">SOCIAL</option>
      <option value="TECNOLOGÍA INTERMEDIA">TECNOLOGÍA INTERMEDIA</option>
      <option value="BASE TECNOLÓGICA">BASE TECNOLÓGICA</option>
    </select>
  </div>
  <div class="form-group">
   <label>Carrera del equipo</label><br>
    <select id="carrera" required>
      <option selected hidden value="<?=$carreraEmpresa;?>" >--<?=$nombreCarrera;?>--</option>
      <?php 
      while($row = $result2->fetch_assoc()) 
      {
      ?>
       <option value="<?php echo $row['claveCarrera']; ?>"><?php echo $row['nombreCarrera']; ?></option>
      <?php 
      } 
      ?>
    </select>
  </div>
   <div class="form-group">
   <label>Periodo</label><br>
    <select id="periodo" required>
      <option selected hidden value="<?=$periodoEmpresa;?>" >--<?=$periodoEmpresa;?>--</option>
      <option value="2016-2">2016-2</option>
      <option value="2017-1">2017-1</option>
      <option value="2017-2">2017-2</option>
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