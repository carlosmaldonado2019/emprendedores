<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
  include 'config.php';
  require 'lib/reportes.php';
  $reportes = new reportes($datosConexionBD);
  $reportes->periodo =$_REQUEST['periodo'];
  
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
          <h2 class="text-center tituloReporte">REPORTE DE EMPRESAS PARTICIPANTES</h2>
          <h2 class="text-center semestre">SEMESTRE <?=$_REQUEST['periodo'];?></h2>
          </section>
        <section class="logoUABCrep">
          <img class="empLogo" src="imagenes/emprendedor.png">
        </section>
        <br><br>
          <strong>REP-EMP003</strong>
          <strong style="float: right;"><?php echo date('d/M/Y'); ?></strong><br><br><br>
          <?php 
          $result = $reportes->empresasRubro();
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
  });
    </footer>
        <script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
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

