<html>
	<head>
		<script>
			$(document).ready(function()
			{     
				$(".editar_miembro_lab").click(function(){
					var id = $(this).attr("value");
					var id_programa = $("#id_programa").val();
					$("body").addClass("superposicion");
					$("#pagina_contenedor").addClass("popup_arreglado");
					$.post("../popup/popup.php", function(data){
						$("#pagina_contenedor").before(data);
					}).done(function(){
						$.post("./Agregar.php", function(data){
							$(".yu_widget_bd").append(data);
							$(".programa_formulario").hide();
							$(".mensaje").hide();
							$("#programa_id").val(id_programa);
							$.post("../Scripts/consulta.php", {opcion: "programa_unidad", id: id}, function(data){
								$("#id_institucion").val(data.ID_Institucion);
								$("#institucion").val(data.Institucion);
								$("#id_unidad").val(data.ID_Unidad);
								$("#unidad").val(data.Unidad);
								$("#periodo").val(data.Periodo_Escolar);
								$("#objetivos").val(data.Objetivos);
								$("#servicio_unidad_programa").val(id);
							}, "json");
						});
					});
				});
				
				$(".dar_baja").click(function(){
					var confirmar = confirm("Desea eliminar esta unidad del programa");
					if(confirmar)
					{
						var id = $(this).attr("value"); 
						$.post("../Scripts/guardar.php", {opcion: "eliminar_programa_unidad", id: id}, function(data){
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
		<?php
			session_start();
			$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
			include '../Scripts/query.php';
			$conexion = new Querys();
			$id = $_POST["id"];
			$unidad = $conexion->Consultas("SELECT ID_Programa_Unidad, Nombre, Abreviacion FROM Programa_Unidad, Unidad WHERE FK_Unidad = ID_Unidad AND FK_Programa = ".$id." ORDER BY Nombre");
		?>
		<div class="contenedor_js"><!--js-widgetcontainer-->
		<input type="hidden" value="<?php echo $id;?>" id="id_programa">
			<div class="perfil_miembros lista_personas_s caja_c contenedor_js"><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
				<h4>
					<strong class="lf">Unidades</strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php
								for($y = 0; $y < count($unidad); $y++)	
								{
							?>
									<li class="tema_miembro lista_temas_js contenedor_js" id="<?php echo $unidad[$y]["ID_Programa_Unidad"];?>" style="padding-left: 0px;"><!--people-item js-list-item js-widget-container-->
										<?php
											if($rol == "Administrador")
											{
										?>
										<div class="indent_derecha"><!--indent-right-->
											<div class="boton_eliminar_miembro arreglar_limpiar contenedor_js"><!--follow-button clearfix js-widgetcontainer-->
												<a class="boton boton_plano boton_eli_miembro js_eli_miembro accion_eli_miembro editar_miembro_lab" value="<?php echo $unidad[$y]["ID_Programa_Unidad"];?>"><!--btn btn-plain btn-follow js-follow action-follow-->Editar</a>
											</div>
										</div>
										<?php
											}
										?>
										<div class="indent_contenedor"><!--indent-container-->
											<h5>
												<a href="../Unidad/?i=<?php echo $unidad[$y]["ID_Programa_Unidad"];?>&n=<?php echo $unidad[$y]["Nombre"];?>"> <?php echo $unidad[$y]["Nombre"];?></a>
												<span class="meta" style="font-weight: normal;"><br>
													<span style="white-space: nowrap;">
														<a class="link_score contenedor_js"><?php echo $unidad[$y]["Abreviacion"];?></a>
													</span>
												</span>
												<span class="meta" style="font-weight: normal;"><br>
													<span style="white-space: nowrap;">
														<a class="link_score contenedor_js" href="../Curso/?i=<?php echo $unidad[$y]["ID_Programa_Unidad"];?>&n=<?php echo $unidad[$y]["Nombre"];?>">Ver Cursos</a>
													</span>
												</span>
												<span class="meta" style="font-weight: normal;"><br>
													<span style="white-space: nowrap;">
														<a class="link_score contenedor_js" href="../Periodo_Escolar/?i=<?php echo $unidad[$y]["ID_Programa_Unidad"];?>&n=<?php echo $unidad[$y]["Nombre"];?>">Ver Periodos Académicos</a>
													</span>
												</span>
												<span class="meta" style="font-weight: normal;"><br>
													<span style="white-space: nowrap;">
														<a class="link_score contenedor_js" href="../Colegio_Programa/?i=<?php echo $unidad[$y]["ID_Programa_Unidad"];?>&n=<?php echo $unidad[$y]["Nombre"];?>">Ver Colegio del Programa</a>
													</span>
												</span>
												<?php
													if($rol == "Administrador")
													{
												?>
												<div class="linea_simple_truncada"><!--truncate-single-line-->
													<a class="meta dar_baja" value="<?php echo $unidad[$y]["ID_Programa_Unidad"];?>">Eliminar de esta Unidad</a>
												</div>
												<?php
													}
												?>
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
