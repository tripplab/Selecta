<html>
	<head>
		<script src="../Unidad/Unidad.js"></script>
		<script>
			$(document).ready(function()
			{     
				$(".columna_derecha_c").load( "./Lista_Departamentos.php", {id: $("#id_unidad").val()});
			});
		</script>
	</head>
	<?php
		session_start();
		$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
		include '../Scripts/query.php';
		$id = $_POST["id"];
		$conexion = new Querys();
		$unidad = $conexion->Consultas("SELECT * FROM Unidad WHERE ID_Unidad = ".$id);
		$unidad = $unidad[0];
	?>
	<body>
		<input type="hidden" value="<?php echo $unidad["ID_Unidad"];?>" id="id_unidad">
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="facilitar_envoltura contenedor_js"><!--facility-wrapper js-widgetcontainer-->
				<div class="elemento_lleno_ancho arreglar_limpiar"><!--full-width-element clearfix-->
					<div class="facilitar_cabecera"  style="height: 145px;"><!--facility-header-->
						<div class="facilitar_informacion_cabecera lf"><!--facility-header-info lf-->
							<table class="arreglar_alinear"><!--valign-fix-->
								<tbody>
									<tr>
										<td valign="bottom" height="80px;">
											<h1>
												<a href="./?i=<?php echo $unidad["ID_Unidad"];?>&n=<?php echo $unidad["Nombre"];?>"><span><?php echo $unidad["Nombre"]; ?></span></a>
											</h1>
										</td>
									</tr>
									<tr>
										<td>
											<div class="meta"><?php echo  $unidad["Ciudad"].", ". $unidad["Pais"];?></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<?php
							if($rol == "Administrador")
							{
						?>
						<div class="facilitar_cabecera_acciones rf"><!--facility-header-actions rf-->
							<div class="facilitar_accion_primaria contenedor_js"><!--facility-primary-action js-widgetcontainer-->
								<a class="boton boton_promover boton_ancho_completo boton_largo boton_invitar departamento" value="<?php echo $unidad["ID_Unidad"];?>"><!--btn btn-promote btn-fullwidth btn-large btn-invite-->Agregar Departamento</a>
							</div>
							<div class="facilitar_accion_primaria contenedor_js"><!--facility-primary-action js-widgetcontainer-->
								<a class="boton boton_promover boton_ancho_completo boton_largo boton_invitar laboratorio" value="<?php echo $unidad["ID_Unidad"];?>"><!--btn btn-promote btn-fullwidth btn-large btn-invite-->Agregar Laboratorio</a>
							</div>						
						</div>
						<?php
							}
						?>
						<div class="limpiar"></div><!--clear-->
					</div>
				</div>
				<div class="limpiar"></div><!--clear-->
				<div class="envoltura_facilitar_principal"><!--facility-main-wrapper-->
					<div class="layout_caja_padded"><!--layout-padded-boxes-->
						<div class="contenido_columna_c"><!--c-col-content-->
							<div class="contenido_c" style="border-right: none;"><!--c-content-->
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="caja_c informacion_institucion contenedor_js" style="margin: 0px;"><!--c-box info-institution js-widgetcontainer-->
										<h4 class="ningun_margen"><!--no-margin-->Información</h4>
										<ul>
											<li class="tema_informacion_institucion abrir_editar contenedor_js nombre_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Nombre</div>
												<?php
													if($rol == "Administrador")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="nombre"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="nombre" id="a_nombre"><!--js-edit-open placeholder-link--><?php echo $unidad["Nombre"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="nombre" id="a_nombre"><!--js-edit-open placeholder-link--><?php echo $unidad["Nombre"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios nombre_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_unidad" value="nombre"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="unidad" name="opcion">
														<input type="hidden" value="<?php echo $unidad["ID_Unidad"];?>" name="id_unidad">
														<div class="control_grupo c_nombre"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="nombre_l">Nombre *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $unidad["Nombre"];?>" class="valor_tema_institution texto campo_laboratorio" id="nombre_form" name="nombre"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="nombre"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js ubicacion_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Ubicación</div>
												<?php
													if($rol == "Administrador")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="ubicacion"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="ubicacion" id="a_ubicacion"><!--js-edit-open placeholder-link--><?php echo ($unidad['Ciudad'] != "" && $unidad['Pais'] != "") ?  $unidad['Ciudad'].", ".$unidad['Pais'] : $unidad['Ciudad']."".$unidad['Pais']; ?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="ubicacion" id="a_ubicacion"><!--js-edit-open placeholder-link--><?php echo ($unidad['Ciudad'] != "" && $unidad['Pais'] != "") ?  $unidad['Ciudad'].", ".$unidad['Pais'] : $unidad['Ciudad']."".$unidad['Pais']; ?></a>
												<?php
													}
												?>
												<input type="hidden" id="h_pais" value="<?php echo $unidad["Pais"];?>">
												<input type="hidden" id="h_ciudad" value="<?php echo $unidad["Ciudad"];?>">
												<input type="hidden" id="h_domicilio" value="<?php echo $unidad["Direccion"];?>">
											</li>
											<div class="contenedor_js formularios ubicacion_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_unidad" value="ubicacion"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="unidad" name="opcion">
														<input type="hidden" value="<?php echo $unidad["ID_Unidad"];?>" name="id_unidad">
														<div class="control_grupo c_domicilio"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="domicilio">Domicilio </label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $unidad["Direccion"];?>" class="valor_tema_institution texto campo_laboratorio" id="domicilio_form" name="domicilio"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo c_ciudad"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="ciudad">Ciudad </label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $unidad["Ciudad"];?>" class="valor_tema_institution texto campo_laboratorio" id="ciudad_form" name="ciudad"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo c_pais"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="l_pais">Pais *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $unidad["Pais"];?>" class="valor_tema_institution texto campo_laboratorio" id="pais_form" name="pais"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="ubicacion"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js abreviacion_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Abreviación</div>
												<?php
													if($rol == "Administrador")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="abreviacion"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="abreviacion" id="a_abreviacion"><!--js-edit-open placeholder-link--><?php echo ($unidad["Abreviacion"] == "") ? "Agregar Abreviación" : $unidad["Abreviacion"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="abreviacion" id="a_abreviacion"><!--js-edit-open placeholder-link--><?php echo ($unidad["Abreviacion"] == "") ? "Agregar Abreviación" : $unidad["Abreviacion"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios abreviacion_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_unidad" value="abreviacion"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="unidad" name="opcion">
														<input type="hidden" value="<?php echo $unidad["ID_Unidad"];?>" name="id_unidad">
														<div class="control_grupo"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label>Abreviacion</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $unidad["Abreviacion"];?>" class="valor_tema_institution texto campo_laboratorio" id="abreviacion_form" name="abreviacion"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="abreviacion"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js pagina_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Página Web</div>
												<?php
													if($rol == "Administrador")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="pagina"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="pagina" id="a_pagina"><!--js-edit-open placeholder-link--><?php echo ($unidad["Pagina_Web"] == "") ? "Agregar Página Web" : $unidad["Pagina_Web"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="pagina" id="a_pagina"><!--js-edit-open placeholder-link--><?php echo ($unidad["Pagina_Web"] == "") ? "Agregar Página Web" : $unidad["Pagina_Web"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios pagina_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_unidad" value="pagina"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="unidad" name="opcion">
														<input type="hidden" value="<?php echo $unidad["ID_Unidad"];?>" name="id_unidad">
														<div class="control_grupo"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label>Página Web</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $unidad["Pagina_Web"];?>" class="valor_tema_institution texto campo_laboratorio" id="pagina_form" name="pagina"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="pagina"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js telefono_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Telefono</div>
												<?php
													if($rol == "Administrador")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="telefono"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="telefono" id="a_telefono"><!--js-edit-open placeholder-link--><?php echo ($unidad["Telefono"] == "") ? "Agregar Telefono" : $unidad["Telefono"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="telefono" id="a_telefono"><!--js-edit-open placeholder-link--><?php echo ($unidad["Telefono"] == "") ? "Agregar Telefono" : $unidad["Telefono"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios telefono_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_unidad" value="telefono"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="unidad" name="opcion">
														<input type="hidden" value="<?php echo $unidad["ID_Unidad"];?>" name="id_unidad">
														<div class="control_grupo"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label>Telefono</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $unidad["Telefono"];?>" class="valor_tema_institution texto campo_laboratorio" id="telefono_form" name="telefono"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="telefono"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
										</ul>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
							</div>
							<div class="columna_derecha_c" style="border-left: none;" id="columna_derecha"><!--c-col-right-->
								
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
