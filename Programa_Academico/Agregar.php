<html>
	<head>
		<script src="./Agregar.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera programa_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_programa"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="programa_nuevo" name="opcion">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo" id="nombre_div"><!--control-grupo-->
								<label class="label_control" id="nombre_l">Nombre *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="nombre" style="width: 620px;" class="texto" name="nombre">
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
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera programa_unidad_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_unidad_programa"><!--form-horizontal action-form-submit--->
						<input type="hidden" id="programa_id" name="programa">
						<input type="hidden" value="programa_unidad" name="opcion">
						<input type="hidden" value="" name="servicio" id="servicio_unidad_programa">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo" id="institucion_div"><!--control-grupo-->
								<label class="label_control">Institucion *</label>
								<input type="hidden" id="id_institucion" name="id_institucion">
								<div class="controles"><!--controls-->
									<input type="textbox" id="institucion" placeholder="Teclea el nombre de la Institución y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="institucion">
									<div id="cargar_lista_institucion" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px; top: 90px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_institucion"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo" id="unidad_div"><!--control-grupo-->
								<label class="label_control">Unidad *</label>
								<input type="hidden" id="id_unidad" name="id_unidad">
								<div class="controles"><!--controls-->
									<input type="textbox" id="unidad" placeholder="Teclea el nombre de la Unidad y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="unidad">
									<div id="cargar_lista_unidad" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px; top: 130px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_unidad"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Periodo Escolar</label>
								<div class="controles"><!--controls-->
									<select style="width: 200px; font-size: 12px;" id="periodo" name="periodo">
										<option value="">Seleccionar</option>
										<option value="Cuatrimestre">Cuatrimestre</option>
										<option value="Semestre">Semestre</option>
									</select>
								</div>
							</div> 
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Objetivos</label>
								<div class="controles"><!--controls-->
									<textarea id="objetivos" class="texto" name="objetivos" style="width: 620px; height: 82px;"></textarea><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
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
