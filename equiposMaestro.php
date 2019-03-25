<?php
	session_start(); // Iniciar una nueva sesión o reanudar la existente
	if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==0) {
	include('menuMaestro.php');
  $equipos = new equipos($datosConexionBD);
  $result = $equipos->consultarEquiposAsesor();
?>
<!DOCTYPE html>

<html lang="es-MX">
	<!-- -Construccion del BODY- -->
<br><br><br><br><br><br><br><br><br><br>
	<body>
	<section class="tablaEquipos">
         <section class="tituloRegistroMaestro">
            <p>TABLA DE EQUIPOS REGISTRADOS</p><br>
    </section>
        <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover">
    <thead class="bg-success">
      <tr>
        <th>Nombre empresa</th>
        <th>Nombre producto/servicio</th>
        <th>Descripción del producto/servicio</th>
        <th>Categoría</th>
        <th>Periodo</th>
        <th>Stand</th>
      </tr>
    </thead>
    <tbody>
<?php     
    while($row = $result->fetch_assoc()) {
?>

      <tr>
        <td><a href="editarEquipo.php?idEquipo=<?=$row['idEquipo'];?>"><?php echo $row['nombreEmpresaEquipo']; ?></a></td>
        <td><?php echo strtoupper($row['nombrePSEquipo']); ?></td>
        <td><?php echo strtoupper($row['descripcionEmpresaEquipo']); ?></td>
        <td><?php echo strtoupper($row['claseEmpresaEquipo']); ?></td>
        <td><?php echo $row['periodoEmpresaEquipo']; ?></td>
        <td><?php echo $row['standEquipo']; ?></td>
      </tr>
<?php
}
?>	
 </tbody>
  </table>
      </div> 
    </section>
		<!-- -Comienza Footer- -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
