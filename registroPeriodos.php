<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
if(isset($_SESSION['login'])){ //condición, isset determina si una variable está definida
    if ($_SESSION['rol']==0) {
        include('menuMaestro.php');
    }
    elseif ($_SESSION['rol']==2) {
        include('menuAdmin.php');
    }
    if ($_SESSION['rol']==0 || $_SESSION['rol']==2) {

        require 'lib/periodos.php';
        $periodos = new periodos($datosConexionBD);
        $result5 = $periodos->consultaPeriodos();
        ?>
        <!DOCTYPE html>

        <html lang="es-MX">

        <!-- -Construccion del HEAD- -->

        <head>
            <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>

        </head>

        <!-- -Construccion del BODY- -->
        <br><br><br><br><br><br><br><br><br><br>
    <body>
    <section class="tituloRegistroMaestro">

        <p>REGISTRO DE PERIODOS

        </p>

    </section>

    <br>

    <section class="formRegistroMaestro">

        <form  id="altaPeriodo" method="POST">
            <div class="form-group">
                <label>Periodo</label>
                <input type="text" class="form-control" id="periodo" required>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" value="Registrar"></input>
        </form>
    </section>

    <!-- -Comienza Footer- -->

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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#altaPeriodo").submit(function(e){
                var e = $("#nombre").val();

                var confirmar=confirm("¿Estás seguro de los datos son correctos? Estos datos serán utilizados para generar constancias");
                if(confirmar==true){
                    $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
                        type: "POST", //tipo por donde se va a mandar los datos
                        url: "views/actionAltaPeriodo.php",
                        data:'&periodo='+$("#periodo").val()
                    }).done(function(result){
                        alert (result);
                        location.reload();
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
    header("LOCATION: http://emprendedores.fcauabc.com"); //Redirección del navegador
}
?>