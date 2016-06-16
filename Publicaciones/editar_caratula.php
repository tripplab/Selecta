<html>
	<?php
        error_reporting(E_ALL ^ E_NOTICE);
		session_start();
		$tipo_get = $_POST["t"];
		$id_get = $_POST["i"];
		$rol = (isset( $_SESSION["Rol"])) ?  $_SESSION["Rol"]: "";
	?>
	<head>
		<script src="./Publicaciones.js"></script>
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
						$pro = "Producto ";
						$mensaje_subir = "Subir/Modificar Archivo (PDF)";
						if($tipo_get != '3.1.d' && $tipo_get != '2.12.e' && $tipo_get != '2.12.f' && $tipo_get != '2.12.g')
							$pro .= $tipo_get;
						$subtipo = explode(".", $tipo_get);
						$etiqueta = "";
						$titulo = "";
						$autores = "";
						$detalles = "";
						$abstract = "";
						$editar = false;
						$mensaje = "";
						$subir_ar = "disabled";
						$descargar_ar = "disabled";
						switch($tipo_get)
						{
							case "0.1": case "1.1":
								$producto = $conexion->Consultas("SELECT Grado, Nombre, Localidad, Anio FROM Escolaridad WHERE ID_Escolaridad = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Grado"]." en ".$producto["Nombre"];
									$detalles = $producto["Localidad"];
									$abstract = $producto["Anio"];
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "0.2": case "1.2";
								$producto = $conexion->Consultas("SELECT Nombre_Localidad, Fecha_Inicial, Fecha_Final FROM Experiencia WHERE ID_Experiencia = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Nombre_Localidad"];
									$inicial = explode("-", $producto["Fecha_Inicial"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0];
									if($producto["Fecha_Final"] != "0000-00-00")
									{
										$final = explode("-", $producto["Fecha_Final"]);
										$detalles .= " - ".$final[2]."/".$final[1]."/".$final[0];
									}
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "0.3":
								$producto = $conexion->Consultas("SELECT Categoria, Subcategoria, Puesto, Fecha FROM Categoria WHERE ID_Promocion = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Puesto"];
									$inicial = explode("-", $producto["Fecha"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0];
									$abstract = $producto["Categoria"]."-".$producto["Subcategoria"];
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "2.1.a": case "2.1.b": case "2.1.c": case "2.1.d": case "2.1.e": case "2.1.f": case "2.1.g": case "2.2": case "2.3":
							case "2.4": case "2.5": case "2.7.a": case "2.7.b": case "2.7.c": case "2.7.d": case "2.8.a": case "2.8.b": case "2.8.c":
							case "2.8.d": case "2.8.e": case "2.8.f": case "2.9": case "2.10.a": case "2.10.b": case "2.10.c": case "2.11.a": 
							case "2.11.b": case "2.11.c": case "2.12.a": case "2.12.b": case "2.12.c": case "2.12.d":
								$producto = $conexion->Consultas("SELECT Volumen, Numero, Paginas, ID_Articulo, Titulo, Tema, Conferencia_Capitulo, Impacto_TituloLibro, Editor, No_Referencia_Rerporte, Abstract, FK_Journal, Fecha FROM Articulos WHERE ID_Articulo = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									if($subtipo[1] == '1' || $subtipo[1] == "2" || $subtipo[1] == "3" || $subtipo[1] == "4" || $subtipo[1] == "7" || $subtipo[1] == "8" || $subtipo[1] == "9" || $subtipo[1] == "11" || $tipo_get == "2.12.c" || $tipo_get == "2.12.d")
										$titulo = $producto["Titulo"];		
									else if($subtipo[1] == "5" || $tipo_get == "2.12.a" || $tipo_get == "2.12.b")
										$titulo = $producto["Tema"];	
									else if($subtipo[1] == "10")
										$titulo = $producto["Abstract"];
									$lista_autores = $conexion->Consultas("SELECT Alias FROM Alias WHERE FK_Articulo = ".$producto["ID_Articulo"]);
									for($z = 0; $z < count($lista_autores); $z++)
										$autores .= $lista_autores[$z]["Alias"].", ";
									$autores = trim($autores, ", ");
									unset($lista_autores);	
									if($subtipo[1] == '1' && ($subtipo[2] == "c" || $subtipo[2] == "d") || $tipo_get == "2.11.b" || $tipo_get == "2.12.b")
										$detalles = $producto["Conferencia_Capitulo"];
									else if($subtipo[1] == '1' && ($subtipo[2] == "g") || $tipo_get == "2.11.c" || $tipo_get == "2.12.d" || $subtipo[1] == '8' && ($subtipo[2] == 'c' || $subtipo[2] == 'd' || $subtipo[2] == 'e' || $subtipo[2] == 'f'))
										$detalles = $producto["Tema"];
									else if($subtipo[1] == '3' || $tipo_get == "2.11.a" || $tipo_get == "2.12.a" || $tipo_get == "2.1.f" || $tipo_get == "2.1.b" || $tipo_get == "2.1.e" || $tipo_get == "2.2" || $tipo_get == "2.12.c")
										$detalles = $producto["Impacto_TituloLibro"];
									else if($subtipo[1] == '4' || $subtipo[1] == '5')
										$detalles = (($producto["Editor"] == "") ? "" : "Editado por ".$producto["Editor"]);
									else if($subtipo[1] == '7' || $subtipo[1] == '8' && ($arreglo_tipo[2] == 'a' || $arreglo_tipo[2] == 'b'))
										$detalles = (($producto["No_Referencia_Rerporte"] == "") ? "" : "No. Referencia ".$producto["No_Referencia_Rerporte"]);
									else if($subtipo[1] == "9")
										$detalles = $producto["Abstract"];
									if($producto["Volumen"] != "")
											$detalles .= $producto["Volumen"];
									if($producto["Numero"] != "")
										$detalles .= "(".$producto["Numero"].")";
									$detalles .= ": ";
									if($producto["Paginas"] != "")
										$detalles .= $producto["Paginas"];
									if($subtipo[1] == '1' && ($subtipo[2] == "a"))
									{	
                                                                             if($producto["FK_Journal"]==NULL){
                                                                     $lista_Estado = $conexion->Consultas("SELECT Estado FROM articulos WHERE ID_Articulo = ".$producto["ID_Articulo"]);            
							$detalles=" Estado:".$lista_Estado;
                                                    }
                                                    else{
										$detalles1 = $conexion->Consultas("SELECT Nombre_Completo, Factor_Impacto FROM Journal WHERE ID_Journal = ".$producto["FK_Journal"]);
										$detalles = $detalles1[0]["Nombre_Completo"]." ";
										if($producto["Volumen"] != "")
											$detalles .= $producto["Volumen"];
										if($producto["Numero"] != "")
											$detalles .= "(".$producto["Numero"].")";
										$detalles .= ": ";
										if($producto["Paginas"] != "")
											$detalles .= $producto["Paginas"];
										$detalles .=", IF ".$detalles1[0]["Factor_Impacto"];
                                                    }
									}
									$inicial = explode("-", $producto["Fecha"]);
									$abstract = $inicial[2]."/".$inicial[1]."/".$inicial[0];
									if(count($eti = $conexion->Consultas("SELECT Etiqueta_Copei FROM Alias WHERE FK_Articulo = ".$producto["ID_Articulo"]." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"])) > 0)
									{
										$etiqueta = $eti[0]["Etiqueta_Copei"];
										$editar = true;
										$mensaje = "No soy autor";
									}
									$subir_ar = "";
									if(file_exists("../Archivos/Articulos/".$titulo."_".$producto["ID_Articulo"].".pdf"))
										$descargar_ar = "";
								}
							break;
							case "2.12.e":
								$producto = $conexion->Consultas("SELECT Motivo, Objetivos, Fecha_Inicial, Fecha_Final FROM Comision WHERE ID_Comision = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Motivo"];
									$autores = $producto["Objetivos"];
									$inicial = explode("-", $producto["Fecha_Inicial"]);
									$final = explode("-", $producto["Fecha_Final"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "2.12.f":
								$producto = $conexion->Consultas("SELECT * FROM Difusion_Divulgacion WHERE ID_DD = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Evento"];
									$autores = $producto["Participantes"];
									$abstract = $producto["Objetivos"];
									$inicial = explode("-", $producto["Fecha_Inicial"]);
									$final = explode("-", $producto["Fecha_Final"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "2.12.g":
								$producto = $conexion->Consultas("SELECT * FROM Visitas_Academicas WHERE ID_Visita = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Nombre_Visitante"];
									$autores = $producto["Objetivo"];
									$inicial = explode("-", $producto["Fecha"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0];
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "2.12.h":
								$producto = $conexion->Consultas("SELECT * FROM Medios WHERE ID_Medios = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Reportero_Medio"];
									$autores = $producto["Tema"];
									$inicial = explode("-", $producto["Fecha"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0];
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "3.1.a": case "3.1.b": case "3.1.c":
								$producto = $conexion->Consultas("SELECT Curso.Nombre, Nombre_Programa, Total_Horas, Fecha_Inicial, Fecha_Final, Etiqueta_Copei FROM Formacion_Curso, Curso, Programa_Unidad, Programa_Academico WHERE FK_Curso = ID_Curso AND Curso.FK_Programa = Programa_Unidad.ID_Programa_Unidad AND Programa_Unidad.FK_Programa = ID_Programa AND ID_Formacion = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Nombre"];
									$autores = $producto["Total_Horas"]." horas";
									$inicial = explode("-", $producto["Fecha_Inicial"]);
									$final = explode("-", $producto["Fecha_Final"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
									$abstract = $producto["Nombre_Programa"];
									$etiqueta = $producto["Etiqueta_Copei"];
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "3.1.d":
								$producto = $conexion->Consultas("SELECT Curso.Nombre, Nombre_Programa, Total_Horas, Fecha_Inicial, Fecha_Final, Etiqueta_Copei FROM Formacion_Curso, Curso, Programa_Unidad, Programa_Academico WHERE FK_Curso = ID_Curso AND Curso.FK_Programa = Programa_Unidad.ID_Programa_Unidad AND Programa_Unidad.FK_Programa = ID_Programa AND ID_Formacion = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Nombre"];
									$autores = $producto["Total_Horas"]." horas";
									$inicial = explode("-", $producto["Fecha_Inicial"]);
									$final = explode("-", $producto["Fecha_Final"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];
									$abstract = $producto["Nombre_Programa"];
									$etiqueta = $producto["Etiqueta_Copei"];
									$editar = true;
									$mensaje = "Eliminar";
								}
							break;
							case "3.2.a": case "3.2.b": case "3.3": 
								$producto = $conexion->Consultas("SELECT Titulo, Abstract, Fecha_Final, Concluida FROM Tesis WHERE ID_Tesis = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Titulo"].(($producto["Concluida"] == 0) ? " (En proceso)" : " (Concluida)");
									$final = explode("-", $producto["Fecha_Final"]);
									$autores = $conexion->Consultas("SELECT Alias FROM Usuario_Tesis WHERE Estudiante = 1 AND FK_Tesis = ".$id_get);
									$autores = $autores[0]["Alias"];
									$detalles = $producto["Abstract"];
									$abstract = $final[2]."/".$final[1]."/".$final[0];
									if(count($eti = $conexion->Consultas("SELECT Etiqueta_Copei FROM Usuario_Tesis WHERE FK_Tesis= ".$id_get." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"])) > 0)
									{
										$etiqueta = $eti[0]["Etiqueta_Copei"];
										$editar = true;
										$mensaje = "No soy autor";
									}
								}
							break;
							case "4.3": case "4.4": case "4.5": case "4.6": case "4.7": case "4.8": case "4.9": case "4.10": case "4.11": case "4.13":
							case "4.14": case "4.15": case "4.16": case "4.17": case "4.18":
								$producto = $conexion->Consultas("SELECT Fecha_Inicial, Fecha_Final, Descripcion_Localidad, Congreso_Discutido_Estu_Miemb_Otorga_Respon, Titulo_Proyecto_MedioDiscusion_Revista_Puesto, SNI_ISSN_NoPatente_Subpro FROM Repercusion WHERE ID_Repercusion = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									if($tipo_get == "4.3" || $tipo_get == "4.4" || $tipo_get == "4.5" || $tipo_get == "4.7" || $tipo_get == "4.8" || $tipo_get == "4.10" || $tipo_get == "4.11")
										$titulo = $producto["Descripcion_Localidad"];		
									else if($tipo_get == "4.14" || $tipo_get == "4.17" || $tipo_get == "4.18")
										$titulo = $producto["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"];
									else if($tipo_get == "4.13" || $tipo_get == "4.15" || $tipo_get == "4.9" || $tipo_get == "4.6")
										$titulo = $producto["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];	
									else if($tipo_get == "4.16")
										$titulo = "No. Patente".$producto["SNI_ISSN_NoPatente_Subpro"];	
									if($tipo_get == "4.5" || $tipo_get == "4.10" || $tipo_get == "4.11")		
										$autores = $producto["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];
									else if($tipo_get == "4.6" || $tipo_get == "4.13")		
										$autores = $producto["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"];
									else if($tipo_get == "4.14" || $tipo_get == "4.17" || $tipo_get == "4.18" || $tipo_get == "4.9")		
										$autores = $producto["Descripcion_Localidad"];
									$inicial = explode("-", $producto["Fecha_Inicial"]);
									if($tipo_get != "4.11")
										$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0];	
									else 
									{
										$final = explode("-", $producto["Fecha_Final"]);
										$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];	
									}	
									$editar = true;	
									$mensaje = "Eliminar";
								}
							break;
							case "4.12":
								$producto = $conexion->Consultas("SELECT Fecha_Inicial, Fecha_Final, Titulo, Gastos_Inversion, Gastos_Corr, Moneda FROM Proyecto WHERE ID_Proyecto = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Titulo"];
									$inicial = explode("-", $producto["Fecha_Inicial"]);
									$final = explode("-", $producto["Fecha_Final"]);
									$abstract = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];	
									$detalles = ($producto["Gastos_Inversion"] + $producto["Gastos_Corr"])." ".$producto["Moneda"];	
									if(count($eti = $conexion->Consultas("SELECT ID_Usuario_Proyecto FROM Usuario_Proyecto WHERE FK_Proyecto = ".$id_get." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"])) > 0)
									{
										$editar = true;
										$mensaje = "No soy autor";
									}
								}
							break;
							case "5":
								$producto = $conexion->Consultas("SELECT * FROM Criterio WHERE ID_Criterio = ".$id_get);
								if(count($producto) > 0)
								{
									$producto = $producto[0];
									$titulo = $producto["Descripcion"];
									$inicial = explode("-", $producto["Fecha"]);
									$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0];	
									$etiqueta = $producto["Etiqueta_Copei"];
									$editar = true;
									$mensaje = "Eliminar";
									$subir_ar = "";
									if(file_exists("../Archivos/Articulos/".$titulo."_".$producto["ID_Articulo"].".pdf"))
										$descargar_ar = "";
								}
								$mensaje_subir = "Subir/Modificar Documento Probatorio (PDF)";
							break;
						}
					?>
					<div class="contenido_c"><!--c-content-->
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								
								<div class="abstract_publicacion contenedor_js etiqueta"><!--pub-abstract js-widgetcontainer-->
									<div class="arreglar_limpiar"><!--clearfix-->
										<?php 
                                                                                
                                                                                
											if($etiqueta != "" && ($rol == "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))) 
											{
										?>
												<a class="abrir_editar editar_link texto_derecha"><!--edit-open edit-link text-right-->
													<span class="icono_editar"><!--ico-edit--></span>Edit</a>
										<?php
											}
										?>
										<div class="tipo_label"  ><!--type-label--><?php echo $pro; ?><span id="producto_tipo"><?php echo (($etiqueta != "") ? ".".$etiqueta : "");?></span></div>
									</div>
									
									<form class="cambio_etiqueta_form">
										<input type="hidden" name="identificador" value=<?php echo $id_get;?>>
										<input type="hidden" name="tipo" value=<?php echo $tipo_get;?>>
										<input type="hidden" name="etiqueta" value=<?php echo $etiqueta;?>>
										<input type="hidden" name="opcion" value="etiqueta_copei">
										<div class="envoltura_cambio_etiqueta">
											<div class="tipo_label"><!--type-label--><?php echo $pro.".";?><input type="text" id="etiqueta" name="etiqueta" class="texto_envoltura_cambio_etiqueta" value=<?php echo $etiqueta;?>></div>
										</div>
										<div class="toolbar_editar"><!--edit-toolbar-->
											<div class="rf">
												<a class="cerrar_editar">Cancelar</a>
												<input type="submit" class="guardar_editar boton boton_promover margen_boton" value="Guardar">
											</div>
											<div class="limpiar"></div><!--clear-->
										</div>
									</form>
									
								</div>
								
								<h1 class="titulo_publicacion"><!--pub-tittle--><?php echo $titulo;?></h1>
								<div class="autores_publicacion contenedor_js"><!--pub-authors js-widgetcontainer-->
									<div class="expander_contenedor_js expander_colapsado_js" style="max-height: none;"><!--js-expander-container js-expander-collapsed-->
										<p><?php echo $autores;?></p>
									</div>
								</div>
								<div class="detalles_publicacion"><!--pub-details--><?php echo $detalles;?></div>
								<div class="abstract_publicacion contenedor_js"><!--pub-abstract js-widgetcontainer-->
									<div class="arreglar_limpiar"><!--clearfix-->
										<div class="expander_contenedor_js expander_colapsado_js" style="max-height: 54px;"><!--js-expander-container js-expander-collapsed-->
											<p><?php echo $abstract;?></p>
										</div>
									</div>
								</div>
								<?php 
									if($rol != "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
									{
								?>
										<div class="contenedor_acciones"><!--action-container-->
											<div class="barra_acciones contenedor_js"><!--action-bar js-widgetcontainer-->
												<div class="grupo_boton lf"><!--btn-group lf-->
													<a class="boton_editar mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?> data-type=<?php echo $tipo_get;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Editar</a>
													<a class="boton_no_au mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?> data-type=<?php echo $tipo_get;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer--><?php echo $mensaje;?></a>
													<a class="boton_si_au mostrar_dialogo_acciones boton boton_plano boton_largo contenedor_js" value=<?php echo $id_get;?> data-type=<?php echo $tipo_get;?>><!--edit-button action-show-dialog btn btn-plain btn-large js-widgetcontainer-->Soy autor</a>
													<?php 
														if($editar == true) 
															echo "<script>
																$('.boton_si_au').hide();
															</script>";
														else 
															echo "<script>
																$('.boton_editar').hide();
																$('.boton_no_au').hide();
															</script>";
													?>
												</div>
												<div class="limpiar"></div><!--clear-->
											</div>
											<div class="limpiar"></div><!--clear-->
										</div>
								<?php
									}
								?>
								
                                                                <?php 
									if($_SESSION["Rol"]=="sin rol" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
									{
								?>
											<?php 
														 
															echo "<script>
																$('.boton_si_au').hide();
                                                                                                                                $('.boton_editar').hide();
																$('.boton_no_au').hide();
															        $('.subir_archivo').hide();
                                                                                                                                  $('.descargar_archivo').hide();
                                                                                                                             </script>";
														
															
													?>
												
								<?php
									}
								?>
							</div>
						</div>
					</div>
					<div class="columna_derecha_c"><!--c-col-right-->
						<div class="contenedor_js"><!--js-widgetcontainer-->
							<div class="texto_centrado caja_c"><!--text-center c-box-->
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="contenedor_js"><!--js-widgetcontainer-->
										<a class="boton boton_promover boton_largo boton_ancho_completo subir_archivo" <?php echo $subir_ar;?>><!--btn btn-promote btn-large btn-fullwidth--><?php echo $mensaje_subir;?></a>
										<input type="file" style="display: none;" id="subir_archivo" data-type=<?php echo $tipo_get?> class='<?php echo $titulo;?>_<?php echo $id_get;?>'>
										<a class="boton boton_promover boton_largo boton_ancho_completo descargar_archivo" <?php echo $descargar_ar;?> href="../Archivos/Articulos/<?php echo $titulo;?>_<?php echo $id_get;?>.pdf" ><!--btn btn-promote btn-large btn-fullwidth-->Descargar Archivo</a>
									</div>
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
