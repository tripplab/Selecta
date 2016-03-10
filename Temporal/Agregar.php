<html>
	<head>
		<script src="./Agregar.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion inicial"><!--publication-dialog-container-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<h1>¿Que te gustaría agregar?</h1>
					<div class="contenedor_intercanbio_subir"><!--upload-swap-container-->
						<div class="contenedor_titulo_publicacion"><!--publication-tittle-container-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								<form class="form_c submit_form_accion"><!---c-form action-submit-form-->
									Convenios de colaboración académica, científica y tecnológica.<br>
									<input type='radio' class='mostrar_tipo_copei' name='tipo_comision' value='Internacional'>Instituciones internacionales<br>
									<input type='radio' class='mostrar_tipo_copei' name='tipo_comision' value='Nacional'>Instituciones nacional<br>
									Gestión tecnológica y vinculación con la industria e Instituciones<br>
									<input type='radio' class='mostrar_tipo_copei' name='tipo_comision' value='Proyecto'>Proyecto<br>
									<input type='radio' class='mostrar_tipo_copei' name='tipo_comision' value='Servicios'>Servicios de Laboratorio<br>
									<div class="barra_footer"><!--footer-bar-->
										<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion rf agrandar"><!---btn btn-promote action-submit-button rf-->
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera comision_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_comision"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="convenio_servicio" name="opcion">
						<input type="hidden" value="" name="servicio" id="servicio_comision">
						<input type="hidden" value="" name="tipo_comision" id="tipo_comision_">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="titulo_publicacion arreglar_limpiar titulo"><!--publication-tittle clearfix-->
								<strong id="tipo_"></strong>
							</div>
							<div class="control_grupo c_usuario" id="usuario_div"><!--control-grupo-->
								<label class="label_control" id="usuario_l">Responsable *</label>
								<input type="hidden" id="id_usuario" name="id_usuario">
								<div class="controles"><!--controls-->
									<input type="textbox" id="usuario" placeholder="Teclea el nombre del Usuario y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="usuario">
									<div id="cargar_lista_usuario" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_usuario"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo" id="proyecto_div"><!--control-grupo-->
								<label class="label_control" id="proyecto_l">Proyecto *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="proyecto" style="width: 620px;" class="texto" name="proyecto">
								</div>
							</div>
							<div class="control_grupo" id="institucion_div"><!--control-grupo-->
								<label class="label_control" id="institucion_l">Institución *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="institucion" style="width: 620px;" class="texto" name="institucion">
								</div>
							</div>
							<div class="control_grupo a_1"><!--control-grupo-->
								<label class="label_control">Convenio *</label>
								<div class="controles"><!--controls-->
									<input type='radio' class='convenio_' name='vinculo_proyecto' value='No' checked id="vinculo_no">No
									<input type='radio' class='convenio_' name='vinculo_proyecto' value='Si' id="vinculo_si">Si
								</div>
							</div>
							<div class="control_grupo a_2" id="objetivo_div"><!--control-grupo-->
								<label class="label_control" id="objetivo_l">Objetivos *</label>
								<div class="controles"><!--controls-->
									<textarea id="objetivo" style="width: 620px;" class="texto" name="objetivo"></textarea>
								</div>
							</div>
							<div class="control_grupo" id="inicial_div"><!--control-grupo-->
								<label class="label_control" id="fecha_l">Fecha Inicio *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 200px; font-size: 12px;" id="dia_i" name="dia_i" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 200px; font-size: 12px;" id="mes_i" name="mes_i" class="fechas">
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 200px; font-size: 12px;" id="anio_i" name="anio_i" class="fechas">
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
							<div class="control_grupo" id="termino_div"><!--control-grupo-->
								<label class="label_control">Fecha Termino *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 200px; font-size: 12px;" id="dia_t" name="dia_t" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 200px; font-size: 12px;" id="mes_t" name="mes_t" class="fechas">
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 200px; font-size: 12px;" id="anio_t" name="anio_t" class="fechas">
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
						<div class="barra_footer"><!--footer-bar-->
							<a class="boton boton_plano link_accion_regresar"><!--btn btn-plain action-libk-back-->
								<span class="icono_fecha_regresar_negra"><!--ico-arrow-dark-left--></span>Regresar</a>
							<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion agrandar rf"><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="mensaje" style="padding: 50px 110px;"><!--or-text--></div>
		
	</body>
</html>
