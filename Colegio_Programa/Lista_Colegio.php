<html>
	<head>
		<script src="./Colegio.js"></script>
	</head>
	<body>
		<h4 class="ningun_margen"><!--no-margin-->Integrantes</h4>
		<ul>
	<?php			
			session_start();
			$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
			include '../Scripts/query.php';
			$conexion = new Querys();
			$id = $_POST["id"];
			$coordinador = $conexion->Consultas("SELECT COUNT(ID_Colegio) AS Total FROM Colegio_Programa WHERE Coordinador = 1 AND FK_Programa = ".$id);
			$secretaria = $conexion->Consultas("SELECT COUNT(ID_Colegio) AS Total FROM Colegio_Programa WHERE Sec_Academica = 1 AND FK_Programa = ".$id);
			$colegio = $conexion->Consultas("SELECT ID_Colegio, Coordinador, Sec_Academica, Nombre, Apellido_Paterno, Apellido_Materno FROM Colegio_Programa, Usuario WHERE FK_Usuario = ID_Usuario AND FK_Programa = ".$id." ORDER BY Nombre");
			for($x = 0; $x < count($colegio); $x++)
			{	
		?>
					<li class="tema_informacion_institucion abrir_editar contenedor_js <?php echo $colegio[$x]["ID_Colegio"];?>_li"><!--institution-info-item edit-open js-widgetcontainer-->
						<div class="indent_izquierda"><!--indent-left-->Integrante</div>
						<?php
							if($rol == "Administrador" && ($coordinador[0]["Total"] == 0 || $secretaria[0]["Total"] == 0 || $colegio[$x]["Coordinador"] == 1 || $colegio[$x]["Sec_Academica"] == 1))
							{
						?>
								<div class="indent_derecha"><!--indent-right-->
									<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="<?php echo $colegio[$x]["ID_Colegio"];?>"><!--js-edit-open edit-link text-right-->
										<span class="icono_editar"></span>Editar</a>
								</div>
								<a class="abrir_editar_js placeholder_link" value="<?php echo $colegio[$x]["ID_Colegio"];?>" id="<?php echo $colegio[$x]["ID_Colegio"];?>_a"><!--js-edit-open placeholder-link--><?php echo $colegio[$x]["Nombre"]." ".$colegio[$x]["Apellido_Paterno"]."-".$colegio[$x]["Apellido_Materno"];?></a>		
								<a class="placeholder_link eliminar_curso" style="font-weight: bold;" value="<?php echo $colegio[$x]["ID_Colegio"];?>"><!--js-edit-open placeholder-link-->Eliminar</a>		
						<?php
							}
							else
							{
						?>
							<a class="placeholder_link" value="<?php echo $colegio[$x]["ID_Colegio"];?>" id="<?php echo $colegio[$x]["ID_Colegio"];?>_a"><!--js-edit-open placeholder-link--><?php echo $colegio[$x]["Nombre"]." ".$colegio[$x]["Apellido_Paterno"]."-".$colegio[$x]["Apellido_Materno"];?></a>		
						<?php
							}
						?>
					</li>
					<div class="contenedor_js formularios <?php echo $colegio[$x]["ID_Colegio"];?>_form"><!--js-widgetcontainer-->
						<div class="seccion_editar"><!--edit-section-->
							<form class="form_horizontal colegio_formulario" value="<?php echo $colegio[$x]["ID_Colegio"];?>"><!--form-horizontal institution-contactinformation-editform-->
								<input type="hidden" value="colegio_nuevo" name="opcion">
								<input type="hidden" value="<?php echo $colegio[$x]["ID_Colegio"];?>" name="servicio">
								<div class="control_grupo coordinador"><!--control-grupo-->
									<div class="indent_contenedor"><!--indent-container-->
										<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
											<label><?php echo $colegio[$x]["Nombre"]." ".$colegio[$x]["Apellido_Paterno"]."-".$colegio[$x]["Apellido_Materno"];?></label>
										</div>
									</div>
								</div>
								<?php
									if($coordinador[0]["Total"] == 0 || $colegio[$x]["Coordinador"] == 1)
									{
								?>
										<div class="control_grupo coordinador"><!--control-grupo-->
											<div class="indent_contenedor"><!--indent-container-->
												<div class="indent_izquierda"><!--indent-left-->
													<div class="label_control"><!--control-label-->
														<label>Coordinador</label>
													</div>
												</div>
												<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
													<select style="width: 129px; font-size: 12px;" id="coordinador_<?php echo $colegio[$x]["ID_Colegio"];?>" name="cordinador" class="texto">
														<option value="0">No</option>
														<option value="1">Si</option>
													</select>
												</div>
											</div>
										</div>
								<?php
										echo "<script> $('#coordinador_".$colegio[$x]["ID_Colegio"]."').val('".$colegio[$x]["Coordinador"]."'); </script>";
									}
									if($secretaria[0]["Total"] == 0 || $colegio[$x]["Sec_Academica"] == 1)
									{
								?>
										<div class="control_grupo sec"><!--control-grupo-->
											<div class="indent_contenedor"><!--indent-container-->
												<div class="indent_izquierda"><!--indent-left-->
													<div class="label_control"><!--control-label-->
														<label>Secretario Académico</label>
													</div>
												</div>
												<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
													<select style="width: 129px; font-size: 12px;" id="secretario_<?php echo $colegio[$x]["ID_Colegio"];?>" name="secretario" class="texto">
														<option value="0">No</option>
														<option value="1">Si</option>
													</select>
												</div>
											</div>
										</div>
								<?php
										echo "<script> $('#secretario_".$colegio[$x]["ID_Colegio"]."').val('".$colegio[$x]["Sec_Academica"]."'); </script>";
									}
								?>
								<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
									<a class="abrir_editar_js boton_link link_marcado" value="<?php echo $colegio[$x]["ID_Colegio"];?>"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
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
