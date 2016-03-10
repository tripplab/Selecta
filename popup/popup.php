<html>
	<?php
		session_start();
		if(!isset($_SESSION["Rol"]) && !isset($_SESSION["ID"]) && !isset($_SESSION["Usuario_Temporal"]))
			header("Location: ../Logeo/");
	?>
	<head>
		<script src="../popup/popup.js"></script>
	</head>
	<body>
		<div class="mascara_sobrepuesta" style="position: fixed; width:100%; height: 100%; top: 0px; left: 0px; display: block; z-index: 1001;"></div><!--yui3-overlay-mask-->
		<div id="dialogo_publicacion" class="yu_widget yu_sobreposicion yu_widget_posicionado yu_widget_apilado yu_modo_superposicion y_modo_popup yu_widget_enfocado contenedor_js dialogo_publicacion" tabindex="-1" style="left: 0px; top: 0px; z-index: 1001;"><!--yui3-widget youi3-overlay yui3-widget-positioned yui3-widget-stacked yui3-overlay-modal y-popup-modal yui3-overlay-focused js-widgetcontainer publication-dialog-->
			<div class="contenedor_popup_y"><!--y-popup-container-->
				<div class="yu_contenido_superposionado yu-widget-modoestandar y_popup" style="position: relative;" id="pop_up_id"><!--yui3-content-overlay yui3-widget-stdmod y-popup-->
					<div class="yu_widget_bd"><!--yui3-widget-bd--></div>
					<div class="cerrar"><!--close-->
						<a>
							<span class="icono_cerrar_x_2"><!--ico-x-close-light--></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
