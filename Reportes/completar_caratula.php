<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$conexion = new Querys();
	?>
	<head>
		<script src="./Reportes.js"></script>
		</head>
	<body>
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="envoltura_literatura" id="envoltura_literatura_publicaciones"><!--literature-wrapper-->
				<div id="envoltura_literatura_div">
					
					<div>
					<div class="pequeno_subtitulo"><!--subheader-small-->
						<div class="elemento_ancho_completo"><!--full-width-element-->
							<div class="divisor_contenido_perfil"><!--profile-badge-container-->
								<?php
									$nombre = $conexion->Consultas("SELECT Usuario.Nombre as Nombre, Apellido_Paterno, Apellido_Materno, Unidad.Nombre as Unidad FROM Usuario, Unidad_Departamento, Unidad WHERE FK_Unidad = ID_Unidad AND FK_Unidad_Departamento = ID_Unidad_Departamento AND ID_Usuario = ".$_SESSION['ID']);
									$nombre = $nombre[0];
								?>
								<a class="lf divisor_perfil mostrar_herramientas_tip_acciones" href="../Perfil/?i=<?php echo $_SESSION["ID"];?>&n=<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>"><!--profile-badge action-show-tooltip-->
									<div class="m_imagen_c lf imagen_cabecera_perfil imagen_subtitulo"><!--c-img-m lf profile-header-image subheader-image-->
										<?php
											if(file_exists("../fotos_perfil/".$nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"].".jpg"))
												echo '<img src="../fotos_perfil/'.$nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"].'.jpg" width="50" height="50">';
											else
												echo '<img src="../fotos_perfil/default.jpg" width="50" height="50">';
										?>
										
									</div>
									<div class="lf personal_cabecera_personal"><!--lf profile-header-personal-->
										<table height="100%" valign="middle">
											<tbody>
												<tr>
													<td>
														<div>
															<h4 style="display: inline;"><?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?></h4>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="detalles"><?php echo $nombre["Unidad"];?></div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="limpiar"></div><!--clear-->
								</a>
							</div>
							<div class="limpiar"></div><!--clear-->
						</div>
					</div>
					<div class="limpiar"></div><!--clear-->
				</div>
					
					
				</div>
				
				<div class="contenido_columna_c comisiones_columna" style="padding-top: 70px;"><!--c-col-content-->
					<?php
						function comisiones($id, $motivo, $tipo, $informe)
						{
					?>
							<li class="lista_temas_c publicacion_li contenido_js"><!---c-list-item li-publication js-widgetcontainer-->
								<div style="margin-top: -2px;">
									<h5>
										<a class="link_titulo_publicacion_js">
											<span class="titulo_publicacion titulo_publicacion_titulo_js">
											<?php
												if($tipo == "Internacional" || $tipo == "Nacional")
												{
											?>
													<a href="./Generar_Comision.php?i=<?php echo $id;?>&n=<?php echo $motivo;?>" target="_blank"><?php echo $motivo;?></a>
											<?php 
												}
												else if($tipo == "Sabatico")
												{
											?>
													<a href="./Generar_Sabatico.php?i=<?php echo $id;?>&n=<?php echo $motivo;?>" target="_blank"><?php echo $motivo;?></a>
											<?php 
												}
												else
												{
											?>
													<a><?php echo $motivo;?></a>
											<?php
												}
											?>
											</span>
										</a>
									</h5>
								</div>
								<?php
									if(($tipo == "Internacional" || $tipo == "Nacional") && count($informe) > 0)
									{
								?>
										<div class="autores"><a href="./Generar_Reporte_Comision.php?i=<?php echo $informe[0]["ID_Informe"];?>&n=<?php echo $motivo;?>" target="_blank">Generar Informe</a></div>
								<?php
									}
									else if($tipo == "Internacional" || $tipo == "Nacional")
									{
								?>
										<div class="autores"><a href="../Comisiones/Editar.php?i=<?php echo $id;?>&n=<?php echo $motivo;?>">Llenar Informe</a></div>
								<?php		
									}
								?>
							</li>
					<?php	
						}
					?>
								
					<div class="contenido_c" style="border-right: none;"><!--c-content-->
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								<div class="caja_c publicaciones_wexp_js" style="margin: 0px;"><!--c-box js-wexp-publications-->
									<h4>
										<strong class="lf">
											<a>Comisiones Internacionales</a>
										</strong>
									</h4>
									<ul>
										<?php
											$comision = $conexion->Consultas("SELECT ID_Comision, Motivo FROM Comision WHERE Tipo_Comision LIKE 'Internacional' AND FK_Usuario = ".$_SESSION["ID"]);
											for($x = 0; $x < count($comision); $x++)
											{
												$informe = $conexion->Consultas("SELECT ID_Informe FROM Informe_Comision WHERE FK_Comision = ".$comision[$x]["ID_Comision"]);
												comisiones($comision[$x]["ID_Comision"], $comision[$x]["Motivo"], "Internacional", $informe);
											}
											unset($comision);
											unset($informe);
										?>
									</ul>
								</div>
								<div class="caja_c publicaciones_wexp_js" style="margin: 20px 0px 0px 0px;"><!--c-box js-wexp-publications-->
									<h4>
										<strong class="lf">
											<a>Comisiones Nacionales</a>
										</strong>
									</h4>
									<ul>
										<?php
											$comision = $conexion->Consultas("SELECT ID_Comision, Motivo FROM Comision WHERE Tipo_Comision LIKE 'Nacional' AND FK_Usuario = ".$_SESSION["ID"]);
											for($x = 0; $x < count($comision); $x++)
											{
												$informe = $conexion->Consultas("SELECT ID_Informe FROM Informe_Comision WHERE FK_Comision = ".$comision[$x]["ID_Comision"]);
												comisiones($comision[$x]["ID_Comision"], $comision[$x]["Motivo"], "Nacional", $informe);
											}
											unset($comision);
											unset($informe);
										?>
									</ul>
								</div>
								<div class="caja_c publicaciones_wexp_js" style="margin: 20px 0px 0px 0px;"><!--c-box js-wexp-publications-->
									<h4>
										<strong class="lf">
											<a>Vacaciones</a>
										</strong>
									</h4>
									<ul>
										<?php
											$comision = $conexion->Consultas("SELECT ID_Comision, Fecha_Inicial, Fecha_Final FROM Comision WHERE Tipo_Comision LIKE 'Vacacion' AND FK_Usuario = ".$_SESSION["ID"]);
											for($x = 0; $x < count($comision); $x++)
											{
												$inicial = explode("-", $comision[$x]["Fecha_Inicial"]);
												$final = explode("-", $comision[$x]["Fecha_Final"]);
												comisiones($comision[$x]["ID_Comision"], $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0], "Vacacion", "");
											}
											unset($comision);
											unset($informe);
										?>
									</ul>
								</div>
								<div class="caja_c publicaciones_wexp_js" style="margin: 20px 0px 0px 0px;"><!--c-box js-wexp-publications-->
									<h4>
										<strong class="lf">
											<a>Sabáticas</a>
										</strong>
									</h4>
									<ul>
										<?php
											$comision = $conexion->Consultas("SELECT ID_Comision, Fecha_Inicial, Fecha_Final FROM Comision WHERE Tipo_Comision LIKE 'Sabatico' AND FK_Usuario = ".$_SESSION["ID"]);
											for($x = 0; $x < count($comision); $x++)
											{
												$inicial = explode("-", $comision[$x]["Fecha_Inicial"]);
												$final = explode("-", $comision[$x]["Fecha_Final"]);
												comisiones($comision[$x]["ID_Comision"], $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0], "Sabatico", "");
											}
											unset($comision);
											unset($informe);
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="columna_derecha_c" style="border-left: none;"><!--c-col-right-->
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								<div class="laboratorio_perfil contenedor_luz_js caja_c abrir_editar_js"><!--profile-aboutme js-highlight-container c-box js-edit-open-->
									<h4>
										<strong class="lf">
											<a class="link_inherit">Generar CV</a>
										</strong>
									</h4>
									<form class="editarform_laboratorio_perfil form_horizontal" style="margin-bottom: 0px; display: none;"><!--profile-aboutme-editform-->
										<div class="control_grupo"><!--control-grupo-->
											<label class="label_control">Factor de Impacto *</label>
											<div class="controles_cud"><!--controls-->
												<input type="textbox" id="factor_impacto" style="width: 250px;" class="texto" name="factor_impacto" value='<?php echo (isset($_SESSION["factor"])) ? $_SESSION["factor"] : 1;?>'>
											</div>
										</div>
                                                                                 
										<div class="control_grupo"><!--control-grupo-->
											<label class="label_control">Citas   *</label>
											<div class="controles_cud"><!--controls-->
												<input type="textbox" id="no_citas" style="width: 250px;" class="texto" name="no_citas" value='<?php echo (isset($_SESSION["citas"])) ? $_SESSION["citas"] : 1;?>'>
											</div>
										</div>
										<div class="control_grupo"><!--control-grupo-->
											<label class="label_control">Fecha Inicio</label>
											<div class="controles_cud"><!--controls-->
												<table width="100%">
													<tbody>
														<tr>
															<td align="left">
																<select style="width: 70px; font-size: 12px;" id="dia_i" name="dia_i">
																	<option>Día</option>
																	<?php
																		for($i = 1; $i < 32; $i++)
																			echo "<option value='".$i."'>".$i."</option>";
																	?>
																</select>
															</td>
															<td align="center">
																<select style="width: 70px; font-size: 12px;" id="mes_i" name="mes_i">
																	<option>Mes</option>
																	<?php
																		for($i = 1; $i < 13; $i++)
																			echo "<option value='".$i."'>".$i."</option>";
																	?>
																</select>
															</td>
															<td align="right">
																<select style="width: 70px; font-size: 12px;" id="anio_i" name="anio_i">
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
																<select style="width: 70px; font-size: 12px;" id="dia_f" name="dia_f">
																	<option>Día</option>
																	<?php
																		for($i = 1; $i < 32; $i++)
																			echo "<option value='".$i."'>".$i."</option>";
																	?>
																</select>
															</td>
															<td align="center">
																<select style="width: 70px; font-size: 12px;" id="mes_f" name="mes_f">
																	<option>Mes</option>
																	<?php
																		for($i = 1; $i < 13; $i++)
																			echo "<option value='".$i."'>".$i."</option>";
																	?>
																</select>
															</td>
															<td align="right">
																<select style="width: 70px; font-size: 12px;" id="anio_f" name="anio_f">
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
												<a class="cerrar_editar_js link_marcado"><!--js-edit-close link-underlined-->Cancelar</a>
												<a class="guardar_editar boton boton_promover margen_boton cv_link" target="_blank">Continuar</a>
											</div>
											<div class="limpiar"></div><!--clear-->
										</div>
									</form>
								</div>
							</div>
							<div class="perfil_miembros lista_personas_s caja_c contenedor_js"><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
								<div style="margin-top: -2px;">
									<h4>
										<strong class="lf">
											<a>Generar Reporte Institucional</a>
										</strong>
									</h4>
								</div>
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
