<html>
	<script src="./Instituciones.js"></script>
	<script>
		$(document).ready(function()
		{     
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "./Listado_Instituciones.php");
		});
	</script>
	<body>
		<div id="contenido" class="columna_derecha_has"><!--has-right-col-->
			<div class="envoltura_literatura" id="envoltura_literatura_publicaciones"><!--literature-wrapper-->
				<div id="envoltura_literatura_div">
					<div class="cabecera_literatura elemento_lleno_ancho" id="elemento_cabecera_literatura" style="height: 100px;"><!--literature-header full-width-element-->
						<div class="cabecera_contenedora lf"><!--header-content lf-->
							<h1>Instituciones</h1>
							<div class="limpiar"></div><!--clear-->
						</div>
						<?php
							session_start();
							$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
							if($rol == "Administrador")
							{
						?>
						<div class="cabecera_contenedora_derecha rf"><!--header-content-right rf-->
							<div class="agregarpublicaciones_perfil contenedor_js"><!--profile-addpublications js-widgetcontainer-->
								<a class="agregar_institucion_js boton boton_promover boton_largo boton_ancho_completo">Agregar Institución</a><!--js-add btn btn-promote btn-large btn-fullwidth-->
							</div>
							<div class="limpiar"></div><!--clear-->
						</div>
						
						<?php
							}
						?>
						<div class="limpiar"></div><!--clear-->
					</div>
					
					<div class="limpiar"></div><!--clear-->
				</div>
				
				<div class="contenido_columna_c"><!--c-col-content-->
					<div class="contenido_c" style="padding-top: 0; width: 725px; border-right: none;"><!--c-content-->
						<div class="limpiar"></div><!--clear-->
						<div class="envoltura_contenido_literatura"><!--literature-content-wrapper-->
							<div class="contenedor_js"><!--js-widgetcontainer-->
								<div class="publicaciones_p publicaciones_js"><!--publication-feed js-publication-feed-->
									<ul class="publicacion_cuerpo_p lista_contenido_js"><!--publication-feed-body js-list-content-->
										
									</ul>
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
