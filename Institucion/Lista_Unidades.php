<html>
	<head>
		<script>
			$(document).ready(function()
			{     
				$(".editar_miembro_lab").click(function(){
					var confirmar = confirm("Desea eliminar esta Unidad");
					if(confirmar)
					{
						var id = $(this).attr("value"); 
						$.post("../Scripts/guardar.php", {opcion: "eliminar_unidad", id: id}, function(data){
							if(data == "")
								$(".bloque_miembros #" + id).hide();
							else
								alert(data);
						});
					}
				});
			});
		</script>
	</head>
	<body>
		<div class="contenedor_js"><!--js-widgetcontainer-->
			<div class="perfil_miembros lista_personas_s caja_c contenedor_js"><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
				<h4>
					<strong class="lf">Unidades</strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php
								session_start();
								include '../Scripts/query.php';
								$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
								$conexion = new Querys();
								$id = $_POST["id"];
								$unidad = $conexion->Consultas("SELECT Nombre, Abreviacion, ID_Unidad FROM Unidad WHERE FK_Institucion = ".$id." ORDER BY Nombre");
								for($y = 0; $y < count($unidad); $y++)	
								{
							?>
									<li class="tema_miembro lista_temas_js contenedor_js" id="<?php echo $unidad[$y]["ID_Unidad"];?>" style="padding-left: 0px;"><!--people-item js-list-item js-widget-container-->
										<?php
											if($rol == "Administrador")
											{
										?>
												<div class="indent_derecha"><!--indent-right-->
													<div class="boton_eliminar_miembro arreglar_limpiar contenedor_js"><!--follow-button clearfix js-widgetcontainer-->
														<a class="boton boton_plano boton_eli_miembro js_eli_miembro accion_eli_miembro editar_miembro_lab" value="<?php echo $unidad[$y]["ID_Unidad"];?>"><!--btn btn-plain btn-follow js-follow action-follow-->Eliminar</a>
													</div>
												</div>
										<?php
											}
										?>
										<div class="indent_contenedor"><!--indent-container-->
											<h5>
												<a href="../Unidad/?i=<?php echo $unidad[$y]["ID_Unidad"];?>&n=<?php echo $unidad[$y]["Nombre"];?>"> <?php echo $unidad[$y]["Nombre"];?></a>
												<div class="linea_simple_truncada"><!--truncate-single-line-->
													<a class="meta dar_baja"><?php echo $unidad[$y]["Abreviacion"];?></a>
												</div>
											</h5>
										</div>
									</li>
							<?php
								}
							?>
						</ul>
					</div>										
				</div>
			</div>
		</div>
	</body>
</html>
