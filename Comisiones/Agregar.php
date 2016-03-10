<html>
	<head>
		<script src="./Agregar.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera comision_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_comision"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="comision" name="opcion">
						<input type="hidden" value="" name="servicio" id="servicio_comision">
						<input type="hidden" value="" name="tipo_comision" id="tipo_comision_">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="titulo_publicacion arreglar_limpiar titulo"><!--publication-tittle clearfix-->
								<strong id="tipo_"></strong>
							</div>
							<div class="control_grupo a_1" id="solicitud_div"><!--control-grupo-->
								<label class="label_control">Fecha de Solicitud *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 200px; font-size: 12px;" id="dia_s" name="dia_s" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 200px; font-size: 12px;" id="mes_s" name="mes_s" class="fechas">
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 200px; font-size: 12px;" id="anio_s" name="anio_s" class="fechas">
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
							<div class="control_grupo a_1" id="motivos_div"><!--control-grupo-->
								<label class="label_control" id="motivos_l">Evento/Motivos *</label>
								<div class="controles"><!--controls-->
									<textarea id="motivos" class="texto" name="motivos" style="width: 620px; height: 82px;"></textarea><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
								</div>
							</div>
							<div class="control_grupo a_1"><!--control-grupo-->
								<label class="label_control">Objetivos</label>
								<div class="controles"><!--controls-->
									<textarea id="objetivos" class="texto" name="objetivos" style="width: 620px; height: 82px;"></textarea><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
								</div>
							</div>
							<div class="control_grupo lugar_div a_1"><!--control-grupo-->
								<label class="label_control" id="lugar_l">Lugar *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="lugar" style="width: 620px;" class="texto" name="lugar">
								</div>
							</div>
							<div class="control_grupo a_1 a_2" id="transporte_div"><!--control-grupo-->
								<label class="label_control" id="transporte_l">Fuente de Financiamento *</label>
								<div class="controles"><!--controls-->
									<table width="70%">
										<tbody>
											<tr>
												<td align="left">
													<input type="text" placeholder="Transporte" class="texto" style="width: 190px; font-size: 12px;" id="f_transporte" name="f_transporte" >
												</td>
												<td align="center">
													<input type="text" placeholder="Monto de Transporte" class="texto" style="width: 190px; font-size: 12px;" id="m_transporte" name="m_transporte" >
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="control_grupo a_1 a_2" id="viaticos_div"><!--control-grupo-->
								<label class="label_control" id="viaticos_l"></label>
								<div class="controles"><!--controls-->
									<table width="70%">
										<tbody>
											<tr>
												<td align="left">
													<input type="text" class="texto" placeholder="Viáticos" style="width: 190px; font-size: 12px;" id="f_viaticos" name="f_viaticos" >
												</td>
												<td align="center">
													<input type="text" class="texto" placeholder="Monto de Viáticos" style="width: 190px; font-size: 12px;" id="m_viaticos" name="m_viaticos" >
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div> 
							<div class="control_grupo a_1 a_2" id="otros_div"><!--control-grupo-->
								<label class="label_control" id="otros_l"></label>
								<div class="controles"><!--controls-->
									<table width="70%">
										<tbody>
											<tr>
												<td align="left">
													<input type="text" class="texto" placeholder="Otros" style="width: 190px; font-size: 12px;" id="f_otros" name="f_otros" >
												</td>
												<td align="center">
													<input type="text" class="texto" placeholder="Monto de Otros" style="width: 190px; font-size: 12px;" id="m_otros" name="m_otros" >
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="control_grupo a_1"><!--control-grupo-->
								<label class="label_control">Proyecto</label>
								<div class="controles"><!--controls-->
									<input type='radio' class='proyecto_' name='vinculo_proyecto' value='No' checked id="vinculo_no">No
									<input type='radio' class='proyecto_' name='vinculo_proyecto' value='Si' id="vinculo_si">Si
								</div>
							</div>
							<div class="control_grupo a_3" id="financiamiento_div"><!--control-grupo-->
								<label class="label_control" id="financiamiento_l">Fuente Financiamiento *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="financiamiento" style="width: 620px;" class="texto" name="financiamiento">
								</div>
							</div>
							<div class="control_grupo a_3" id="profesor_div"><!--control-grupo-->
								<label class="label_control" id="profesor_l">Profesor Responsable *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="profesor" style="width: 620px;" class="texto" name="profesor">
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
							<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion agrandar rf"><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera informe_comision"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_informe"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="informe_comision" name="opcion">
						<input type="hidden" value="" name="servicio" id="servicio_informe">
						<input type="hidden" value="" name="id" id="id_comision">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo" id="informe_div"><!--control-grupo-->
								<label class="label_control">Fecha *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 200px; font-size: 12px;" id="dia_in" name="dia_in" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 200px; font-size: 12px;" id="mes_in" name="mes_in" class="fechas">
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 200px; font-size: 12px;" id="anio_in" name="anio_in" class="fechas">
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
								<label class="label_control">Evento asistido *</label>
								<div class="controles"><!--controls-->
									<input type='radio' class='evento' name='evento' value='Congreso o Reunión Académica' checked id="1">Congreso o Reunión Académica<br>
									<input type='radio' class='evento' name='evento' value='Congreso o Reunión Académica internacional' id="2">Congreso o Reunión Académica internacional<br>
									<input type='radio' class='evento' name='evento' value='Estancia de trabajo en institución internacional' id="3">Estancia de trabajo en institución internacional<br>
									<input type='radio' class='evento' name='evento' value='Participación como jurado de examen de grado' id="4">Participación  como jurado de examen de grado<br>
									<input type='radio' class='evento' name='evento' value='Otros' id="5">Otros
								</div>
							</div>
							<div class="control_grupo a_4" id="descripcion_div"><!--control-grupo-->
								<label class="label_control" id="descripcion_l">Describir *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="descripcion" style="width: 620px;" class="texto" name="descripcion">
								</div>
							</div>
							<div class="control_grupo" id="objetivos_div"><!--control-grupo-->
								<label class="label_control" id="objetivos_l">Descripcion de actividades *</label>
								<div class="controles"><!--controls-->
									<textarea id="objetivos" class="texto" name="objetivos" style="width: 620px; height: 82px;" placeholder="DESCRIBA EL OBJETO DE LA COMISIÓN, ACTIVIDADES REALIZADAS, RESULTADOS OBTENIDOS, CONTRIBUCIONES PARA EL CENTRO"></textarea><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
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
		
		<div class="mensaje" style="padding: 50px 110px;"><!--or-text--></div>
		
	</body>
</html>
