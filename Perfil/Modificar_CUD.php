<html>
	<head>
		<script src="../Perfil/Modificar_CUD.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera CUD_Editar"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->					
					<form class="form_horizontal form_accion_submit CUD"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="cud_usuario" name="opcion">
						<input type="hidden" name="id_usuario" id="id_usuario">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo c_institucion" id="institucion_div"><!--control-grupo-->
								<label class="label_control" id="institucion_l">Institucion *</label>
								<input type="hidden" id="id_institucion" name="id_institucion">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" id="institucion" placeholder="Teclea el nombre de la Institución y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="institucion">
									<div id="cargar_lista_institucion" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 81px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_institucion"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo c_unidad" id="unidad_div"><!--control-grupo-->
								<label class="label_control" id="unidad_l">Unidad *</label>
								<input type="hidden" id="id_unidad" name="id_unidad">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" id="unidad" placeholder="Teclea el nombre de la Unidad y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="unidad">
									<div id="cargar_lista_unidad" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 120px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_unidad"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo c_departamento" id="departamento_div" style="display: none;"><!--control-grupo-->
								<label class="label_control" id="departamento_l">Departamento *</label>
								<input type="hidden" id="id_departamento" name="id_departamento">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" id="departamento" placeholder="Teclea el nombre del Departamento y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="departamento">
									<div id="cargar_lista_departamento" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 159px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_departamento"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="barra_footer"><!--footer-bar-->
							<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion agrandar rf"><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera Nivel_Nuevo"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->					
					<form class="form_horizontal form_accion_submit nivel_"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="nivel_nuevo" name="opcion">
						<input type="hidden" name="servicio" id="servicio_sni">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo nnivel_c"><!--control-grupo-->
								<label class="label_control" id="nnivel_l">Nivel *</label>
								<div class="controles_cud"><!--controls-->
									<input type="textbox" id="nnivel" style="width: 440px;" maxlength="255" class="texto" name="nivel">
								</div>
							</div>
							<div class="control_grupo nfechas_c"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label id="nfecha_l">Fecha Asignación *</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<table width="80%">
											<tbody>
												<tr>
													<td align="left">
														<select style="width: 90px; font-size: 12px;" id="ndia_" name="dia_" class="fechas">
															<option>Día</option>
															<?php
																for($i = 1; $i < 32; $i++)
																	echo "<option value='".$i."'>".$i."</option>";
															?>
														</select>
													</td>
													<td align="center">
														<select style="width: 90px; font-size: 12px;" id="nmes_" name="mes_" class="fechas">
															<option>Mes</option>
															<?php
																for($i = 1; $i < 13; $i++)
																	echo "<option value='".$i."'>".$i."</option>";
															?>
														</select>
													</td>
													<td align="right">
														<select style="width: 90px; font-size: 12px;" id="nanio_" name="anio_" class="fechas">
															<option>Año</option>
															<?php
																for($i = 2020; $i > 1910; $i--)
																	echo "<option value='".$i."'>".$i."</option>";
															?>
														</select>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="barra_footer"><!--footer-bar-->
							<a class="boton boton_plano link_accion_regresar eliminar" value="">Eliminar</a>
							<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion agrandar rf"><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="mensaje" style="padding-left: 118px; padding-bottom: 19px;"><!--or-text--></div>
		
	</body>
</html>
