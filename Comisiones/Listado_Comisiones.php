<html>
	<?php
		session_start();
		date_default_timezone_set('UTC');
		$mostrar = $_POST["mostrar"];
		include '../Scripts/query.php';
		$conexion = new Querys();
		$rol = (isset( $_SESSION["Rol"])) ?  $_SESSION["Rol"]: "";
	?>
	<head>
		<script>
			$(document).ready(function()
			{
				$(".a_inter").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				$(".a_nac").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				$(".a_vac").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				
				
				$(".agregar_js").click(function(e){
					var tipo = $(this).attr("value");
					$("body").addClass("superposicion");
					$("#pagina_contenedor").addClass("popup_arreglado");
					$.post("../popup/popup.php", function(data){
						$("#pagina_contenedor").before(data);
					}).done(function(){
						$.post("./Agregar.php", function(data){
							$(".yu_widget_bd").append(data);
							$(".comision_formulario").hide();
							$(".informe_comision").hide();
							$(".mensaje").hide();
							
							
							$(".inicial").hide();
							$(".comision_formulario").show();
							$("#tipo_comision_").val(tipo);
							$("#tipo_").text(tipo);
							$(".a_3").hide();
							if(tipo == "Internacional")
							{
								$(".a_2").show();
								$(".a_1").show();
							}
							else if(tipo == "Nacional")
							{
								$(".a_1").show();
								$(".a_2").hide();
							}
							else
								$(".a_1").hide();
							if(tipo == "Nacional" || tipo == "Internacional")
							{
								var date = new Date();
								var dia = date.getDate();
								var mes = date.getMonth() + 1;
								var anio = date.getFullYear();
								$("#dia_s option").map(function(){
									if($(this).text() == dia) return this;
								}).attr('selected', 'selected');
								$("#mes_s option").map(function(){
									if($(this).text() == mes) return this;
								}).attr('selected', 'selected');
								$("#anio_s option").map(function(){
									if($(this).text() == anio) return this;
								}).attr('selected', 'selected');
								
								$("#dia_i option").map(function(){
									if($(this).text() == dia) return this;
								}).attr('selected', 'selected');
								$("#mes_i option").map(function(){
									if($(this).text() == mes) return this;
								}).attr('selected', 'selected');
								$("#anio_i option").map(function(){
									if($(this).text() == anio) return this;
								}).attr('selected', 'selected');
								
								$("#dia_t option").map(function(){
									if($(this).text() == dia + 1) return this;
								}).attr('selected', 'selected');
								$("#mes_t option").map(function(){
									if($(this).text() == mes) return this;
								}).attr('selected', 'selected');
								$("#anio_t option").map(function(){
									if($(this).text() == anio) return this;
								}).attr('selected', 'selected');
							}
						});
					});
					e.stopPropagation();
				});
				
			});
		</script>
	</head>
	<body>
		<?php
			function cargar_comisiones($f_inicial, $f_final, $id, $motivo, $lugar)
			{
				$conexion = new Querys();
				$inicial = explode("-", $f_inicial);
				$final = explode("-", $f_final);
				?>
					<li class="lista_temas_c publicacion_li contenido_js" style="margin-bottom: 0px;">
						<div class="titulo_expandible" style="margin-top: -2px;">
							<div class="contenido_expandido titulo_js contenido_expandido_js expandido_colapsado_js" style="max-height: none;">
								<span class="titulo">
									<span class="link_titulo_publicacion_js">	
										<a class="titulo_publicacion titulo_publicacion_titulo_js editar_producto_copei" href="./Editar.php?i=<?php echo $id;?>&n=<?php echo $motivo;?>"><?php echo $motivo;?></a>	
									</span>		
								</span>			
							</div>					
						</div>	
						<div class="autores autores_expandibles" style="margin-top: 5px;">	
							<div class="contenido_expandido autores_js contenido_expandido_js expandido_colapsado_js">
								<span class="autores"><?php echo $lugar;?></span>
							</div>
						</div>		
						<div class="detalles" style="margin: 0px 0;"><?php echo $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];?> 
									<a href="../Reportes/Generar_Comision.php?i=<?php echo $id;?>&n=<?php echo $motivo;?>" target="_blank"> (Imprimir Solicitud) </a> 
							<?php
								$informe = $conexion->Consultas("SELECT ID_Informe FROM Informe_Comision WHERE FK_Comision = ".$id);
								if(count($informe) > 0)
								{
							?>		
									<a href="../Reportes/Generar_Reporte_Comision.php?i=<?php echo $informe[0]["ID_Informe"];?>&n=<?php echo $motivo;?>" target="_blank">Informe</a>
							<?php
								}
								else if($GLOBALS["rol"] == "Administrador" || (isset($_SESSION['ID']) && $_SESSION["Usuario_Temporal"] == $_SESSION["ID"]))
								{
							?>
									<a href="../Comisiones/Editar.php?i=<?php echo $id;?>&n=<?php echo $motivo;?>">Llenar Informe</a>
							<?php
								}
							?>
						</div>
					</li>
				<?php
			}
			function cargar_sab_vac($f_inicial, $f_final, $id, $tipo)
			{
				$inicial = explode("-", $f_inicial);
				$final = explode("-", $f_final);
				?>
					<li class="tema_miembro lista_temas_js contenedor_js" style="padding-left: 0px; padding-right: 0px;"><!--people-item js-list-item js-widget-container-->
						<div class="indent_contenedor"><!--indent-container-->
							<h5>
							<?php
								if($GLOBALS["rol"] == "Administrador" || (isset($_SESSION['ID']) && $_SESSION["Usuario_Temporal"] == $_SESSION["ID"]))
								{
							?>
								<a href="./Editar.php?i=<?php echo $id;?>&f_i=<?php echo $f_inicial;?>&f_f=<?php echo $f_final;?>"><?php echo $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];?></a>
							<?php
								}
								else
								{
							?>
							<a><?php echo $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];?></a>
							<?php
								}	
								if($tipo)
								{
							?>
								<a href="../Reportes/Generar_Sabatico.php?i=<?php echo $id;?>&n=<?php echo $f_inicial."/".$f_final;?>" target="_blank">(Imprimir Solicitud)</a>
							<?php
								}
							?>
							</h5>
						</div>
					</li>
				<?php
			}
		?>
		
		
		<div class="contenido_c" style="padding-top: 0; border-right: none; width: 310px;"><!--c-content-->
			<div class="limpiar"></div><!--clear-->
			<div class="envoltura_contenido_literatura"><!--literature-content-wrapper-->
				<div class="contenedor_js"><!--js-widgetcontainer-->
					<div class="publicaciones_p publicaciones_js"><!--publication-feed js-publication-feed-->
						<ul class="publicacion_cuerpo_p lista_contenido_js"><!--publication-feed-body js-list-content-->
							<h2 style="margin-top: 0;">Comisiones Internacionales 
							<?php 
								if($rol == "Administrador" || (isset($_SESSION['ID']) && $_SESSION["Usuario_Temporal"] == $_SESSION["ID"]))
									echo "<a class='agregar_js' value='Internacional'>Agregar</a>";
							?>
							</h2>
							<?php
								$comision = $conexion->Consultas("SELECT ID_Comision, Motivo, Lugar, Fecha_Inicial, Fecha_Final FROM Comision WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Tipo_Comision LIKE 'Internacional' AND Fecha_Final > '".date("Y-m-d")."' ORDER BY Fecha_Final");
								for($y = 0; $y < count($comision); $y++)
									cargar_comisiones($comision[$y]["Fecha_Inicial"], $comision[$y]["Fecha_Final"], $comision[$y]["ID_Comision"], $comision[$y]["Motivo"], $comision[$y]["Lugar"]);
								/*if($mostrar == "ok")
								{*/
								$comision = $conexion->Consultas("SELECT ID_Comision, Motivo, Lugar, Fecha_Inicial, Fecha_Final FROM Comision WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Tipo_Comision LIKE 'Internacional' AND (Fecha_Final < '".date("Y-m-d")."' OR Fecha_Final = '".date("Y-m-d")."') ORDER BY Fecha_Final");
								$anio = 0;
								for($y = 0; $y < count($comision); $y++)
								{
									$fecha_ = explode("-", $comision[$y]["Fecha_Final"]);
									$fecha_ = $fecha_[0];
									if($anio != $fecha_)
									{
										if($anio != 0)
											echo "</div>";
										$anio = $fecha_;
										echo "<h2><a value='".$anio."_div_inter' class='a_inter'>".$anio."</a></h2>";
										echo "<div id='".$anio."_div_inter'  style='display: none;'>";
									}
										cargar_comisiones($comision[$y]["Fecha_Inicial"], $comision[$y]["Fecha_Final"], $comision[$y]["ID_Comision"], $comision[$y]["Motivo"], $comision[$y]["Lugar"]);
								}
							?>
							</div>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="" style="float: left; padding-top: 0; border-right: none; width: 310px;"><!--c-content-->
			<div class="limpiar"></div><!--clear-->
			<div class="envoltura_contenido_literatura"><!--literature-content-wrapper-->
				<div class="contenedor_js"><!--js-widgetcontainer-->
					<div class="publicaciones_p publicaciones_js"><!--publication-feed js-publication-feed-->
						<ul class="publicacion_cuerpo_p lista_contenido_js"><!--publication-feed-body js-list-content-->
							<h2 style="margin-top: 0;">Comisiones Nacionales 
							<?php 
								if($rol == "Administrador" || (isset($_SESSION['ID']) && $_SESSION["Usuario_Temporal"] == $_SESSION["ID"]))
									echo "<a class='agregar_js' value='Nacional'>Agregar</a>";
							?>
							</h2>
							<?php
								$comision = $conexion->Consultas("SELECT ID_Comision, Motivo, Lugar, Fecha_Inicial, Fecha_Final FROM Comision WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Tipo_Comision LIKE 'Nacional' AND Fecha_Final > '".date("Y-m-d")."' ORDER BY Fecha_Inicial");
								for($y = 0; $y < count($comision); $y++)
									cargar_comisiones($comision[$y]["Fecha_Inicial"], $comision[$y]["Fecha_Final"], $comision[$y]["ID_Comision"], $comision[$y]["Motivo"], $comision[$y]["Lugar"]);
								$comision = $conexion->Consultas("SELECT ID_Comision, Motivo, Lugar, Fecha_Inicial, Fecha_Final FROM Comision WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Tipo_Comision LIKE 'Nacional' AND (Fecha_Final < '".date("Y-m-d")."' OR Fecha_Final = '".date("Y-m-d")."') ORDER BY Fecha_Final");
								$anio = 0;
								for($y = 0; $y < count($comision); $y++)
								{
									$fecha_ = explode("-", $comision[$y]["Fecha_Final"]);
									$fecha_ = $fecha_[0];
									if($anio != $fecha_)
									{
										if($anio != 0)
											echo "</div>";
										$anio = $fecha_;
										echo "<h2><a value='".$anio."_div_nac' class='a_nac'>".$anio."</a></h2>";
										echo "<div id='".$anio."_div_nac'  style='display: none;'>";
									}
										cargar_comisiones($comision[$y]["Fecha_Inicial"], $comision[$y]["Fecha_Final"], $comision[$y]["ID_Comision"], $comision[$y]["Motivo"], $comision[$y]["Lugar"]);
								}
							?>
							</div>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="columna_derecha_c" style="border-left: none; width: 307px; "><!--c-col-right-->
			<div class="contenedor_js"><!--js-widgetcontainer-->
			<div class="perfil_miembros lista_personas_s caja_c contenedor_js" style="margin-top: 0px; "><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
				<h4>
					<strong class="lf">Sabaticas 
					<?php 
						if($rol == "Administrador" || (isset($_SESSION['ID']) && $_SESSION["Usuario_Temporal"] == $_SESSION["ID"]))
							echo "<a class='agregar_js' value='Sabatico'>Agregar</a>";
					?>
					</strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php
								$comision = $conexion->Consultas("SELECT ID_Comision, Fecha_Inicial, Fecha_Final FROM Comision WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Tipo_Comision LIKE 'Sabatico' AND Fecha_Final > '".date("Y-m-d")."' ORDER BY Fecha_Final");
								for($y = 0; $y < count($comision); $y++)	
									cargar_sab_vac($comision[$y]["Fecha_Inicial"], $comision[$y]["Fecha_Final"], $comision[$y]["ID_Comision"], 0);
								$comision = $conexion->Consultas("SELECT ID_Comision, Fecha_Inicial, Fecha_Final FROM Comision WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Tipo_Comision LIKE 'Sabatico' AND (Fecha_Final < '".date("Y-m-d")."' OR Fecha_Final = '".date("Y-m-d")."') ORDER BY Fecha_Final");
								for($y = 0; $y < count($comision); $y++)	
									cargar_sab_vac($comision[$y]["Fecha_Inicial"], $comision[$y]["Fecha_Final"], $comision[$y]["ID_Comision"], 0);
							?>
						</ul>
					</div>										
				</div>
			</div>
		</div>
		<div class="contenedor_js"><!--js-widgetcontainer-->
			<div class="perfil_miembros lista_personas_s caja_c contenedor_js"><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
					<h4>
					<strong class="lf">Vacaciones 
					<?php 
						if($rol == "Administrador" || (isset($_SESSION['ID']) && $_SESSION["Usuario_Temporal"] == $_SESSION["ID"]))
							echo "<a class='agregar_js' value='Vacacion'>Agregar</a>";
					?>
					</strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php
								$comision = $conexion->Consultas("SELECT ID_Comision, Fecha_Inicial, Fecha_Final FROM Comision WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Tipo_Comision LIKE 'Vacacion' AND Fecha_Inicial > '".date("Y-m-d")."' ORDER BY Fecha_Final");
								for($y = 0; $y < count($comision); $y++)	
									cargar_sab_vac($comision[$y]["Fecha_Inicial"], $comision[$y]["Fecha_Final"], $comision[$y]["ID_Comision"], 1);
								$comision = $conexion->Consultas("SELECT ID_Comision, Fecha_Inicial, Fecha_Final FROM Comision WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Tipo_Comision LIKE 'Vacacion' AND (Fecha_Final < '".date("Y-m-d")."' OR Fecha_Final = '".date("Y-m-d")."') ORDER BY Fecha_Final");
								$anio = 0;
								for($y = 0; $y < count($comision); $y++)
								{
									$fecha_ = explode("-", $comision[$y]["Fecha_Final"]);
									$fecha_ = $fecha_[0];
									if($anio != $fecha_)
									{
										if($anio != 0)
											echo "</div>";
										$anio = $fecha_;
										echo "<h2><a value='".$anio."_div_vac' class='a_vac'>".$anio."</a></h2>";
										echo "<div id='".$anio."_div_vac'  style='display: none;'>";
									}
										cargar_sab_vac($comision[$y]["Fecha_Inicial"], $comision[$y]["Fecha_Final"], $comision[$y]["ID_Comision"], 1);
								}
							?>
							</div>
						</ul>
					</div>										
				</div>
			</div>
		</div>
		</div>
	
	</body>
</html>
