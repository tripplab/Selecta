<html>
	<head>
		<script src="./Agregar.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera institucion_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_institucion"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="institucion_nuevo" name="opcion">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo" id="nombre_div"><!--control-grupo-->
								<label class="label_control" id="nombre_l">Nombre *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="nombre" style="width: 620px;" class="texto" name="nombre">
								</div>
							</div>
							<div class="control_grupo pais_div_"><!--control-grupo-->
								<label class="label_control" id="pais_l_">País *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="pais_" style="width: 620px;" class="texto" name="pais">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Ciudad</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="ciudad" style="width: 620px;" class="texto" name="ciudad">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Domicilio</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="domicilio" style="width: 620px;" class="texto" name="domicilio">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Página Web</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="pagina" style="width: 620px;" class="texto" name="pagina">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Abreviación</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="abreviacion" style="width: 620px;" class="texto" name="abreviacion">
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
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera unidad_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_unidad"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="unidad_nuevo" name="opcion">
						<input type="hidden" value="" name="servicio" id="servicio_unidad">
						<input type="hidden" value="" name="id" id="id_institucion">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo" id="nombre_div_"><!--control-grupo-->
								<label class="label_control" id="nombre_l_">Nombre *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="nombre_" style="width: 620px;" class="texto" name="nombre">
								</div>
							</div>
							<div class="control_grupo pais_div"><!--control-grupo-->
								<label class="label_control" id="pais_l">País *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="pais" style="width: 620px;" class="texto" name="pais">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Ciudad</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="ciudad" style="width: 620px;" class="texto" name="ciudad">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Domicilio</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="domicilio" style="width: 620px;" class="texto" name="domicilio">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Teléfono</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="telefono" style="width: 620px;" class="texto" name="telefono">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Página Web</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="pagina" style="width: 620px;" class="texto" name="pagina">
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Abreviación</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="abreviacion" style="width: 620px;" class="texto" name="abreviacion">
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
