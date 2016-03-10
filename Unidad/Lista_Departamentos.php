<html>	
	<?php
		session_start();
		$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
		include '../Scripts/query.php';
		$conexion = new Querys();
		$id = $_POST["id"];
		$departamento = $conexion->Consultas("SELECT Nombre, ID_Departamento FROM Departamento, Unidad_Departamento WHERE FK_Departamento = ID_Departamento AND FK_Unidad = ".$id." AND FK_Departamento IS NOT NULL ORDER BY Nombre");
	?>
	<head>
		<script>
			$(document).ready(function()
			{     
				$(".editar_miembro_lab").click(function(){
					var id = $(this).attr("value"); 
					var opcion = ($(this).attr("data-type"));
					var confirmar = confirm("Desea eliminar este " + opcion);
					if(confirmar)
					{
						$.post("../Scripts/guardar.php", {opcion: "eliminar_" + opcion, id: id}, function(data){
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
					<strong class="lf"><?php echo (count($departamento) > 0) ? "Departamentos" : "Laboratorios";?></strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php
								function crear_lista($id, $nombre, $direccion, $opcion)
								{
							?>
									<li class="tema_miembro lista_temas_js contenedor_js" id="<?php echo $id;?>" style="padding-left: 0px;"><!--people-item js-list-item js-widget-container-->
										<?php
											if($opcion != "" && $GLOBALS["rol"] == "Administrador")
											{
										?>
											<div class="indent_derecha"><!--indent-right-->
												<div class="boton_eliminar_miembro arreglar_limpiar contenedor_js"><!--follow-button clearfix js-widgetcontainer-->
													<a class="boton boton_plano boton_eli_miembro js_eli_miembro accion_eli_miembro editar_miembro_lab" value="<?php echo $id;?>" data-type="<?php echo $opcion;?>"><!--btn btn-plain btn-follow js-follow action-follow-->Eliminar</a>
												</div>
											</div>
										<?php
											}
										?>
										<div class="indent_contenedor"><!--indent-container-->
											<h5>
												<a href="../<?php echo $direccion;?>"> <?php echo $nombre;?></a>
											</h5>
										</div>
									</li>
							<?php	
								}
								for($y = 0; $y < count($departamento); $y++)	
									crear_lista($departamento[$y]["ID_Departamento"], $departamento[$y]["Nombre"], "Departamento/?i=".$departamento[$y]["ID_Departamento"]."&n=".$departamento[$y]["Nombre"], "departamento");
								if(count($departamento) == 0)
								{
									$laboratorio = $conexion->Consultas("SELECT Nombre, ID_Laboratorio FROM Laboratorio, Unidad_Departamento WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ".$id." AND FK_Departamento IS NULL ORDER BY Nombre");
									for($y = 0; $y < count($laboratorio); $y++)	
										crear_lista($laboratorio[$y]["ID_Laboratorio"], $laboratorio[$y]["Nombre"], "Laboratorio/?i=".$laboratorio[$y]["ID_Laboratorio"]."&n=".$laboratorio[$y]["Nombre"], "Laboratorio");
								}
							?>
						</ul>
					</div>										
				</div>
			</div>
			
			<div class="perfil_miembros lista_personas_s caja_c contenedor_js"><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
				<h4>
					<strong class="lf">Programas Académicos</strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php	
								$programa = $conexion->Consultas("SELECT Nombre_Programa, ID_Programa FROM Programa_Academico, Programa_Unidad WHERE ID_Programa = FK_Programa AND FK_Unidad = ".$id." ORDER BY Nombre_Programa");
								for($y = 0; $y < count($programa); $y++)	
									crear_lista($programa[$y]["ID_Programa"], $programa[$y]["Nombre_Programa"], "Programa_Academico/Informacion.php?i=".$programa[$y]["ID_Programa"]."&n=".$programa[$y]["Nombre_Programa"], "");
							?>
						</ul>
					</div>										
				</div>
			</div>
		</div>
	</body>
</html>
