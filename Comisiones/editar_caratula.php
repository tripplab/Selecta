<html>
	<?php
		session_start();
		$id_get = $_POST["i"];
	?>
	<head>
		<script src="./Comisiones.js"></script>
	</head>
	<body>
		<div id="contenido_producto" class="soporte_subtitulo_pequeño columna_derecha_has"><!--subheader-small-support has-right-col-->
			<div class="envolutar_publicacion contenedor_js"><!--publication-wrapper js-widgetcontainer-->
				<div>
					<div class="pequeno_subtitulo"><!--subheader-small-->
						<div class="elemento_ancho_completo"><!--full-width-element-->
							<div class="divisor_contenido_perfil"><!--profile-badge-container-->
								<?php
									include '../Scripts/query.php';
									$conexion = new Querys();
									$nombre = $conexion->Consultas("SELECT Usuario.Nombre as Nombre, Apellido_Paterno, Apellido_Materno, Unidad.Nombre as Unidad FROM Usuario, Unidad_Departamento, Unidad WHERE FK_Unidad = ID_Unidad AND FK_Unidad_Departamento = ID_Unidad_Departamento AND ID_Usuario = ".$_SESSION['Usuario_Temporal']);
									$nombre = $nombre[0];
								?>
								<a class="lf divisor_perfil mostrar_herramientas_tip_acciones" href="../Perfil/?i=<?php echo $_SESSION["Usuario_Temporal"];?>&n=<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>"><!--profile-badge action-show-tooltip-->
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
				<div class="contenido_columna_c" id="editar_publicacion_"><!--c-col-content-->
					<?php
						$tipo = "";
						$motivo = "";
						$lugar = "";
						$detalles = "";
						$aceptado = "";
						
						$comision = $conexion->Consultas("SELECT * FROM Comision WHERE ID_Comision = ".$id_get);
						if(count($comision) > 0)
						{
							
							$comision = $comision[0];
							$inicial = explode("-", $comision["Fecha_Inicial"]);
							$final = explode("-", $comision["Fecha_Final"]);
							$aceptado = ($comision["Aceptado"] == "0" || $comision["Aceptado"] == null) ? "Aceptado" : "Rechazado";
							if($comision["Tipo_Comision"] == "Internacional" || $comision["Tipo_Comision"] == "Nacional")
							{
								$tipo = "Comisión ".$comision["Tipo_Comision"];
								$motivo = $comision["Motivo"];
								$lugar = $comision["Lugar"];
								$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
							}
							else 
							{
								if($comision["Tipo_Comision"] == "Sabatica")
									$tipo = "Sabática";
								else
									$tipo = "Vacación";
								$motivo = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
							}
						}
					?>
					<div class="contenido_c"><!--c-content-->
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								<div class="abstract_publicacion contenedor_js etiqueta"><!--pub-abstract js-widgetcontainer-->
									<div class="arreglar_limpiar"><!--clearfix-->
										<div class="tipo_label"  ><!--type-label--><?php echo $tipo; ?></div>
									</div>
								</div>
								<h1 class="titulo_publicacion"><!--pub-tittle--><?php echo $motivo;?></h1>
								<div class="autores_publicacion contenedor_js"><!--pub-authors js-widgetcontainer-->
									<div class="expander_contenedor_js expander_colapsado_js" style="max-height: none;"><!--js-expander-container js-expander-collapsed-->
										<p><?php echo $lugar;?></p>
									</div>
								</div>
								<div class="detalles_publicacion"><!--pub-details--><?php echo $detalles;?></div>
								<?php 
									if(count($comision) > 0 && $comision["Tipo_Comision"] == "Internacional")
									{
								?>
										<div class="abstract_publicacion contenedor_js"><!--pub-abstract js-widgetcontainer-->
											<div class="arreglar_limpiar"><!--clearfix-->
												<div class="expander_contenedor_js expander_colapsado_js" style="max-height: 100px;"><!--js-expander-container js-expander-collapsed-->
													<p>FUENTE DE FINANCIAMIENTO:</p>
													<div class="tabla">
														<table width="75%">
															<tbody>
																<tr>
																	<td align="left" class="letras">CONCEPTO</td>
																	<td align="center" class="letras">FUENTE DE FINANCIAMIENTO</td>
																	<td align="right" class="letras">MONTO</td>
																</tr>
																<tr>
																	<td align="left" class="letras">Transporte</td>
																	<td align="center" class="letras"><?php echo $comision["Fuente_Transporte"];?></td>
																	<td align="right" class="letras"><?php echo $comision["Monto_Transporte"];?></td>
																</tr>
																<tr>
																	<td align="left" class="letras">Viáticos</td>
																	<td align="center" class="letras"><?php echo $comision["Fuente_Viatico"];?></td>
																	<td align="right" class="letras"><?php echo $comision["Monto_Viatico"];?></td>
																</tr>
																<tr>
																	<td align="left" class="letras">Otros</td>
																	<td align="center" class="letras"><?php echo $comision["Fuente_Otros"];?></td>
																	<td align="right" class="letras"><?php echo $comision["Monto_Otros"];?></td>
																</tr>
																<tr>
																	<td align="left" class="letras">Total: </td>
																	<td align="center" class="letras"></td>
																	<td align="right" class="letras"><?php echo $comision["Monto_Transporte"] + $comision["Monto_Viatico"] + $comision["Monto_Otros"];?></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
								<?php
									}
								?>
								<div class="contenedor_acciones"><!--action-container-->
									<div class="barra_acciones contenedor_js"><!--action-bar js-widgetcontainer-->
										<div class="grupo_boton lf"><!--btn-group lf-->
											<?php 
												if($_SESSION["Usuario_Temporal"] == $_SESSION["ID"] || $_SESSION["Rol"] == "Administrador")
												{
											?>
													<a class="boton_editar mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Editar</a>
													<a class="boton_aceptar mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer--><?php echo $aceptado;?></a>
													<a class="boton_eliminar mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Eliminar</a>
													<a class="mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" href="../Reportes/Generar_Comision.php?i=<?php echo $id_get;?>&n=<?php echo $motivo;?>" target="_blank"><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Imprimir Solución</a>
													<?php 
														if(count($informe = $conexion->Consultas("SELECT * FROM Informe_Comision WHERE FK_Comision = ".$comision["ID_Comision"])) == 0 && count($comision) > 0 && ($comision["Tipo_Comision"] == "Internacional" || $comision["Tipo_Comision"] == "Nacional"))
														{
													?>
															<a class="boton_informe mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Agregar Informe</a>
													<?php
														}
												}
											?>
										</div>
										<div class="limpiar"></div><!--clear-->
									</div>
									<div class="limpiar"></div><!--clear-->
								</div>
							</div>
							<?php 
								if(count($informe) > 0)
								{
									$informe = $informe[0];
									$fecha = explode("-", $informe["Fecha"]);
							?>
									<div class="contenedor_js"><!--js-widgetcontainer-->
										<div class="abstract_publicacion contenedor_js etiqueta"><!--pub-abstract js-widgetcontainer-->
											<div class="arreglar_limpiar"><!--clearfix-->
												<div class="tipo_label"  ><!--type-label-->Informe</div>
											</div>
										</div>
										<h1 class="titulo_publicacion"><!--pub-tittle--><?php echo $informe["Evento"];?></h1>
										<div class="autores_publicacion contenedor_js"><!--pub-authors js-widgetcontainer-->
											<div class="expander_contenedor_js expander_colapsado_js" style="max-height: none;"><!--js-expander-container js-expander-collapsed-->
												<p><?php echo $informe["Descipcion"];?></p>
											</div>
										</div>
										<div class="detalles_publicacion"><!--pub-details--><?php echo $fecha[2]."/".$fecha[1]."/".$fecha[0];?></div>
										<div class="contenedor_acciones"><!--action-container-->
											<div class="barra_acciones contenedor_js"><!--action-bar js-widgetcontainer-->
												<div class="grupo_boton lf"><!--btn-group lf-->
													<?php 
														if($_SESSION["Usuario_Temporal"] == $_SESSION["ID"] || $_SESSION["Rol"] == "Administrador")
														{
													?>
															<a class="boton_editar_informe mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $informe["ID_Informe"];?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Editar</a>
															<a class="boton_eliminar_informe mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $informe["ID_Informe"];?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Eliminar</a>
													<?php
														}
													?>
													<a class="boton_eliminar_informe mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" href="../Reportes/Generar_Reporte_Comision.php?i=<?php echo $informe[0]["ID_Informe"];?>&n=<?php echo $motivo;?>" target="_blank"><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Imprimir Informe</a>
												</div>
												<div class="limpiar"></div><!--clear-->
											</div>
											<div class="limpiar"></div><!--clear-->
										</div>
									</div>
							<?php
								}
							?>
							
						</div>
					</div>
					<div class="columna_derecha_c"><!--c-col-right-->
						
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
