<?php
session_start();
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==0) {
      include('menuMaestro.php');
    }
    elseif ($_SESSION['rol']==1) {
      include('menuAlumno.php');
    }
  }
  else{
    include('menuInicio.php');
  }
  $equipos->periodo =$_REQUEST['periodo'];
  $result = $equipos->consultarEquipos();

  function recortarCadena($cadena, $maxLength){
  $tamano = strlen($cadena); 
  if($tamano > $maxLength){
    $sanada = substr(str_replace("<br />", "/n", $cadena), 0, $maxLength-3)."...";
    return nl2br(str_replace("/n", " ", $sanada));
  }else{
    return $cadena;
  }
}
?>
<!DOCTYPE html>

<html lang="es-MX">

  
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
    <section class="tablaEquipos">
         <section class="tituloRegistroMaestro">
            <p>TABLA DE EQUIPOS REGISTRADOS</p><br>
    </section>
        <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover">
              <thead class="bg-success">
                <tr>
                  <th></th>
                  <th>Nombre del asesor</th>
                  <th>Nombre empresa</th>
                  <th>Nombre producto/servicio</th>
                  <th>Descripción del producto/servicio</th>
                  <th>Categoría</th>
                  <th>Periodo</th>
                  <th>Total Integrantes</th>
                  <th>Stand</th>
                </tr>
              </thead>
              <tbody>
      <?php     
      		$numero=0;
          while($row = $result->fetch_assoc()) {
          	$numero++;
      ?>  
                <tr>
                  <td><?=$numero;?></td>
                  <td><?php echo strtoupper($row['paternoAsesor']." ".$row['maternoAsesor']." ".$row['nombreAsesor']); ?></td>
                  <td><a href="datosEquipo.php?idEquipo=<?=$row['idEquipo'];?>"><?php echo strtoupper($row['nombreEmpresaEquipo']); ?></a></td>
                  <td><?php echo strtoupper($row['nombrePSEquipo']); ?></td>
                  <td><?php echo strtoupper(recortarCadena($row['descripcionEmpresaEquipo'],50)); ?></td>
                  <td><?php echo strtoupper($row['claseEmpresaEquipo']); ?></td>
                  <td><?php echo $row['periodoEmpresaEquipo']; ?></td>
                  <td><?php echo $row['totalIntegrantesEquipo']; ?></td>
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
  });    <script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
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

