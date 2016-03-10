<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$conexion = new Querys();
		$id = $_SESSION["Usuario_Temporal"];
		$rol = (isset( $_SESSION["Rol"])) ?  $_SESSION["Rol"]: "";
	?>
	<head>
		<script src="./Comites.js"></script>
	</head>
	<body>
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="envoltura_perfil"><!--profile-wrapper-->
				<div class="elemento_lleno_ancho arreglar_limpiar contenedor_js"><!--full-width-element clearfix js-widgetcontainer-->
					<div class="cabecera_perfil"  style="height: 147px;"><!--profile-header-->
						<div class="lf imagen_cabecera_perfil"><!--profile-header-image lf-->
							<div class="envoltura_perfil_imagen contenedor_js"><!--profile-image-wrapper js-idgetcontainer-->
								<?php 
									$nombre = $conexion->Consultas("SELECT Usuario.Nombre, Apellido_Paterno, Apellido_Materno, FK_Departamento, Unidad.Nombre as Unidad, Institucion.Nombre as Institucion, ID_Institucion, ID_Unidad FROM Usuario, Unidad_Departamento, Unidad, Institucion WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ID_Unidad AND FK_Institucion = ID_Institucion AND ID_Usuario = ".$id);
									$nombre = $nombre[0];
								?>
								<input type="hidden" value="<?php echo $id;?>" id="id_usuario">
								<input type="hidden" value="<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>" id="nombre_usuario">
								<input type="file" style="display: none;" id="subir_archivo">
								<div class="imagen_c_xl"><!--c-img-xl--> 
									<a class="placeholder_imagen editar_js" href="./?i=<?php echo $id;?>&n=<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>"><!--img-placeholder js-edit-->
										<?php
											if(file_exists("../fotos_perfil/".$nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"].".jpg"))
												echo '<img src="../fotos_perfil/'.$nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"].'.jpg" width="178" height="180">';
											else
												echo '<img src="../fotos_perfil/default.jpg" width="178" height="180">';
										?>
									</a>
								</div>
							</div>
						</div>
						<div class="perfil_cabecera_personal lf"><!--profile-header-personal lf-->
							<table class="arreglar_alinear">
								<tbody>
									<tr>
										<td valign="bottom" height="61px;">
											<h1 class="perfil_cabecera_nombre"><!--profile-header-name-->
												<a href="./?i=<?php echo $id;?>&n=<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>"><?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?></a>
											</h1>
										</td>
									</tr>
									<tr>
										<td style="padding: 3;">
											<div>
												<div class="arreglar_limpiar institucion contenedor_js"><!--clearfix meta profile- js-widgetcontainer--->
													<div class="lf nombre_institucion linea_simple_truncada"><!--lf position truncate-single-line-->
														<strong><a id="institucion" value="<?php echo $nombre["ID_Institucion"];?>" href="../Institucion/Informacion.php?i=<?php echo $nombre["ID_Institucion"];?>&n=<?php echo $nombre["Institucion"];?>"><?php echo $nombre["Institucion"];?></a></strong>
													</div>												
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding: 3;">
											<div>
												<div class="arreglar_limpiar institucion contenedor_js"><!--clearfix meta profile- js-widgetcontainer--->
													<a class="lf nombre_unidad linea_simple_truncada" id="unidad" value="<?php echo $nombre["ID_Unidad"];?>" href="../Unidad/?i=<?php echo $nombre["ID_Unidad"];?>&n=<?php echo $nombre["Unidad"];?>"><!--lf institution org truncate-single-line--><?php echo $nombre["Unidad"];?></a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="padding: 3;">
											<div>
												<div class="arreglar_limpiar institucion contenedor_js"><!--clearfix meta profile- js-widgetcontainer--->
													<?php 
														$nombre_departamento = "";
														if($nombre["FK_Departamento"] != null)
														{
															$departamento = $conexion->Consultas("SELECT Nombre FROM Departamento WHERE ID_Departamento = ".$nombre["FK_Departamento"]);
															$nombre_departamento = $departamento[0]["Nombre"];
														}
													?>
													<div class="lf nombre_unidad linea_simple_truncada" id="departamento" value="<?php echo $nombre["FK_Departamento"];?>"><!--lf institution org truncate-single-line--><?php echo $nombre_departamento;?></div>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="limpiar"></div><!--clear-->
						</div>
						<div class="cabecera_contenedora rf"><!--header-content lf-->
							<h1 style="margin-top: 35px; margin-right: 80px;">Comités</h1>
							<div class="limpiar"></div><!--clear-->
						</div>
					</div>
				</div>
				
				<div class="contenido_columna_c comisiones_columna" style="margin-top: 20;"><!--c-col-content-->
										
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
