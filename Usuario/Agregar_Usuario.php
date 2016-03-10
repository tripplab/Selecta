<html>
	<head>
		<script src="./Agregar_Usuario.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera comision_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_comision" id="guardar_usuario_"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="nuevo_usuario" name="opcion">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Nombre Completo *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<input type="text" placeholder="Nombre (s)" class="texto" style="width: 190px; font-size: 12px;" id="nombre_usuario" name="nombre_usuario" >
												</td>
												<td align="center">
													<input type="text" placeholder="Apellido Paterno" class="texto" style="width: 190px; font-size: 12px;" id="a_paterno_usuario" name="a_paterno_usuario" >
												</td>
												<td align="right">
													<input type="text" placeholder="Apellido Materno" class="texto" style="width: 190px; font-size: 12px;" id="a_materno_usuario" name="a_materno_usuario" >
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Lugar de Nacimiento *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="lugar_nacimiento_usuario" style="width: 620px;" class="texto" name="lugar_nacimiento_usuario">
								</div>
							</div>
							<div class="control_grupo" id="fecha_nacimiento"><!--control-grupo-->
								<label class="label_control">Fecha de Nacimiento *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 200px; font-size: 12px;" id="dia_nacimiento_usuario" name="dia_nacimiento_usuario" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 200px; font-size: 12px;" id="mes_nacimiento_usuario" name="mes_nacimiento_usuario" class="fechas">
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 200px; font-size: 12px;" id="anio_nacimiento_usuario" name="anio_nacimiento_usuario" class="fechas">
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
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Correo Electrónico *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="correo_usuario" style="width: 620px;" class="texto" name="correo_usuario">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Útlimo Nivel Académico *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="nivel_usuario" style="width: 620px;" class="texto" name="nivel_usuario">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Seguro Médico</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="seguro_usuario" style="width: 620px;" class="texto" name="seguro_usuario">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Rol *</label>
								<div class="controles"><!--controls-->
									<select style="width: 129px; font-size: 12px;" id="rol_usuario" name="rol_usuario" class="fechas">
										<option value="Administrador">Administrador</option>
										<option value="Profesor">Profesor</option>
										<option value="Auxiliar">Auxiliar</option>
										<option value="Estudiante">Estudiante</option>
										<option value="Pasante">Licenciatura</option>
									</select>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Estatus *</label>
								<div class="controles"><!--controls-->
									<select style="width: 129px; font-size: 12px;" id="estatus_usuario" name="estatus_usuario" class="fechas">
										<option value="0">Inactivo</option>
										<option value="1">Activo</option>
									</select>
								</div>
							</div>
							<div class="control_grupo c_institucion" id="institucion_div"><!--control-grupo-->
								<label class="label_control" id="institucion_l">Institucion *</label>
								<input type="hidden" id="id_institucion" name="id_institucion">
								<div class="controles"><!--controls-->
									<input type="textbox" id="institucion" placeholder="Teclea el nombre de la Institución y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="institucion">
									<div id="cargar_lista_institucion" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px; top: 405px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
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
								<div class="controles"><!--controls-->
									<input type="textbox" id="unidad" placeholder="Teclea el nombre de la Unidad y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="unidad">
									<div id="cargar_lista_unidad" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px; top: 445px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
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
								<div class="controles"><!--controls-->
									<input type="textbox" id="departamento" placeholder="Teclea el nombre del Departamento y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="departamento">
									<div id="cargar_lista_departamento" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px; top: 485px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_departamento"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="barra_footer"><!--footer-bar-->
							<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion agrandar rf "><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="mensaje" style="padding: 50px 223px;"><!--or-text--></div>
		
	</body>
</html>

