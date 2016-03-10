<html>	
	<?php
		include '../Scripts/query.php';
		$conexion = new Querys();
		$id = $_POST["id"];
	?>
	<head>
		<script>
			$(document).ready(function()
			{     
				$(".editar_miembro_lab").click(function(){
					var confirmar = confirm("Desea eliminar este Laboratorio");
					if(confirmar)
					{
						var id = $(this).attr("value"); 
						$.post("../Scripts/guardar.php", {opcion: "eliminar_Laboratorio", id: id}, function(data){
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
					<strong class="lf">Laboratorios</strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php
								$laboratorio = $conexion->Consultas("SELECT Nombre, ID_Laboratorio FROM Laboratorio, Unidad_Departamento WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Departamento = ".$id." ORDER BY Nombre");
								for($y = 0; $y < count($laboratorio); $y++)
								{
							?>
									<li class="tema_miembro lista_temas_js contenedor_js" style="padding-left: 0px;" id="<?php echo $laboratorio[$y]["ID_Laboratorio"];?>"><!--people-item js-list-item js-widget-container-->
										<?php
											if($_SESSION["Rol"] == "Administrador")
											{
										?>
										<div class="indent_derecha"><!--indent-right-->
											<div class="boton_eliminar_miembro arreglar_limpiar contenedor_js"><!--follow-button clearfix js-widgetcontainer-->
												<a class="boton boton_plano boton_eli_miembro js_eli_miembro accion_eli_miembro editar_miembro_lab" value="<?php echo $laboratorio[$y]["ID_Laboratorio"];?>"><!--btn btn-plain btn-follow js-follow action-follow-->Eliminar</a>
											</div>
										</div>
										<?php
											}
										?>
										<div class="indent_contenedor"><!--indent-container-->
											<h5>
												<a href="../Laboratorio/?i=<?php echo $laboratorio[$y]["ID_Laboratorio"];?>&n=<?php echo $laboratorio[$y]["Nombre"];?>"> <?php echo $laboratorio[$y]["Nombre"];?></a>
												<div class="linea_simple_truncada"><!--truncate-single-line-->
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
