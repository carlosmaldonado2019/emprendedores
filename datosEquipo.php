<?php
	session_start();
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
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
    include 'config.php';
    require 'lib/alumnos.php';
    $equipos = new equipos($datosConexionBD);
    $alumnos = new alumnos($datosConexionBD);
    $equipos->id =$_REQUEST['idEquipo'];
    $alumnos->id =$_REQUEST['idEquipo'];
    $result = $equipos->consultarAsesorEquipo();
    $result2 = $alumnos->consultarDatosIntegrantes();

    while($row = $result->fetch_assoc()) {
      $idEquipo=$row['idEquipo'];
      $nombreEmpresa=$row['nombreEmpresaEquipo'];
      $descripcionEmpresa=$row['descripcionEmpresaEquipo'];
      $nombreProducto=$row['nombrePSEquipo'];
      $nombreAsesor=$row['nombreAsesor'];
      $apellidoPaternoAsesor=$row['apellidoPaternoAsesor'];
      $apellidoMaternoAsesor=$row['apellidoMaternoAsesor'];
      $unidadAcademica=$row['unidadAcademica'];
      $periodoEmpresa=$row['periodoEmpresaEquipo'];
      $rubroEmpresa=$row['claseEmpresaEquipo'];

      if ($unidadAcademica==10) 
      {
        $unidadAcademica="FACULTAD DE CIENCIAS AGRÍCOLAS";
      }
      elseif ($unidadAcademica==90) 
      {
        $unidadAcademica="FACULTAD DE CIENCIAS ADMINISTRATIVAS";
      }
    }
?>

 <body>
     <div class="clear4"></div>
  <div class="clear4"></div>
  <div class="clear4"></div>
<div class="clear4"></div>
<div class="clear4"></div>
    <section class="reportes" margin: 0px auto;">
    <a style="float: right;" class="btnImprimir" id="pdf" href="#!"><button style="font-size: 20px;" class="btn-info">Imprimir</button></a><br>
     <section class="logoEmpRep">
            <img class="uabcLogo" src="imagenes/fca-uabc.png">
      </section>
      <section class="tituloEmpRep">
        <h2 class="text-center uabc"><strong>UNIVERSIDAD AUTÓNOMA DE BAJA CALIFORNIA</strong></h2>
        <h2 class="text-center fca">FACULTAD DE CIENCIAS ADMINISTRATIVAS</h2>
        <h2 class="text-center expo">EXPO EMPRENDEDORA</h2>
        <h2 class="text-center tituloReporte"><strong>FICHA DE REGISTRO EMPRESARIAL</strong></h2>
        <h2 class="text-center semestre">SEMESTRE <?=$periodoEmpresa;?></h2>
      </section>
      <section class="logoUABCrep">
            <img class="empLogo" src="imagenes/emprendedor.png">
          </section>
      <br><br>
      <strong style="float: right;"><?php echo date('d/M/Y'); ?></strong><br>
  <div style='width:100%;text-align:right;'>
    <p>
      <div style='font-weight:bold;font-size:10pt;'>Facultad: <?=$unidadAcademica;?></div>
      <div class="clear0"></div>
      <div style='font-weight:bold;font-size:10pt;'>Asesor: <?=$nombreAsesor." ".$apellidoPaternoAsesor." " .$apellidoMaternoAsesor;?></div>
      <div class="clear0"></div>
      <div style='font-weight:bold;font-size:10pt;'>Periodo: <?=$periodoEmpresa;?></div>
    </p>
  </div>
  <div style='width:100%;text-align:left; position:relative;'>
    <p>
      <div style='font-size:10pt;'>Folio: <?=$idEquipo;?></div> 
      <div class="clear0"></div>
      <div style='font-size:10pt;'>Nombre de la empresa: <?=$nombreEmpresa;?></div>
      <div class="clear0"></div>
      <div style='font-size:10pt;'>Nombre del producto o servicio: <?=$nombreProducto;?></div>
      <div class="clear0"></div>
      <div style='font-size:10pt;'>Descripción del servicio: <?=$descripcionEmpresa;?></div>
      <div class="clear0"></div>
      <div style='font-size:10pt;'>Categor&iacute;a: <?=$rubroEmpresa;?></div>
      <div class="clear0"></div>
    </p>
  </div>

  <div class="clear"></div>
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" style="width: 100%; text-align: center;"> 
      <thead class="bg-success"> 
        <tr>
          <th></th> 
          <th class="text-center">Matricula</th> 
          <th class="text-center">Nombre Completo</th> 
          <th class="text-center">Carrera</th>
          <th class="text-center">Grupo</th>
          <th class="text-center">Sexo</th>  
          <th class="text-center">Correo</th>
          <th class="text-center">Celular</th>   
          <th class="text-center">Firma</th>
        </tr> 
      </thead>
      <tbody> 
      <?php
      $numero=1;
     while($row = $result2->fetch_assoc())
     {
      ?>
            <tr>  
            	<td><?=$numero++;?></td>
                <td><?=$row['matriculaAlumno'];?></td>        

                <td><?=$row['apellidoPaternoAlumno']." ".$row['apellidoMaternoAlumno']." ".$row['nombreAlumno'];?></td>

                <td><?=$row['abreviaturaCarrera'];?></td>

                <td><?=$row['grupoAlumno'];?></td>

                <td><?=$row['sexoAlumno'];?> </td>

                <td><?=$row['correoAlumno'];?></td>
                <td style="width: 120px;""><?=$row['celularAlumno'];?></td>
                <td style="width: 150px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

              </tr>
  <?php
    }
    ?>
      </tbody>  
      </table>
      </div>
          <br><br><br><br><br><br>
          <section class="firmas">
            <div class="firma">
              <div class="lineaFirma"></div>
              <strong class="text-center"><?=$nombreAsesor." ".$apellidoPaternoAsesor." ".$apellidoMaternoAsesor;?></strong><br>
              <small class="text-center">Firma del docente</small>
            </div>
          </section>
          <a style="float: right;" class="btnImprimir" id="pdf" href="#!"><button style="font-size: 20px;" class="btn-info">Imprimir</button></a><br>
    </section>
    <!-- -Comienza Footer- -->
<br><br><br><br><br>
    <?php include("footer.php"); ?>
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
