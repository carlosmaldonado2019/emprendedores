<?php
session_start(); // Iniciar una nueva sesiÃ³n o reanudar la existente
  if(isset($_SESSION['login'])){ //condiciÃ³n, isset determina si una variable estÃ¡ definida
     if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
?>
  <body>
     <div class="clear4"></div>
  <div class="clear4"></div>
  <div class="clear4"></div>
<div class="clear4"></div>
<div class="clear4"></div>
              <section class="logoEmpRep">
            <img class="uabcLogo" src="imagenes/fca-uabc.png">
          </section>
          <section class="tituloEmpRep">
            
            <h2 class="text-center fca">MENSAJE ENVIADO CON EXITO</h2>




    <!-- -Comienza Footer- -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
 
</script>
  </body>
</html>
<?php
  }
  else
  {
    echo "Acceso denegado";
  }
}else{
  header("LOCATION: http://fcauabc.com/emprendedores/"); //RedirecciÃ³n del navegador
}
?>