<?php
session_start(); // Iniciar una nueva sesiÃ³n o reanudar la existente
  if(isset($_SESSION['login'])){ //condiciÃ³n, isset determina si una variable estÃ¡ definida
     if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
  include 'config.php';
  require 'lib/asesores.php';
  $asesores = new asesores($datosConexionBD);
  $result = $asesores->consultarAsesores();

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
            
            <h2 class="text-center fca">ENVIAR MENSAJE</h2><br><br><br>



<section class="formRegistroMaestro">

<form name="frmContacto" method="POST" action="enviar.php" enctype="multipart/form-data">



  <div class="form-group">
    <input type="hidden" class="form-control" id="asesor" aria-describedby="emailHelp">
  </div>

<div class="form-group">


  	<label for="Email">Correo(s)*</label>

<?php 
session_start();

$correo = $_SESSION ["correoAsesor"];

$link = mysql_connect("mysql5011.smarterasp.net", "9f6318_empren", "empren2016");

mysql_select_db ("db_9f6318_empren", $link);

mysql_set_charset('utf8');

$sql = ("SELECT correoAsesor FROM asesores");

$resultado = mysql_query($sql, $link);

//$row = mysql_fetch_row ($resultado);

?>

<input type="text" class="form-control" name="Email" value="<?php for($cont = 0; $cont < mysql_num_rows($resultado); $cont++) { echo mysql_result($resultado, $cont)." "; } ?>">
  </div><br><br>

<div class="form-group">
  	<label for="Asunto">Asunto*</label>
    <input type="text" class="form-control" name="Asunto">
  </div><br><br>


<div class="form-group">
  	<label for="Mensaje">Mensaje*</label>
    <textarea name="Mensaje" rows="10" cols="80"></textarea>    
  </div><br>

<div class="form-group">
        <label>Archivo adjunto</label><br>
        <input type="file" name="archivo" size=20></div><br>

<div class="form-group">
        <input type="file" name="archivo1" size=20></div><br>

<div class="form-group">
        <input type="file" name="archivo2" size=20></div><br>


<tr>
<td colspan="2" style="text-align:Center">
<input type="submit" class="btn btn-primary" value="Enviar" style="text-align:Center"></input>
</td>
</tr>
</form>
</section>


    <!-- -Comienza Footer- -->
<br><br><br><br><br><br><br><br><br><br><br><br>
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
<?php
  }
  else
  {
    echo "Acceso denegado";
  }
}else{
  header("LOCATION: http://emprendedores.fcauabc.com"); //RedirecciÃ³n del navegador
}
?>