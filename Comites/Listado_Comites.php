<html>
	<?php
		session_start();
		date_default_timezone_set('UTC');
		include '../Scripts/query.php';
		$conexion = new Querys();
		$rol = (isset( $_SESSION["Rol"])) ?  $_SESSION["Rol"]: "";
		$id = $_SESSION["Usuario_Temporal"];
	?>
	<head>
		<script>
			$(document).ready(function()
			{
				$(".a_i").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				$(".a_ii").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				$(".a_iii").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				$(".a_iv").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				$(".a_v").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				$(".a_vi").click(function(){
					if($("#" + $(this).attr("value")).is(":hidden"))
						$("#" + $(this).attr("value")).show();
					else
						$("#" + $(this).attr("value")).hide();
				});
				
				$(".terminar").click(function(){
					$.post("../Scripts/guardar.php", {opcion: 'terminar_comite', id: $(this).attr("value")}, function(data){
						if(data == "")
							$.post("./Listado_Comites.php", function(data){
								$(".comisiones_columna").empty();
								$(".comisiones_columna").append(data);
							});
						else
							alert(data);
					});
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
							$(".comite_formulario").hide();
							$(".mensaje").hide();
							
							$(".inicial").hide();
							$(".comite_formulario").show();
							$("#tipo_comite_").val(tipo);
							$("#tipo_").text(text);
						});
					});
					e.stopPropagation();
				});
			});
		</script>
	</head>
	<body>
		<?php
			function cargar_comites($f_inicial, $f_final, $id, $motivo)
			{
				$inicial = explode("-", $f_inicial);
				$final = explode("-", $f_final);
				?>
					<li class="lista_temas_c publicacion_li contenido_js" style="margin-bottom: 0px; padding-top: 5px;">
						<div class="titulo_expandible" style="margin-top: -2px;">
							<div class="contenido_expandido titulo_js contenido_expandido_js expandido_colapsado_js" style="max-height: none;">
								<span class="titulo">
									<span class="link_titulo_publicacion_js">	
										<?php 
											if($GLOBALS['rol'] == "Administrador" || (isset($_SESSION['ID']) && $GLOBALS['id'] == $_SESSION["ID"]))
											{
										?>
												<a class="titulo_publicacion titulo_publicacion_titulo_js editar_producto_copei" href="./Editar.php?i=<?php echo $id;?>&n=<?php echo $motivo;?>"><?php echo $motivo;?></a>	
										<?php 
											}
											else
											{
										?>	
												<a class="titulo_publicacion titulo_publicacion_titulo_js editar_producto_copei"><?php echo $motivo;?></a>	
										<?php 
											}
										?>	
									</span>		
								</span>			
							</div>					
						</div>	
						<div class="detalles"><?php echo $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".(($final[2] == "00" && $final[1] == "00" && $final[0] == "0000") ? "Presente (<a class='terminar' value='".$id."'>Terminar</a>)" : $final[2]."/".$final[1]."/".$final[0])?></div>						
					</li>
				<?php
			}
		?>
		<table>
			<tr>
				<td>
				<?php
				$comites_nombres = $conexion->Consultas("SELECT * FROM Comite ORDER BY Tipo");
				for($x = 0; $x < count($comites_nombres); $x++)
				{	
					if($x == 3)
					echo "</td></tr><tr><td>";
				?>
					<div class="contenido_c" style="padding-top: 0; border-right: none; width: 285px; min-height: 218px;"><!--c-content-->
						<div class="limpiar"></div><!--clear-->
						<div class="envoltura_contenido_literatura"><!--literature-content-wrapper-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								<div class="publicaciones_p publicaciones_js"><!--publication-feed js-publication-feed-->
									<ul class="publicacion_cuerpo_p lista_contenido_js"><!--publication-feed-body js-list-content-->
										<h2 style="margin-top: 0; padding: 0 0 0px;">
											<?php 
												echo $comites_nombres[$x]["Tipo"];
												if($rol == "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
													echo " <a class='agregar_js' value='".$comites_nombres[$x]["ID_Comite"]."'>Agregar</a>";
											?>
										</h2>
										<?php
											$comite = $conexion->Consultas("SELECT ID_Usuario_Comite, Fecha_Inicio, Fecha_Final, Nombre_Comite FROM Usuario_Comite WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Comite = ".$comites_nombres[$x]["ID_Comite"]." AND (Fecha_Final > '".date("Y-m-d")."' OR Fecha_Final = '0000-00-00') ORDER BY Fecha_Final");
											for($y = 0; $y < count($comite); $y++)
												cargar_comites($comite[$y]["Fecha_Inicio"], $comite[$y]["Fecha_Final"], $comite[$y]["ID_Usuario_Comite"], $comite[$y]["Nombre_Comite"]);
											$comite = $conexion->Consultas("SELECT ID_Usuario_Comite, Fecha_Inicio, Fecha_Final, Nombre_Comite FROM Usuario_Comite WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Comite = ".$comites_nombres[$x]["ID_Comite"]." AND (Fecha_Final < '".date("Y-m-d")."' OR Fecha_Final = '".date("Y-m-d")."') AND Fecha_Final NOT LIKE '0000-00-00' ORDER BY Fecha_Final");
											$anio = 0;
											for($y = 0; $y < count($comite); $y++)
											{
												$fecha_ = explode("-", $comite[$y]["Fecha_Final"]);
												$fecha_ = $fecha_[0];
												if($anio != $fecha_)
												{
													if($anio != 0)
														echo "</div>";
													$anio = $fecha_;
													$tipo = explode(" ", $comites_nombres[$x]["Tipo"]);
													$tipo = explode(".", $tipo[0]);
													$tipo = $tipo[1];
													echo "<h2><a value='".$anio."_div_".$tipo."' class='a_".$tipo."'>".$anio."</a></h2>";
													echo "<div id='".$anio."_div_".$tipo."'  style='display: none;'>";
												}
												cargar_comites($comite[$y]["Fecha_Inicio"], $comite[$y]["Fecha_Final"], $comite[$y]["ID_Usuario_Comite"], $comite[$y]["Nombre_Comite"]);
											}
										?>
										</div>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>
				</td>
			</tr>
		</table>
	</body>
</html>

