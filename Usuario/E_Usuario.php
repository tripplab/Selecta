<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$conexion = new Querys();
		$usuario = $conexion->Consultas("SELECT ID_Usuario, Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento, Correo_Electronico, Num_Ser_Med, Ultimo_Nivel_Academico, Rol, Estatus, Nick FROM Usuario WHERE ID_Usuario = ".$_SESSION["ID"]);
		$usuario = $usuario[0];
	?>
	<head>
		<script src="./e_usuario.js"></script>
	</head>
	<body>
		<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" id="id_usuario">
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
												Editar Perfil
											</h1>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
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
												<div class="indent_izquierda" id="nombre_l"><!--indent-left-->Nombre</div>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="nombre"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="nombre" id="a_nombre"><!--js-edit-open placeholder-link--><?php echo $usuario["Nombre"];?></a>
											</li>
											<div class="contenedor_js formularios nombre_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="nombre"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="editar_usuario_rol" name="opcion">
														<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
														<div class="control_grupo c_nombre"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="nombre_l">Nombre *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $usuario["Nombre"];?>" class="valor_tema_institution texto campo_laboratorio" id="nombre_form" name="nombre"><!--institution-item-value text institution-field-street-->
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
											<li class="tema_informacion_institucion abrir_editar contenedor_js paterno_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda" id="paterno_l"><!--indent-left-->Apellido Paterno</div>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="paterno"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="paterno" id="a_paterno"><!--js-edit-open placeholder-link--><?php echo $usuario["Apellido_Paterno"];?></a>
											</li>
											<div class="contenedor_js formularios paterno_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="paterno"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="editar_usuario_rol" name="opcion">
														<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
														<div class="control_grupo c_paterno"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="paterno_l">Apellido Paterno *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $usuario["Apellido_Paterno"];?>" class="valor_tema_institution texto campo_laboratorio" id="paterno_form" name="paterno"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="paterno"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js materno_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda" id="materno_l"><!--indent-left-->Apellido Materno</div>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="materno"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="materno" id="a_materno"><!--js-edit-open placeholder-link--><?php echo $usuario["Apellido_Materno"];?></a>
											</li>
											<div class="contenedor_js formularios materno_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="materno"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="editar_usuario_rol" name="opcion">
														<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
														<div class="control_grupo c_materno"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="materno_l">Apellido Materno *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $usuario["Apellido_Materno"];?>" class="valor_tema_institution texto campo_laboratorio" id="materno_form" name="materno"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="materno"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js lugar_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda" id="lugar_l"><!--indent-left-->Lugar de Nacimiento</div>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="lugar"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="lugar" id="a_lugar"><!--js-edit-open placeholder-link--><?php echo $usuario["Lugar_Nacimiento"];?></a>
											</li>
											<div class="contenedor_js formularios lugar_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="lugar"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="editar_usuario_rol" name="opcion">
														<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
														<div class="control_grupo c_lugar"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="lugar_l">Lugar de Nacimiento *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $usuario["Lugar_Nacimiento"];?>" class="valor_tema_institution texto campo_laboratorio" id="lugar_form" name="lugar"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="lugar"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js fecha_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda" id="fecha_l"><!--indent-left-->Fecha de Nacimiento</div>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="fecha"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<?php
														$fecha = explode("-", $usuario["Fecha_Nacimiento"]);
												?>
												<a class="abrir_editar_js placeholder_link" value="fecha" id="a_fecha"><!--js-edit-open placeholder-link--><?php echo $fecha[2]."/".$fecha[1]."/".$fecha[0];?></a>
											</li>
											<div class="contenedor_js formularios fecha_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="fecha"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="editar_usuario_rol" name="opcion">
														<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
														<div class="control_grupo c_fecha"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="fecha_l">Fecha de Nacimiento *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<table width="80%">
																		<tbody>
																			<tr>
																				<td align="left">
																					<select style="width: 129px; font-size: 12px;" id="dia_" name="dia" class="fechas">
																						<?php
																							for($i = 1; $i < 32; $i++)
																								echo "<option value='".$i."'>".$i."</option>";
																						?>
																					</select>
																				</td>
																				<td align="center">
																					<select style="width: 129px; font-size: 12px;" id="mes_" name="mes" class="fechas">
																						<?php
																							for($i = 1; $i < 13; $i++)
																								echo "<option value='".$i."'>".$i."</option>";
																						?>
																					</select>
																				</td>
																				<td align="right">
																					<select style="width: 129px; font-size: 12px;" id="anio_" name="anio" class="fechas">
																						<?php
																							for($i = 2020; $i > 1910; $i--)
																								echo "<option value='".$i."'>".$i."</option>";
																						?>
																					</select>
																					<?php
																						echo "<script> 
																							$('#dia_').val('". $fecha[2]."'); 
																							$('#mes_').val('". $fecha[1]."'); 
																							$('#anio_').val('". $fecha[0]."'); 
																						</script>";
																					?>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="fecha"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js correo_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda" id="correo_l"><!--indent-left-->Correo Electrónico</div>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="correo"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="correo" id="a_correo"><!--js-edit-open placeholder-link--><?php echo $usuario["Correo_Electronico"];?></a>
											</li>
											<div class="contenedor_js formularios correo_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="correo"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="editar_usuario_rol" name="opcion">
														<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
														<div class="control_grupo c_correo"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="correo_l">Correo Electrónico *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $usuario["Correo_Electronico"];?>" class="valor_tema_institution texto campo_laboratorio" id="correo_form" name="correo"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="correo"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js seguro_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda" id="seguro_l"><!--indent-left-->Seguro Médico</div>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="seguro"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="seguro" id="a_seguro"><!--js-edit-open placeholder-link--><?php echo $usuario["Num_Ser_Med"];?></a>
											</li>
											<div class="contenedor_js formularios seguro_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="seguro"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="editar_usuario_rol" name="opcion">
														<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
														<div class="control_grupo c_seguro"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="seguro_l">Seguro Médico </label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $usuario["Num_Ser_Med"];?>" class="valor_tema_institution texto campo_laboratorio" id="seguro_form" name="seguro"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="seguro"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
															<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
														</div>
													</form>
												</div>
											</div>
											<li class="tema_informacion_institucion abrir_editar contenedor_js nivel_li"><!--institution-info-item edit-open js-widgetcontainer-->
												<div class="indent_izquierda" id="seguro_l"><!--indent-left-->Último Nivel Académico</div>
												<div class="indent_derecha"><!--indent-right-->
													<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="nivel"><!--js-edit-open edit-link text-right-->
														<span class="icono_editar"></span>Editar</a>
												</div>
												<a class="abrir_editar_js placeholder_link" value="nivel" id="a_nivel"><!--js-edit-open placeholder-link--><?php echo $usuario["Ultimo_Nivel_Academico"];?></a>
											</li>
											<div class="contenedor_js formularios nivel_form"><!--js-widgetcontainer-->
												<div class="seccion_editar"><!--edit-section-->
													<form class="form_horizontal editar_informacion_laboratorio" value="nivel"><!--form-horizontal institution-contactinformation-editform-->
														<input type="hidden" value="editar_usuario_rol" name="opcion">
														<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
														<div class="control_grupo c_nivel"><!--control-grupo-->
															<div class="indent_contenedor"><!--indent-container-->
																<div class="indent_izquierda"><!--indent-left-->
																	<div class="label_control"><!--control-label-->
																		<label id="nivel_l">Último Nivel Académico *</label>
																	</div>
																</div>
																<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																	<input type="text" value="<?php echo $usuario["Ultimo_Nivel_Academico"];?>" class="valor_tema_institution texto campo_laboratorio" id="nivel_form" name="nivel"><!--institution-item-value text institution-field-street-->
																</div>
															</div>
														</div>
														<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
															<a class="abrir_editar_js boton_link link_marcado" value="nivel"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
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
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="contenedor_js nick_name"><!--js-widgetcontainer-->
										<div class="laboratorio_perfil contenedor_luz_js caja_c abrir_editar_js"><!--profile-aboutme js-highlight-container c-box js-edit-open-->
											<h4>
												<strong class="lf">
													<a class="link_inherit">Cambiar Nombre de Usuario</a>
												</strong>
											</h4>
											<form class="editarform_laboratorio_perfil form_horizontal nick_form" style="margin-bottom: 0px; display: none;" value="nick"><!--profile-aboutme-editform-->
												<input type="hidden" value="editar_usuario_rol" name="opcion">
												<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
												<div class="control_grupo c_nick"><!--control-grupo-->
													<label class="label_control nick_l">Nombre de Usuario *</label>
													<div class="controles_cud"><!--controls-->
														<input type="textbox" id="nick" style="width: 250px;" class="texto" name="nick" value='<?php echo $usuario["Nick"];?>'>
													</div>
												</div>
												<div class="toolbar_editar"><!--edit-toolbar-->
													<div class="rf meta">
														<a class="cerrar_editar_js link_marcado"><!--js-edit-close link-underlined-->Cancelar</a>
														<button class="guardar_editar boton boton_promover margen_boton cv_link">Continuar</button>
													</div>
													<div class="limpiar"></div><!--clear-->
												</div>
											</form>
										</div>
									</div>
									<div class="perfil_miembros lista_personas_s caja_c contenedor_js"><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
										<div style="margin-top: -2px;">
											<h4>
												<strong class="lf">
													<a class="link_inherit">Cambiar Contraseña</a>
												</strong>
											</h4>
											<form class="editarform_laboratorio_perfil form_horizontal contrasenia_form" style="margin-bottom: 0px; display: none;" value="contrasenia"><!--profile-aboutme-editform-->
												<input type="hidden" value="editar_usuario_rol" name="opcion">
												<input type="hidden" value="<?php echo $usuario["ID_Usuario"];?>" name="id_usuario">
												<div class="control_grupo c_contrasenia"><!--control-grupo-->
													<label class="label_control contrasenia_l">Contraseña Anterior *</label>
													<div class="controles_cud"><!--controls-->
														<input type="password" id="a_contrasenia" style="width: 250px;" class="texto" name="a_contrasenia">
													</div>
												</div>
												<div class="control_grupo c_contrasenia"><!--control-grupo-->
													<label class="label_control contrasenia_l">Nueva Contraseña *</label>
													<div class="controles_cud"><!--controls-->
														<input type="password" id="contrasenia" style="width: 250px;" class="texto" name="contrasenia">
													</div>
												</div>
												<div class="control_grupo c_contrasenia"><!--control-grupo-->
													<label class="label_control contrasenia_l">Repetir Contraseña *</label>
													<div class="controles_cud"><!--controls-->
														<input type="password" id="r_contrasenia" style="width: 250px;" class="texto" name="r_contrasenia">
													</div>
												</div>
												<div class="toolbar_editar"><!--edit-toolbar-->
													<div class="rf meta">
														<a class="cerrar_editar_js link_marcado"><!--js-edit-close link-underlined-->Cancelar</a>
														<button class="guardar_editar boton boton_promover margen_boton cv_link">Continuar</button>
													</div>
													<div class="limpiar"></div><!--clear-->
												</div>
											</form>
										</div>
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
