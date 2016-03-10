<html>
	<?php 
		include '../Scripts/query.php';
		$conexion = new Querys();
	?>
	<head>
		<script src="./Agregar.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion mostrar_cabecera editar_institucion_"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->					
					<form class="form_horizontal form_accion_submit CUD"><!--form-horizontal action-form-submit--->
						<?php 
							$institucion = $conexion->Consultas("SELECT ID_Institucion, Institucion.Nombre AS Institucion, ID_Unidad, Unidad.Nombre AS Unidad, ID_Unidad_Departamento, Rol FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Institucion = FK_Institucion AND ID_Unidad = FK_Unidad AND ID_Unidad_Departamento = FK_Unidad_Departamento AND ID_Usuario = ".$_POST["id"]);
						?>
						<input type="hidden" value="editar_institucion_cud" name="opcion">
						<input type="hidden" name="id_usuario" id="id_usuario">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="control_grupo c_institucion" id="institucion_div"><!--control-grupo-->
								<label class="label_control" id="institucion_l">Institucion *</label>
								<input type="hidden" id="id_institucion" name="id_institucion" value="<?php echo (count($institucion) > 0) ? $institucion[0]["ID_Institucion"]: "";?>">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" value="<?php echo (count($institucion) > 0) ? $institucion[0]["Institucion"]: "";?>" id="institucion" placeholder="Teclea el nombre de la Institución y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="institucion">
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
								<input type="hidden" id="id_unidad" name="id_unidad" value="<?php echo (count($institucion) > 0) ? $institucion[0]["ID_Unidad"]: "";?>">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" value="<?php echo (count($institucion) > 0) ? $institucion[0]["Unidad"]: "";?>" id="unidad" placeholder="Teclea el nombre de la Unidad y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="unidad">
									<div id="cargar_lista_unidad" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 120px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_unidad"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<?php 
								$departamento = array();	
								if(count($institucion) > 0)
									$departamento = $conexion->Consultas("SELECT ID_Departamento, Nombre FROM Departamento, Unidad_Departamento WHERE ID_Departamento = FK_Departamento");
							?>
							<div class="control_grupo c_departamento" id="departamento_div"><!--control-grupo-->
								<label class="label_control" id="departamento_l">Departamento *</label>
								<input type="hidden" id="id_departamento" name="id_departamento" value="<?php echo (count($departamento) > 0) ? $departamento[0]["ID_Departamento"]: "";?>">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" value="<?php echo (count($departamento) > 0) ? $departamento[0]["Nombre"]: "";?>" id="departamento" placeholder="Teclea el nombre del Departamento y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="departamento">
									<div id="cargar_lista_departamento" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 159px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_departamento"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<?php 
								if(count($departamento) > 0)
									echo "<script> $('#departamento_div').hide(); </script>";
								if(count($institucion) > 0 && $institucion[0]["Rol"] == "Estudiante")
								{
									$programa = $conexion->Consultas("SELECT Nombre_Programa, ID_Programa, ID_Periodo_Escolar, Identificador, Nivel FROM Usuario, Matricula_Programa, Periodo_Escolar_Ingreso, Programa_Unidad, Programa_Academico WHERE Programa_Unidad.FK_Programa = ID_Programa AND Periodo_Escolar_Ingreso.FK_Programa = ID_Programa_Unidad AND FK_Periodo_Escolar = ID_Periodo_Escolar AND FK_Usuario = ID_Usuario AND ID_Usuario = ".$_POST["id"]." ORDER BY Fecha_Inicio DESC");
							?>
									<div class="control_grupo c_programa"><!--control-grupo-->
										<label class="label_control" id="programa_l">Programa *</label>
										<input type="hidden" id="id_programa" name="id_programa" value="<?php echo (count($programa) > 0) ? $programa[0]["ID_Programa"]: "";?>">
										<div class="controles_cud"><!--controls-->
											<input type="textbox" value="<?php echo (count($programa) > 0) ? $programa[0]["Nombre_Programa"]: "";?>" id="programa" placeholder="Teclea el nombre del Programa y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="programa">
											<div id="cargar_lista_programa" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 159px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
												<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
													<ul class="yu_lista_aclista" role="listbox" id="contenedor_programa"><!--yui3-aclist-list-->
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="control_grupo c_periodo"><!--control-grupo-->
										<label class="label_control" id="periodo_l">Periodo *</label>
										<input type="hidden" id="id_periodo" name="id_periodo" value="<?php echo (count($programa) > 0) ? $programa[0]["ID_Periodo_Escolar"]: "";?>">
										<div class="controles_cud"><!--controls-->
											<input type="textbox" value="<?php echo (count($programa) > 0) ? $programa[0]["Identificador"]: "";?>" id="periodo" placeholder="Teclea el nombre del Programa y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="periodo">
											<div id="cargar_lista_periodo" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 198px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
												<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
													<ul class="yu_lista_aclista" role="listbox" id="contenedor_periodo"><!--yui3-aclist-list-->
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="control_grupo"><!--control-grupo-->
										<label class="label_control">Nivel *</label>
										<select style="width: 129px; font-size: 12px;" id="nivel" name="nivel">
											<option value="Maestría">Maestría</option>
											<option value="Doctorado">Doctorado</option>
										</select>
									</div>
							<?php 
									echo "<script> $('#nivel').val('".((count($programa) > 0) ? $programa[0]["Nivel"] : "Maestría")."'); </script>";
								}
							?>
							
						</div>
						<div class="barra_footer"><!--footer-bar-->
							<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion agrandar rf"><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera editar_constrasenia"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->					
					<form class="form_horizontal form_accion_submit contrasenia"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="editar_usuario_rol" name="opcion">
						<input type="hidden" value="<?php echo $_POST["id"]?>" name="id_usuario">
						<div class="control_grupo c_contrasenia"><!--control-grupo-->
							<label class="label_control contrasenia_l">Nueva Contraseña *</label>
							<div class="controles_cud"><!--controls-->
								<input type="password" id="contrasenia" style="width: 250px;" class="texto" name="contrasenia_">
							</div>
						</div>
						<div class="control_grupo c_contrasenia"><!--control-grupo-->
							<label class="label_control contrasenia_l">Repetir Contraseña *</label>
							<div class="controles_cud"><!--controls-->
								<input type="password" id="r_contrasenia" style="width: 250px;" class="texto" name="r_contrasenia">
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
