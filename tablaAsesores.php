<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
  include 'config.php';
  require 'lib/asesores.php';
  $asesores = new asesores($datosConexionBD);
  $result = $asesores->consultarAsesores();
  
?>
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
    <section class="tablaEquipos" style="max-width: 600px;">
         <section class="tituloRegistroMaestro" style="width: 600px;">
            <p>TABLA DE ASESORES REGISTRADOS</p><br>
        </section>
        <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover">
              <thead class="bg-success">
                <tr>
                  <th></th>
                  <th>Número de empleado</th>
                  <th>Matrícula del Asesor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
      <?php 
          $numero=1;    
          while($row = $result->fetch_assoc()) {
      ?>
                <tr>
                  <td><?php echo $numero++;?></td>
                  <td><?php echo $row['numeroEmpleadoAsesor']; ?></td>
                  <td><a href="editarMaestro.php?id=<?php echo $row['idAsesor']; ?>"><?php echo strtoupper($row['apellidoPaternoAsesor']." ".$row['apellidoMaternoAsesor']." ".$row['nombreAsesor']); ?></a></td>
                  <td><button id="eliminar" name="<?=$row['numeroEmpleadoAsesor'];?>" value="<?=$row['idAsesor'];?>">Eliminar</button></td>
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
  });        <script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
       
    <script type="text/javascript">
    $(document).ready(function(){
      $("section div table tbody tr td button#eliminar").click(function(){
        var id=$(this).val();
        var nombre=$(this).attr("name");
        var confirmar=confirm("¿Estás seguro que deseas eliminar el asesor "+nombre+"?");
        if(confirmar==true){
          $.ajax({ 
              type: "POST",
              url: "views/actionEliminarAsesor.php",
              data:"id="+id
            }).done(function(){
              location.reload(true);
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

