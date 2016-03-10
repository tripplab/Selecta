<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$conexion = new Querys();
		$id = $_SESSION["Usuario_Temporal"];
		$rol = (isset( $_SESSION["Rol"])) ?  $_SESSION["Rol"]: "";
	?>
	<head>
		<script src="./Publicaciones.js"></script>
		<script src="../Scripts/jquery.cookies.2.2.0.min.js"></script>
	</head>
	<script>
		 $(document).ready(function()
		{
			if($.cookie('impacto') == null || $.cookie('imp') == '')
			{
				$.cookie('impacto', '1');
				$("#umbral_factor").val($.cookie('impacto'));
				$("#l_umbral_factor").text($.cookie('impacto'));
			}
			else
			{
				$("#umbral_factor").val($.cookie('impacto'));
				$("#l_umbral_factor").text($.cookie('impacto'));
			}
			if($.cookie('citas') == null || $.cookie('citas') == '')
			{
				$.cookie('citas', '1');
				$("#umbral_citas").val($.cookie('citas'));
				$("#l_umbral_citas").text($.cookie('citas'));
			}
			else 
			{
				$("#umbral_citas").val($.cookie('citas'));
				$("#l_umbral_citas").text($.cookie('citas'));
			}
			
			$(".cabecera_literatura .cabecera_contenedora .umbral .guardar_editar").click(function(){
				$.cookie('impacto', $('#umbral_factor').val());
				$.cookie('citas', $('#umbral_citas').val());
			});
		
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .datos_generales");	
		});	  
	</script>
	<body>
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="envoltura_literatura" id="envoltura_literatura_publicaciones"><!--literature-wrapper-->
				<div id="envoltura_literatura_div">
					<div class="cabecera_literatura elemento_lleno_ancho" id="elemento_cabecera_literatura" style="padding-bottom: 27px;"><!--literature-header full-width-element-->
						
						<div class="lf imagen_cabecera_perfil "><!--profile-header-image lf-->
							<div class="envoltura_perfil_imagen contenedor_js"><!--profile-image-wrapper js-idgetcontainer-->
								<?php 
								
									$nombre = $conexion->Consultas("SELECT Usuario.Nombre, Apellido_Paterno, Apellido_Materno, FK_Departamento, Unidad.Nombre as Unidad, Institucion.Nombre as Institucion, ID_Institucion, ID_Unidad FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ID_Unidad AND FK_Institucion = ID_Institucion AND ID_Usuario = ".$id);
									$nombre = $nombre[0];
								?>
								<input type="hidden" value="<?php echo $id;?>" id="id_usuario">
								<input type="hidden" value="<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>" id="nombre_usuario">
								<input type="file" style="display: none;" id="subir_archivo">
								<div class="imagen_c_xl" style="height: 178px;"><!--c-img-xl--> 
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
										<td style="padding: 3;">
											<div>
												<div class="arreglar_limpiar institucion contenedor_js"><!--clearfix meta profile- js-widgetcontainer--->
													<div class="lf nombre_institucion linea_simple_truncada"><!--lf position truncate-single-line-->
														<strong><a id="institucion" value="<?php echo $nombre["ID_Institucion"];?>" href="../Institucion/Informacion.php?i=<?php echo $nombre["ID_Institucion"];?>&n=<?php echo $nombre["Institucion"];?>"><?php echo $nombre["Institucion"];?></a></strong>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding: 3;">
											<div>
												<div class="arreglar_limpiar institucion contenedor_js"><!--clearfix meta profile- js-widgetcontainer--->
													<a class="lf nombre_unidad linea_simple_truncada" id="unidad" value="<?php echo $nombre["ID_Unidad"];?>" href="../Unidad/?i=<?php echo $nombre["ID_Unidad"];?>&n=<?php echo $nombre["Unidad"];?>"><!--lf institution org truncate-single-line--><?php echo $nombre["Unidad"];?></a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding: 3;">
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
							<div class="limpiar"></div><!--clear-->
						</div>
						<div class="cabecera_contenedora rf"><!--header-content lf-->
							<h2>Producción COPEI (Puntos <span id="puntaje_total"></span>)</h2>
							<div class="limpiar"></div><!--clear-->
						</div>
						<?php 
							if($rol == "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
							{
						?>
								<div class="cabecera_contenedora_derecha rf" style="padding-top: 0px;"><!--header-content-right rf-->
									<div class="agregarpublicaciones_perfil contenedor_js"><!--profile-addpublications js-widgetcontainer-->
										<a class="agregar_js boton boton_promover boton_largo boton_ancho_completo">Agregar producto</a><!--js-add btn btn-promote btn-large btn-fullwidth-->
									</div>
									<div class="limpiar"></div><!--clear-->
								</div>
								<div class="umbral" style="padding-top: 37px;"><!--literature-intro-->
									Umbrales:
									<a class="umbral_ editar_link texto_derecha"><!--edit-open edit-link text-right-->
										<span class="icono_editar"><!--ico-edit--></span>Edit</a>
									<br>Factor de Impacto: <span id="l_umbral_factor" class="span_umbral"></span>
									<input type="text" class="texto esconder_cajas" id="umbral_factor">
									<br>Número de Citas: <span id="l_umbral_citas" class="span_umbral"></span>
									<input type="text" class="texto no_citas esconder_cajas" id="umbral_citas">	
									<div class="toolbar_editar" style="margin-top: -40px;"><!--edit-toolbar-->
										<div class="rf">
											<a class="cerrar_editar">Cancelar</a>
											<input type="submit" class="guardar_editar boton boton_promover margen_boton" value="Guardar">
										</div>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
						<?php
							}
						?>
						
						<div class="limpiar"></div><!--clear-->
					</div>
					
					<div class="barra_tabuladora grupo_boton contenedor_js menu_publicaciones"><!--tab-bar btn-group js-widgetcontainer-->
						<a class="boton boton_largo luz_alta cargar_pagina_ajax selected generales"><!--btn btn-large highlights ajax-page-load-->Datos Grales</a>
						<span class="separador"><!--separator-->&nbsp;</span>
						<a class="boton boton_largo luz_alta cargar_pagina_ajax antecedentes"><!--btn btn-large highlights ajax-page-load-->Antecedentes <span id="menu_antecedentes"></span></a>
						<span class="separador"><!--separator-->&nbsp;</span>
						<a class="boton boton_largo luz_alta cargar_pagina_ajax productos_2"><!--btn btn-large highlights ajax-page-load-->Investigación/Desarrollo <span id="menu_productos"></span></a>
						<span class="separador"><!--separator-->&nbsp;</span>
						<a class="boton boton_largo luz_alta cargar_pagina_ajax formacion"><!--btn btn-large highlights ajax-page-load-->Recursos Humanos <span id="menu_formacion"></span></a>
						<span class="separador"><!--separator-->&nbsp;</span>
						<a class="boton boton_largo luz_alta cargar_pagina_ajax repercusion"><!--btn btn-large highlights ajax-page-load-->Repercusión</a>
						<span class="separador"><!--separator-->&nbsp;</span>
						<a class="boton boton_largo luz_alta cargar_pagina_ajax criterios"><!--btn btn-large highlights ajax-page-load-->Criterios</a>
					</div>
					
					<div class="limpiar"></div><!--clear-->
				</div>
				
				<div class="contenido_columna_c"><!--c-col-content-->
					<div class="contenido_c" style="padding-top: 0; width: 518px;"><!--c-content-->
						<div class="limpiar"></div><!--clear-->
						<div class="envoltura_contenido_literatura"><!--literature-content-wrapper-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								<div class="publicaciones_p publicaciones_js"><!--publication-feed js-publication-feed-->
									<ul class="publicacion_cuerpo_p lista_contenido_js"><!--publication-feed-body js-list-content-->
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					<div class="columna_derecha_c"><!--c-col-right-->
						<div class="columnaderecha_literatura"><!--literature-rightcolumn-->
							<h2>Articulos posiblemente relacionados contigo</h2>
							<div class="autor_cluster_relacionados contenedor_js"><!--author-cluster-promos js-widgetcontainer-->
								<div class="contenedor_autores_sugerencias promo_caja_c contenedor_js"><!--suggest-author-container c-box-promo js-widgetcontainer-->
									<div class="promocion"><!--promo-->
										<?php 
											if($rol == "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
											{
										?>
												<h3>¿Estos articulos son tuyos?</h3>
										<?php
											}
											else
											{
										?>
												<h3>Articulos que podrían estar relacionados con <?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?></h3>
										<?php
											}
											function lista_relacion($titulo, $identificador, $tipo, $autores)
											{
												?>
												<div class="lista_autores_sugeridos" id=<?php echo $identificador;?>><!--suggest-authors-list-->
													<div class="contenedor_temas_autores_sugeridos contenedor_temas_sugeridos_js"><!--suggest-author-item-container js-suggest-item-container-->
														<div class="temas_sugeridos_js temas_autores_sugeridos contenedor_js"><!--js-suggest-item suggest-author-item js-widetcontainer-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="titulo_autores_pub"><!--pub-author-and-tittle-->
																	<a href="./Editar.php?i=<?php echo $identificador;?>&t=<?php echo $tipo;?>&n=<?php echo $titulo;?>" class="publicacion_url"><!--publication-url-->
																		<div class="titulo_publicacion_js titulo_pub"><!--js-publication-tittle pub-tittle--><?php echo $titulo;?></div>
																	</a>
																	<div class="pub_autores"><!--pub-author-->
																		<span style="color:#444444;"><?php echo $autores;?></span>
																	</div>
																</div>
																<?php
																	if($GLOBALS['rol'] == "Administrador" || (isset($_SESSION['ID']) && $GLOBALS['id'] == $_SESSION["ID"]))
																	{
																?>
																		<div class="botones_acciones"><!--action-buttons-->
																			<button class="si_js boton boton_promover margen_boton" value=<?php echo $identificador;?> data-type=<?php echo $tipo;?>><!--yes-js btn btn-promote btn-margin-->Si</button>
																		</div>
																<?php
																	}
																?>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
											
											$autor = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE ID_Usuario = ".$id);
											$autor = $autor[0];
											$nombre = explode(" ", $autor["Nombre"]);
											$nombre_av = "";
											for($i = 0; $i < count($nombre); $i++)
												$nombre_av .= substr($nombre[$i], 0, 1).". ";
											$nombre_av = trim($nombre_av);
											$producto = $conexion->Consultas("SELECT Titulo, ID_Articulo, Tipo FROM Articulos, Alias, Tipo_Copei WHERE FK_Tipo = ID_Tipo AND ID_Articulo = FK_Articulo AND (Alias = '".$autor["Nombre"]." ".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]."' OR Alias  = '".$autor["Nombre"]." ".$autor["Apellido_Paterno"]."' OR Alias = '".$nombre_av." ".$autor["Apellido_Paterno"]."' OR Alias = '".$nombre_av." ".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]."' OR Alias = '".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]." ".$nombre_av."') AND FK_Usuario IS NULL");
											for($x = 0; $x < count($producto); $x++)
											{
												$autores = $conexion->Consultas("SELECT Alias FROM Alias WHERE FK_Articulo = ".$producto[$x]["ID_Articulo"]);
												$l_autores = "";
												for($z = 0; $z < count($autores); $z++)
													$l_autores .= $autores[$z]["Alias"].", ";
												$l_autores = trim($l_autores, ", ");
												unset($autores);
												lista_relacion($producto[$x]["Titulo"], $producto[$x]["ID_Articulo"], $producto[$x]["Tipo"], $l_autores);
											}
											unset($producto);
											
											$producto = $conexion->Consultas("SELECT Titulo, ID_Tesis, Tipo FROM Tesis, Usuario_Tesis, Tipo_Copei WHERE FK_Tipo = ID_Tipo AND ID_Tesis = FK_Tesis AND (Alias = '".$autor["Nombre"]." ".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]."' OR Alias  = '".$autor["Nombre"]." ".$autor["Apellido_Paterno"]."' OR Alias = '".$nombre_av." ".$autor["Apellido_Paterno"]."' OR Alias = '".$nombre_av." ".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]."' OR Alias = '".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]." ".$nombre_av."') AND FK_Usuario IS NULL");
											for($x = 0; $x < count($producto); $x++)
											{
												$autores = $conexion->Consultas("SELECT Alias FROM Usuario_Tesis WHERE FK_Tesis = ".$producto[$x]["ID_Tesis"]);
												$l_autores = "";
												for($z = 0; $z < count($autores); $z++)
													$l_autores .= $autores[$z]["Alias"].", ";
												$l_autores = trim($l_autores, ", ");
												unset($autores);
												lista_relacion($producto[$x]["Titulo"], $producto[$x]["ID_Tesis"], $producto[$x]["Tipo"], $l_autores);
											}
											unset($producto);
										?>
									</div>
								</div>
							</div>
							<!--<div class="caja_c"><!--c-box-->
								<!--<div class="cajabuscarliteratura_literatura contenedor_js"><!--literature-literaturesearchbox js-widgetcontainer-->
									<!--<form class="formulario_buscador"><!--search-form-->
										<!--<div class="envoltura_busqueda_simple js_envoltura_busqueda"><!--simple-search-wrapper js-search-wrapper-->
											<!--<input type="text" name="consulta" class="input_buscar_js input_simple_buscar" placeholder="Buscar artículo"><!--js-search-input simple-seach_input-->
											<!--<a class="boton_simple_buscar buscar_js"><!--simple-search-button js-search-->
												<!--<span class="buscar_icono_articulo"><!--ico-magnifier--></span>
											<!--</a>										
										</div>
									</form>
									<div class="limpiar"></div><!--clear-->
								<!--</div>
							</div>-->
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
