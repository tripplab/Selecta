<html>
	<?php
		session_start();
		$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
		include '../Scripts/query.php';
		$id = $_POST["id"];
		$conexion = new Querys();
		$laboratorio = $conexion->Consultas("SELECT ID_Laboratorio, Laboratorio.Nombre, Descripcion, Ext_Telefono, Pag_Web, Cupo_Integrantes, Numero, Unidad.Ciudad, Unidad.Pais, Unidad.Nombre as Unidad, Institucion.Nombre AS Institucion, ID_Unidad, ID_Institucion, FK_Departamento FROM Laboratorio, Unidad_Departamento, Unidad, Institucion WHERE FK_Institucion = ID_Institucion AND FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ID_Unidad AND ID_Laboratorio = ".$id);
		$laboratorio = $laboratorio[0];
	?>
	<head>
		<script src="../Laboratorio/Laboratorio.js"></script>
	</head>
	<body>
		<input type="hidden" value="<?php echo $laboratorio["ID_Laboratorio"];?>" id="id_laboratorio">
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="facilitar_envoltura contenedor_js"><!--facility-wrapper js-widgetcontainer-->
				<div class="elemento_lleno_ancho arreglar_limpiar"><!--full-width-element clearfix-->
					<div class="facilitar_cabecera"><!--facility-header-->
						<div class="facilitar_informacion_cabecera lf"><!--facility-header-info lf-->
							<table class="arreglar_alinear"><!--valign-fix-->
								<tbody>
									<tr>
										<td valign="bottom" height="80px;">
											<h1>
												<a href="./?i=<?php echo $laboratorio["ID_Laboratorio"];?>&n=<?php echo $laboratorio["Nombre"];?>"><span>Laboratorio <?php echo $laboratorio["Numero"].": ".$laboratorio["Nombre"];?></span></a>
											</h1>
										</td>
									</tr>
									<tr>
										<td>
											<div class="meta"><?php echo  $laboratorio["Ciudad"].", ". $laboratorio["Pais"];?></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>						
						<?php
							if($rol == "Administrador" || $rol == "Profesor")
							{
						?>
						<div class="facilitar_cabecera_acciones rf"><!--facility-header-actions rf-->
							<div class="facilitar_accion_primaria contenedor_js"><!--facility-primary-action js-widgetcontainer-->
								<a class="boton boton_promover boton_ancho_completo boton_largo boton_invitar" value="<?php echo $laboratorio["ID_Laboratorio"];?>"><!--btn btn-promote btn-fullwidth btn-large btn-invite-->Agregar Miembros</a>
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
											<li class="tema_informacion_institucion abrir_editar contenedor_js CUD_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Centro/Unidad</div>																		
												<?php
													$departamento = "";
													if($laboratorio["FK_Departamento"] != null)
													{
														$departamento = $conexion->Consultas("SELECT Nombre FROM Departamento WHERE ID_Departamento = ".$laboratorio["FK_Departamento"]);
														$departamento = $departamento[0]["Nombre"];
													}
													if($rol == "Administrador" || $rol == "Profesor")
													{
												?>
													<div class="indent_derecha"><!--indent-right-->
														<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="CUD"><!--js-edit-open edit-link text-right-->
															<span class="icono_editar"></span>Editar</a>
													</div>
													<a class="abrir_editar_js placeholder_link" value="CUD" id="a_institucion"><!--js-edit-open placeholder-link--><?php echo $laboratorio["Institucion"];?></a>
													<a class="abrir_editar_js placeholder_link" value="CUD" id="a_unidad"><!--js-edit-open placeholder-link--><?php echo $laboratorio["Unidad"];?></a>
													<a class="abrir_editar_js placeholder_link" value="CUD" id="a_departamento"><!--js-edit-open placeholder-link--><?php echo $departamento;?></a>
													<?php
														}
														else
														{
													?>
													<a class="placeholder_link" value="CUD" id="a_institucion"><!--js-edit-open placeholder-link--><?php echo $laboratorio["Institucion"];?></a>
													<a class=" placeholder_link" value="CUD" id="a_unidad"><!--js-edit-open placeholder-link--><?php echo $laboratorio["Unidad"];?></a>
													<a class=" placeholder_link" value="CUD" id="a_departamento"><!--js-edit-open placeholder-link--><?php echo $departamento;?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios CUD_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="CUD"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="lab_miembro" name="opcion">
														<input type="hidden" value="<?php echo $laboratorio["ID_Laboratorio"];?>" name="id_laboratorio">
														<input type="hidden" id="id_institucion" name="id_institucion" value="<?php echo $laboratorio["ID_Institucion"];?>">
														<input type="hidden" id="id_unidad" name="id_unidad" value="<?php echo $laboratorio["ID_Unidad"];?>">
														<input type="hidden" id="id_departamento" name="id_departamento" value="<?php echo $laboratorio["FK_Departamento"];?>">
														<div class="control_grupo c_institucion"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="institucion_l">Institución *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="textbox" value="<?php echo $laboratorio["Institucion"];?>" id="institucion" placeholder="Teclea el nombre de la Institución y elige la opcion correcta de la lista" style="width: 375px;" maxlength="255" class="valor_tema_institution texto campo_laboratorio" name="institucion">
																	<div id="cargar_lista_institucion" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 376px; left: 100px; top: 24px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
																		<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
																			<ul class="yu_lista_aclista" role="listbox" id="contenedor_institucion"><!--yui3-aclist-list-->
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="control_grupo c_unidad"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="unidad_l">Unidad *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="textbox" value="<?php echo $laboratorio["Unidad"];?>" id="unidad" placeholder="Teclea el nombre de la Unidad y elige la opcion correcta de la lista" style="width: 375px;" maxlength="255" class="valor_tema_institution texto campo_laboratorio" name="unidad">
																	<div id="cargar_lista_unidad" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 376px; left: 100px; top: 24px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
																		<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
																			<ul class="yu_lista_aclista" role="listbox" id="contenedor_unidad"><!--yui3-aclist-list-->
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="control_grupo c_departamento" id="departamento_div"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="departamento_l">Departamento *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="textbox" value="<?php echo $departamento;?>" id="departamento" placeholder="Teclea el nombre del Departamento y elige la opcion correcta de la lista" style="width: 375px;" maxlength="255" class="valor_tema_institution texto campo_laboratorio" name="departamento">
																	<div id="cargar_lista_departamento" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 376px; left: 100px; top: 24px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
																		<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
																			<ul class="yu_lista_aclista" role="listbox" id="contenedor_departamento"><!--yui3-aclist-list-->
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="CUD"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js numero_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Número</div>
												<?php
													if($rol == "Administrador" || $rol == "Profesor")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="numero"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="numero" id="a_numero"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Numero"] == "0") ? "Agregar Numero" : $laboratorio["Numero"];?></a>
												<?php
													}
													else
													{
												?>
												<a class=" placeholder_link" value="numero" id="a_numero"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Numero"] == "0") ? "Agregar Numero" : $laboratorio["Numero"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios numero_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="numero"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="lab_miembro" name="opcion">
														<input type="hidden" value="<?php echo $laboratorio["ID_Laboratorio"];?>" name="id_laboratorio">
														<div class="control_grupo c_numero"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="numero_l">Número *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $laboratorio["Numero"];?>" class="valor_tema_institution texto campo_laboratorio" id="numero_form" name="numero"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="numero"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js nombre_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Nombre</div>
												<?php
													if($rol == "Administrador" || $rol == "Profesor")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="nombre"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="nombre" id="a_nombre"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Nombre"] == "") ? "Agregar Nombre" : $laboratorio["Nombre"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="nombre" id="a_nombre"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Nombre"] == "") ? "Agregar Nombre" : $laboratorio["Nombre"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios nombre_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="nombre"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="lab_miembro" name="opcion">
														<input type="hidden" value="<?php echo $laboratorio["ID_Laboratorio"];?>" name="id_laboratorio">
														<div class="control_grupo c_nombre"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="nombre">Nombre *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $laboratorio["Nombre"];?>" class="valor_tema_institution texto campo_laboratorio" id="nombre_form" name="nombre"><!--institution-item-value text institution-field-street-->
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
											<li class="tema_informacion_institucion abrir_editar contenedor_js descripcion_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Descripción</div>
												<?php
													if($rol == "Administrador" || $rol == "Profesor")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="descripcion"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="descripcion" id="a_descripcion"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Descripcion"] == "") ? "Agregar Descripción" : $laboratorio["Descripcion"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="descripcion" id="a_descripcion"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Descripcion"] == "") ? "Agregar Descripción" : $laboratorio["Descripcion"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios descripcion_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="descripcion"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="lab_miembro" name="opcion">
														<input type="hidden" value="<?php echo $laboratorio["ID_Laboratorio"];?>" name="id_laboratorio">
														<div class="control_grupo"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label>Descripción</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<textarea class="valor_tema_institution texto campo_laboratorio" id="descripcion_form" name="descripcion" style="height:126px;"><?php echo $laboratorio["Descripcion"];?></textarea>	
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="descripcion"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js telefono_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Telefono</div>
												<?php
													if($rol == "Administrador" || $rol == "Profesor")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="telefono"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="telefono" id="a_telefono"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Ext_Telefono"] == "") ? "Agregar Telefono" : $laboratorio["Ext_Telefono"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="telefono" id="a_telefono"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Ext_Telefono"] == "") ? "Agregar Telefono" : $laboratorio["Ext_Telefono"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios telefono_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="telefono"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="lab_miembro" name="opcion">
														<input type="hidden" value="<?php echo $laboratorio["ID_Laboratorio"];?>" name="id_laboratorio">
														<div class="control_grupo"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label>Telefono</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $laboratorio["Ext_Telefono"];?>" class="valor_tema_institution texto campo_laboratorio" id="telefono_form" name="telefono"><!--institution-item-value text institution-field-street-->
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
											<li class="tema_informacion_institucion abrir_editar contenedor_js pagina_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Página Web</div>
												<?php
													if($rol == "Administrador" || $rol == "Profesor")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="pagina"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="pagina" id="a_pagina"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Pag_Web"] == "") ? "Agregar Página Web" : $laboratorio["Pag_Web"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="pagina" id="a_pagina"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Pag_Web"] == "") ? "Agregar Página Web" : $laboratorio["Pag_Web"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios pagina_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="pagina"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="lab_miembro" name="opcion">
														<input type="hidden" value="<?php echo $laboratorio["ID_Laboratorio"];?>" name="id_laboratorio">
														<div class="control_grupo"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label>Página Web</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $laboratorio["Pag_Web"];?>" class="valor_tema_institution texto campo_laboratorio" id="pagina_form" name="pagina"><!--institution-item-value text institution-field-street-->
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
											<li class="tema_informacion_institucion abrir_editar contenedor_js cupo_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda"><!--indent-left-->Cupo máximo miembros</div>
												<?php
													if($rol == "Administrador" || $rol == "Profesor")
													{
												?>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="cupo"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="cupo" id="a_cupo"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Cupo_Integrantes"] == "0") ? "Agregar Cupo" : $laboratorio["Cupo_Integrantes"];?></a>
												<?php
													}
													else
													{
												?>
												<a class="placeholder_link" value="cupo" id="a_cupo"><!--js-edit-open placeholder-link--><?php echo ($laboratorio["Cupo_Integrantes"] == "0") ? "Agregar Cupo" : $laboratorio["Cupo_Integrantes"];?></a>
												<?php
													}
												?>
											</li>
											<div class="contenedor_js formularios cupo_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="cupo"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="lab_miembro" name="opcion">
														<input type="hidden" value="<?php echo $laboratorio["ID_Laboratorio"];?>" name="id_laboratorio">
														<div class="control_grupo"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label>Cupo máximo</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $laboratorio["Cupo_Integrantes"];?>" class="valor_tema_institution texto campo_laboratorio" id="cupo_form" name="cupo"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="cupo"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
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
