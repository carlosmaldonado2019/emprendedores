<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
     if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
  include 'config.php';
  require 'lib/reportes.php';
  $reportes = new reportes($datosConexionBD);
  $reportes->periodo =$_REQUEST['periodo'];
  $result4= $reportes->empresasParticipantes();
  $result5= $reportes->alumnosParticipantes();
  $result6= $reportes->carrerasParticipantes();
  $result7= $reportes->carrerasParticipantes();
  $result8= $reportes->facultadesParticipantes();
  $result9= $reportes->facultadesParticipantes();
  $result10= $reportes->docentesParticipantes();

   while($row = $result6->fetch_assoc()) {
    $totalCarreras++;
   }
   while($row = $result8->fetch_assoc()) {
    $totalFacultades++;
   }
?>
  <body>
  <div class="clear4"></div>
  <div class="clear4"></div>
  <div class="clear4"></div>
<div class="clear4"></div>
<div class="clear4"></div>
    <section class="reportes">
      <a style="float: right;" class="btnImprimir" id="pdf" href="#!"><button style="font-size: 20px;" class="btn-info">Imprimir</button></a><br>
      <section class="logoEmpRep">
        <img class="uabcLogo" src="imagenes/fca-uabc.png">
      </section>
        <section class="tituloEmpRep">
        <h2 class="text-center uabc">UNIVERSIDAD AUTÓNOMA DE BAJA CALIFORNIA</h2>
        <h2 class="text-center fca">FACULTAD DE CIENCIAS ADMINISTRATIVAS</h2>
        <h2 class="text-center expo">EXPO EMPRENDEDORA</h2>
        <h2 class="text-center tituloReporte">CONCENTRADO DE PARTICIPANTES</h2>
        <h2 class="text-center semestre">SEMESTRE <?=$_REQUEST['periodo'];?></h2>
      </section>
        <section class="logoUABCrep">
          <img class="empLogo" src="imagenes/emprendedor.png">
        </section>
          <br><br>
          <strong>REP-EMP002</strong>
          <strong style="float: right;"><?php echo date('d/M/Y'); ?></strong><br><br><br>
          <?php 
            while($row = $result4->fetch_assoc()) {
          ?>
              <strong><?=$row['totalEmpresas'];?> Empresas participantes</strong><br>
          <?php
            }
            while($row = $result5->fetch_assoc()) {
          ?>
              <strong><?=$row['totalAlumnos'];?> Alumnos</strong><br>
          <?php
            }
            while($row = $result10->fetch_assoc()) {
          ?>
              <strong><?=$row['totalDocentes'];?> Docentes</strong><br><br>
          <?php
            }
          ?>
              <strong><?=$totalCarreras;?> Carreras:</strong><br>
          <ul>
          <?php
             while($row = $result7->fetch_assoc()) {
          ?>
              <li><?=$row['carrera'];?></li>
          <?php
            }
          ?>
          </ul>
          <strong><?=$totalFacultades;?> Facultades:</strong><br>
          <ul>   
          <?php
             while($row = $result9->fetch_assoc()) {
          ?>
              <li><?=$row['unidad'];?></li>
          <?php
            }
          ?>
          </ul>
          <br><br><br>
          <strong>Empresas y alumnos</strong><br><br>
        <?php
          $reportes->concentradoParticipantes();
        ?> 
    <br><br><br><br><br>
      <strong>Empresas por categorías</strong><br><br>
        <?php
          $reportes->empresasCategoria();
        ?> 
         <br><br><br><br><br><br>
          <section class="firmas">
            <div class="firma">
              <div class="lineaFirma"></div>
              <strong class="text-center">M.S. T&oacute;mas Cervantes Collado</strong><br>
              <small class="text-center">Coordinador de emprendedores</small>
            </div>
            <div class="firma">
              <div class="lineaFirma"></div>
              <strong class="text-center">Dr. Raúl González Núñez</strong><br>
              <small class="text-center">Director</small>
            </div>
          </section>
        <a style="float: right;" class="btnImprimir" id="pdf" href="#!"><button style="font-size: 20px;" class="btn-info">Imprimir</button></a><br>
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
<script type="text/javascript">
    $(document).ready(function(){ 
    $("a#pdf").click(function(e){
      window.print();
    });
  });
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
  header("LOCATION: http://fcauabc.com/emprendedores/"); //Redirección del navegador
}
?>

