<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$conexion = new Querys();
		$rol = (isset($_SESSION['Rol'])) ? $_SESSION["Rol"] : "";
		$habilitar_opciones = false;
                global $url;
                $servidor=$_SERVER['REQUEST_URI'];
                $servidor1=split ("/", $servidor); 
              
			 
		if(isset($_SESSION['ID']))
		{
			$nombre = $conexion->Consultas("SELECT Usuario.Nombre as Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE ID_Usuario = ".$_SESSION["ID"]);
			$nombre = $nombre[0];
                         $nombreCompleto = $conexion->Consultas("SELECT Usuario.Nombre as Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE ID_Usuario = ".$_SESSION["ID"]);
		  $nombreCompleto1 = $nombreCompleto[0];
                   $name=$nombreCompleto1["Nombre"]." ".$nombreCompleto1["Apellido_Paterno"]." ".$nombreCompleto1["Apellido_Materno"];
               
                   $url="http://".$_SERVER['HTTP_HOST']."/".$servidor1[1]."/Perfil/index.php?i=".$name;
                
			$habilitar_opciones = true;
		}
		else if(isset($_SESSION['Usuario_Temporal']))
			$habilitar_opciones = true;
	?>
	<head>
		<script src="../Scripts/Selecta.js"></script>
	</head>
	<body><!--has-overlay-->
		<div id="pagina_contenedor"><!--popup-fixed-->
			<div class="barra_navegacion" id="barra_navegacion_1"> <!--navbar-inner-->
				<div class="contenedor" id="contenedor_1"> <!--container-->
					<ul class="navegador navegador_izquierdo"> <!--nav-->
						<!--<li class="tema logo" id="logo_1">
							<a href=# class="imagen_logo"> <!--logo-link-->
						<!--		<span class="icono_logo"> <!--ico-logo--><!--SELECTA</span>
						<!--	</a>
						</li> <!--header-item-->
						<?php 
							if($habilitar_opciones)
							{
						?>
						<li class="division_vertical"></li>
						<li class="tema publicaciones menu_navegar_a" id="publicaciones_1">
							<a class="cabecera_link" href="../Publicaciones">Producción</a><!--header-link-->
							<div class="barra_estado"></div> <!--linkstatusBar-->
						</li> 
						<li class="division_vertical"></li> <!--divider-vertical-->
						<li class="tema comisiones menu_navegar_a" id="proyectos_1">
							<a href="../Comisiones" class="cabecera_link">Comisiones</a><!--header-link-->
							<div class="barra_estado"></div> <!--linkstatusBar-->
						</li>
						<li class="division_vertical"></li>
						<li class="tema comites menu_navegar_a" id="comites_1">
							<a href="../Comites" class="cabecera_link">Comités</a><!--header-link-->
							<div class="barra_estado"></div> <!--linkstatusBar-->
						</li>
						<li class="division_vertical"></li>
						<li class="tema insituciones menu_navegar_a" id="reportes_1">
							<a href="../Temporal" class="cabecera_link">Convenios</a><!--header-link-->
							<div class="barra_estado"></div> <!--linkstatusBar-->
						</li>
						<?php 
							}
							if($rol == "Administrador")
							{
						?>
							<li class="division_vertical"></li>
							<li class="tema menu_navegar_a">
								<div class="lf buscar_tipo_dropdown admin_menu"><!--lf search-type-dropdown-->
									<a href="#" class="cabecera_link admin">Administración</a><!--header-link-->
									<div class="barra_estado"></div> <!--linkstatusBar-->
									<ul class="menu_tipo_dropdown con_fecha" style="left: -2px;"><!--type-dropdown-menu with-arrow-->
										<li class="buscar_tipo_tema"><!--search-type-item-->
											<a class="liga_buscar_tipo seleccionar_tipo_js" href="../Institucion">
												Instituciones
											</a>
										</li>
										<li class="buscar_tipo_tema"><!--search-type-item-->
											<a class="liga_buscar_tipo seleccionar_tipo_js" href="../Programa_Academico">
												Programas
											</a>
										</li>
										<li class="buscar_tipo_tema">
											<a href="../Usuario" class="liga_buscar_tipo seleccionar_tipo_js">Configuración de cuentas</a>
										</li>
										<li class="buscar_tipo_tema"><!--search-type-item-->
											<a href="../Configuracion_Sistema" class="liga_buscar_tipo seleccionar_tipo_js">Configuración del sistema</a>
										</li>
									</ul>
								</div><!--dropdown dropdown-right-align dropdown-open-->
							</li><!--js-header-settings-item header-item actions menuactive menuactive-profile js-widgetcontainer-->
						<?php
							}
						?>
						<li class="division_vertical"></li>
						<li class="tema ayuda menu_navegar_a" id="ayuda_1">
							<div class="lf buscar_tipo_dropdown ayuda_menu"><!--lf search-type-dropdown-->
								<a href="#" class="cabecera_link ayuda">Ayuda</a><!--header-link-->
								<div class="barra_estado"></div> <!--linkstatusBar-->
								<ul class="menu_tipo_dropdown con_fecha" style="left: -2px;"><!--type-dropdown-menu with-arrow-->
									<li class="buscar_tipo_tema"><!--search-type-item-->
										<a class="liga_buscar_tipo seleccionar_tipo_js" href=#>
											Créditos
										</a>
									</li>
								</ul>
							</div><!--dropdown dropdown-right-align dropdown-open-->							
						</li>
						<li class="division_vertical"></li>		
					</ul>
					<?php 
						if($rol == "Administrador")
							echo "<ul class='navegador navegador_derecho' style='margin-left: 76px;'><!--nav nav-right-->";
						else if($rol != "")
							echo "<ul class='navegador navegador_derecho' style='margin-left: 192px;'><!--nav nav-right-->";
						else
							echo "<ul class='navegador navegador_derecho' style='margin-left: 582px;'><!--nav nav-right-->";
					?>
						<li id="buscador_1" class="tema buscar contenedor_js">
							<div id="div_buscador_1" class="estado_form_busqueda busqueda_activa">
								<div id="div_buscador_1_1" class="form_buscador_enmarcado">
									<form class="form_buscador_js  formulario_buscador" id="form_buscador_1" action="../Usuario/Buscar.php">
										<button type="input" class="submit_buscador">
											<i class="icono_busqueda_blanco"></i><!--ico-search-white-->
										</button><!--search-form-submit-->
										<input type="text" name="consulta" placeholder="Buscar Usuario" class="buscado_form_text y_a_i"><!--name=query class=search_form-text yui3-aclist-input-->
										<div class="widget_yui aclista_yu widget_posicionado_yu aclist_escondida_yu" style="width: 420px; left: 768.5px; top: 50px;">
											<div class="aclist_contenedor_yu">
												
											</div>
										</div>
									</form><!--js-form-submit search-form-->
								</div><!--search-form-wrapper-->
							</div><!--search-form-state searchinactive-->
						</li><!--header-item search js-widgetcontainer-->
						<?php
							if($rol != "")
							{
						?>
						<li id="mensajes_1" class="tema notificacion mensajes contenedor_js iluminar">
							<div id="desplegar_1" class="desplegar">
								<a href=# class="cabecera_btn boton desplegable_p" id="boton_mensajes_1">
									<span class="contenedor_js" id="icono_mensajes_1">
										<span class="contador_notificador_js notificador_contador hidden">
											<span class="numeros">0</span><!--number-->
										</span><!--js-notifications-cointer notifications-counter hidden-->
										<span class="icono_mensajes_cabecera"></span><!--ico-header-messages-black-->
									</span><!--js-widgetcontainer-->
									<div class="barra_estado"></div> <!--linkstatusBar-->
								</a><!--header-btn btn dropdown-toggle-->
								<div class="menu_desplegable solicitud_desplegable contenedor_js" id="menu_desplegable_mensajes_1">
									<div class="titulo_desplegable">Mensajes</div><!--dropdown-title-->
									<div class="notificaciones_pi contenedor_notificaciones mensajes_desplegables contenedor_js">
										<div class="no_temas">
											<div class="mensajes_inner">Usted no tiene mensajes nuevos</div>
										</div><!--no-items-->
										<div class="ver_todos_btn"><!--view-all-btn-->
											<a href=# class="ver_todos_inner">Ver Todos</a><!--inner-view-all-->
										</div>
									</div><!--feed-notifications notification-container dropdown-messages js-widgetcontainer-->
								</div><!--dropdown-menu dropdown-request js-widget-container-->
							</div><!--dropdown dropdown-open-->
						</li><!--header-item notifications messages js-widgetcontainer-->
						<?php
							}
						?>
						<li id="menu_perfil_1" class="cabecera_temas_js tema acciones menu_activo perfil_menu_activo contenedor_js iluminar">
							<div class="desplegar alinear_derecha_despliege"  id="desplegar_derecha_perfil">
								<span class="cabecera_btn boton desplegable_p" id="cabecera_boton_perfil">
									<?php
										if(isset($_SESSION['ID']))
										{
									?>
											<a class="link_perfil link_perfil_js p_desplegable_ign_js lf contenedor_js" href="../Perfil/?i=<?php echo $_SESSION["ID"];?>&n=<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>">
												<?php
													if(file_exists("../fotos_perfil/".$nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"].".jpg"))
														echo '<img src="../fotos_perfil/'.$nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"].'.jpg" class="link_perfil_imagen" width="30" height="30" id="imagen_perfil_pequeña">';
													else
														echo '<img src="../fotos_perfil/default.jpg" class="link_perfil_imagen" width="30" height="30" id="imagen_perfil_pequeña">';
												?>
												<!--profile-link-image-->
											</a><!--profile-link js-profile-link js-ignore-dropdown-toggle ls js-widgetcontainer-->
									<?php
										}
									?>
									<i class="icono_menu_flecha_negra"></i><!--ico-header-arrow-black-->
									<?php
										if(isset($_SESSION['ID']))
										{
									?>
									<div class="barra_estado" id="b_e"></div> <!--linkstatusBar-->
									<?php
										}
									?>
								</span><!--header-btn btn dropdown-toggle-->
								<ul class="menu_desplegable">
									<?php
										if(isset($_SESSION['ID']))
										{
									?>
											<li class="entrada_tour_js">
												<a href="../Perfil/?i=<?php echo $_SESSION["ID"];?>&n=<?php echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];?>" class="tema_link">Tu Perfil</a><!--link-item-->
											</li><!--js-tour-entry-->
											<li><!--search-type-item-->
												<a href='../Usuario/Editar_Usuario.php' class="tema_link">Configuración de cuenta</a>
											</li>
											<li><!--search-type-item-->
												<a class="liga_buscar_tipo seleccionar_tipo_js reporte tema_link">
													Generar Reporte
												</a>
											</li>
                                                                                        <li>
                                                                                        <form name="f1"> 
                                                                                            
                                                                                            <input type="hidden"  name="campo1" id="campo1" value="<?php echo $url;?>"> 

                                                                                            <a class="liga_buscar_tipo seleccionar_tipo_js  tema_link" onclick="copia_portapapeles()">
													Generar URL
												</a>
</form> 
                                                                                            </li>

<script language="javascript"> 
function copia_portapapeles() {
     var select= document.getElementById("campo1").value;
  window.prompt("Copy to clipboard: Ctrl+C, Enter", select);
}

function copyToClipboard(){ 
    
  var select= document.getElementById("campo1").value;
   alert(select);
   window.clipboardData.setData("Text", document.getElementById("campo1").value); 
} 
</script> 
                                                                                        
											<div class="divisor"></div><!--divider-->
											<li>
												<a href="../Caratula/Salir.php" class="tema_link">
													Salir
												</a>
											</li>
									<?php
										}
										else
										{
									?>
											<li>
												<a href="../Caratula/Salir.php" class="tema_link">
													Ingresar
												</a>
											</li>
									<?php
										}
									?>
								</ul><!--dropdown-menu-->
							</div><!--dropdown dropdown-right-align dropdown-open-->
						</li><!--js-header-settings-item header-item actions menuactive menuactive-profile js-widgetcontainer-->
					</ul>
				</div>
			</div>
			<div id="contenedor_principal" class="columna_60_40"><!--cols-60-40--></div>
		</div>
	</body>
</html>
