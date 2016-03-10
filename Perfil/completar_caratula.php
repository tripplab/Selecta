<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$id = $_POST["id"];
		echo "<input type='hidden' value='".$id."' id='identificador'>";
		$conexion = new Querys();
		$nombre = $conexion->Consultas("SELECT Usuario.Nombre, Apellido_Paterno, Apellido_Materno, FK_Departamento, Unidad.Nombre as Unidad, Institucion.Nombre as Institucion, ID_Institucion, ID_Unidad FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ID_Unidad AND FK_Institucion = ID_Institucion AND ID_Usuario = ".$id);
		$nombre = $nombre[0];
		date_default_timezone_set('UTC');
		$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
	?>
	<head>
		<script src="../Perfil/Perfil.js"></script>
	</head>
	<body>
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="envoltura_perfil"><!--profile-wrapper-->
				<div class="elemento_lleno_ancho arreglar_limpiar contenedor_js"><!--full-width-element clearfix js-widgetcontainer-->
					<div class="cabecera_perfil"><!--profile-header-->
						<div class="lf imagen_cabecera_perfil"><!--profile-header-image lf-->
							<div class="envoltura_perfil_imagen contenedor_js"><!--profile-image-wrapper js-idgetcontainer-->
								<?php 
									if($rol == "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
									{
								?>
										<div class="informacion_no_imagen editar_js"><!--info-no-image edit-js-->
											<div class="informacion"><!--text-->
												<span class="texto_informacion"><!--info-text-->
													<span class="icono_agregar"></span>
													Cambiar imagen
												</span>
											</div>
										</div>
								<?php 
									}
								?>
								<input type="hidden" value="<?php echo $id;?>" id="id_usuario">
								<input type="hidden" value="<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>" id="nombre_usuario">
								<input type="file" style="display: none;" id="subir_archivo">
								<div class="imagen_c_xl"><!--c-img-xl--> 
									<a class="placeholder_imagen editar_js" href="./?i=<?php echo $id;?>&n=<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>"><!--img-placeholder js-edit-->
										<?php
											if(file_exists("../fotos_perfil/".$nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"].".jpg"))
												echo '<img src="../fotos_perfil/'.$nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"].'.jpg" width="178" height="180">';
											else
												echo '<img src="../fotos_perfil/default.jpg" width="178" height="180">';
										?>
									</a>
								</div>
							</div>
						</div>
						<div class="perfil_cabecera_personal lf"><!--profile-header-personal lf-->
							<table class="arreglar_alinear">
								<tbody>
									<tr>
										<td valign="bottom" height="61px;">
											<h1 class="perfil_cabecera_nombre"><!--profile-header-name-->
												<a href="./?i=<?php echo $id;?>&n=<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>"><?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?></a>
											</h1>
										</td>
									</tr>
									<tr>
										<td>
											<div>
												<div class="arreglar_limpiar institucion contenedor_js"><!--clearfix meta profile- js-widgetcontainer--->
													<div class="lf nombre_institucion linea_simple_truncada"><!--lf position truncate-single-line-->
														<strong><a id="institucion" value="<?php echo $nombre["ID_Institucion"];?>" href="../Institucion/Informacion.php?i=<?php echo $nombre["ID_Institucion"];?>&n=<?php echo $nombre["Institucion"];?>"><?php echo $nombre["Institucion"];?></a></strong>
													</div>
													<?php 
														if($rol == "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
														{
													?>
															<a class="lf editar_link editar_js"><!--lf ls-edit edit-link-->
																<span class="icono_editar"><!--ico-edit--></span>Edit</a>
													<?php
														}
													?>														
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div>
												<div class="arreglar_limpiar institucion contenedor_js"><!--clearfix meta profile- js-widgetcontainer--->
													<a class="lf nombre_unidad linea_simple_truncada" id="unidad" value="<?php echo $nombre["ID_Unidad"];?>" href="../Unidad/?i=<?php echo $nombre["ID_Unidad"];?>&n=<?php echo $nombre["Unidad"];?>"><!--lf institution org truncate-single-line--><?php echo $nombre["Unidad"];?></a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div>
												<div class="arreglar_limpiar institucion contenedor_js"><!--clearfix meta profile- js-widgetcontainer--->
													<?php 
														$nombre_departamento = "";
														if($nombre["FK_Departamento"] != null)
														{
															$departamento = $conexion->Consultas("SELECT Nombre FROM Departamento WHERE ID_Departamento = ".$nombre["FK_Departamento"]);
															$nombre_departamento = $departamento[0]["Nombre"];
														}
													?>
													<div class="lf nombre_unidad linea_simple_truncada" id="departamento" value="<?php echo $nombre["FK_Departamento"];?>"><!--lf institution org truncate-single-line--><?php echo $nombre_departamento;?></div>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="limpiar"></div><!--clear-->
					</div>
				</div>
				<div class="barra_tabuladora grupo_boton contenedor_js" style="margin-left: 0px;border-left: 1px solid #ccc;"><!--tab-bar btn-group js-widgetcontainer-->
					<a class="boton boton_largo luz_alta cargar_pagina_ajax selected"><!--btn btn-large highlights ajax-page-load-->Resumen</a>
				</div>
				<div class="limpiar"></div><!--clear-->
				<div class="envoltura_perfil_principal"><!--profile-main-wrapper-->
					<div class="layout_caja_padded contenedor_js"><!--layout-padded-boxes js-widgetcontainer-->
						<div class="contenido_columna_c"><!--c-col-content-->
							<div class="contenido_c" style="border-right: none;"><!--c-content-->
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="contenedor_js"><!--js-widgetcontainer-->
										<div class="caja_c publicaciones_wexp_js" style="margin: 0px;"><!--c-box js-wexp-publications-->
											<h4>
												<strong class="lf">
													<a>Publicaciones destacadas</a>
												</strong>
											</h4>
											<ul>
												<?php
													$articulos = $conexion->Consultas("SELECT ID_Articulo, Titulo FROM Articulos, Alias, Tipo_Copei WHERE ID_Articulo = FK_Articulo AND FK_Usuario = ".$id." AND FK_Tipo = ID_Tipo AND Tipo LIKE '2.1.a'");
													for($x = 0; $x < count($articulos); $x++)
													{
												?>
														<li class="lista_temas_c publicacion_li contenido_js"><!---c-list-item li-publication js-widgetcontainer-->
															<div style="margin-top: -2px;">
																<h5>
																	<span class="tipo_publicacion">Artículo: </span>
																	<a class="link_titulo_publicacion_js">
																		<span class="titulo_publicacion titulo_publicacion_titulo_js"><a href="../Publicaciones/Editar.php?i=<?php echo $articulos[$x]["ID_Articulo"];?>&t=<?php echo "2.1.a";?>&n=<?php echo $articulos[$x]["Titulo"];?>"><?php echo $articulos[$x]["Titulo"];?></a></span>
																	</a>
																</h5>
															</div>
															<?php
																$autor = $conexion->Consultas("SELECT Alias FROM Alias WHERE FK_Articulo = ".$articulos[$x]["ID_Articulo"]);
																$lista_autores = array();
																for($a = 0; $a < count($autor); $a++)
																	$lista_autores[] = $autor[$a]["Alias"];
																$autores = join(", ", $lista_autores);
															?>
															<div class="autores"><?php echo $autores;?></div>
														</li>
												<?php
													}
												?>
											</ul>
										</div>
									</div>
									
									<div class="contenedor_js"><!--js-widgetcontainer-->
										<div class="caja_c publicaciones_wexp_js" style="margin: 20px 0px;"><!--c-box js-wexp-publications-->
											<h4>
												<strong class="lf">
													<a>Proyectos Vigentes</a>
												</strong>
											</h4>
											<ul>
												<?php												
													$producto = $conexion->Consultas("SELECT ID_Proyecto, Fecha_Inicial, Fecha_Final, Titulo, Gastos_Inversion, Gastos_Corr, Moneda FROM Proyecto, Usuario_Proyecto WHERE FK_Proyecto = ID_Proyecto AND FK_Usuario = ".$id." AND Fecha_Inicial < '".date("Y-m-d")."' AND Fecha_Final > '".date("Y-m-d")."' ORDER BY Fecha_Inicial");
													for($x = 0; $x < count($producto); $x++)
													{
														$inicial = explode("-", $producto[$x]["Fecha_Inicial"]);
														$final = explode("-", $producto[$x]["Fecha_Final"]);	
												?>
														<li class="lista_temas_c publicacion_li contenido_js"><!---c-list-item li-publication js-widgetcontainer-->
															<div style="margin-top: -2px;">
																<h5>
																	<span class="tipo_publicacion">Proyecto: </span>
																	<a class="link_titulo_publicacion_js">
																		<span class="titulo_publicacion titulo_publicacion_titulo_js"><a href="../Publicaciones/Editar.php?i=<?php echo $producto[$x]["ID_Proyecto"];?>&t=<?php echo "4.12";?>&n=<?php echo $producto[$x]["Titulo"];?>"><?php echo $producto[$x]["Titulo"];?></a></span>
																	</a>
																</h5>
															</div>
															<div class="autores"><?php echo ($producto[$x]["Gastos_Inversion"] + $producto[$x]["Gastos_Corr"])." ".$producto[$x]["Moneda"];?></div>
															<div class="detalles"><?php echo $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];?></div>
														</li>
												<?php
													}
												?>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="columna_derecha_c" style="border-left: none;"><!--c-col-right-->
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<?php
										$laboratorio = $conexion->Consultas("SELECT ID_Laboratorio, Nombre, Descripcion, Numero FROM Laboratorio, Lab_Miembro WHERE ID_Laboratorio = FK_Laboratorio AND FK_Usuario = ".$id." AND (Fecha_Final > '".date('Y-m-d')."' OR Fecha_Final = '0000-00-00') ORDER BY Numero");
										for($x = 0; $x < count($laboratorio); $x++)
										{
									?>
												<div class="contenedor_js" id="acerca_laboratorio_<?php echo $laboratorio[$x]["ID_Laboratorio"];?>"><!--js-widgetcontainer-->
													<div id="laboratorio_estatico_<?php echo $laboratorio[$x]["ID_Laboratorio"];?>" class="laboratorio_perfil contenedor_luz_js caja_c abrir_editar_js"><!--profile-aboutme js-highlight-container c-box js-edit-open-->
														<h4>
															<strong class="lf"><a href="../Laboratorio/?i=<?php echo $laboratorio[$x]["ID_Laboratorio"];?>&n=<?php echo $laboratorio[$x]["Nombre"];?>">Laboratorio <?php echo $laboratorio[$x]["Numero"];?>: <?php echo $laboratorio[$x]["Nombre"];?></a></strong> 
														</h4>
														<div class="contenedor_perfil_laboratorio abrir_editar"><!--profile-aboutme-container edit-open-->
															 <?php echo $laboratorio[$x]["Descripcion"];?>
														</div>
													</div>
												</div>
									<?php
										}
									?>
								</div>
								
								<div class="contenedor_js" id="sni_cargar"><!--js-widgetcontainer-->
									
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
