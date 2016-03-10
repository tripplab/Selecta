<html>
	<head>
		<script src="../Caratula/Reportes.js"></script>
	</head>
	<body>
		<div class="contenedor_dialogo_publicacion opcion publicacion_dialogo"><!--publication-dialog-container-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<h1>¿Que quieres hacer?</h1>
				<h3 class="subtitulos"><!--sub-headline-->Selecciona las <strong>manera</strong> correcta para agregar tu(s) producto(s)</h3>
				<table class="dialogo_navegacion layout_dos_puertas" width="100%"><!--dialog-navigation two-doors-layout-->
					<tbody>
						<tr>
							<td class="tema_dialogo_navegacion contenedor_js"><!--dialog-navigation-item js-widgetcontainer-->
								<a class="tema_contenido agregar_articulo_producto_js"><!--item-content js-add-journal-articles-->
									<div class="tema_subtitulo"><!--item-headline-->Imprimir CV</div>
								</a>
							</td>
							<td class="tema_dialogo_navegacion contenedor_js"><!--dialog-navigation-item js-widgetcontainer-->
								<a class="tema_contenido agregar_subir_archivo"><!--item-content js-add-journal-articles-->
									<div class="tema_subtitulo"><!--item-headline-->Imprimir Reporte Institucional</div>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera nuevo uno_por_uno"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="editarform_laboratorio_perfil form_horizontal" style="margin-bottom: 0px;"><!--profile-aboutme-editform-->
						<div class="control_grupo"><!--control-grupo-->
							<div class=""><!--controls-->
								<table width="100%">
									<tbody>
										<tr>
											<td align="left">
												<label class="label_control" style="width: 150px;">Factor de Impacto (Filtro para 4.1) *</label>
												<div class="controles_cud"><!--controls-->
													<input type="textbox" id="factor_impacto" style="width: 100px;" class="texto" name="factor_impacto" value='<?php echo (isset($_SESSION["factor"])) ? $_SESSION["factor"] : 1;?>'>
												</div>
											</td>
											<td align="right" valign="top">
												<label class="label_control" style="width: 150px;">Citas (Filtro para 4.2) *</label>
												<div class="controles_cud"><!--controls-->
													<input type="textbox" id="no_citas" style="width: 100px;" class="texto" name="no_citas" value='<?php echo (isset($_SESSION["citas"])) ? $_SESSION["citas"] : 1;?>'>
												</div>
											</td>
                                                                                      
										</tr>
                                                                                <tr>
                                                                                    <br>
                                                                                      <td align="left" >
												<label class="label_control" style="width: 150px;">Estado del articulo*</label>
												<div class="controles_cud"><!--controls-->
                                                                                                    <select  id="Estado_Art" name="Estado_Art">
           <option value="Todos">Todos</option>                                                            
  <option value="Preparacion">Preparación</option>
  <option value="Enviado">Enviado</option>
  <option value="Aceptado">Aceptado</option>

</select>
													
												</div>
											</td>
                                                                                </tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="control_grupo"><!--control-grupo-->
							<label class="label_control">Fecha Inicio</label>
							<div class="controles_cud"><!--controls-->
								<table width="100%">
									<tbody>
										<tr>
											<td align="left">
												<select style="width: 70px; font-size: 12px;" id="dia_i" name="dia_i" class="texto">
													<option>Día</option>
													<?php
														for($i = 1; $i < 32; $i++)
															echo "<option value='".$i."'>".$i."</option>";
													?>
												</select>
											</td>
											<td align="center">
												<select style="width: 70px; font-size: 12px;" id="mes_i" name="mes_i" class="texto">
													<option>Mes</option>
													<?php
														for($i = 1; $i < 13; $i++)
															echo "<option value='".$i."'>".$i."</option>";
													?>
												</select>
											</td>
											<td align="right">
												<select style="width: 70px; font-size: 12px;" id="anio_i" name="anio_i" class="texto">
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
							<label class="label_control">Fecha Final</label>
							<div class="controles_cud"><!--controls-->
								<table width="100%">
									<tbody>
										<tr>
											<td align="left">
												<select style="width: 70px; font-size: 12px;" id="dia_f" name="dia_f" class="texto">
													<option>Día</option>
													<?php
														for($i = 1; $i < 32; $i++)
															echo "<option value='".$i."'>".$i."</option>";
													?>
												</select>
											</td>
											<td align="center">
												<select style="width: 70px; font-size: 12px;" id="mes_f" name="mes_f" class="texto">
													<option>Mes</option>
													<?php
														for($i = 1; $i < 13; $i++)
															echo "<option value='".$i."'>".$i."</option>";
													?>
												</select>
											</td>
											<td align="right">
												<select style="width: 70px; font-size: 12px;" id="anio_f" name="anio_f" class="texto">
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
						<div class="toolbar_editar"><!--edit-toolbar-->
							<div class="rf meta">
								<a class="cerrar_editar_js link_marcado"><!--js-edit-close link-underlined-->Regresar</a>
								<a class="guardar_editar boton boton_promover margen_boton cv_link" target="_blank">Continuar</a>
							</div>
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>	
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera nuevo institucional"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="editarform_laboratorio_perfil form_horizontal institucion" style="margin-bottom: 0px;"><!--profile-aboutme-editform-->
						<div class="control_grupo c_institucion" id="institucion_div"><!--control-grupo-->
								<label class="label_control" id="institucion_l">Institucion *</label>
								<input type="hidden" id="id_institucion" name="id_institucion">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" id="institucion" placeholder="Teclea el nombre de la Institución y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="institucion">
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
								<input type="hidden" id="id_unidad" name="id_unidad">
								<div class="controles_cud"><!--controls-->
									<input type="textbox" id="unidad" placeholder="Teclea el nombre de la Unidad y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="unidad">
									<div id="cargar_lista_unidad" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 120px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
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
								<div class="controles_cud"><!--controls-->
									<input type="textbox" id="departamento" placeholder="Teclea el nombre del Departamento y elige la opcion correcta de la lista" style="width: 440px;" maxlength="255" class="texto" name="departamento">
									<div id="cargar_lista_departamento" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 441px; left: 130px; top: 159px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_departamento"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="usuarios"></div>
						<div class="control_grupo"><!--control-grupo-->
							<label class="label_control">Fecha Inicio</label>
							<div class="controles_cud"><!--controls-->
								<table width="100%">
									<tbody>
										<tr>
											<td align="left">
												<select style="width: 70px; font-size: 12px;" id="dia_i_" name="dia_i_" class="texto">
													<option>Día</option>
													<?php
														for($i = 1; $i < 32; $i++)
															echo "<option value='".$i."'>".$i."</option>";
													?>
												</select>
											</td>
											<td align="center">
												<select style="width: 70px; font-size: 12px;" id="mes_i_" name="mes_i_" class="texto">
													<option>Mes</option>
													<?php
														for($i = 1; $i < 13; $i++)
															echo "<option value='".$i."'>".$i."</option>";
													?>
												</select>
											</td>
											<td align="right">
												<select style="width: 70px; font-size: 12px;" id="anio_i_" name="anio_i_" class="texto">
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
							<label class="label_control">Fecha Final</label>
							<div class="controles_cud"><!--controls-->
								<table width="100%">
									<tbody>
										<tr>
											<td align="left">
												<select style="width: 70px; font-size: 12px;" id="dia_f_" name="dia_f_" class="texto">
													<option>Día</option>
													<?php
														for($i = 1; $i < 32; $i++)
															echo "<option value='".$i."'>".$i."</option>";
													?>
												</select>
											</td>
											<td align="center">
												<select style="width: 70px; font-size: 12px;" id="mes_f_" name="mes_f_" class="texto">
													<option>Mes</option>
													<?php
														for($i = 1; $i < 13; $i++)
															echo "<option value='".$i."'>".$i."</option>";
													?>
												</select>
											</td>
											<td align="right">
												<select style="width: 70px; font-size: 12px;" id="anio_f_" name="anio_f_" class="texto">
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
						<div class="toolbar_editar"><!--edit-toolbar-->
							<div class="rf meta">
								<a class="cerrar_editar_js link_marcado"><!--js-edit-close link-underlined-->Regresar</a>
								<a class="guardar_editar boton boton_promover margen_boton institucional_button" target="_blank">Continuar</a>
							</div>
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>	
		
	</body>
</html>
