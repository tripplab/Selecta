<html>
	<head>
		<script src="./Agregar.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera laboratorio_formulario"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit form_laboratorio"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="laboratorio_nuevo" name="opcion">
						<input type="hidden" value="" name="departamento" id="id_departamento">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo" id="nombre_div_"><!--control-grupo-->
								<label class="label_control" id="nombre_l_">Nombre *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="nombre_" style="width: 620px;" class="texto" name="nombre">
								</div>
							</div>
							<div class="control_grupo numero_div"><!--control-grupo-->
								<label class="label_control" id="numero_l">Número *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="numero" style="width: 620px;" class="texto" name="numero">
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
								<label class="label_control">Descripción</label>
								<div class="controles"><!--controls-->
									<textarea id="descripcion" class="texto" name="descripcion" style="width: 620px; height: 82px;"></textarea><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Cupo Disponible</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="cupo" style="width: 620px;" class="texto" name="cupo">
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
