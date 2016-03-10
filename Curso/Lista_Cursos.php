<html>
	<head>
		<script src="./Curso.js"></script>
	</head>
	<body>
		<h4 class="ningun_margen"><!--no-margin-->Cursos</h4>
		<ul>
	<?php			
			session_start();
			$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
			include '../Scripts/query.php';
			$conexion = new Querys();
			$id = $_POST["id"];
			$lista_cursos = $conexion->Consultas("SELECT * FROM Curso WHERE FK_Programa = ".$id." ORDER BY Nombre");
			for($x = 0; $x < count($lista_cursos); $x++)
			{	
		?>
					<li class="tema_informacion_institucion abrir_editar contenedor_js <?php echo $lista_cursos[$x]["ID_Curso"];?>_li"><!--institution-info-item edit-open js-widgetcontainer-->
						<div class="indent_izquierda"><!--indent-left-->Nombre</div>
						<?php
							if($rol == "Administrador")
							{
						?>
						<div class="indent_derecha"><!--indent-right-->
							<a class="abrir_editar_js editar_link texto_derecha" style="width: 32px;" value="<?php echo $lista_cursos[$x]["ID_Curso"];?>"><!--js-edit-open edit-link text-right-->
								<span class="icono_editar"></span>Editar</a>
						</div>
						<a class="abrir_editar_js placeholder_link" value="<?php echo $lista_cursos[$x]["ID_Curso"];?>" id="<?php echo $lista_cursos[$x]["ID_Curso"];?>_a"><!--js-edit-open placeholder-link--><?php echo $lista_cursos[$x]["Nombre"];?></a>		
						<a class="placeholder_link eliminar_curso" style="font-weight: bold;" value="<?php echo $lista_cursos[$x]["ID_Curso"];?>"><!--js-edit-open placeholder-link-->Eliminar</a>		
						<?php
							}
							else
							{
						?>
						<a class="placeholder_link" value="<?php echo $lista_cursos[$x]["ID_Curso"];?>" id="<?php echo $lista_cursos[$x]["ID_Curso"];?>_a"><!--js-edit-open placeholder-link--><?php echo $lista_cursos[$x]["Nombre"];?></a>		
						<?php
							}
						?>
						
					</li>
					<div class="contenedor_js formularios <?php echo $lista_cursos[$x]["ID_Curso"];?>_form"><!--js-widgetcontainer-->
						<div class="seccion_editar"><!--edit-section-->
							<form class="form_horizontal curso_formulario" value="<?php echo $lista_cursos[$x]["ID_Curso"];?>"><!--form-horizontal institution-contactinformation-editform-->
								<input type="hidden" value="curso_nuevo" name="opcion">
								<input type="hidden" value="<?php echo $lista_cursos[$x]["ID_Curso"];?>" name="servicio">
								<div class="control_grupo" id="c_<?php echo $lista_cursos[$x]["ID_Curso"];?>"><!--control-grupo-->
									<div class="indent_contenedor"><!--indent-container-->
										<div class="indent_izquierda"><!--indent-left-->
											<div class="label_control"><!--control-label-->
												<label id="<?php echo $lista_cursos[$x]["ID_Curso"];?>_l">Nombre *</label>
											</div>
										</div>
										<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
											<input type="text" value="<?php echo $lista_cursos[$x]["Nombre"];?>" class="valor_tema_institution texto" id="nombre_<?php echo $lista_cursos[$x]["ID_Curso"];?>" name="nombre" style="width: 387px;"><!--institution-item-value text institution-field-street-->
										</div>
									</div>
								</div>
								<div class="control_grupo"><!--control-grupo-->
									<div class="indent_contenedor"><!--indent-container-->
										<div class="indent_izquierda"><!--indent-left-->
											<div class="label_control"><!--control-label-->
												<label>Objetivos</label>
											</div>
										</div>
										<div class="highlight_error error_campo"><!--error-highlight-street error-street-->
											<textarea class="valor_tema_institution texto" name="objetivos" style="width: 387px;"><?php echo $lista_cursos[$x]["Objetivos"];?></textarea><!--institution-item-value text institution-field-street-->
										</div>
									</div>
								</div>
								<div class="control_grupo texto_derecha texto_gris_lighter"><!--control-grupo text-right text-gray-lighter-->
									<a class="abrir_editar_js boton_link link_marcado" value="<?php echo $lista_cursos[$x]["ID_Curso"];?>"><!--js-edit-open btn-link link-underlined-->Cancelar</a>
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
