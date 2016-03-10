<html>
	<?php
		include '../Scripts/query.php';
		$conexion = new Querys();
		function cargar_lista($id, $nombre, $a_paterno, $a_materno, $lugar, $fecha, $correo, $seguro, $ultimo_nivel, $rol, $estatus, $institucion, $id_institucion, $unidad, $id_unidad, $unidad_departamento)
		{
			$conexion = new Querys();
		?>
				<li class="tema_informacion_institucion abrir_editar contenedor_js <?php echo $id;?>_li"><!--institution-info-item edit-open js-widgetcontainer-->
					<div class="indent_izquierda"><!--indent-left-->Nombre</div>
					<div class="indent_derecha"><!--indent-right-->
						<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="<?php echo $id;?>"><!--js-edit-open edit-link text-right-->
							<span class="icono_editar"></span>Editar</a>
					</div>
					<a class="abrir_editar_js placeholder_link" value="<?php echo $id;?>" id="<?php echo $id;?>_a"><!--js-edit-open placeholder-link--><?php echo $nombre." ".$a_paterno."-".$a_materno;?></a>
				</li>
				<div class="contenedor_js formularios <?php echo $id;?>_form"><!--js-widgetcontainer-->
					<div class="seccion_editar"><!--edit-section-->
						<form class="form_horizontal editar_tipo_copei" value="<?php echo $id;?>"><!--form-horizontal institution-contactinformation-editform-->
							<input type="hidden" value="editar_usuario" name="opcion">
							<input type="hidden" value="<?php echo $id;?>" name="id_usuario">
							<h4 class="ningun_margen"><!--no-margin-->Datos Personales</h4><br>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label id="<?php echo $id;?>_nombre">Nombre *</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<input type="text" value="<?php echo $nombre;?>" class="valor_tema_institution texto" id="nombre_<?php echo $id;?>" name="nombre" style="width: 387px;"><!--institution-item-value text institution-field-street-->
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label id="<?php echo $id;?>_paterno">Apellido Paterno *</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<input type="text" value="<?php echo $a_paterno;?>" class="valor_tema_institution texto" id="paterno_<?php echo $id;?>" name="paterno" style="width: 387px;"><!--institution-item-value text institution-field-street-->
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label id="<?php echo $id;?>_materno">Apellido Materno *</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<input type="text" value="<?php echo $a_materno;?>" class="valor_tema_institution texto" id="materno_<?php echo $id;?>" name="materno" style="width: 387px;"><!--institution-item-value text institution-field-street-->
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Lugar de Nacimiento</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<input type="text" value="<?php echo $lugar;?>" class="valor_tema_institution texto" name="lugar" style="width: 387px;"><!--institution-item-value text institution-field-street-->
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Fecha de Nacimiento</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<table width="80%">
											<tbody>
												<tr>
													<?php
														$fecha = explode("-", $fecha);
													?>
													<td align="left">
														<select style="width: 129px; font-size: 12px;" id="dia_<?php echo $id;?>" name="dia" class="fechas">
															<?php
																for($i = 1; $i < 32; $i++)
																	echo "<option value='".$i."'>".$i."</option>";
															?>
														</select>
													</td>
													<td align="center">
														<select style="width: 129px; font-size: 12px;" id="mes_<?php echo $id;?>" name="mes" class="fechas">
															<?php
																for($i = 1; $i < 13; $i++)
																	echo "<option value='".$i."'>".$i."</option>";
															?>
														</select>
													</td>
													<td align="right">
														<select style="width: 129px; font-size: 12px;" id="anio_<?php echo $id;?>" name="anio" class="fechas">
															<?php
																for($i = 2020; $i > 1910; $i--)
																	echo "<option value='".$i."'>".$i."</option>";
															?>
														</select>
														<?php
															echo "<script> 
																$('#dia_".$id."').val('". $fecha[2]."'); 
																$('#mes_".$id."').val('". $fecha[1]."'); 
																$('#anio_".$id."').val('". $fecha[0]."'); 
															</script>";
														?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Correo Electrónico</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<input type="text" value="<?php echo $correo;?>" class="valor_tema_institution texto" name="correo" style="width: 387px;"><!--institution-item-value text institution-field-street-->
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Seguro Médico</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<input type="text" value="<?php echo $seguro;?>" class="valor_tema_institution texto" name="seguro" style="width: 387px;"><!--institution-item-value text institution-field-street-->
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Último Nivel Académico</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<input type="text" value="<?php echo $ultimo_nivel;?>" class="valor_tema_institution texto" name="nivel" style="width: 387px;"><!--institution-item-value text institution-field-street-->
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label id="rol_<?php echo $id;?>_l">Rol</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<select style="width: 129px; font-size: 12px;" id="rol_<?php echo $id;?>" name="rol" class="fechas">
											<option value="Administrador">Administrador</option>
											<option value="Profesor">Profesor</option>
											<option value="Auxiliar">Auxiliar</option>
											<option value="Estudiante">Estudiante</option>
											<option value="Pasante">Licenciatura</option>
										</select>
										<?php
											echo "<script> $('#rol_".$id."').val('".$rol."'); </script>";
										?>
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Estatus</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<select style="width: 129px; font-size: 12px;" id="estatus_<?php echo $id;?>" name="estatus" class="fechas">
											<option value="0">Inactivo</option>
											<option value="1">Activo</option>
										</select>
										<?php
											echo "<script> $('#estatus_".$id."').val('".$estatus."'); </script>";
										?>
									</div>
								</div>
							</div>
							<br><h4 class="ningun_margen"><!--no-margin-->Información Institucional</h4><br>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Institución</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
											<label><?php echo $institucion;?></label>
									</div>
								</div>
							</div>
							<div class="control_grupo"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Unidad</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<label><?php echo $unidad;?></label>
									</div>
								</div>
							</div>
							<?php 
								$departamento = $conexion->Consultas("SELECT Nombre, ID_Departamento FROM Departamento, Unidad_Departamento WHERE ID_Departamento = FK_Departamento AND ID_Unidad_Departamento = ".$unidad_departamento);								
							?>
							<div class="control_grupo c_departamento" id="<?php echo $id;?>_departamento_div"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Departamento *</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<label><?php echo (count($departamento) > 0) ? $departamento[0]["Nombre"] : "";?></label>
									</div>
								</div>
							</div>
							<?php
								if(count($departamento) == 0)
									echo "<script> $('#".$id."_departamento_div').hide(); </script>";
								$programa = $conexion->Consultas("SELECT Nombre_Programa, Identificador, ID_Periodo_Escolar, Nivel, ID_Matricula, ID_Programa FROM Usuario, Matricula_Programa, Periodo_Escolar_Ingreso, Programa_Unidad, Programa_Academico WHERE ID_Usuario = FK_Usuario AND ID_Periodo_Escolar = FK_Periodo_Escolar AND Periodo_Escolar_Ingreso.FK_Programa = Programa_Unidad.FK_Programa AND Programa_Unidad.FK_Programa = ID_Programa ORDER BY Periodo_Escolar_Ingreso.Fecha_Inicio DESC");
							?>								
							<div class="control_grupo c_departamento" id="<?php echo $id;?>_programa_div"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Programa</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<label><?php echo (count($programa) > 0) ? $programa[0]["Nombre_Programa"] : "";?></label>
									</div>
								</div>
							</div>
							<div class="control_grupo c_departamento" id="<?php echo $id;?>_periodo_div"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Periodo Escolar</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<label><?php echo (count($programa) > 0) ? $programa[0]["Identificador"] : "";?></label>
									</div>
								</div>
							</div>
							<div class="control_grupo c_departamento" id="<?php echo $id;?>_nivel_div"><!--control-grupo-->
								<div class="indent_contenedor"><!--indent-container-->
									<div class="indent_izquierda"><!--indent-left-->
										<div class="label_control"><!--control-label-->
											<label>Nivel Académico *</label>
										</div>
									</div>
									<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
										<label><?php echo (count($programa) > 0) ? $programa[0]["ID_Programa"] : "";?></label>
									</div>
								</div>
							</div>
							<?php
								if(count($programa) == 0)
									echo "<script> 
										$('#".$id."_programa_div').hide(); 
										$('#".$id."_periodo_div').hide(); 
										$('#".$id."_nivel_div').hide(); 
									</script>";
							?>
							<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
								<a class="abrir_editar_js boton_link link_marcado" value="<?php echo $id;?>"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
								<a class="editar_institucion boton_link link_marcado" value="<?php echo $id;?>"><!--js-edit-open btn-link link-underlined-->Editar Información Institucional</a>
								<a class="cambiar_contrasenia boton_link link_marcado" value="<?php echo $id;?>"><!--js-edit-open btn-link link-underlined-->Cambiar Contraseña</a>
								<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
							</div>
						</form>
					</div>
				</div>
		<?php
			}
	?>
	<head>
		<script src="../Usuario/usuario.js"></script>
	</head>
	<body>
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="facilitar_envoltura contenedor_js"><!--facility-wrapper js-widgetcontainer-->
				<div class="elemento_lleno_ancho arreglar_limpiar"><!--full-width-element clearfix-->
					<div class="facilitar_cabecera"><!--facility-header-->
						<div class="facilitar_informacion_cabecera lf"><!--facility-header-info lf-->
							<table class="arreglar_alinear"><!--valign-fix-->
								<tbody>
									<tr>
										<td valign="bottom" height="80px;">
											<h1>
												Configuración de cuentas
											</h1>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="facilitar_cabecera_acciones rf"><!--facility-header-actions rf-->
							<div class="facilitar_accion_primaria contenedor_js"><!--facility-primary-action js-widgetcontainer-->
								<a class="boton boton_promover boton_ancho_completo boton_largo boton_invitar"><!--btn btn-promote btn-fullwidth btn-large btn-invite-->Agregar cuentas de usaurio</a>
							</div>						
						</div>
						<div class="limpiar"></div><!--clear-->
					</div>
				</div>
				<div class="limpiar"></div><!--clear-->
				<div class="envoltura_facilitar_principal"><!--facility-main-wrapper-->
					<div class="layout_caja_padded"><!--layout-padded-boxes-->
						<div class="contenido_columna_c"><!--c-col-content-->
							<div class="contenido_c" style="border-right: none;"><!--c-content-->
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="caja_c informacion_institucion contenedor_js" style="margin: 0px;"><!--c-box info-institution js-widgetcontainer-->
										<h4 class="ningun_margen"><!--no-margin-->Administradores</h4>
										<ul>
											<?php
												$usuarios = $conexion->Consultas("SELECT ID_Usuario, Usuario.Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento, Correo_ELectronico, Num_Ser_Med, Ultimo_Nivel_Academico, Rol, Estatus, Institucion.Nombre AS Institucion, ID_Institucion, Unidad.Nombre AS Unidad, ID_Unidad, ID_Unidad_Departamento FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Unidad = FK_Unidad AND ID_Institucion = FK_Institucion AND FK_Unidad_Departamento = ID_Unidad_Departamento AND Rol LIKE 'Administrador'");
												for($x = 0; $x < count($usuarios); $x++)
													cargar_lista($usuarios[$x]["ID_Usuario"], $usuarios[$x]["Nombre"], $usuarios[$x]["Apellido_Paterno"], $usuarios[$x]["Apellido_Materno"], $usuarios[$x]["Lugar_Nacimiento"], $usuarios[$x]["Fecha_Nacimiento"], $usuarios[$x]["Correo_ELectronico"], $usuarios[$x]["Num_Ser_Med"], $usuarios[$x]["Ultimo_Nivel_Academico"], $usuarios[$x]["Rol"], $usuarios[$x]["Estatus"], $usuarios[$x]["Institucion"], $usuarios[$x]["ID_Institucion"], $usuarios[$x]["Unidad"], $usuarios[$x]["ID_Unidad"], $usuarios[$x]["ID_Unidad_Departamento"]);
											?>
										</ul>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
								
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="caja_c informacion_institucion contenedor_js" style="margin: 20px 0px;"><!--c-box info-institution js-widgetcontainer-->
										<h4 class="ningun_margen"><!--no-margin-->Profesores</h4>
										<ul>
											<?php
												$usuarios = $conexion->Consultas("SELECT ID_Usuario, Usuario.Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento, Correo_ELectronico, Num_Ser_Med, Ultimo_Nivel_Academico, Rol, Estatus, Institucion.Nombre AS Institucion, ID_Institucion, Unidad.Nombre AS Unidad, ID_Unidad, ID_Unidad_Departamento FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Unidad = FK_Unidad AND ID_Institucion = FK_Institucion AND FK_Unidad_Departamento = ID_Unidad_Departamento AND Rol LIKE 'Profesor'");
												for($x = 0; $x < count($usuarios); $x++)
													cargar_lista($usuarios[$x]["ID_Usuario"], $usuarios[$x]["Nombre"], $usuarios[$x]["Apellido_Paterno"], $usuarios[$x]["Apellido_Materno"], $usuarios[$x]["Lugar_Nacimiento"], $usuarios[$x]["Fecha_Nacimiento"], $usuarios[$x]["Correo_ELectronico"], $usuarios[$x]["Num_Ser_Med"], $usuarios[$x]["Ultimo_Nivel_Academico"], $usuarios[$x]["Rol"], $usuarios[$x]["Estatus"], $usuarios[$x]["Institucion"], $usuarios[$x]["ID_Institucion"], $usuarios[$x]["Unidad"], $usuarios[$x]["ID_Unidad"], $usuarios[$x]["ID_Unidad_Departamento"]);
											?>
										</ul>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
								
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="caja_c informacion_institucion contenedor_js" style="margin: 20px 0px;"><!--c-box info-institution js-widgetcontainer-->
										<h4 class="ningun_margen"><!--no-margin-->Auxiliares</h4>
										<ul>
											<?php
												$usuarios = $conexion->Consultas("SELECT ID_Usuario, Usuario.Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento, Correo_ELectronico, Num_Ser_Med, Ultimo_Nivel_Academico, Rol, Estatus, Institucion.Nombre AS Institucion, ID_Institucion, Unidad.Nombre AS Unidad, ID_Unidad, ID_Unidad_Departamento FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Unidad = FK_Unidad AND ID_Institucion = FK_Institucion AND FK_Unidad_Departamento = ID_Unidad_Departamento AND Rol LIKE 'Auxiliar'");
												for($x = 0; $x < count($usuarios); $x++)
													cargar_lista($usuarios[$x]["ID_Usuario"], $usuarios[$x]["Nombre"], $usuarios[$x]["Apellido_Paterno"], $usuarios[$x]["Apellido_Materno"], $usuarios[$x]["Lugar_Nacimiento"], $usuarios[$x]["Fecha_Nacimiento"], $usuarios[$x]["Correo_ELectronico"], $usuarios[$x]["Num_Ser_Med"], $usuarios[$x]["Ultimo_Nivel_Academico"], $usuarios[$x]["Rol"], $usuarios[$x]["Estatus"], $usuarios[$x]["Institucion"], $usuarios[$x]["ID_Institucion"], $usuarios[$x]["Unidad"], $usuarios[$x]["ID_Unidad"], $usuarios[$x]["ID_Unidad_Departamento"]);
											?>
										</ul>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
								
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="caja_c informacion_institucion contenedor_js" style="margin: 20px 0px;"><!--c-box info-institution js-widgetcontainer-->
										<h4 class="ningun_margen"><!--no-margin-->PosDoc</h4>
										<ul>
											<?php
												$usuarios = $conexion->Consultas("SELECT ID_Usuario, Usuario.Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento, Correo_ELectronico, Num_Ser_Med, Ultimo_Nivel_Academico, Rol, Estatus, Institucion.Nombre AS Institucion, ID_Institucion, Unidad.Nombre AS Unidad, ID_Unidad, ID_Unidad_Departamento FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Unidad = FK_Unidad AND ID_Institucion = FK_Institucion AND FK_Unidad_Departamento = ID_Unidad_Departamento AND Rol LIKE 'Posdoc'");
												for($x = 0; $x < count($usuarios); $x++)
													cargar_lista($usuarios[$x]["ID_Usuario"], $usuarios[$x]["Nombre"], $usuarios[$x]["Apellido_Paterno"], $usuarios[$x]["Apellido_Materno"], $usuarios[$x]["Lugar_Nacimiento"], $usuarios[$x]["Fecha_Nacimiento"], $usuarios[$x]["Correo_ELectronico"], $usuarios[$x]["Num_Ser_Med"], $usuarios[$x]["Ultimo_Nivel_Academico"], $usuarios[$x]["Rol"], $usuarios[$x]["Estatus"], $usuarios[$x]["Institucion"], $usuarios[$x]["ID_Institucion"], $usuarios[$x]["Unidad"], $usuarios[$x]["ID_Unidad"], $usuarios[$x]["ID_Unidad_Departamento"]);
											?>
										</ul>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
								
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="caja_c informacion_institucion contenedor_js" style="margin: 20px 0px;"><!--c-box info-institution js-widgetcontainer-->
										<h4 class="ningun_margen"><!--no-margin-->Estudiantes</h4>
										<ul>
											<?php
												$usuarios = $conexion->Consultas("SELECT ID_Usuario, Usuario.Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento, Correo_ELectronico, Num_Ser_Med, Ultimo_Nivel_Academico, Rol, Estatus, Institucion.Nombre AS Institucion, ID_Institucion, Unidad.Nombre AS Unidad, ID_Unidad, ID_Unidad_Departamento FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Unidad = FK_Unidad AND ID_Institucion = FK_Institucion AND FK_Unidad_Departamento = ID_Unidad_Departamento AND Rol LIKE 'Estudiante'");
												for($x = 0; $x < count($usuarios); $x++)
													cargar_lista($usuarios[$x]["ID_Usuario"], $usuarios[$x]["Nombre"], $usuarios[$x]["Apellido_Paterno"], $usuarios[$x]["Apellido_Materno"], $usuarios[$x]["Lugar_Nacimiento"], $usuarios[$x]["Fecha_Nacimiento"], $usuarios[$x]["Correo_ELectronico"], $usuarios[$x]["Num_Ser_Med"], $usuarios[$x]["Ultimo_Nivel_Academico"], $usuarios[$x]["Rol"], $usuarios[$x]["Estatus"], $usuarios[$x]["Institucion"], $usuarios[$x]["ID_Institucion"], $usuarios[$x]["Unidad"], $usuarios[$x]["ID_Unidad"], $usuarios[$x]["ID_Unidad_Departamento"]);
											?>
										</ul>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
								
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="caja_c informacion_institucion contenedor_js" style="margin: 20px 0px;"><!--c-box info-institution js-widgetcontainer-->
										<h4 class="ningun_margen"><!--no-margin-->Estudiantes de Licenciatura</h4>
										<ul>
											<?php
												$usuarios = $conexion->Consultas("SELECT ID_Usuario, Usuario.Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento, Correo_ELectronico, Num_Ser_Med, Ultimo_Nivel_Academico, Rol, Estatus, Institucion.Nombre AS Institucion, ID_Institucion, Unidad.Nombre AS Unidad, ID_Unidad, ID_Unidad_Departamento FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Unidad = FK_Unidad AND ID_Institucion = FK_Institucion AND FK_Unidad_Departamento = ID_Unidad_Departamento AND Rol LIKE 'Pasante'");
												for($x = 0; $x < count($usuarios); $x++)
													cargar_lista($usuarios[$x]["ID_Usuario"], $usuarios[$x]["Nombre"], $usuarios[$x]["Apellido_Paterno"], $usuarios[$x]["Apellido_Materno"], $usuarios[$x]["Lugar_Nacimiento"], $usuarios[$x]["Fecha_Nacimiento"], $usuarios[$x]["Correo_ELectronico"], $usuarios[$x]["Num_Ser_Med"], $usuarios[$x]["Ultimo_Nivel_Academico"], $usuarios[$x]["Rol"], $usuarios[$x]["Estatus"], $usuarios[$x]["Institucion"], $usuarios[$x]["ID_Institucion"], $usuarios[$x]["Unidad"], $usuarios[$x]["ID_Unidad"], $usuarios[$x]["ID_Unidad_Departamento"]);
											?>
										</ul>
										<div class="limpiar"></div><!--clear-->
									</div>
								</div>
								
							</div>
							<div class="columna_derecha_c" style="border-left: none;" id="columna_derecha"><!--c-col-right-->
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="limpiar"></div><!--clear-->
		<div>
			<div id="footer" class="clearfix">
				<!---<span class="footer-right">DERECHOS RESERVADOS</span>
				<span class="footer-left">DERECHOS RESERVADOS</span>--->
			</div>
		</div>
	</body>
</html>
