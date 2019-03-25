<?php
	include 'config.php';
	require 'lib/grupos.php';
	require 'lib/equipos.php';
	$grupos = new grupos($datosConexionBD);
	$equipos = new equipos($datosConexionBD);
	$result = $grupos->consultarPeriodosGrupos();
	$result2 = $grupos->consultarPeriodosGrupos();
	$result3 = $grupos->consultarPeriodosGrupos();
	$result4 = $grupos->consultarPeriodosGrupos();
	$result5 = $equipos->consultarPeriodosEquipos();
	$result6 = $equipos->consultarPeriodosEquipos();
	$result7 = $grupos->consultarPeriodosGrupos();
	$result8 = $equipos->consultarPeriodosEquipos();
	$result9 = $grupos->consultarPeriodosGrupos();
        $resultcorreo = $grupos->consultarPeriodosGrupos();
        $resultcorreo = $grupos->consultarPeriodosGrupos();

?>
<!DOCTYPE html>
<html lang="es-MX">
	<!-- -Construccion del HEAD- -->
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="" />
		<meta name="description" content="" />
<!-- -Zona de recursos externos- -->
		<link rel="icon" href="imagenes/emprendedores.ico">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/sliderPrincipal.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
		<link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
		<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery/jquery.flexisel.js"></script>
		<script type="text/javascript" src="js/slider/jssor.slider.mini.js"></script>
    	<script type="text/javascript" src="js/slider/sliderPrincipal.js"></script>
    	<script type="text/javascript" src="js/slider/sliderNoticias.js"></script>
    	<script type="text/javascript" src="js/slider/sliderMarcas.js"></script>
		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="docs.min.js"></script>
    	<script type="text/javascript" src="ie10-viewport-bug-workaround.js"></script>
		<title>Emprendedores | Siembra una idea, cosecha tus sueños</title>
	</head>
	<style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
</style>
	<!-- -Construccion del BODY- -->
	<body>
		<section class="main-header navbar-fixed-top">
			<header>
				<div class="container">
			    	<div class="encabezado">
			    		<section class="logoEmp">
				    		<a href="index.php">
				    			<img class="uabcLogo" src="imagenes/fca-uabc.png">
				    		</a>
			    		</section>
			    		<section class="tituloEmp">
			    			<section class="tituloTexto">
			    				<p><strong>EMPRENDEDORES XXVI</strong>
			    				<br>
			    				<cite class="cita">Siembra una idea, cosecha tus sueños.</cite>
			    				</p>
			    			</section>
			    		</section>
						<section class="logoUABC">
				    		<a href="index.php">
				    			<img class="empLogo" src="imagenes/emprendedor.png">
				    		</a>
			    		</section>
			    	</div>
			    </div>
			<!-- Comienza menu de navegacion para móviles -->
			<nav class="navbar navbar-default" role="navigation">
		    	<div class="container">
			        <div class="navbar-header">
		          		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
		          		</button>
		          		<a id="inicio" href="index.php" class="navbar-brand" ><strong  style="color: white;"><img src="imagenes/logoT.png" >&nbsp; EMPRENDEDORES XXIII</img></strong></a>
		    		</div>
		    		<!-- Menú de navegación normal -->
			    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="border-color: #39b54a;">
				    	<ul class="nav navbar-nav navbar-center" id="navbar">
					        <li><a href="index.php"><strong>INICIO</strong></a></li>
					        <li><a href="#"><strong>EQUIPOS</strong> <span class="caret"></span></a>
				        		<ul class="dropdown-menu">
				        			<?php     
								        while($row = $result5->fetch_assoc()) {
								    ?>
				            				<li><a href="equiposAdmin.php?periodo=<?=$row['periodoEmpresaEquipo'];?>"><?=$row['periodoEmpresaEquipo'];?></a></li>
				            		<?php
			                        	}
			                        ?>
				            	</ul>
				          	</li>
					        <li><a href="#"><strong>ALUMNOS</strong> <span class="caret"></span></a>
				        		<ul class="dropdown-menu">
				        			<?php     
								        while($row = $result4->fetch_assoc()) {
								    ?>
				            				<li><a href="tablaAlumnos.php?periodo=<?=$row['periodoGrupo'];?>"><?=$row['periodoGrupo'];?></a></li>
				            		<?php
			                        	}
			                        ?>
				            	</ul>
				          	</li>
		                    <li><a href="#"><strong >REPORTES</strong> <span class="caret"></span></a>
						        <ul class="dropdown-menu">
						        	<li><a href="#">Alumnos por carrera <span class="caret"></span></a>
						        		<ul class="dropdown-menu">
						        			<?php     
										        while($row = $result->fetch_assoc()) {
										    ?>
						            				<li><a href="alumnosCarrera.php?periodo=<?=$row['periodoGrupo'];?>"><?=$row['periodoGrupo'];?></a></li>
						            		<?php
					                        	}
					                        ?>
						            	</ul>
						          	</li>
						        	<li><a href="#">Concentrado de Participantes <span class="caret"></span></a>
						        		<ul class="dropdown-menu">
						        			<?php     
										        while($row = $result2->fetch_assoc()) {
										    ?>
						            				<li><a href="concentradoParticipantes.php?periodo=<?=$row['periodoGrupo'];?>"><?=$row['periodoGrupo'];?></a></li>

                                                                             

						            		<?php
					                        	}
					                        ?>
						            	</ul>
						          	</li>
						          	<li><a href="#">Empresas participantes <span class="caret"></span></a>
						        		<ul class="dropdown-menu">
						        			<?php     
										        while($row = $result3->fetch_assoc()) {
										    ?>
						            				<li><a href="empresasParticipantes.php?periodo=<?=$row['periodoGrupo'];?>"><?=$row['periodoGrupo'];?></a></li>
						            		<?php
					                        	}
					                        ?>
						            	</ul>
						          	</li>
						          	<li><a href="#">Equipos registrados <span class="caret"></span></a>
						        		<ul class="dropdown-menu">
						        			<?php     
										        while($row = $result6->fetch_assoc()) {
										    ?>
						            				<li><a href="equiposRegistrados.php?periodo=<?=$row['periodoEmpresaEquipo'];?>"><?=$row['periodoEmpresaEquipo'];?></a></li>
						            		<?php
					                        	}
					                        ?>
						            	</ul>
						          	</li>
						        </ul>
						      </li>
					        <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
		                            <strong >REGISTRO</strong> <span class="caret"></span>
		                        </a>
		                        <ul class="dropdown-menu" role="menu">
		                            <li><a href="registroMaestro.php">Asesores</a></li>
		                            <li><a href="registroAlumnos.php">Alumnos</a></li>
		                            <li><a href="registroEquipo.php">Equipos</a></li>
		                            <li><a href="registroGrupo.php">Grupos</a></li>
		                            <li><a href="registroUnidad.php">Unidades Académicas</a></li>
		                            <li><a href="registroCarrera.php">Carreras</a></li>
                                    <li><a href="registroPeriodo.php">Periodos</a></li>
		                        </ul>
		                    </li>
		                    <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
		                            <strong >EDITAR</strong> <span class="caret"></span>
		                        </a>
		                        <ul class="dropdown-menu" role="menu">
		                            <li><a href="tablaAsesores.php">Asesores</a></li>
		                           	<li><a href="#">Alumnos<span class="caret"></span></a>
						        		<ul class="dropdown-menu">
						        		<?php     
								        while($row = $result7->fetch_assoc()) {
								    	?>
						        			<li><a href="tablaAlumnos2.php?periodo=<?=$row['periodoGrupo'];?>"><?=$row['periodoGrupo'];?></a></li>
						        		<?php
						        		}
						        		?>
						        		</ul>
						        	</li>
		                            <li><a href="#">Equipos<span class="caret"></span></a>
						        		<ul class="dropdown-menu">
						        		<?php     
								        while($row = $result8->fetch_assoc()) {
								    	?>
						        			<li><a href="tablaEquipos.php?periodo=<?=$row['periodoEmpresaEquipo'];?>"><?=$row['periodoEmpresaEquipo'];?></a></li>
						        		<?php
						        		}
						        		?>
						        		</ul>
						        	</li>
		                            <li><a href="#">Grupos<span class="caret"></span></a>
						        		<ul class="dropdown-menu">
						        		<?php     
								        while($row = $result9->fetch_assoc()) {
								    	?>
						        			<li><a href="tablaGrupos.php?periodo=<?=$row['periodoGrupo'];?>"><?=$row['periodoGrupo'];?></a></li>
						        		<?php
						        		}
						        		?>
						        		</ul>
						        	</li>
		                            <li><a href="tablaUnidades.php">Unidades Académicas</a></li>
		                            <li><a href="tablaCarreras.php">Carreras</a></li>
		                        </ul>
		                    </li>
		                    <li><a href="convocatoria.php"><strong>CONVOCATORIA</strong></a></li>



                                         <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
		                            <strong >CORREO</strong> <span class="caret"></span>
		                        </a>
                                         <ul class="dropdown-menu" role="menu">
		                            <li><a href="correoAsesores.php">Asesores</a></li>
		                           	<li><a href="correoAlumnos.php">Alumnos</a></li>
                                         
				      	</ul>

		                  <li><a href="logOut.php"><strong onmouseover="this.innerHTML='CERRAR SESION';" onmouseleave="this.innerHTML='<img src=imagenes/who.png>Administrador';"><img src="imagenes/who.png" width="24px" height="24px">Administrador</strong></a></li>

			    	</div><!-- /.navbar-collapse -->
		  		</div><!-- /.container-fluid -->
			</nav>
			<!-- -Fin del menu de navegacion- -->
		</section>
				<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>

		<script type="text/javascript">
		$(document).ready(function(){
			$("nav div div ul li ul li#concentrado").hover(function(){
				$("nav div div ul li ul li#periodo").css("display","block");
			});
			$( "nav div div ul li ul li#periodo" ).mouseout(function() {
			  $("nav div div ul li ul li#periodo").css("display","none");
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