<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
  if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==2) {
  include('menuAdmin.php');
  include 'config.php';
  require 'lib/alumnos.php';
  $alumnos = new alumnos($datosConexionBD);
  $alumnos->periodo =$_REQUEST['periodo'];
  $result = $alumnos->consultarAlumnoNoId();
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
            <p>TABLA DE ALUMNOS REGISTRADOS</p><br>
    </section>
        <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover">
              <thead class="bg-success">
                <tr>
                  <th></th>
                  <th>Matrícula del Alumno</th>
                  <th>Nombre del Alumno</th>
                  <th>Nombre de la Empresa</th>
                  <th>Asistió</th>
                  <th>Constancia<br>Equipo</th>
                  <!--<th>Grupo</th>-->
                  <!--<th></th>-->
                </tr>
              </thead>
              <tbody>
      <?php 
          $numero=1;    
          while($row = $result->fetch_assoc()) {
      ?>
                <tr>
                  <td><?php echo $numero++;?></td>
                  <td><?php echo $row['matriculaAlumno']; ?></td>
                  <td><?php echo strtoupper($row['apellidoPaternoAlumno']." ".$row['apellidoMaternoAlumno']." ".$row['nombreAlumno']); ?></td>
                  <td><?php echo strtoupper($row['nombreEmpresa']); ?></td>
                  <td><?php if ($row['constanciaAlumno']=="no")
            {echo "<a href='#'><button id='boton' style='background:none;border:none;' value='".$row['matriculaAlumno']."'><img src='imagenes/tacha2.png'/></button></a>";}
             if ($row['constanciaAlumno']=="si")
                        {echo "<a href='#'><button id='botonDos' style='background:none;border:none;' value='".$row['matriculaAlumno']."'><img src='imagenes/palomita1.png'/></button></a>";} ?></td>
                    <td><?php if ($row['constanciaEquipo']=="no")
            {echo "<a href='#'><button id='botonTres' style='background:none;border:none;' value='".$row['matriculaAlumno']."'><img src='imagenes/tacha2.png'/></button></a>";}
             if ($row['constanciaEquipo']=="si")
                        {echo "<a href='#'><button id='botonCuatro' style='background:none;border:none;' value='".$row['matriculaAlumno']."'><img src='imagenes/palomita1.png'/></button></a>";} ?></td>
                    <!--<td><input type="text" name="--><?//=$row['matriculaAlumno']; ?><!--" size="5" id="id" value="--><?//=$row['grupoAlumno']; ?><!--"></td>-->
                    <!--<td><button id="btn-magic" name="--><?//=$row['carreraAlumno'];?><!--" value="--><?//=$row['empresaAlumno'];?><!--">boton mágico</button></td>-->
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
      var grupo="";
      var matricula="";
     $("input#id").keyup(function(event){
        if(event.keyCode==13)
        {
          location.reload();
        }
        else
        {
        grupo=$(this).val();
        matricula=$(this).attr("name");
      
      $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
        type: "POST", //tipo por donde se va a mandar los datos
        url: "views/actionUpdateGrupo.php",
        data:"matricula="+matricula+
        '&grupo='+String(grupo)
      })
    return false;
    }});
  });
</script>
        <script type="text/javascript">
    $(document).ready(function(){ 
    $("button#boton").click(function(e){ //Función de JavaScript donde recibe todos los elementos del formulario 
      $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
        type: "POST", //tipo por donde se va a mandar los datos
        url: "actionUpdateConstancia.php", //Archivo al que enruta los datos del formulario
        data:"folio="+$(this).val()
      }).done(function(result){
        location.reload(); //Con este método Cargamos por defecto la vista de ver usuarios
      });
    return false;
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
    $("button#botonDos").click(function(e){ //Función de JavaScript donde recibe todos los elementos del formulario 
      $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
        type: "POST", //tipo por donde se va a mandar los datos
        url: "actionUpdateConstanciaDos.php", //Archivo al que enruta los datos del formulario
        data:"folio="+$(this).val()
      }).done(function(result){
        location.reload(); //Con este método Cargamos por defecto la vista de ver usuarios
      });
    return false;
    });
  });
</script>
 <script type="text/javascript">
    $(document).ready(function(){ 
    $("button#botonTres").click(function(e){ //Función de JavaScript donde recibe todos los elementos del formulario 
      $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
        type: "POST", //tipo por donde se va a mandar los datos
        url: "actionUpdateConstanciaEquipo.php", //Archivo al que enruta los datos del formulario
        data:"folio="+$(this).val()
      }).done(function(result){
        location.reload(); //Con este método Cargamos por defecto la vista de ver usuarios
      });
    return false;
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
    $("button#botonCuatro").click(function(e){ //Función de JavaScript donde recibe todos los elementos del formulario 
      $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
        type: "POST", //tipo por donde se va a mandar los datos
        url: "actionUpdateConstanciaEquipoDos.php", //Archivo al que enruta los datos del formulario
        data:"folio="+$(this).val()
      }).done(function(result){
        location.reload(); //Con este método Cargamos por defecto la vista de ver usuarios
      });
    return false;
    });
  });
</script>
    <script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("div table tbody tr td button#btn-magic").click(function(){
        var empresa=$(this).val();
        var carrera=$(this).attr("name");
        $.ajax({ 
            type: "POST",
            url: "views/actionBotonMagico.php",
            data:"empresa="+empresa+
            "&carrera="+carrera
          }).done(function(){
            location.reload(true);
          });
    return false;
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

