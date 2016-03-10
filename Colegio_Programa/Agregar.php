<html>
	<head>
		<script src="./Agregar.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera colegio_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_colegio"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="colegio_nuevo" name="opcion">
						<input type="hidden" name="id_programa" id="id_programa">
						<input type="hidden" name="servicio">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo c_usuario"><!--control-grupo-->
								<label class="label_control" id="usuario_l">Usuario *</label>
								<input type="hidden" id="id_usuario" name="id_usuario">
								<div class="controles"><!--controls-->
									<input type="textbox" id="usuario" placeholder="Teclea el nombre del Usuario y elige la opcion correcta de la lista" maxlength="255" class="texto" name="usuario">
									<div id="cargar_lista_usuario" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 611px; left: 160px; top: 90px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_usuario"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo" id="coordinador"><!--control-grupo-->
								<label class="label_control">Coordinador</label>
								<div class="controles"><!--controls-->
									<select style="width: 200px; font-size: 12px;" id="cordinador" name="cordinador">
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
								</div>
							</div>
							<div class="control_grupo" id="secretaria"><!--control-grupo-->
								<label class="label_control" id="tipo_l">Secretario</label>
								<div class="controles"><!--controls-->
									<select style="width: 200px; font-size: 12px;" id="secretario" name="secretario">
										<option value="0">No</option>
										<option value="1">Si</option>
									</select>
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
