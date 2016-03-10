<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$conexion = new Querys();
	?>
	<head>
		<script src="./configuracion.js"></script>
	</head>
	<body>
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
												<a href="./">Configuración del Sistema</a>
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
										<h4>
											<strong class="lf">
												<a class="link_inherit">Actualizar revistas del Journal Citation Reports (JCR)</a>
											</strong>
										</h4>
										<form class="actualizar_jcr form_horizontal" style="margin-bottom: 0px; display: none;"><!--profile-aboutme-editform-->
											<input type="hidden" value="JCR" name="opcion">
											<h3>Siga las siguientes instrucciones</h3>
											<h3>1. Entrar a la pagina de <a href='http://admin-apps.webofknowledge.com/JCR/JCR' target="_blank">JCR</a></h3>
											<h3>2. Dar clic en establecer una nueva sesión</h3>
											<h3>3. De la tabla marcar la casilla Seleccionar view all Journals</h3>
											<h3>4. Buscar en la URL de la página la palabra SID= y obtener el valor que le sigue</h3>
											<h3>5. El valor obtenido de la URL de la página de JCR pegarlo en la caja de abajo</h3>
											<h3>6. En la página de Journal dar clic en Submit</h3>
											<h3>7. En la parte de abajo dar clic en Actualizar</h3>
											<div class="control_grupo"><!--control-grupo-->
												<label class="label_control">SID</label>
												<div class="controles" style="margin-left: 50px;"><!--controls-->
													<input type="textbox" id="sid" style="width: 250px;" class="texto" name="sid">
												</div>
											</div>
											<div class="toolbar_editar"><!--edit-toolbar-->
												<div class="rf meta">
													<a class="cerrar_editar_js link_marcado"><!--js-edit-close link-underlined-->Cancelar</a>
													<a class="actualizar boton boton_promover margen_boton cv_link" target="_blank">Actualizar</a>
												</div>
												<div class="limpiar"></div><!--clear-->
											</div>
										</form>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
								
								
								<div class="contenedor_js"><!--js-widgetcontainer-->
										<div class="caja_c publicaciones_wexp_js" style="margin: 20px 0px;"><!--c-box js-wexp-publications-->
											<h4>
												<strong class="lf">
													<a>Tipo Copei</a>
												</strong>
											</h4>
											<ul>
												<?php												
													$tipo_copei = $conexion->Consultas("SELECT * FROM Tipo_Copei");
													for($x = 0; $x < count($tipo_copei); $x++)
													{	
												?>
														<li class="tema_informacion_institucion abrir_editar contenedor_js <?php echo $tipo_copei[$x]["ID_Tipo"];?>_li"><!--institution-info-item edit-open js-widgetcontainer-->
															<div class="indent_izquierda"><!--indent-left--><?php echo $tipo_copei[$x]["Tipo"];?></div>
															<div class="indent_derecha"><!--indent-right-->
																<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="<?php echo $tipo_copei[$x]["ID_Tipo"];?>"><!--js-edit-open edit-link text-right-->
																	<span class="icono_editar"></span>Editar</a>
															</div>
															<a class="abrir_editar_js placeholder_link" value="<?php echo $tipo_copei[$x]["ID_Tipo"];?>" id="<?php echo $tipo_copei[$x]["ID_Tipo"];?>_a"><!--js-edit-open placeholder-link--><?php echo $tipo_copei[$x]["Descripcion"];?></a>
														</li>
														<div class="contenedor_js formularios <?php echo $tipo_copei[$x]["ID_Tipo"];?>_form"><!--js-widgetcontainer-->
															<div class="seccion_editar"><!--edit-section-->
																<form class="form_horizontal editar_tipo_copei" value="<?php echo $tipo_copei[$x]["ID_Tipo"];?>"><!--form-horizontal institution-contactinformation-editform-->
																	<input type="hidden" value="tipo_copei" name="opcion">
																	<input type="hidden" value="<?php echo $tipo_copei[$x]["ID_Tipo"];?>" name="id_tipo">
																	<div class="control_grupo" id="c_<?php echo $tipo_copei[$x]["ID_Tipo"];?>"><!--control-grupo-->
																		<div class="indent_contenedor"><!--indent-container-->
																			<div class="indent_izquierda"><!--indent-left-->
																				<div class="label_control"><!--control-label-->
																					<label id="<?php echo $tipo_copei[$x]["ID_Tipo"];?>_l">Descripción *</label>
																				</div>
																			</div>
																			<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																				<input type="text" value="<?php echo $tipo_copei[$x]["Descripcion"];?>" class="valor_tema_institution texto" id="descripcion_<?php echo $tipo_copei[$x]["ID_Tipo"];?>" name="descripcion" style="width: 387px;"><!--institution-item-value text institution-field-street-->
																			</div>
																		</div>
																	</div>
																	<div class="control_grupo"><!--control-grupo-->
																		<div class="indent_contenedor"><!--indent-container-->
																			<div class="indent_izquierda"><!--indent-left-->
																				<div class="label_control"><!--control-label-->
																					<label>Puntuación Mínima</label>
																				</div>
																			</div>
																			<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																				<input type="text" value="<?php echo $tipo_copei[$x]["Puntuacion_Min"];?>" class="valor_tema_institution texto" id="puntuacion_min" name="puntuacion_min" style="width: 387px;"><!--institution-item-value text institution-field-street-->
																			</div>
																		</div>
																	</div>
																	<div class="control_grupo"><!--control-grupo-->
																		<div class="indent_contenedor"><!--indent-container-->
																			<div class="indent_izquierda"><!--indent-left-->
																				<div class="label_control"><!--control-label-->
																					<label>Puntuación Máxima</label>
																				</div>
																			</div>
																			<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
																				<input type="text" value="<?php echo $tipo_copei[$x]["Puntuacion_Max"];?>" class="valor_tema_institution texto" id="puntuacion_max" name="puntuacion_max" style="width: 387px;"><!--institution-item-value text institution-field-street-->
																			</div>
																		</div>
																	</div>
																	<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
																		<a class="abrir_editar_js boton_link link_marcado" value="<?php echo $tipo_copei[$x]["ID_Tipo"];?>"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
																		<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
																	</div>
																</form>
															</div>
														</div>
												<?php
													}
												?>
											</ul>
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
