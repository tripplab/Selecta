<html>
	<head>
		<script src="../Laboratorio/Modificar_Lab.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->					
					<form class="form_horizontal form_accion_submit miembro"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="miembro_laboratorio" name="opcion">
						<input type="hidden" name="rol" id="rol">
						<input type="hidden" id="id_laboratorio" name="id_laboratorio">
						<input type="hidden" id="servicio_laboratorio" name="servicio">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo c_usuario" id="usuario_div"><!--control-grupo-->
								<label class="label_control" id="usuario_l">Usuario *</label>
								<input type="hidden" id="id_usuario" name="id_usuario">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" id="usuario" placeholder="Teclea el nombre del Usuario y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="usuario">
									<div id="cargar_lista_usuario" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 81px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_usuario"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo a_1 c_tipo_direccion"><!--control-grupo-->
								<label class="label_control" id="tipo_l">Tipo Direccion *</label>
								<div class="controles_cud"><!--controls-->
									<select style="width: 200px; font-size: 12px;" id="tipo" name="tipo">
										<option value="">Seleccionar</option>
										<option value="Director">Director</option>
										<option value="Co-Director">Co-Director</option>
										<option value="Tutor">Tutor</option>
									</select>
								</div>
							</div>
							<div class="control_grupo" id="inicial_div"><!--control-grupo-->
								<label class="label_control" id="fecha_l">Fecha Inicio *</label>
								<div class="controles_cud"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 130px; font-size: 12px;" id="dia_pub" name="dia_pub" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 130px; font-size: 12px;" id="mes_pub" name="mes_pub" class="fechas">
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 130px; font-size: 12px;" id="anio_pub" name="anio_pub" class="fechas">
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
								<label class="label_control">Fecha Termino </label>
								<div class="controles_cud"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 130px; font-size: 12px;" id="dia_pub_t" name="dia_pub_t" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 130px; font-size: 12px;" id="mes_pub_t" name="mes_pub_t" class="fechas">
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 130px; font-size: 12px;" id="anio_pub_t" name="anio_pub_t" class="fechas">
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
							<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion agrandar rf"><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
					<div class="mensaje" style="padding-left: 90px; padding-bottom: 50px;"><!--or-text--></div>
				</div>
			</div>
		</div>
		
	</body>
</html>
