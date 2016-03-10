<html>
	<?php
		session_start();
		$id_get = $_POST["i"];
		$opcion = $_POST["t"];
	?>
	<head>
		<script src="./Temporal.js"></script>
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
				<div class="contenido_columna_c" id="editar_publicacion_"><!--c-col-content-->
					<?php
						$tipo = "";
						$motivo = "";
						$lugar = "";
						$detalles = "";
						$aceptado = "";
						if($opcion == "convenio")
						{
							$comision = $conexion->Consultas("SELECT * FROM Convenios WHERE ID_Convenio = ".$id_get);
							if(count($comision) > 0)
							{
								$comision = $comision[0];
								$inicial = explode("-", $comision["Fecha_Inicio"]);
								$final = explode("-", $comision["Fecha_Final"]);
								$tipo = "Institución ".(($comision["Nac_Inter"] == 0) ? "Internacional" : "Nacional");
								$motivo = $comision["Nombre_Proyecto"];
								$lugar = $comision["Nombre_Institucion"];
								$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
							}
						}
						else if($opcion == "proyecto")
						{
							$comision = $conexion->Consultas("SELECT * FROM Proyectos_Institucion WHERE ID_Proyecto = ".$id_get);
							if(count($comision) > 0)
							{
								$comision = $comision[0];
								$inicial = explode("-", $comision["Fecha_Inicial"]);
								$final = explode("-", $comision["Fecha_Final"]);
								$tipo = "Proyecto";
								$motivo = $comision["Titulo"];
								$lugar = $comision["Objetivos"];
								$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
							}	
						}
						else
						{
							$comision = $conexion->Consultas("SELECT * FROM Servicios_Laboratorio WHERE ID_Servicio = ".$id_get);
							if(count($comision) > 0)
							{
								$comision = $comision[0];
								$inicial = explode("-", $comision["Fecha_Inicial"]);
								$final = explode("-", $comision["Fecha_Final"]);
								$tipo = "Servicio de Laboratorio";
								$motivo = $comision["Servicio"];
								$lugar = $comision["Objetivo"];
								$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
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
								
								<div class="contenedor_acciones"><!--action-container-->
									<div class="barra_acciones contenedor_js"><!--action-bar js-widgetcontainer-->
										<div class="grupo_boton lf"><!--btn-group lf-->
											<a class="boton_editar mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?> data-type=<?php echo $opcion;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Editar</a>
											<a class="boton_eliminar mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?> data-type=<?php echo $opcion;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Eliminar</a>
										</div>
										<div class="limpiar"></div><!--clear-->
									</div>
									<div class="limpiar"></div><!--clear-->
								</div>
							</div>
							
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
