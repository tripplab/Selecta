<html>
	<head>
		<script src="./Lista_Miembros.js"></script>
	</head>
	<body>
		<div class="contenedor_js"><!--js-widgetcontainer-->
			<div class="perfil_miembros lista_personas_s caja_c contenedor_js"><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
				<h4>
					<strong class="lf">Miembros de Laboratorio (Actuales)</strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php
								session_start();
								$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
								include '../Scripts/query.php';
								$conexion = new Querys();
								date_default_timezone_set('UTC');
								$id = $_POST["id"];
								$usuario_lab = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, ID_Miembro, ID_Usuario, Lab_Miembro.Rol FROM Usuario, Lab_Miembro WHERE ID_Usuario = FK_Usuario AND (Tipo_Direccion LIKE '%Director%' OR Tipo_Direccion LIKE '') AND FK_Laboratorio = ".$id." AND (Fecha_Final > '".date('Y-m-d')."' OR Fecha_Final = '0000-00-00') ORDER BY Nombre");
								for($y = 0; $y < count($usuario_lab); $y++)	
								{
							?>
									<li class="tema_miembro lista_temas_js contenedor_js" style="padding-bottom: 10px;"><!--people-item js-list-item js-widget-container-->
										<div class="indent_izquierda"><!--indent-left-->
											<div class="imagen_c_s imagen_gente"><!--c-img-s people-img-->
												<a href="../Perfil/?i=<?php echo $usuario_lab[$y]["ID_Usuario"]?>&n=<?php echo $usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"];?>">
													<?php
														if(file_exists("../fotos_perfil/".$usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"].".jpg"))
															echo '<img src="../fotos_perfil/'.$usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"].'.jpg" height="30px;" width="30px;">';
														else
															echo '<img src="../fotos_perfil/default.jpg" height="30px;" width="30px;">';
													?>
												</a>
											</div>
										</div>
										<div class="indent_derecha"><!--indent-right-->
											<div class="boton_eliminar_miembro arreglar_limpiar contenedor_js"><!--follow-button clearfix js-widgetcontainer-->
												<?php
												if($rol == "Administrador" || $rol == "Profesor")
												{
												?>		
												<a class="boton boton_plano boton_eli_miembro js_eli_miembro accion_eli_miembro editar_miembro_lab" value="<?php echo $usuario_lab[$y]["ID_Miembro"];?>" data-type="<?php echo $id;?>" data-text="<?php echo $usuario_lab[$y]["Rol"];?>"><!--btn btn-plain btn-follow js-follow action-follow-->Editar</a>
												<?php
													}
												?>
											</div>
										</div>
										<div class="indent_contenedor"><!--indent-container-->
											<h5>
												<a href="../Perfil/?i=<?php echo $usuario_lab[$y]["ID_Usuario"];?>&n=<?php echo $usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"];?>"><?php echo $usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"];?></a>
												<div class="linea_simple_truncada"><!--truncate-single-line-->													
													<?php
													if($rol == "Administrador" || $rol == "Profesor")
													{
													?>		
													<a class="meta dar_baja" value="<?php echo $usuario_lab[$y]["ID_Miembro"];?>" data-text="<?php echo $usuario_lab[$y]["ID_Usuario"];?>">Dar de baja</a>													
													<?php
														}
													?>
												</div>
											</h5>
										</div>
									</li>
							<?php
								}
							?>
						</ul>
					</div>										
				</div>
			</div>
		</div>
		
		<div class="contenedor_js"><!--js-widgetcontainer-->
			<div class="perfil_miembros lista_personas_s caja_c contenedor_js"><!--profile-coauthors people-list-s c-box js-widgetcontainer-->
				<h4>
					<strong class="lf">Miembros de Laboratorio (Pasados)</strong>
				</h4>
				<div class="contenedor_miembros_js"><!--js-coauthor-container-->
					<div class="bloque_miembros autores_toggle_js"><!--authors-block js-toggle-authors-->
						<ul>
							<?php
								$usuario_lab = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, ID_Miembro, ID_Usuario FROM Usuario, Lab_Miembro WHERE ID_Usuario = FK_Usuario AND (Tipo_Direccion LIKE '%Director%' OR Tipo_Direccion LIKE '') AND FK_Laboratorio = ".$id." AND (Fecha_Final < '".date('Y-m-d')."'  OR Fecha_Final  = '".date('Y-m-d')."') AND Fecha_Final NOT LIKE '0000-00-00' ORDER BY Nombre");
								for($y = 0; $y < count($usuario_lab); $y++)	
								{
							?>
									<li class="tema_miembro lista_temas_js contenedor_js" style="padding-bottom: 10px;"><!--people-item js-list-item js-widget-container-->
										<div class="indent_izquierda"><!--indent-left-->
											<div class="imagen_c_s imagen_gente"><!--c-img-s people-img-->
												<a href="../Perfil/?i=<?php echo $usuario_lab[$y]["ID_Usuario"]?>&n=<?php echo $usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"];?>">
													<?php
														if(file_exists("../fotos_perfil/".$usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"].".jpg"))
															echo '<img src="../fotos_perfil/'.$usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"].'.jpg" height="30px;" width="30px;">';
														else
															echo '<img src="../fotos_perfil/default.jpg" height="30px;" width="30px;">';
													?>
												</a>
											</div>
										</div>
										<?php
										if($rol == "Administrador" || $rol == "Profesor")
										{
										?>		
											<div class="indent_derecha"><!--indent-right-->
												<div class="boton_eliminar_miembro arreglar_limpiar contenedor_js"><!--follow-button clearfix js-widgetcontainer-->
													<a class="boton boton_plano boton_eli_miembro js_eli_miembro accion_eli_miembro eliminar_miembro_lab" value="<?php echo $usuario_lab[$y]["ID_Miembro"];?>" data-text="<?php echo $usuario_lab[$y]["ID_Usuario"];?>"><!--btn btn-plain btn-follow js-follow action-follow-->Eliminar</a>
												</div>
											</div>
										<?php
											}
										?>	
										<div class="indent_contenedor"><!--indent-container-->
											<h5>
												<a href="../Perfil/?i=<?php echo $usuario_lab[$y]["ID_Usuario"];?>&n=<?php echo $usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"];?>"><?php echo $usuario_lab[$y]["Nombre"]." ".$usuario_lab[$y]["Apellido_Paterno"]."-".$usuario_lab[$y]["Apellido_Materno"];?></a>
											</h5>
										</div>
									</li>
							<?php
								}
							?>
						</ul>
					</div>										
				</div>
			</div>
		</div>
	</body>
</html>
