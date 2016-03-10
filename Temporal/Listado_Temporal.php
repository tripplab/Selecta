<html>
	<head>
	</head>
	<body>
		<?php
			session_start();
			include '../Scripts/query.php';
			$conexion = new Querys();
			date_default_timezone_set('UTC');
			$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
			$id = $_SESSION["Usuario_Temporal"];
			
			function crear_elementos($id, $etiqueta, $titulo, $subtitulo, $f_inicial, $f_final, $tipo)
			{
				echo '<li class="lista_temas_c publicacion_li contenido_js">';
					echo '<div class="titulo_expandible" style="margin-top: -2px;">';
						echo '<div class="contenido_expandido titulo_js contenido_expandido_js expandido_colapsado_js" style="max-height: none;">';
							echo '<span class="titulo">';
								echo '<span class="tipo_publicacion">'.$etiqueta.'</span>';		
								echo '<span class="link_titulo_publicacion_js">';	
								if($GLOBALS['rol'] == "Administrador" || (isset($_SESSION['ID']) && $GLOBALS['id'] == $_SESSION["ID"]))
									echo '<a class="titulo_publicacion titulo_publicacion_titulo_js editar_producto_copei" href="./Editar.php?i='.$id.'&t='.$tipo.'&n='.$titulo.'">'.$titulo.'</a>';
								else
									echo '<a class="titulo_publicacion titulo_publicacion_titulo_js editar_producto_copei">'.$titulo.'</a>';
								echo '</span>';		
							echo '</span>';			
						echo '</div>';					
					echo '</div>';	
					echo '<div class="autores autores_expandibles">';	
						echo '<div class="contenido_expandido autores_js contenido_expandido_js expandido_colapsado_js">';
							echo '<span class="autores">'.$subtitulo.'</span>';
						echo '</div>';
					echo '</div>';		
					echo '<div class="detalles">'.$f_inicial.(($f_final != "0000-00-00") ? " / ".$f_final : "").'</div>';	
				echo '</li>';
			}
			
		
			//
			echo '<div class="datos_generales">';
				echo '<h2 style="margin-top: 0;">Convenios de colaboración académica, científica y tecnológica.</h2>'; 
				for($x = 0; $x < 2; $x++)
				{
					echo '<h2 style="margin-top: 0; margin-left: 30px;">'.(($x == 0) ? "Instituciones internacionales" : "Instituciones nacionales")."</h2>";
					$producto = $conexion->Consultas("SELECT ID_Convenio, Nombre_Proyecto, Nombre_Institucion, Fecha_Inicio, Fecha_Final FROM Convenios WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Nac_Inter = ".$x." ORDER BY Fecha_Inicio");
					for($y = 0; $y < count($producto); $y++)
						crear_elementos($producto[$y]["ID_Convenio"], "Proyecto: ", $producto[$y]["Nombre_Proyecto"], $producto[$y]["Nombre_Institucion"], $producto[$y]["Fecha_Inicio"], $producto[$y]["Fecha_Final"], 'convenio');
				}
				unset($producto);
			echo '</div>';
			//
			echo '<div class="datos_generales"><br><br>';
				echo '<h2 style="margin-top: 0;">Gestión tecnológica y vinculación con la industria e Instituciones</h2>';
				echo '<h2 style="margin-top: 0; margin-left: 30px;">Proyectos</h2>';
				$producto = $conexion->Consultas("SELECT * FROM Proyectos_Institucion WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." ORDER BY Fecha_Inicial");
				for($y = 0; $y < count($producto); $y++)
					crear_elementos($producto[$y]["ID_Proyecto"], "Proyecto: ", $producto[$y]["Titulo"], $producto[$y]["Objetivos"], $producto[$y]["Fecha_Inicial"], $producto[$y]["Fecha_Final"], 'proyecto');
				unset($producto);
				
				echo '<h2 style="margin-top: 0; margin-left: 30px;">SERVICIOS DE LABORATORIO</h2>';
				$producto = $conexion->Consultas("SELECT ID_Servicio, Servicio, Objetivo, Fecha_Inicial, Fecha_Final FROM Servicios_Laboratorio WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." ORDER BY Fecha_Inicial");
				for($y = 0; $y < count($producto); $y++)
					crear_elementos($producto[$y]["ID_Servicio"], "Servicio: ", $producto[$y]["Servicio"], $producto[$y]["Objetivo"], $producto[$y]["Fecha_Inicial"], $producto[$y]["Fecha_Final"], 'servicio');
				unset($producto);
			echo '</div>';
			
		?>
	</body>
</html>
