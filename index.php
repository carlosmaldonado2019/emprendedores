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
?>
<!DOCTYPE html>

<html lang="es-MX">
	<!-- -Construccion del BODY- -->
	<body>
		<!-- Jssor Slider -->
		<section class="main">
			<div id="slider0_container">
        		<div id="slider1_container">
            		<!-- Loading Screen -->
            		<div id="slider12_container" u="loading">
                		<div id="slider2_container">
                		</div>
	                	<div id="slider3_container">
	                	</div>
            		</div>
            	<!-- Slides Container -->
		            	<div id="slider4_container" u="slides">
			                <div>
			                    <img u="image" src2="imagenes/15065077_1154271054648905_676499808_o (2).jpg" />
			                </div>
			                <div>
			                    <img u="image" src2="imagenes/slide2.png" />
			                </div>
			                 <div>
			                    <img u="image" src2="imagenes/slide3.png" />
			                </div>
			                 <div>
			                    <img u="image" src2="imagenes/Flyer 2.0 2018.jpg"/>
			                </div>
			            </div>
		            <!-- bullet navigator container -->
		            	<div u="navigator" class="jssorb21">
		                <!-- bullet navigator item prototype -->
		                <div u="prototype">
	                </div>
		            </div>
			            <!-- Arrow Left -->
			            <span u="arrowleft" class="jssora21l">
			            </span>
			            <!-- Arrow Right -->
			            <span u="arrowright" class="jssora21r">
			            </span>
        		</div>
        <!-- Jssor Slider End -->
    		</div>
		</section>
		<!-- Banners -->
		<br><br><br><br>
		<section  class="contenedorBanner container">
			<img class="imgBanner" src=""> <!--editable-->
		</section>
		<!-- -Comienza Footer- -->
		    <?php include("footer.php"); ?>
<script type="text/javascript" src="js/jquery/jquery-2.1.4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){ 
    $("a#pdf").click(function(e){
      window.print();
    });
  });	</body>
</html>