<?php

	class reportes
	{
		var $claveCarrera;
		var $nombreCarrera;
		var $periodo;
		var $rubro;
		var $idEquipo;
		var $categoria;
		var $idGrupo;
		var $numeroGrupo;
	
		private $datosConexionBD;
		
		 function __construct($datosConexionBD){
		 	$this->datosConexionBD=$datosConexionBD;
		 }
		 
		public function alumnosCarrera(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$total=0;
			$query = "SELECT DISTINCT alumnos.carreraAlumno, carreras.nombreCarrera AS nombreCarrera FROM alumnos INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno WHERE grupos.periodoGrupo='".$this->periodo."'";
			$resultado = $mysqli->query($query);
			while($row = $resultado->fetch_assoc()) { 
				$this->claveCarrera = $row['carreraAlumno'];
				$this->nombreCarrera = $row['nombreCarrera'];
				$query2 = "SELECT COUNT(*) AS subtotal, grupos.numeroGrupo AS grupo, alumnos.semestreAlumno, grupos.turnoGrupo AS turno FROM alumnos INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno WHERE alumnos.carreraAlumno='".$this->claveCarrera."' AND grupos.periodoGrupo='".$this->periodo."' GROUP BY grupos.numeroGrupo, alumnos.semestreAlumno, grupos.turnoGrupo";
				$resultado2 = $mysqli->query($query2); //envía una única consulta a la base de datos 
				if (!$resultado2) { //condición
					printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
				}
				?>
				<strong >Programa educativo:</strong> <?=$this->nombreCarrera;?> <br><br>
		        <div class="table-responsive">
		           <table class="table table-striped table-bordered table-hover" style="width: 100%; text-align: center;" >
		              <thead class="bg-success">
		                <tr>
		                  <th class="text-center">Grupo</th>
		                  <th class="text-center">Semestre</th>
		                  <th class="text-center">Turno</th>
		                  <th class="text-center">Alumnos participantes</th>
		                </tr>
		              </thead>
		              <tbody>
		      <?php

		      		$subtotal=0;     
		          while($row2 = $resultado2->fetch_assoc()) {
		            $subtotal+=$row2['subtotal'];
		            $total+=$row2['subtotal'];
		      ?>
		                <tr>
		                  <td><?php echo $row2['grupo']; ?></td>
		                  <td><?php echo $row2['semestreAlumno']; ?></td>
		                  <td><?php echo $row2['turno']; ?></td>
		                  <td><?php echo $row2['subtotal']; ?></td>
		                </tr>

		      <?php
		      }
		      ?>  
		              </tbody>
		              <tfoot>
		                 <tr>
		                  <th style="border: none;"></th>
		                  <th style="border: none;"></th>
		                  <th class="text-right">TOTAL</th>
		                  <th class="text-center"><?php echo $subtotal; ?></th>
		                </tr>
		              </tfoot>
		        </table>
		      </div> 
		      <br><br>
		    <?php
			} 
			?>
			<div class="table-responsive">
		           <table class="table table-striped table-bordered table-hover" style="width: 50%; text-align: center; float: right;" >
		              <tfoot>
		                <tr>
		                  <th class="text-center bg-success">TOTAL DE ALUMNOS</th>
		                  <th class="text-center"><?php echo $total; ?></th>
		                </tr>
		              </tfoot>
		        </table>
		      </div><br><br>
		    <?php
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
		
		public function concentradoParticipantes(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT DISTINCT carreras.abreviaturaCarrera
						FROM alumnos 
						INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
						INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
						WHERE grupos.periodoGrupo='".$this->periodo."'
						ORDER BY carreras.claveCarrera";
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
			?>
				<div class="table-responsive">
	             	<table class="table table-striped table-bordered table-hover" style="width: 100%; text-align: center;" >
	                	<thead class="bg-success">
	                  		<tr>
	                    		<th class="text-center">Participantes</th>
	        <?php
				
		                while($row = $resultado->fetch_assoc()) {
		                  echo "<th class='text-center'>".$row['abreviaturaCarrera']."</th>";
		                }
	                   ?>
	                   			<th class="text-center">Total</th>
	                		</tr>
	                	</thead>
	                	<tbody>
			                <tr>
			                	<td>Alumnos</td>
			    <?php
			    	$query2 = "SELECT carreras.nombreCarrera, 
									COUNT(*) AS subtotalAlumnos
								FROM alumnos 
								INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
								INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
								WHERE grupos.periodoGrupo='".$this->periodo."' 
								GROUP BY carreras.nombreCarrera 
								ORDER BY carreras.claveCarrera";
						$resultado2 = $mysqli->query($query2); //envía una única consulta a la base de datos 
						if (!$resultado2) { //condición
							printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
						}
						else
						{
				    		while($row2 = $resultado2->fetch_assoc()) {
				    			 $totalAlumnos+=$row2['subtotalAlumnos'];
				?>
                      			<td><?=$row2['subtotalAlumnos'];?></td>
                <?php
			                }
			    ?>
			                	<td><?=$totalAlumnos;?></td>
			                </tr>
			                <tr>
                  				<td>Empresas</td>
			    <?php
				    		$query3 = "SELECT DISTINCT carreras.claveCarrera AS claveCarrera
										FROM alumnos 
										INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
										INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
										WHERE grupos.periodoGrupo='".$this->periodo."'
										ORDER BY carreras.claveCarrera";
							$resultado3 = $mysqli->query($query3); //envía una única consulta a la base de datos 
							if (!$resultado3) { //condición
								printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
							}
							else
							{
								while($row3 = $resultado3->fetch_assoc()) {	
									$this->claveCarrera=$row3['claveCarrera'];
									$query4 = "SELECT COUNT(*) AS subtotalEmpresas
												FROM equipos 
												WHERE periodoEmpresaEquipo='".$this->periodo."'
												AND carreraEquipo='".$this->claveCarrera."'";
									$resultado4 = $mysqli->query($query4); //envía una única consulta a la base de datos 
									if (!$resultado4) { //condición
										printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
									}
									else
									{
										$totalEmpresas;
					                    while($row4 = $resultado4->fetch_assoc()) {
					                    	$totalEmpresas+=$row4['subtotalEmpresas'];
					        ?>
					                    	<td><?=$row4['subtotalEmpresas'];?></td>
					        <?php
					                    }
									}
								}
							}
							?>
											<td><?=$totalEmpresas;?></td>
						                </tr>
						    <?php
			            }
			    ?>
			            </tbody>
	                </table>
	            </div>
	        	<?php
				
			}
		}
		public function empresasCategoria(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT DISTINCT carreras.abreviaturaCarrera
						FROM alumnos 
						INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
						INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
						WHERE grupos.periodoGrupo='".$this->periodo."'
						ORDER BY carreras.claveCarrera";
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
			?>
				<div class="table-responsive">
		           	<table class="table table-striped table-bordered table-hover" style="width: 100%; text-align: center;" >
		              	<thead class="bg-success">
		               		<tr>
		                  		<th class="text-center">Categor&iacute;as</th>
		    <?php
		                	while($row = $resultado->fetch_assoc()) {
		    ?>
		                  		<th class='text-center'><?=$row['abreviaturaCarrera'];?></th>
		    <?php
		                	}
		    ?>
		    					<th class="text-center">Total</th>
		                  	</tr>
		                </thead>
		                <tbody>
		    <?php
			            $query2 = "SELECT DISTINCT claseEmpresaEquipo
							FROM equipos 
							WHERE periodoEmpresaEquipo='".$this->periodo."'";
						$resultado2 = $mysqli->query($query2); //envía una única consulta a la base de datos 
						if (!$resultado2) { //condición
							printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
						}
						else
						{
							while($row2 = $resultado2->fetch_assoc()) {
				?>
								<tr>
									<td><?=$row2['claseEmpresaEquipo'];?></td>
				<?php
							 	$this->categoria=$row2['claseEmpresaEquipo'];
							 	$query3 = "SELECT DISTINCT carreras.claveCarrera AS carrera
											FROM alumnos 
											INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
											INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
											WHERE grupos.periodoGrupo='".$this->periodo."'
											ORDER BY carreras.claveCarrera";
								$resultado3 = $mysqli->query($query3); //envía una única consulta a la base de datos 
								if (!$resultado3) { //condición
									printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
								}
								else
								{
									$totalCategorias=0;
									$contador=0;
									while($row3 = $resultado3->fetch_assoc()) {
										$contador++;
										$this->carrera=$row3['carrera'];
										$query4 = "SELECT COUNT(*) AS subtotalCategoria
											FROM equipos 
											WHERE periodoEmpresaEquipo='".$this->periodo."' AND carreraEquipo='".$this->carrera."' AND claseEmpresaEquipo='".$this->categoria."'";
										$resultado4 = $mysqli->query($query4); //envía una única consulta a la base de datos 
										if (!$resultado4) { //condición
											printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
										}
										else
										{
											while($row4 = $resultado4->fetch_assoc()) {
												$totalCategorias+=$row4['subtotalCategoria'];
												if ($row4['subtotalCategoria']==0) 
												{
													$totalEquipos=" ";
												}
												else
												{
													$totalEquipos=$row4['subtotalCategoria'];
												}
			?>
												<td><?=$totalEquipos;?></td>
			<?php
											}

										}
									}
												$total+=$totalCategorias;
			?>
												<td><?php echo $totalCategorias; ?></td>
			<?php
								}
			?>
								</tr>
			<?php
							}
						}
			?>
						</tbody>
						<tfoot>
		                	<tr>
		    <?php
		                		for ($i=0; $i < $contador ; $i++) { 
		    ?>
		    						<td style="border:none;"></td>
		    <?php
		                		}
		    ?>
		                		<th class="text-right">TOTAL</th>
		                		<th class="text-center"><?php echo $total; ?></th>
		                	</tr>
		              	</tfoot>
		            </table>
		        </div>
		    <?php
			}
		}
		public function empresasParticipantes(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT COUNT(DISTINCT idEquipo) AS totalEmpresas 
						FROM equipos 
						WHERE periodoEmpresaEquipo='".$this->periodo."'";
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
		public function alumnosParticipantes(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT COUNT(*) AS totalAlumnos
						FROM alumnos 
						INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno
						WHERE grupos.periodoGrupo='".$this->periodo."'";
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
		public function docentesParticipantes(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT COUNT(DISTINCT asesorEquipo) AS totalDocentes 
						FROM equipos
						WHERE periodoEmpresaEquipo='".$this->periodo."'";
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
		public function carrerasParticipantes(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT DISTINCT carreras.nombreCarrera AS carrera
						FROM alumnos 
						INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
						INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno
						WHERE grupos.periodoGrupo='".$this->periodo."'";
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
		public function facultadesParticipantes(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT DISTINCT unidades.nombreUnidadAcademica AS unidad
						FROM alumnos 
						INNER JOIN unidades ON unidades.claveUnidadAcademica=alumnos.unidadAcademicaAlumno 
						INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno
						WHERE grupos.periodoGrupo='".$this->periodo."'";
			$resultado = $mysqli->query($query); //envía una única consulta a la base de datos 
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
		public function empresasRubro(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT DISTINCT claseEmpresaEquipo
						FROM equipos  
						WHERE periodoEmpresaEquipo='".$this->periodo."'";
			$resultado = $mysqli->query($query);
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				while($row = $resultado->fetch_assoc()) { 
					$totalEquipos=0;
					$totalIntegrantes=0;
					$this->rubro = $row['claseEmpresaEquipo'];
				?>
					<strong >CATEGOR&Iacute;A:</strong> <?=$this->rubro;?> <br><br>
					<div class="table-responsive">
			           <table class="table table-striped table-bordered table-hover" style="width: 100%; text-align: center;" >
			              	<thead class="bg-success">
			                	<tr>
				                	<th class="text-center">No.</th>
				                	<th class="text-center">Empresa</th>
				                	<th class="text-center">Producto/Servicio</th>
				                	<th class="text-center">Tipo</th>
				                	<th class="text-center">Integrantes</th>
				<?php
					$query = "SELECT 	DISTINCT alumnos.carreraAlumno AS claveCarrera, 
										carreras.abreviaturaCarrera AS nombreCarrera 
										FROM alumnos 
										INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
										INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
										INNER JOIN equipos ON equipos.idEquipo=alumnos.empresaAlumno
										WHERE grupos.periodoGrupo='".$this->periodo."' AND equipos.claseEmpresaEquipo='".$this->rubro."'";
						$resultado2 = $mysqli->query($query);
						if (!$resultado2) { //condición
						printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
						}
						else
						{
							while($row2 = $resultado2->fetch_assoc()) { 
							?>
									<th class="text-center"><?=$row2['nombreCarrera'];?></th>
							<?php
							}
						}
				?>
					            </tr>
					        </thead>
		        <?php
		        	$query = "SELECT 	equipos.idEquipo,
		        						equipos.nombreEmpresaEquipo,
										equipos.nombrePSEquipo,
										equipos.descripcionEmpresaEquipo,
										equipos.tipoEmpresaEquipo,
										COUNT(*) AS totalIntegrantesEquipo
								FROM alumnos
								INNER JOIN equipos ON alumnos.empresaAlumno=equipos.idEquipo 
								WHERE equipos.claseEmpresaEquipo='".$this->rubro."' AND equipos.periodoEmpresaEquipo='".$this->periodo."'
								GROUP BY equipos.idEquipo";
					$resultado3 = $mysqli->query($query);
					if (!$resultado3) { //condición
						printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
					}
					else
					{
						while($row3 = $resultado3->fetch_assoc()) { 
							$totalEquipos++;
							$this->idEquipo = $row3['idEquipo'];
							$numeroEquipo++;
		        ?>
					        <tbody>
					        	<tr>
				                  	<td><?php echo $numeroEquipo; ?></td>
				 					<td><?php echo $row3['nombreEmpresaEquipo']; ?></td>
				 					<td><?php echo $row3['nombrePSEquipo']; ?></td>
				 					<td><?php echo $row3['tipoEmpresaEquipo']; ?></td>
				 					<td><?php echo $row3['totalIntegrantesEquipo']; ?></td>
				 		<?php
				 			$query = "SELECT 	DISTINCT alumnos.carreraAlumno AS claveCarrera
										FROM alumnos 
										INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
										INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
										INNER JOIN equipos ON equipos.idEquipo=alumnos.empresaAlumno
										WHERE grupos.periodoGrupo='".$this->periodo."' AND equipos.claseEmpresaEquipo='".$this->rubro."'";
							$resultado4 = $mysqli->query($query);
							if (!$resultado4) { //condición
							printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
							}
							else
							{
					 			while($row4 = $resultado4->fetch_assoc()) {
					 				$this->claveCarrera = $row4['claveCarrera'];
					 				$query5 = "SELECT COUNT(*) AS total 
											FROM alumnos 
											INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
											INNER JOIN equipos ON equipos.idEquipo=alumnos.empresaAlumno
											WHERE equipos.idEquipo='".$this->idEquipo."' AND alumnos.carreraAlumno='".$this->claveCarrera."'";
									$resultado5 = $mysqli->query($query5);
									if (!$resultado5) { //condición
									printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
									}
									else
									{
										while($row5 = $resultado5->fetch_assoc()) {
											$totalIntegrantes+=$row5['total'];
											if ($row5['total']==0) 
											{
												$totalIntegrantesCarrera=" ";
											}
											else
											{
												$totalIntegrantesCarrera=$row5['total'];
											}
											
							?>
											<td><?php echo $totalIntegrantesCarrera; ?></td>
							<?php
										}
									}
								}
				 			} 
				 		?>
				                </tr>
					        </tbody>
					<?php
						}
					?>
					 		<tfoot>
					        	<tr>
					        		<th colspan=2 style="border:none;">TOTAL DE EQUIPOS: <?=$totalEquipos;?></th>
					        		<th style="border:none;">TOTAL DE PARTICIPANTES: <?=$totalIntegrantes;?></th>
					        		<th colspan=2 style="border:none; text-align: right;">TOTAL POR CARRERA: </th>
				<?php
					       	$query6 = "SELECT DISTINCT alumnos.carreraAlumno AS claveCarrera
										FROM alumnos 
										INNER JOIN carreras ON carreras.claveCarrera=alumnos.carreraAlumno 
										INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
										INNER JOIN equipos ON equipos.idEquipo=alumnos.empresaAlumno
										WHERE grupos.periodoGrupo='".$this->periodo."' AND equipos.claseEmpresaEquipo='".$this->rubro."'";
							$resultado6 = $mysqli->query($query6);
							if (!$resultado6) { //condición
							printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
							}
							else
							{
								while($row6 = $resultado6->fetch_assoc()) {
									$this->carrera=$row6['claveCarrera'];
							       	$query7 = "SELECT COUNT(*) AS total
												FROM alumnos 
												INNER JOIN grupos ON grupos.idGrupo=alumnos.grupoAlumno 
												INNER JOIN equipos ON equipos.idEquipo=alumnos.empresaAlumno
												WHERE grupos.periodoGrupo='".$this->periodo."' AND alumnos.carreraAlumno='".$this->carrera."' AND equipos.claseEmpresaEquipo='".$this->rubro."'";
									$resultado7 = $mysqli->query($query7);
									if (!$resultado7) { //condición
									printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
									}
									else
									{
										while($row7 = $resultado7->fetch_assoc()) {
				?>
											<th class="text-center"><?=$row7['total'];?></th>
				<?php
										}
									}
								}
							}
				?>
					        	</tr>
					        </tfoot>
					    </table>
					   <br><br>

				<?php
					}
				}
			}
		}

		public function equiposRegistrados(){
			/* conexión a la base de datos */
			$mysqli = new mysqli($this->datosConexionBD[0], $this->datosConexionBD[1], $this->datosConexionBD[2], $this->datosConexionBD[3]);
			/* check connection */
			if (mysqli_connect_errno()) { //condición
				printf("Error de conexión: %s\n", mysqli_connect_error()); //Devuelve el código de error de la última llamada
				exit();
			}
			mysqli_set_charset($mysqli,"utf8");
			$query = "SELECT idGrupo, numeroGrupo FROM grupos WHERE periodoGrupo='".$this->periodo."' ORDER BY numeroGrupo";
			$resultado = $mysqli->query($query);
			
			while($row = $resultado->fetch_assoc()) { 
				$this->idGrupo = $row['idGrupo'];
				$this->numeroGrupo = $row['numeroGrupo'];
				$query2 = "SELECT equipos.nombreEmpresaEquipo,
								 equipos.nombrePSEquipo,
								 equipos.claseEmpresaEquipo,
								 COUNT(*) AS totalIntegrantesEquipo,
								 asesores.apellidoPaternoAsesor,
								 asesores.apellidoMaternoAsesor,
								 asesores.nombreAsesor
							FROM alumnos
							INNER JOIN equipos ON equipos.idEquipo=alumnos.empresaAlumno
							INNER JOIN asesores ON asesores.idAsesor=equipos.asesorEquipo
							WHERE alumnos.grupoAlumno='".$this->idGrupo."'
							GROUP BY equipos.idEquipo";
				$resultado2 = $mysqli->query($query2); //envía una única consulta a la base de datos 
				$resultado5 = $mysqli->query($query2);
				if (!$resultado2) { //condición
					printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
				}
				else
				{
					$row2 = $resultado2->fetch_assoc()
					?>
					<strong >Grupo:</strong> <?=$this->numeroGrupo;?><br>
					<strong >Asesor:</strong> <?=$row2['apellidoPaternoAsesor']." ".$row2['apellidoMaternoAsesor']." ".$row2['nombreAsesor'];?> <br><br>
			        <div class="table-responsive">
			           <table class="table table-striped table-bordered table-hover" style="width: 100%; text-align: center;" >
			              <thead class="bg-success">
			                <tr>
			                  <th class="text-center">N&uacute;mero</th>
			                  <th class="text-center">Empresa</th>
			                  <th class="text-center">Producto/Servicio</th>
			                  <th class="text-center">Cantidad de alumnos</th>
			                </tr>
			              </thead>
			              <tbody>
		      <?php
		      			$totalEquipos=0;
			      		$subtotal=0;     
			          while($row5 = $resultado5->fetch_assoc()) {
			          	$totalEquipos++;
			            $subtotal+=$row5['totalIntegrantesEquipo'];
		      ?>
		                <tr>
		                  <td><?php echo $totalEquipos; ?></td>
		                  <td><?php echo $row5['nombreEmpresaEquipo']; ?></td>
		                  <td><?php echo $row5['nombrePSEquipo']; ?></td>
		                  <td><?php echo $row5['totalIntegrantesEquipo']; ?></td>
		                </tr>

					      <?php
					      }
					      ?>  
		              </tbody>
		              <tfoot>
		                 <tr>
		                  <th style="border: none;"></th>
		                  <th style="border: none;"></th>
		                  <th class="text-right">TOTAL</th>
		                  <th class="text-center"><?php echo $subtotal; ?></th>
		                </tr>
		              </tfoot>
		        </table>
		      </div> 
		      <br><br>
		    <?php
		    	}
			} 
			?>
			<div class="table-responsive">
		           <table class="table table-striped table-bordered table-hover" style="width: 50%; text-align: center; float: right;" >
		              <tfoot>
		                <tr>
			                <th class="text-center bg-success">TOTAL DE EQUIPOS</th>
			        <?php
			                $query3 = "SELECT COUNT(*) AS totalEquipos FROM equipos WHERE periodoEmpresaEquipo='".$this->periodo."'";
							$resultado3 = $mysqli->query($query3);
							if (!$resultado3) { //condición
								printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
							}
							else{
							$row3=$resultado3->fetch_assoc();
						?>
		                  	<th class="text-center"><?php echo $row3['totalEquipos']; ?></th>
		                <?php
		                  	}
		                ?>
		                </tr>
		                <tr>
		                	<th class="text-center bg-success">TOTAL DE ALUMNOS INSCRITOS</th>
		            <?php
		                	$query4 = "SELECT SUM(inscritosGrupo) AS totalInscritos FROM grupos WHERE periodoGrupo='".$this->periodo."'";
							$resultado4 = $mysqli->query($query4);
							if (!$resultado4) { //condición
								printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
							}
							else{
							$row4=$resultado4->fetch_assoc();
							$totalInscritos=$row4['totalInscritos'];
					?>
		                		<th class="text-center"><?php echo $totalInscritos; ?></th>
		                	 <?php
		                  	}
		                ?>
		                </tr>
		                <tr>
		                	<th class="text-center bg-success">TOTAL DE ALUMNOS POR INSCRIBIRSE</th>
		            <?php
		                	$query5 = "SELECT COUNT(*) AS totalAlumnos FROM alumnos 
		                				INNER JOIN grupos ON alumnos.grupoAlumno=grupos.idGrupo
		                				WHERE periodoGrupo='".$this->periodo."'";
							$resultado5 = $mysqli->query($query5);
							if (!$resultado5) { //condición
								printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
							}
							else{
							$row5=$resultado5->fetch_assoc();
							$porInscribirse=$totalInscritos-$row5['totalAlumnos'];
					?>
		                		<th class="text-center"><?php echo $porInscribirse; ?></th>
		            <?php
		                  	}
		                ?>
		                </tr>
		              </tfoot>
		        </table>
		      </div><br><br>
		    <?php
			if (!$resultado) { //condición
				printf("Errormessage: %s\n", $mysqli->error); //Devuelve el código de error de la última llamada
			}
			else
			{
				/* close connection */
				$mysqli->close();
				return $resultado;
			}
		}
	}
?>