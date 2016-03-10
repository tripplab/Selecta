<html>
	<head>
		<script>
			$(document).ready(function()
			{     
				$(".contenedor_cursos").load( "./Lista_Periodos.php", {id: $("#id_programa").val()});				
				
				$(".boton_invitar").click(function(){
					var id = $("#id_programa").val(); 
					$("body").addClass("superposicion");
					$("#pagina_contenedor").addClass("popup_arreglado");
					$.post("../popup/popup.php", function(data){
						$("#pagina_contenedor").before(data);
					}).done(function(){
						$.post("./Agregar.php", function(data){
							$(".yu_widget_bd").append(data);
							$(".mensaje").hide();
							$("#id_programa").val(id);
						});
					});
				});
			});
		</script>
	</head>
	<?php
		session_start();
		$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
		include '../Scripts/query.php';
		$id = $_POST["id"];
		$conexion = new Querys();
		$periodo = $conexion->Consultas("SELECT Institucion.Nombre as Institucion, ID_Institucion, Unidad.Nombre as Unidad, ID_Unidad, Nombre_Programa, ID_Programa, ID_Programa_Unidad FROM Institucion, Unidad, Programa_Unidad, Programa_Academico WHERE ID_Institucion = FK_Institucion AND ID_Unidad = FK_Unidad AND FK_Programa = ID_Programa AND ID_Programa_Unidad = ".$id);
		$periodo = $periodo[0];
	?>
	<body>
		<input type="hidden" value="<?php echo $periodo["ID_Programa_Unidad"];?>" id="id_programa">
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
												<a href="../Programa_Academico/Informacion.php?i=<?php echo $periodo["ID_Programa"];?>&n=<?php echo $periodo["Nombre_Programa"];?>"><?php echo $periodo["Nombre_Programa"]; ?></a>
											</h1>
										</td>
									</tr>
									<tr>
										<td>
											<div class="meta">
												<a href="../Institucion/Informacion.php?i=<?php echo $periodo["ID_Institucion"];?>&n=<?php echo $periodo["Institucion"];?>"><?php echo $periodo["Institucion"]; ?></a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="meta">
												<a href="../Unidad/?i=<?php echo $periodo["ID_Unidad"];?>&n=<?php echo $periodo["Unidad"];?>"><?php echo $periodo["Unidad"]; ?></a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<?php
							if($rol == "Administrador")
							{
						?>
						<div class="facilitar_cabecera_acciones rf"><!--facility-header-actions rf-->
							<div class="facilitar_accion_primaria contenedor_js"><!--facility-primary-action js-widgetcontainer-->
								<a class="boton boton_promover boton_ancho_completo boton_largo boton_invitar" value="<?php echo $periodo["ID_Programa_Unidad"];?>"><!--btn btn-promote btn-fullwidth btn-large btn-invite-->Agregar Periodo Escolar</a>
							</div>					
						</div>
						<?php
							}
						?>
						<div class="limpiar"></div><!--clear-->
					</div>
				</div>
				<div class="limpiar"></div><!--clear-->
				<div class="envoltura_facilitar_principal"><!--facility-main-wrapper-->
					<div class="layout_caja_padded"><!--layout-padded-boxes-->
						<div class="contenido_columna_c"><!--c-col-content-->
							<div class="contenido_c" style="border-right: none;"><!--c-content-->
								<div class="contenedor_js"><!--js-widgetcontainer-->
									<div class="caja_c informacion_institucion contenedor_js contenedor_cursos" style="margin: 0px;"><!--c-box info-institution js-widgetcontainer-->
										
											
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
