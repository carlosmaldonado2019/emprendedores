<?php
session_start();
include('menuInicio.php');
?>

<!DOCTYPE html>
<html lang="es-MX">
<!-- -Construccion del HEAD- -->
<head>

</head>

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

<section class="tituloRegistroMaestro">

    <p>INICIAR SESIÓN

    </p>

</section>

<br>

<section class="login">

    <form id="login" method="POST">

        <div class="form-group">

            <input type="text" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="Correo">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="contrasenia" aria-describedby="emailHelp"
                   placeholder="Contraseña">
            <small id="fileHelp" class="form-text text-muted">¿Olvidaste tu contraseña? Presiona <a
                        href="recuperacionCuenta.php">aquí</a></small>
        </div>
        <input type="submit" class="btn btn-primary" value="Entrar"></input>
    </form>
</section>
<br><br><br><br><br><br><br><br><br><br>
<!-- -Comienza Footer- -->
<?php include("footer.php"); ?>
<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("a#pdf").click(function (e) {
            window.print();
        });
    });
    <
    script
    type = "text/javascript"
    src = "js/jquery/jquery-2.1.4.min.js" ></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#login").submit(function (e) { //Función de JavaScript donde recibe todos los elementos del formulario
            $.ajax({ //metodo de jquery que me ayuda a procesar un formulario de forma asíncrona
                type: "POST", //tipo por donde se va a mandar los datos
                url: "views/actionLogin.php",
                data: "correo=" + $("#correo").val() +
                    '&contrasenia=' + $("#contrasenia").val()
            }).done(function (result) {

                if (result == 1) { //condición
                    window.location = "index.php";	//Rediorecciona a otra página web
                } else {
                    alert(result);
                }
            });
            return false;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.dropdown a.test').on("click", function (e) {
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