<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
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
                  <th></th>
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
                  <td><input type="text" name="<?=$row['idEquipo']; ?>" size="5" id="id" value="<?=$row['standEquipo']; ?>"></td>
                  <td><button id="eliminar" name="<?=$row['nombreEmpresaEquipo'];?>" value="<?=$row['idEquipo'];?>">Eliminar</button></td>
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
        var confirmar=confirm("¿Estás seguro que deseas eliminar el equipo "+nombre+"?");
        if(confirmar==true){
      		$.ajax({ 
  		        type: "POST",
  		        url: "views/actionEliminarEquipo.php",
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
    <script type="text/javascript">
    $(document).ready(function(){
      var stand="";
      var id="";
     $("input#id").keyup(function(event){
        if(event.keyCode==13)
        {
          location.reload();
        }
        else
        {
        stand=$(this).val();
        id=$(this).attr("name");
      
      $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
        type: "POST", //tipo por donde se va a mandar los datos
        url: "views/actionUpdateStand.php",
        data:"id="+id+
        '&stand='+String(stand)
      })
    return false;
    }});
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

