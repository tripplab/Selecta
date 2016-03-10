<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$nombre = $_POST["id"];
		$conexion = new Querys();
	?>
	<head>
		<script>
			$(document).ready(function()
			{     
				$(".limpiar_js").click(function(){
					$("#consulta").val("");
				});
			});
		</script>
	</head>
	<body>
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="contenedor_js"><!--js-widgetcontainer-->
				<div class="contenido_columna_c"><!--c-col-content-->
					<div class="elemento_lleno_ancho subhead">
						<h1>Buscar</h1>
						<form class="formulario_grande formulario_buscar_js">
							<div class="envoltura_buscar_barra envoltura_buscar_js buscar_tiene_valor contenedor_js">
								<div class="indent_contenedor">
									<div class="indent_izquierda">
										<button type="submit" class="boton_barra_buscar boton_buscar_js">
											<span class="icono_buscar"></span>
										</button>
									</div>
									<div class="indent_derecha">
										<a class="limpiar_buscar limpiar_js">
											<span class="cerrar_x"></span>
										</a>
									</div>
									<input value="<?php echo $nombre;?>" type="text" id="consulta" name="consulta" class="input_barra_buscar input_buscar_js" placeholder="Buscar usuario" autocomplete="off" >
								</div>
							</div>
						</form>
					</div>
					<div class="buscar_contenido_js">
						<div class="contenido_c" style="border-right: none;"><!--c-content-->
							<div class="buscar_resultados_js">
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="lista_gente_m">
										<ul class="lista_c">
											<?php
												$usuario = $conexion->Consultas("SELECT Usuario.Nombre, Apellido_Paterno, Apellido_Materno, ID_Usuario, Unidad.Nombre as Unidad FROM Usuario, Unidad_Departamento, Unidad WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND ID_Unidad = FK_Unidad AND Usuario.Nombre LIKE '".$nombre."%' ORDER BY Usuario.Nombre");
												for($i = 0; $i < count($usuario); $i++)
												{
											?>
													<li class="temas_gente tema_lista_js contenedor_js">
														<div class="indent_izquierda">
															<div class="m_imagen_c gente_imagen">
																<a href="../Perfil/?i=<?php echo $usuario[$i]["ID_Usuario"];?>&n=<?php echo $usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"];?>">
																	<?php
																		if(file_exists("../fotos_perfil/".$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].".jpg"))
																		{
																	?>
																			<img src="../fotos_perfil/<?php echo $usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"];?>.jpg" height="50px" width="50px">
																	<?php
																		}
																		else
																		{
																	?>
																			<img src="../fotos_perfil/default.jpg" height="50px" width="50px">
																	<?php
																		}
																	?>
																</a>
															</div>
														</div>
														<div class="indent_contenedor">
															<h5><a class="presentar_nombre" href="../Perfil/?i=<?php echo $usuario[$i]["ID_Usuario"];?>&n=<?php echo $usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"];?>"><?php echo $usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"];?></a>
																<span class="meta" style="font-weight: normal;">
																	&nbsp; <span style="white-space: nowrap;"></span>
																</span>
															</h5>
															<div class="linea_simple_truncada">
																<span class="meta"><?php echo $usuario[$i]["Unidad"];?></span>
															</div>
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
					</div>
				</div>
			</div>
		</div>
		<div class="limpiar"></div><!--clear-->
		<div>
			<div id="footer" class="clearfix">
				<!---<span class="footer-right">DERECHOS RESERVADOS</span>
				<span class="footer-left">DERECHOS RESERVADOS</span>--->
			</div>
		</div>
	</body>
</html>
