<html>
	<?php
		include '../Scripts/query.php';
		$conexion = new Querys();
	?>
	<head>
		<script src="./Agregar.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera comite_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_comite"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="comite" name="opcion">
						<input type="hidden" value="" name="servicio" id="servicio_comite">
						<input type="hidden" value="" name="tipo_comision" id="tipo_comite_">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="titulo_publicacion arreglar_limpiar titulo"><!--publication-tittle clearfix-->
								<strong id="tipo_"></strong>
							</div>
							<div class="control_grupo a_1" id="motivos_div"><!--control-grupo-->
								<label class="label_control" id="motivos_l">Nombre Comité *</label>
								<div class="controles"><!--controls-->
									<textarea id="motivos" class="texto" name="motivos" style="width: 620px; height: 82px;"></textarea><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
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
								<label class="label_control">Fecha Termino</label>
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
		
		<div class="mensaje" style="padding: 50px 110px;"><!--or-text--></div>
		
	</body>
</html>
