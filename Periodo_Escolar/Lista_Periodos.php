<html>
	<head>
		<script src="./Periodo.js"></script>
	</head>
	<body>
		<h4 class="ningun_margen"><!--no-margin-->Periodos Escolares</h4>
		<ul>
	<?php			
			session_start();
			$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
			include '../Scripts/query.php';
			$conexion = new Querys();
			$id = $_POST["id"];
			$programa = $conexion->Consultas("SELECT * FROM Periodo_Escolar_Ingreso WHERE FK_Programa = ".$id." ORDER BY Fecha_Inicio");
			for($x = 0; $x < count($programa); $x++)
			{	
		?>
					<li class="tema_informacion_institucion abrir_editar contenedor_js <?php echo $programa[$x]["ID_Periodo_Escolar"];?>_li"><!--institution-info-item edit-open js-widgetcontainer-->
						<div class="indent_izquierda"><!--indent-left-->Identificador</div>
						<?php
							if($rol == "Administrador")
							{
						?>
						<div class="indent_derecha"><!--indent-right-->
							<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>"><!--js-edit-open edit-link text-right-->
								<span class="icono_editar"></span>Editar</a>
						</div>
						<a class="abrir_editar_js placeholder_link" value="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>" id="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>_a"><!--js-edit-open placeholder-link--><?php echo $programa[$x]["Identificador"];?></a>		
						<a class="placeholder_link eliminar_curso" style="font-weight: bold;" value="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>"><!--js-edit-open placeholder-link-->Eliminar</a>		
						<?php
							}
							else
							{
						?>
						<a class="placeholder_link" value="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>" id="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>_a"><!--js-edit-open placeholder-link--><?php echo $programa[$x]["Identificador"];?></a>		
						<?php
							}
						?>
					</li>
					<div class="contenedor_js formularios <?php echo $programa[$x]["ID_Periodo_Escolar"];?>_form"><!--js-widgetcontainer-->
						<div class="seccion_editar"><!--edit-section-->
							<form class="form_horizontal periodo_formulario" value="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>"><!--form-horizontal institution-contactinformation-editform-->
								<input type="hidden" value="periodo_nuevo" name="opcion">
								<input type="hidden" value="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>" name="servicio">
								<div class="control_grupo" id="c_<?php echo $programa[$x]["ID_Periodo_Escolar"];?>"><!--control-grupo-->
									<div class="indent_contenedor"><!--indent-container-->
										<div class="indent_izquierda"><!--indent-left-->
											<div class="label_control"><!--control-label-->
												<label id="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>_l">Identificador *</label>
											</div>
										</div>
										<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
											<input type="text" value="<?php echo $programa[$x]["Identificador"];?>" class="valor_tema_institution texto" id="nombre_<?php echo $programa[$x]["ID_Periodo_Escolar"];?>" name="nombre" style="width: 387px;"><!--institution-item-value text institution-field-street-->
										</div>
									</div>
								</div>
								<div class="control_grupo"><!--control-grupo-->
									<div class="indent_contenedor"><!--indent-container-->
										<div class="indent_izquierda"><!--indent-left-->
											<div class="label_control"><!--control-label-->
												<label id="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>_fecha">Fecha Inicial *</label>
											</div>
										</div>
										<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
											<table width="80%">
												<tbody>
													<tr>
														<?php
															$fecha = explode("-", $programa[$x]["Fecha_Inicio"]);
														?>
														<td align="left">
															<select style="width: 129px; font-size: 12px;" id="dia_pub" name="dia_pub" class="fechas">
																<option><?php echo $fecha[2];?></option>
																<?php
																	for($i = 1; $i < 32; $i++)
																		echo "<option value='".$i."'>".$i."</option>";
																?>
															</select>
														</td>
														<td align="center">
															<select style="width: 129px; font-size: 12px;" id="mes_pub" name="mes_pub" class="fechas">
																<option><?php echo $fecha[1];?></option>
																<?php
																	for($i = 1; $i < 13; $i++)
																		echo "<option value='".$i."'>".$i."</option>";
																?>
															</select>
														</td>
														<td align="right">
															<select style="width: 129px; font-size: 12px;" id="anio_pub" name="anio_pub" class="fechas">
																<option><?php echo $fecha[0];?></option>
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
								<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
									<a class="abrir_editar_js boton_link link_marcado" value="<?php echo $programa[$x]["ID_Periodo_Escolar"];?>"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
									<input type="submit" value="Guardar" class="guardar_editar_js boton boton_promover margen_boton"><!---js-edit-save btn btn-promote btn-margin-->
								</div>
							</form>
						</div>
					</div>
		<?php
			}
		?>
		</ul>
		<div class="limpiar"></div><!--clear-->
	</body>
</html>
