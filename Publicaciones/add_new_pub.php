
<html>
	<head>
		<script src="../Publicaciones/add_new_pub.js"></script>
		<script src="../Scripts/spin.js"></script>
		<script src="../Scripts/spin.min.js"></script>
		<script src="../Scripts/spin_prop.js"></script>
	</head>
        <body >
		<div class="contenedor_dialogo_publicacion opcion publicacion_dialogo"><!--publication-dialog-container-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<h1>¿Que quieres hacer?</h1>
				<h3 class="subtitulos"><!--sub-headline-->Selecciona las <strong>manera</strong> correcta para agregar tu(s) producto(s)</h3>
				<table class="dialogo_navegacion layout_dos_puertas" width="100%"><!--dialog-navigation two-doors-layout-->
					<tbody>
						<tr>
							<td class="tema_dialogo_navegacion contenedor_js"><!--dialog-navigation-item js-widgetcontainer-->
								<a class="tema_contenido agregar_articulo_producto_js"><!--item-content js-add-journal-articles-->
									<div class="tema_subtitulo"><!--item-headline-->Agregar uno por uno</div>
								</a>
							</td>
							<td class="tema_dialogo_navegacion contenedor_js"><!--dialog-navigation-item js-widgetcontainer-->
								<a class="tema_contenido agregar_subir_archivo"><!--item-content js-add-journal-articles-->
									<div class="tema_subtitulo"><!--item-headline-->Agregar varios a la vez</div>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		
		<div class="contenedor_dialogo_publicacion inicial eleccion"><!--publication-dialog-container-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<h1>¿Que te gustaría agregar?</h1>
					<h3 class="subtitulos"><!--sub-headline-->Selecciona el <strong>tipo de producto</strong> que te gustaría ingresar</h3>
					<table width="100%">
						<thead>
							<tr>
								<td>Copei</td>
								<td>Informe</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="width: 190px;">
									<?php
										include '../Scripts/query.php';
										$conexion = new Querys();
										$tipos = $conexion->Consultas("SELECT Tipo, Descripcion FROM Tipo_Copei");
										for($i = 0; $i < count($tipos); $i++)
										{
											$count = explode(".", $tipos[$i]["Tipo"]);
											if(count($count) == 1)
												echo "<input type='radio' class='mostrar_tipo_copei' name='tipo_copei' value='".$tipos[$i]["Tipo"]."'><a>".$tipos[$i]["Tipo"].". "."</a>".$tipos[$i]["Descripcion"]." ".(($tipos[$i]["Tipo"] == 5) ? "(Premios y Distinciones)": "")."<br>";
											else if(count($count) == 2)
											{
												if($tipos[$i]["Tipo"] !== '4.1' && $tipos[$i]["Tipo"] != "4.2" && $tipos[$i]["Tipo"] != "2.6")
													echo "<div class='".$count[0]." esconder_t_c_1'><input type='radio' class='mostrar_tipo_copei_1' name='tipo_copei_".$count[0]."' value='".$count[0]."_".$count[1]."'><a>".$tipos[$i]["Tipo"].". "."</a>".$tipos[$i]["Descripcion"]."</div>";
											}
											else if(count($count) == 3)
												echo "<div class='esconder_t_c_2 ".$count[0]."_".$count[1]."'><input type='radio' class='mostrar_tipo_copei_2' name='tipo_copei_".$count[0]."_".$count[1]."' value='".$tipos[$i]["Tipo"]."'><a>".$tipos[$i]["Tipo"].". "."</a>".$tipos[$i]["Descripcion"]."</div>";
										}
									?>
								</td>
								<td style="width: 190px;" valign="top">
									<input type='radio' class='mostrar_tipo_copei' name='tipo_copei' value='2.12.e'>Asistencia a eventos científicos y tecnológicos<br>
									<input type='radio' class='mostrar_tipo_copei' name='tipo_copei' value='2.12.f'>Eventos académicos, científicos, tecnológicos y culturales<br>
									<input type='radio' class='mostrar_tipo_copei' name='tipo_copei' value='2.12.g'>Visitas académicas y otros visitantes<br>
									<input type='radio' class='mostrar_tipo_copei' name='tipo_copei' value='2.12.h'>Medios<br>
									<input type='radio' class='mostrar_tipo_copei' name='tipo_copei' value='3.1.d'>Asesorías
								</td>
							</tr>
						</tbody>
					</table>
					<div class="contenedor_intercanbio_subir"><!--upload-swap-container-->
						<div class="contenedor_titulo_publicacion"><!--publication-tittle-container-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								<form class="form_c submit_form_accion"><!---c-form action-submit-form-->
									<input type="hidden" id="aceptar_titulo" value>
									<input type="hidden" id="tipo_copei" value>
									<label class="apuntador" id="titulo_producto"><!--pointer-->Titulo del producto (Opcionalmente se llena esta caja para buscar en el sistema relación con otros productos)</label>
									<textarea class="texto agregar_publicacion_publicacion_titulo" id="textarea_titulo" placeholder="Ingresa el titulo"></textarea>
									<div class="barra_footer"><!--footer-bar-->
										<a class="boton boton_plano link_accion_regresar"><!--btn btn-plain action-libk-back-->
											<span class="icono_fecha_regresar_negra"><!--ico-arrow-dark-left--></span>Regresar</a>
										<!--<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion rf agrandar" disabled="disabled"><!---btn btn-promote action-submit-button rf-->
									</div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera uno_por_uno" id="matches"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
						<h2>Encontramos artículos relacionados con el titulo que ingresaste. ¿Alguno de ellos es tuyo?</h2>
						<form class="form_c submit_form_accion form_mat"><!---c-form action-submit-form-->
							<input type="hidden" id="titulo_e_matches">
							<input type="hidden" id="tipo_e_matches" name="tipo_copei_esc">
							<input type="hidden" value="autor" name="opcion">
							<input type="hidden" value="" name="guar_act" id="guar_act_autor">
							<ul class="lista_c lista_duplicada"><!--c-list duplicate-list-->
							</ul>
							<div class="barra_footer"><!--footer-bar-->
							<a class="boton boton_plano link_accion_regresar"><!--btn btn-plain action-libk-back-->
								<span class="icono_fecha_regresar_negra"><!--ico-arrow-dark-left--></span>Regresar</a>
							<input type="submit" value="Continuar" class="boton boton_promover submit_boton_accion agrandar rf"><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<div id="cargando_div">
			<div id="contenedor_spin">
				<div id="spin_d" class="spin_div" style="position: absolute; left: 50%; top: 50%;"></div>
			</div>
		</div>
		
		
		<div class="contenedor_dialogo_publicacion mostrar_cabecera nuevo uno_por_uno"><!--publication-dialog-container show-header-->
			<div class="contenedor_dialogo agregar_contenido_diaglogo_js"><!--dialog-content js-add-pub-dialog-content--->
				<div class="arreglar_limpiar contenedor_js"><!--clearfix js-widgetcontainer-->
					<form class="form_horizontal form_accion_submit agregar_nuevo_producto" id="formulario" name="formulario"><!--form-horizontal action-form-submit--->
						<input type="hidden" value="copei" name="opcion">
						<input type="hidden" value="" name="guar_act" id="guar_act_copei">
						<input type="hidden" value="" name="tipo_copei_esc" id="tipo_copei_esc">
                                                <input type="hidden" value="" name="titulo_esc" id="titulo_esc">
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="titulo_publicacion arreglar_limpiar titulo"><!--publication-tittle clearfix-->
                                                              <center>
                                                            <strong id="tipo_producto">Producto </strong><input type="text" style="width: 680px;" name="tipo_copei" id="tipo_copei_" class="texto quitar_margen" disabled="disabled"  >
                                                    
                                                           <input type="textbox" id="Name_producto" style="width: 620px;" name="Name_producto"  class="texto quitar_margen" disabled="disabled" >
                                                            </center>
                                                              
								
                                                                
							</div>
                                                    <div class="control_grupo a_titulo" id="titule" ><!--control-grupo-->
									<label class="label_control" id="titulo_l">Titulo *</label>
									<div class="controles"><!--controls-->
                                                                            <input type="text" name="titulo" id="titulo" class="texto" >
									</div>
								</div>
                                                  <div  id="Estado_div" name="Estado_div" class="control_grupo autores a_autores1"><!--control-grupo-->
								
								<strong >Estado * </strong>
                                                                <div class="controles"><!--controls-->
                                                                <select  id="stado" name="stado">
                                                                      
  <option value="Preparacion">Preparación</option>
  <option value="Enviado">Enviado</option>
  <option value="Aceptado">Aceptado</option>

</select>
                                                                    </div>
                                                           <br>     
							</div>
							<div class="control_grupo autores a_autores"><!--control-grupo-->
								<label class="label_control" id="autor_l">Autores *</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="autores" placeholder="Teclea el nombre de los autores separados por una coma (,)" style="width: 620px;" class="texto" name="autores" >
									<input type="hidden" id="tipo_copei" name="tipo_copei">
								</div>
							</div>
                                                    <div class="control_grupo autores2 a_autores2 " id="autores2" style="display: none"><!--control-grupo-->
								<label class="label_control" >Director 2</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="autores_2"  style="width: 620px;" class="texto" name="autores_2" >
									<input type="hidden" id="tipo_copei" name="tipo_copei">
								</div>
							</div>
							<div class="control_grupo a_2 a_3 a_10" id="divdoi"><!--control-grupo-->
								<label class="label_control">DOI</label>
								<div class="controles borde_doi"><!--controls-->
									<input type="textbox" id="doi" style="width: 599px; border: none;" class="texto publicacion_DOI" name="doi"><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
									<a class="submit_buscador" style="float: right; position: absolute;">
										<i class="icono_busqueda_blanco" id="buscar_doi"></i><!--ico-search-white-->
									</a>
								</div>
							</div>
							<div class="control_grupo a_5" id="institucion_div"><!--control-grupo-->
								<label class="label_control">Institucion *</label>
								<input type="hidden" id="id_institucion" name="id_institucion">
								<div class="controles"><!--controls-->
									<input type="textbox" id="institucion" placeholder="Teclea el nombre de la Institución y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="institucion">
									
                                                                        <div id="cargar_lista_institucion" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_institucion"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo a_5" id="unidad_div"><!--control-grupo-->
								<label class="label_control">Unidad </label>
								<input type="hidden" id="id_unidad" name="id_unidad">
								<div class="controles"><!--controls-->
									<input type="textbox" id="unidad" placeholder="Teclea el nombre de la Unidad y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="unidad">
									<div id="cargar_lista_unidad" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_unidad"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo a_5" id="programa_div"><!--control-grupo-->
								<label class="label_control">Programa *</label>
								<input type="hidden" id="id_programa" name="id_programa">
								<div class="controles"><!--controls-->
									
                                                                    <input type="textbox" id="programa" placeholder="Teclea el nombre del Programa y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="programa">

                                                                        <div id="cargar_lista_programa" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_programa"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo a_5" id="curso_div"><!--control-grupo-->
								<label class="label_control">Curso *</label>
								<input type="hidden" id="id_curso" name="id_curso">
								<div class="controles"><!--controls-->
									<input type="textbox" id="curso" placeholder="Teclea el nombre del Curso y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="curso">
									<div id="cargar_lista_curso" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_curso"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo a_13 a_15" id="journal_div"><!--control-grupo-->
								<label class="label_control">Journal *</label>
								<input type="hidden" id="id_journal" name="id_journal">
								<div class="controles"><!--controls-->
                                                                    <input type="textbox" id="journal" placeholder="Teclea el nombre del Journal y elige la opcion correcta de la lista"  style="width: 620px;" maxlength="255" class="ac_journal texto luz_articulo_error error_articulo ac_cargando_ajax yu_aclista_input" name="journal" aria-autocomplete="list" aria-expanded="false" autocomplete="off"><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
										<!---realiza la busqueda y la clase ac_cargando_ajax cambia de off a on-->
										<!--aria-activedesendant="yui3-...." aparece cuando se carga la lista-->
									<div id="cargar_lista_journal" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_journal"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo c_usuario" id="usuario_div"><!--control-grupo-->
								<label class="label_control" id="usuario_l">Responsable *</label>
								<input type="hidden" id="id_usuario" name="id_usuario">
								<div class="controles"><!--controls-->
									<input type="textbox" id="usuario" placeholder="Teclea el nombre del Usuario y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="texto" name="usuario">
									<div id="cargar_lista_usuario" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_usuario"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo a_1" id="cita_div"><!--control-grupo-->
								<label class="label_control" id="cita_l">Cita_Gastos</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<input type="text" class="texto" style="width: 190px; font-size: 12px;" id="vol" name="vol"  >
												</td>
												<td align="center">
													<input type="text" class="texto" style="width: 190px; font-size: 12px;" id="num" name="num" >
												</td>
												<td align="right">
													<input type="text" class="texto" style="width: 190px; font-size: 12px;" id="pag" name="pag"  >
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="control_grupo a_9 a_12 a_22 a_40" id="referencia_div"><!--control-grupo-->
								<label class="label_control" id="referencia_l">No_Referencia_Reporte</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="referencia" style="width: 620px;" maxlength="255" class="texto" name="referencia"><!--text-->
								</div>
							</div>
							<div class="control_grupo a_8 a_16 a_40" id="capi_div"><!--control-grupo-->
								<label class="label_control" id="capitulo_l">Capitulo_Congreso</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="capitulo" style="width: 620px;" maxlength="255" class="texto" name="capitulo"><!--text-->
								</div>
							</div>
							<div class="control_grupo a_24"><!--control-grupo-->
								<label class="label_control">Paginas</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="paginas" style="width: 620px;" maxlength="255" class="texto" name="paginas"><!--text-->
								</div>
							</div>
							<!--quitar--><div class="control_grupo"><!--control-grupo-->
								<label class="label_control">Volumen</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="volumen" style="width: 620px;" maxlength="255" class="texto" name="volumen"><!--text-->
								</div>
							</div>
							<div class="control_grupo a_8 a_11 a_12 a_21 a_31" id="localidad_div"><!--control-grupo-->
								<label class="label_control" id="localidad_l">Localidad_PaginaWEB</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="localidad" style="width: 620px;" maxlength="255" class="texto" name="localidad"><!--text-->
								</div>
							</div>
							<div class="control_grupo a_2 a_4 a_9 a_18"><!--control-grupo-->
								<label class="label_control" id="editorial_l">Editorial_Afiliacion</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="editorial" style="width: 620px;" maxlength="255" class="texto" name="editorial"><!--text-->
								</div>
							</div>
							<div class="control_grupo a_2 a_4"><!--control-grupo-->
								<label class="label_control">Editor</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="editor" style="width: 620px;" maxlength="255" class="texto" name="editor"><!--text-->
								</div>
							</div>
							<div class="control_grupo a_2 a_4"><!--control-grupo-->
								<label class="label_control">Edición</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="edicion" style="width: 620px;" maxlength="255" class="texto" name="edicion"><!--text-->
								</div>
							</div>
							<div class="control_grupo a_2 a_19"><!--control-grupo-->
								<label class="label_control" id="isbn">ISBN</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="isbn_c" style="width: 620px;" maxlength="255" class="texto" name="isbn"><!--text-->
								</div>
							</div>
							<div class="control_grupo a_5 a_6"><!--control-grupo-->
								<label class="label_control" id="datos_l">Datos X *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left" id="propedeutico">
													<input type="radio" id="prope_no" name="prope" value="0" checked>No  
													<input type="radio" id="prope_si"  name="prope" value="1">Si
												</td>
												<td align="right">
													<select style="width: 200px; font-size: 12px;" id="nivel" name="nivel">
														<option value="Nivel">Nivel</option>
														<option value="Maestría">Maestría</option>
														<option value="Doctorado">Doctorado</option>
                                                                                                                <option value="Ambos">Ambos</option>
													</select>
                                                                                                    
                                                                                                     <select style="width: 200px; font-size: 12px;" id="nivel2" name="nivel2">
														<option value="Nivel">Nivel</option>
														<option value="Licenciatura">Licenciatura</option>
														
                                                                                                                <option value="Maestria">Maestria</option>
                                                                                                                <option value="Doctorado">Doctorado</option>
													</select>
													<input type="textbox" id="anio_lic" style="width: 200px;" maxlength="255" class="texto" name="anio_lic"><!--text-->
												</td>
												
											</tr>
										</tbody>
									</table>
								</div>
							</div> 
							<div class="control_grupo a_1 a_24 a_3 a_7 a_28 a_29 a_40" id="inicial_div"><!--control-grupo-->
								<label class="label_control" id="fecha_l">Fecha Inicio *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
                                                                                                    <select style="width: 200px; font-size: 12px;" id="dia_pub" name="dia_pub" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 200px; font-size: 12px;" id="mes_pub" name="mes_pub" class="fechas" >
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 200px; font-size: 12px;" id="anio_pub" name="anio_pub" class="fechas" >
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
							<div class="control_grupo a_5 a_6 a_20 a_40" id="termino_div"><!--control-grupo-->
								<label class="label_control">Fecha Termino *</label>
								<div class="controles"><!--controls-->
									<table width="100%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 200px; font-size: 12px;" id="dia_pub_t" name="dia_pub_t" class="fechas">
														<option>Día</option>
														<?php
															for($i = 1; $i < 32; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="center">
													<select style="width: 200px; font-size: 12px;" id="mes_pub_t" name="mes_pub_t" class="fechas">
														<option>Mes</option>
														<?php
															for($i = 1; $i < 13; $i++)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="right">
													<select style="width: 200px; font-size: 12px;" id="anio_pub_t" name="anio_pub_t" class="fechas">
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
							<div class="control_grupo a_2 a_3 a_10 a_21 a_32" id="tema_div"><!--control-grupo-->
								<label class="label_control" id="tema_pag_l">Tema</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="topic" style="width: 620px;" maxlength="255" class="texto" name="topic"><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
								</div>
							</div>
							<div class="control_grupo a_11 a_25"><!--control-grupo-->
								<label class="label_control" id="tema_l">Titulo_Libro_Impacto_Revista</label>
								<div class="controles"><!--controls-->
									<textarea type="textbox" id="titulo_libro" style="width: 620px; height: 82px;" class="texto" name="titulo_libro"></textarea><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
								</div>
							</div>
							<div class="control_grupo a_2 a_3 a_6 a_10 a_14 a_23 a_27 a_29" id="abs_div"><!--control-grupo-->
								<label class="label_control" id="abstract_l">Abstract</label>
								<div class="controles"><!--controls-->
									<textarea id="abstract" class="texto" name="abstract" style="width: 620px; height: 82px;"></textarea><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
								</div>
							</div>
							<div class="control_grupo a_13 a_26" id="nocitas_div"><!--control-grupo-->
								<label class="label_control" id="nocitas_l">Numero de Citas</label>
								<div class="controles"><!--controls-->
									<input type="textbox" id="citas" style="width: 620px;" class="texto" name="citas" ><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
								</div>
							</div>
							<div class="control_grupo  a_2 a_10 a_11 a_14 a_17 div_tesis"><!--control-grupo-->
								<label class="label_control">Relación con tesis</label>
								<input type="hidden" id="id_tesis" name="id_tesis">
								<div class="controles"><!--controls-->
									<input type="textbox" id="tesis" placeholder="Teclea el nombre de la tesis y elige la opcion correcta de la lista" style="width: 620px;" maxlength="255" class="ac_journal texto luz_articulo_error error_articulo ac_cargando_ajax yu_aclista_input" name="tesis" aria-autocomplete="list" aria-expanded="false" autocomplete="off"><!--journal-ac text error-highlight-article[journal] error-article[journal] ac-ajax-loadindoff yui3-aclist-->
										<!---realiza la busqueda y la clase ac_cargando_ajax cambia de off a on-->
										<!--aria-activedesendant="yui3-...." aparece cuando se carga la lista-->
									<div id="cargar_lista_tesis" class="yu_widget yu_listaac yu_posicionado_widget yu_aclista_escondida" aria-hidden="true" style="width: 621px; left: 160px;"><!--yui3-gidget yui3-aclist yui3-widget-positionated yui3-aclist-hidden-->
										<div class="yu_aclista_contenedor"><!--yui3-aclist-container-->
											<ul class="yu_lista_aclista" role="listbox" id="contenedor_tesis"><!--yui3-aclist-list-->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="control_grupo  a_30" id="grado_anio_div"><!--control-grupo-->
								<label class="label_control" id="gra_an">Grado/Año</label>
								<table width="85%">
										<tbody>
											<tr>
												<td align="left">
													<select style="width: 200px; font-size: 12px;" id="anio_esc" name="anio_esc">
														<option>Año</option>
														<?php
															for($i = 2020; $i > 1910; $i--)
																echo "<option value='".$i."'>".$i."</option>";
														?>
													</select>
												</td>
												<td align="rigth">
													<select style="width: 200px; font-size: 12px;" id="escolaridad" name="escolaridad">
														<option>Escolaridad</option>
														<option value="Licenciatura">Licenciatura</option>
														<option value="Maestría">Maestría</option>
														<option value="Diplomado">Diplomado</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
							</div>
							
							
						</div>
						<div class="barra_footer"><!--footer-bar-->
							<a class="boton boton_plano link_accion_regresar"><!--btn btn-plain action-libk-back-->
								<span class="icono_fecha_regresar_negra"><!--ico-arrow-dark-left--></span>Regresar</a>
							<input type="submit" class="boton boton_promover submit_boton_accion agrandar rf" value="Continuar"><!---btn btn-promote action-submit-button-->
							<div class="limpiar"></div><!--clear-->
						</div>
					</form>
				</div>
			</div>
		</div>	
					
		<div class="contenedor_dialogo_publicacion mostrar_cabecera lectura eleccion"><!--publication-dialog-container show-header-->
			<div class="agregar_dialogo_contenedor_journal agregar_dialogo_contenedor_journal_js"><!--add-journal-dialog-content js-add-journal-dialog-content-->
				<div class="arreglar_limpiar entrar_manual agregar_manualmente_publicacion contenedor_js"><!--clearfix manual-entry add-publications-manually js-widgetcontainer-->
					<table width="100%">
						<tbody>
							<tr>
								<td align="left" valign="top">
									<div class="contenido_izquierda"><!--content-left-->
										<div class="contenedor_swap_subida"><!--upload-swap-container-->
											<div class="contenedor_titulo_publicacion"><!--publication-tittle-container-->
												<div class="contenedor_js"><!--js-widgetcontainer-->
													<form class="form_c submit_form_accion leer_archivo"><!---c-form action-submit-form-->
														<label class="apuntador">Ingresar Productos</label>
														<div class="control_grupo"><!--control-grupo-->
															<textarea class="texto agregar_titulo_publicacion_publicaciones" name="lectura_text" id="lectura_text"></textarea><!--text add-publications-publication-tittle-->
														</div>
														<div class="control_grupo"><!--control-grupo-->
															<textarea class="texto errores"  style="display:none;" disabled="true"></textarea>
														</div>
                                                                                                               
														<div class="barra_footer"><!--footer-bar-->
                                                                                                                     
															<a class="boton boton_plano link_accion_regresar"><!--btn btn-plain action-libk-back-->
																<span class="icono_fecha_regresar_negra"><!--ico-arrow-dark-left--></span>Regresar</a>
															<input type="submit" class="boton boton_promover submit_boton_accion agrandar rf lectura_agregar" value="Continuar"><!---btn btn-promote action-submit-button-->
															<div class="limpiar"></div><!--clear-->
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</td>
								<td align="right" valign="top" class="contenedor_derecho"><!--content-right-->
									<div class="subir_componente contenedor_js"><!--uploader-component js-widgetcontainer-->
										<div class="contenedor_default_js"><!--js-default-container-->
											<div class="envoltura_drag_drop"><!--drag-and-drop-wrapper-->
												<div class="area_drag_drop"><!--drag-and-drop-area--></div>
												<div class="placeholder">
													<div class="placeholder_texto">Subir archivo</div>
													<span class="icono_zonasubir_largo"><!--ico-dropzone-large--></span>
												</div>
											</div>
											<div class="contenedor_seleccionar_archivo"><!--select-file-container-->
												<div class="yui3_widget yui3_subir"><!--yui3-widget yui3-uploader-->
													<div class="yui3_contenedor_subida"><!--yui3-uploader-content-->
														<a class="boton boton_ancho_completo accion_seleccionar_archivo boton_plano" style="width: 100%; height:100%; padding: 3px;">Seleccionar archivo</a>
														<input type="file" style="visibility:hidden; width: 0px; height:0px;" id="subir_archivo" accept>
													</div>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>		
		</div>		
			
					
		<div class="mensaje" style="padding: 50px 100px;"><!--or-text--></div>
	</body>
</html>
