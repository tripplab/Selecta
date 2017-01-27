<html>
	<head>
	</head>
	<body>
		<?php
                error_reporting(E_ALL ^ E_NOTICE);
			session_start();
			include '../Scripts/query.php';
			$conexion = new Querys();
			date_default_timezone_set('UTC');
			
			function crear_elementos($identificador, $tipo_copei, $actividad, $tipo, $titulo, $autores, $detalles, $minimo, $maximo)
			{
				$espacio = ($minimo != "" && $maximo != "") ? " - " : " ";
				 if($detalles==" Estado:Preparacion" || $detalles==" Estado:Enviado"){
                                    echo '<div class="rf">0</div>';
                                }
                                else{
                                   echo '<div class="rf">'.$minimo.$espacio.$maximo.'</div>'; 
                                }
				
				echo '<div class="informacion_actividad">'.$actividad.'</div>';
				echo '<li class="lista_temas_c publicacion_li contenido_js">';
					echo '<div class="titulo_expandible" style="margin-top: -2px;">';
						echo '<div class="contenido_expandido titulo_js contenido_expandido_js expandido_colapsado_js" style="max-height: none;">';
							echo '<span class="titulo">';
								echo '<span class="tipo_publicacion">'.$tipo.'</span>';		
								echo '<span class="link_titulo_publicacion_js">';	
									if($identificador != "no_editar")	
										echo '<a class="titulo_publicacion titulo_publicacion_titulo_js editar_producto_copei" href="./Editar.php?i='.$identificador.'&t='.$tipo_copei.'&n='.$titulo.'">'.$titulo.'</a>';
									else
										echo '<span class="titulo_publicacion titulo_publicacion_titulo_js">'.$titulo.'</span>';		
								echo '</span>';		
							echo '</span>';			
						echo '</div>';					
					echo '</div>';	
					echo '<div class="autores autores_expandibles">';	
						echo '<div class="contenido_expandido autores_js contenido_expandido_js expandido_colapsado_js" style="max-height: none;>';
							echo '<span class="autores">'.$autores.'</span>';
						echo '</div>';
					echo '</div>';		
					echo '<div class="detalles">'.$detalles.'</div>';	
				echo '</li>';
			}
			
			$tipo_copei = $conexion->Consultas("SELECT ID_Tipo, Tipo, Descripcion, Puntuacion_Min, Puntuacion_Max FROM Tipo_Copei ");
			
                       
                        
                        $citas = (isset($_POST["citas"])) ? $_POST["citas"] : "1";
			$impacto = (isset($_POST["factor"])) ? $_POST["factor"] : "1";
			$_SESSION["citas"] = $citas;
			$_SESSION["factor"] = $impacto;
			//Escolaridad
			echo '<div class="datos_generales">';
			$cad = "";
			for($i = 0; $tipo_copei[$i]["Tipo"] != "0.2"; $i++)
			{
				$cad .= $tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br>";
				if($tipo_copei[$i]["Tipo"] == "0.1")
				{
					echo '<h2 style="margin-top: 0;">'.$cad."</h2>";
					$producto = $conexion->Consultas("SELECT ID_Escolaridad, Grado, Nombre, Localidad, Anio FROM Escolaridad WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Grado NOT LIKE '%Doctorado%' ORDER BY Anio");
					for($y = 0; $y < count($producto); $y++)
						crear_elementos($producto[$y]["ID_Escolaridad"], $tipo_copei[$i]["Tipo"], "", "Especialidad: ", $producto[$y]["Grado"]." en ".$producto[$y]["Nombre"], $producto[$y]["Localidad"], $producto[$y]["Anio"], "", "");
				}
			}
			
			//Experiencia
			echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."</h2>";
			$producto = $conexion->Consultas("SELECT ID_Experiencia, Nombre_Localidad, Fecha_Inicial FROM Experiencia WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Estancia = 0 ORDER BY Fecha_Inicial");
			for($y = 0; $y < count($producto); $y++)
			{
				$inicial = explode("-", $producto[$y]["Fecha_Inicial"]);
				crear_elementos($producto[$y]["ID_Experiencia"], $tipo_copei[$i]["Tipo"], "", "Experiencia: ", $producto[$y]["Nombre_Localidad"], '', $inicial[2]."/".$inicial[1]."/".$inicial[0], "", "");
			}
			$i++;
			
			//Promocion
			echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."</h2>";
			$producto = $conexion->Consultas("SELECT ID_Promocion, Categoria, Subcategoria, Puesto, Categoria.Fecha, Unidad.Nombre as Unidad, Institucion.Nombre as Institucion FROM Categoria, Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Usuario = FK_Usuario AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ID_Unidad AND FK_Institucion = ID_Institucion ORDER BY Fecha");
			echo "<table width='100%'>
					<tbody>
						<tr>";
						$table = "<tr>";
							for($y = 0; $y < count($producto); $y++)
							{
								$inicial = explode("-", $producto[$y]["Fecha"]);	
								echo "<td>  <a a class='titulo_publicacion titulo_publicacion_titulo_js editar_producto_copei' href='./Editar.php?i=".$producto[$y]["ID_Promocion"]."&t=".$tipo_copei[$i]["Tipo"]."&n=".$inicial[0]."'>".$inicial[0]."</a></td>";
								$table .= "<td>".$producto[$y]["Categoria"]."-".$producto[$y]["Subcategoria"]."</td>";
							}
						$table .= "</tr>";
			echo "</tr>";
			echo $table;			
			echo "</body>
				</table>";
			$i++;
			echo '</div>';
			echo '<div class="antecedentes_academicos">';
			//Doctorado
			$cad = "";
			for(; $tipo_copei[$i]["Tipo"] != "1.2"; $i++)
			{
				$cad .= $tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br>";
				if($tipo_copei[$i]["Tipo"] == "1.1")
				{
					echo '<h2 style="margin-top: 0;">'.$cad."</h2>";
					$producto = $conexion->Consultas("SELECT ID_Escolaridad, Grado, Nombre, Localidad, Anio FROM Escolaridad WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Grado LIKE '%Doctorado%' ORDER BY Anio");
					for($y = 0; $y < count($producto); $y++)
						crear_elementos($producto[$y]["ID_Escolaridad"], $tipo_copei[$i]["Tipo"], "", "Doctorado: ", $producto[$y]["Nombre"], $producto[$y]["Localidad"], $producto[$y]["Anio"], "", $tipo_copei[$i]["Puntuacion_Max"]);
				}
			}
			//Estancia
			echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."</h2>";
			$datos_tipo = $conexion->Consultas("SELECT Puntuacion_Min, Puntuacion_Max FROM Tipo_Copei WHERE Tipo LIKE '".$tipo_copei[$i]["Tipo"]."'");
			$datos_tipo = $datos_tipo[0];
			$producto = $conexion->Consultas("SELECT ID_Experiencia, Nombre_Localidad, Fecha_Inicial, Fecha_Final FROM Experiencia WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Estancia = 1 ORDER BY Fecha_Inicial");
			for($y = 0; $y < count($producto); $y++)
			{
				$datetime1 = date_create($producto[$y]["Fecha_Inicial"]);
				$datetime2 = date_create($producto[$y]["Fecha_Final"]);
				$inicial = explode("-", $producto[$y]["Fecha_Inicial"]);
				$final = explode("-", $producto[$y]["Fecha_Final"]);	
				$interval = date_diff($datetime1, $datetime2);
				crear_elementos($producto[$y]["ID_Experiencia"], $tipo_copei[$i]["Tipo"], "", "Estancia: ", $producto[$y]["Nombre_Localidad"], "", $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0], "", ($interval->format('%Y') * $tipo_copei[$i]["Puntuacion_Max"]));
			}
			$i++;
			echo '</div>';
			echo '<div class="productos_menu_2">';
                         
			//Productos 2
			$cad = "";
			$x = 0;
			$tipo = array("2.1.a","2.1.b","2.1.c","2.1.d","2.1.e","2.1.f","2.1.g","2.2","2.3","2.4","2.5","2.6","2.7.a","2.7.b","2.7.c","2.7.d","2.7.e","2.7.f","2.8.a","2.8.b","2.8.c","2.8.d","2.8.e","2.8.f","2.9","2.10.a","2.10.b","2.10.c","2.11.a","2.11.b","2.11.c","2.12.a","2.12.b","2.12.c","2.12.d");
			
                       
                        
             
                        for(;$tipo_copei[$i]["Tipo"] != "3"; $i++)
			{
                               
                           
                            $cad .= $tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br>";
                           
                                
				if($tipo_copei[$i]["Tipo"] == $tipo[$x]  && $tipo[$x] != "2.6")
				{
					$arreglo_tipo = explode(".", $tipo[$x]);
					echo '<h2 style="margin-top: 0;">'.$cad."</h2>";
					$producto = $conexion->Consultas("SELECT Volumen, Numero, Paginas, Fecha, ID_Articulo, Titulo, Tema, Conferencia_Capitulo, Impacto_TituloLibro, Editor, No_Referencia_Rerporte, Abstract, Etiqueta_Copei, FK_Journal, FK_Tesis FROM Articulos, Alias WHERE ID_Articulo = FK_Articulo AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo = ".$tipo_copei[$i]["ID_Tipo"]." ORDER BY Etiqueta_Copei");
					for($y = 0; $y < count($producto); $y++)
					{
						$titulo = "";
						if($arreglo_tipo[1] == '1' || $arreglo_tipo[1] == "2" || $arreglo_tipo[1] == "3" || $arreglo_tipo[1] == "4" || $arreglo_tipo[1] == "7" || $arreglo_tipo[1] == "8" || $arreglo_tipo[1] == "9" || $arreglo_tipo[1] == "11" || $tipo[$x] == "2.12.c" || $tipo[$x] == "2.12.d")
							$titulo = $producto[$y]["Titulo"];		
						else if($arreglo_tipo[1] == "5" || $tipo[$x] == "2.12.a" || $tipo[$x] == "2.12.b")
							$titulo = $producto[$y]["Titulo"];	
						else if($arreglo_tipo[1] == "10")
							$titulo = $producto[$y]["Abstract"];
						$autores = $conexion->Consultas("SELECT Alias, FK_Usuario FROM Alias WHERE FK_Articulo = ".$producto[$y]["ID_Articulo"]);
						$l_autores = "";
						for($z = 0; $z < count($autores); $z++)
						{
							if($autores[$z]["FK_Usuario"] == $_SESSION["Usuario_Temporal"])
								$l_autores .= "<a>".$autores[$z]["Alias"]."</a>, ";
							else
								$l_autores .= $autores[$z]["Alias"].", ";
						}
						$l_autores = trim($l_autores, ", ");
						unset($autores);
						$detalles = "";
						if($arreglo_tipo[1] == '1' && ($arreglo_tipo[2] == "c" || $arreglo_tipo[2] == "d") || $tipo[$x] == "2.11.b" || $tipo[$x] == "2.12.b")
							$detalles = $producto[$y]["Conferencia_Capitulo"];
						else if($arreglo_tipo[1] == '1' && ($arreglo_tipo[2] == "f" || $arreglo_tipo[2] == "g") || $tipo[$x] == "2.11.c" || $tipo[$x] == "2.12.d" || $arreglo_tipo[1] == '8' && ($arreglo_tipo[2] == 'c' || $arreglo_tipo[2] == 'd' || $arreglo_tipo[2] == 'e' || $arreglo_tipo[2] == 'f'))
							$detalles = $producto[$y]["Tema"];
						else if($arreglo_tipo[1] == '3' || $tipo[$x] == "2.11.a" || $tipo[$x] == "2.12.a" || $tipo[$x] == "2.1.b" || $tipo[$x] == "2.1.e" || $tipo[$x] == "2.2" || $tipo[$x] == "2.12.c")
							$detalles = $producto[$y]["Impacto_TituloLibro"];
						else if($arreglo_tipo[1] == '4' || $arreglo_tipo[1] == '5')
							$detalles = (($producto[$y]["Editor"] == "") ? "" : "Editado por ".$producto[$y]["Editor"]);
						else if($arreglo_tipo[1] == '7' || $arreglo_tipo[1] == '8' && ($arreglo_tipo[2] == 'a' || $arreglo_tipo[2] == 'b'))
							$detalles = (($producto[$y]["No_Referencia_Rerporte"] == "") ? "" : "No. Referencia ".$producto[$y]["No_Referencia_Rerporte"]);
						else if($arreglo_tipo[1] == "9")
							$detalles = $producto[$y]["Abstract"];
						if($producto[$y]["Volumen"] != "")
								$detalles .= $producto[$y]["Volumen"];
						if($producto[$y]["Numero"] != "")
							$detalles .= "(".$producto[$y]["Numero"].")";
						$detalles .= ": ";
						if($producto[$y]["Paginas"] != "")
							$detalles .= $producto[$y]["Paginas"];
						$fecha = explode("-", $producto[$y]["Fecha"]);
						$detalles .= "(".$fecha[0].")";
						if($arreglo_tipo[1] == '1' && ($arreglo_tipo[2] == "a"))
						{
                                                    if($producto[$y]["FK_Journal"]==NULL){
                                                        
                                                             
                                                         $lista_Estado = $conexion->Consultas("SELECT Estado FROM Articulos WHERE ID_Articulo = " .$producto[$y]["ID_Articulo"]);
							$detalles=" Estado:".$lista_Estado[0]["Estado"];
                                                        
                                                    }
                                                    else{
                                                        $detalles1 = $conexion->Consultas("SELECT Nombre_Completo, Factor_Impacto FROM Journal WHERE ID_Journal = ".$producto[$y]["FK_Journal"]);
							$detalles = $detalles1[0]["Nombre_Completo"]." ";
                                                        if($producto[$y]["Volumen"] != "")
								$detalles .= $producto[$y]["Volumen"];
							if($producto[$y]["Numero"] != "")
								$detalles .= "(".$producto[$y]["Numero"].")";
							$detalles .= ": ";
							if($producto[$y]["Paginas"] != "")
								$detalles .= $producto[$y]["Paginas"];
							$fecha = explode("-", $producto[$y]["Fecha"]);
							$detalles .= "(".$fecha[$y].")";
							$detalles .=", IF ".$detalles1[0]["Factor_Impacto"];
                                                    
                                                        
                                                    }
                                                   $puntuacionmax= $tipo_copei[$i]["Puntuacion_Max"];
                                                    if($producto[$y]["FK_Tesis"]==NULL){
                                                       $puntuacionmax1=$tipo_copei[$i]["Puntuacion_Max"];
                                                    }
                                                    else{
                                                         $puntuacionmax1= $puntuacionmax*2.5;
                                                         
                                                    }
						}
						crear_elementos($producto[$y]["ID_Articulo"], $tipo_copei[$i]["Tipo"], $tipo_copei[$i]["Tipo"].".".$producto[$y]["Etiqueta_Copei"], "Producto: ", $titulo, $l_autores, $detalles, $tipo_copei[$i]["Puntuacion_Min"], $puntuacionmax1);
					
                                                 $puntuacionmax1=$tipo_copei[$i]["Puntuacion_Max"];
                                                    }
					unset($producto);
					$x++;
					$cad = "";
				}
				else if($tipo[$x] == "2.6")
				{
					echo '<h2 style="margin-top: 0;">'.$cad."</h2>";
					$producto = $conexion->Consultas("SELECT ID_Articulo, Titulo, Tema, Conferencia_Capitulo, Impacto_TituloLibro, Editor, Etiqueta_Copei, FK_Journal, Tipo, Puntuacion_Min, Puntuacion_Max FROM Articulos, Alias, Tipo_Copei WHERE ID_Tipo = FK_Tipo AND ID_Articulo = FK_Articulo AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tesis IS NOT NULL");
					for($y = 0; $y < count($producto); $y++)
					{
						$arreglo_tipo = explode(".", $producto[$y]["Tipo"]);
						$titulo = "";
						if($arreglo_tipo[1] == '1' || $arreglo_tipo[1] == "2" || $arreglo_tipo[1] == "3" || $arreglo_tipo[1] == "4")
							$titulo = $producto[$y]["Titulo"];		
						else if($arreglo_tipo[1] == "5")
							$titulo = $producto[$y]["Tema"];		
						$autores = $conexion->Consultas("SELECT Alias FROM Alias WHERE FK_Articulo = ".$producto[$y]["ID_Articulo"]);
						$l_autores = "";
						for($z = 0; $z < count($autores); $z++)
							$l_autores .= $autores[$z]["Alias"].", ";
						$l_autores = trim($l_autores, ", ");
						unset($autores);			
						crear_elementos("no_editar", $tipo_copei[$i]["Tipo"], $tipo_copei[$i]["Tipo"].".".($y + 1), "Producto: ", $titulo, $l_autores, 'Producto: '.$producto[$y]["Tipo"].".".$producto[$y]["Etiqueta_Copei"], $producto[$y]["Puntuacion_Min"], $producto[$y]["Puntuacion_Max"]);
					}
					unset($producto);
					$x++;
					$cad = "";
				}
			}
			unset($tipo);
			echo '<h2 style="margin-top: 0;">Intercambio académico y cooperación científica y tecnológica<br><br>Asistencia a eventos científicos y tecnológicos</h2>';
			$producto = $conexion->Consultas("SELECT Motivo, Objetivos, Fecha_Inicial, Fecha_Final, ID_Comision FROM Comision WHERE Tipo_Comision LIKE 'Intercambio' AND FK_Usuario = ".$_SESSION['Usuario_Temporal']);
			for($y = 0; $y < count($producto); $y++)
			{
				$inicial = explode("-", $producto[$y]["Fecha_Inicial"]);
				$final = explode("-", $producto[$y]["Fecha_Final"]);	
				crear_elementos($producto[$y]["ID_Comision"], "2.12.e", "", "Evento: ", $producto[$y]["Motivo"], $producto[$y]["Objetivos"], $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0], "", "");
			}
			unset($producto);
			echo '<h2 style="margin-top: 0;">Difusión, divulgación científica y tecnológica<br><br>Eventos académicos, científicos, tecnológicos y culturales</h2>';
			$producto = $conexion->Consultas("SELECT * FROM Difusion_Divulgacion WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']);
			for($y = 0; $y < count($producto); $y++)
			{
				$inicial = explode("-", $producto[$y]["Fecha_Inicial"]);
				$final = explode("-", $producto[$y]["Fecha_Final"]);	
				crear_elementos($producto[$y]["ID_DD"], "2.12.f", "", "Evento: ", $producto[$y]["Evento"], $producto[$y]["Objetivos"], $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0], "", "");
			}
			unset($producto);
			echo '<h2 style="margin-top: 0;">Visitas académicas y otros visitantes<br><br>Se recibieron y atendieron por parte del Langebio las siguientes visitas</h2>';
			$producto = $conexion->Consultas("SELECT * FROM Visitas_Academicas WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']);
			for($y = 0; $y < count($producto); $y++)
			{
				$inicial = explode("-", $producto[$y]["Fecha"]);
				crear_elementos($producto[$y]["ID_Visita"], "2.12.g", "", "Visitante: ", $producto[$y]["Nombre_Visitante"], $producto[$y]["Objetivo"], $inicial[2]."/".$inicial[1]."/".$inicial[0], "", "");
			}
			unset($producto);
			echo '<h2 style="margin-top: 0;">Medios</h2>';
			$producto = $conexion->Consultas("SELECT * FROM Medios WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']);
			for($y = 0; $y < count($producto); $y++)
			{
				$inicial = explode("-", $producto[$y]["Fecha"]);
				crear_elementos($producto[$y]["ID_Medios"], "2.12.h", "", "Reportero/Medio: ", $producto[$y]["Reportero_Medio"], $producto[$y]["Tema"], $inicial[2]."/".$inicial[1]."/".$inicial[0], "", "");
			}
			unset($producto);
			echo '</div>';
			echo '<div class="formacion_recursos">';
			//cursos
			$cad = "";
			$x = 0;
			$tipo = array("3.1.a", "3.1.b", "3.1.c");
			for(;$tipo_copei[$i]["Tipo"] != "3.2"; $i++)
			{
				$cad .= $tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br>";
				if($tipo_copei[$i]["Tipo"] == $tipo[$x])
				{
					echo '<h2 style="margin-top: 0;">'.$cad."</h2>";
					$producto = $conexion->Consultas("SELECT ID_Formacion, Curso.Nombre, Nombre_Programa, Total_Horas, Etiqueta_Copei FROM Formacion_Curso, Curso, Programa_Unidad, Programa_Academico WHERE FK_Curso = ID_Curso AND Curso.FK_Programa = Programa_Unidad.ID_Programa_Unidad AND Programa_Unidad.FK_Programa = ID_Programa AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo = ".$tipo_copei[$i]["ID_Tipo"]." ORDER BY Etiqueta_Copei");
					for($y = 0; $y < count($producto); $y++)
						crear_elementos($producto[$y]["ID_Formacion"], $tipo_copei[$i]["Tipo"], $tipo_copei[$i]["Tipo"].".".$producto[$y]["Etiqueta_Copei"], "Curso: ", $producto[$y]["Nombre"], $producto[$y]["Nombre_Programa"], $producto[$y]["Total_Horas"]." horas", "", ($producto[$y]["Total_Horas"] * $tipo_copei[$i]["Puntuacion_Max"]));
					unset($producto);
					$x++;
					$cad = "";
				}
			}
			unset($tipo);
			echo '<h2 style="margin-top: 0;">Asesorías</h2>';
			$producto = $conexion->Consultas("SELECT ID_Formacion, Curso.Nombre, Nombre_Programa, Formacion_Curso.Fecha_Inicial, Formacion_Curso.Fecha_Final, Total_Horas FROM Formacion_Curso, Curso, Programa_Unidad, Programa_Academico WHERE FK_Curso = ID_Curso AND Curso.FK_Programa = Programa_Unidad.ID_Programa_Unidad AND Programa_Unidad.FK_Programa = ID_Programa AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo IS NULL ORDER BY Formacion_Curso.Fecha_Inicial");	
			for($y = 0; $y < count($producto); $y++)
				crear_elementos($producto[$y]["ID_Formacion"], "3.1.d", "", "Curso: ", $producto[$y]["Nombre"], $producto[$y]["Nombre_Programa"], $producto[$y]["Total_Horas"]." horas", "", "");
			unset($producto);
			
			//tesis
			$cad = "";
			$x = 0;
			$tipo = array("3.2.a", "3.2.b", "3.3");
			for(;$tipo_copei[$i]["Tipo"] != "4"; $i++)
			{
				$cad .= $tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br>";
				if($tipo_copei[$i]["Tipo"] == $tipo[$x])
				{
					echo '<h2 style="margin-top: 0;">'.$cad."</h2>";
					$producto = $conexion->Consultas("SELECT ID_Tesis, Titulo, Concluida, Etiqueta_Copei FROM Tesis, Usuario_Tesis WHERE FK_Tesis = ID_Tesis AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo = ".$tipo_copei[$i]["ID_Tipo"]." ORDER BY Etiqueta_Copei");
					for($y = 0; $y < count($producto); $y++)
					{
						$estudiante = $conexion->Consultas("SELECT Alias FROM Usuario_Tesis WHERE FK_Tesis = ".$producto[$y]["ID_Tesis"]." AND Estudiante = 1");
						$estudiante = (count($estudiante) > 0) ? $estudiante[0]["Alias"] : "";
						$director = $conexion->Consultas("SELECT COUNT(ID_Usuario_Tesis) AS Total FROM Usuario_Tesis WHERE FK_Tesis = ".$producto[$y]["ID_Tesis"]." AND Estudiante = 1");
						crear_elementos($producto[$y]["ID_Tesis"], $tipo_copei[$i]["Tipo"], $tipo_copei[$i]["Tipo"].".".$producto[$y]["Etiqueta_Copei"], "Tesis: ", $producto[$y]["Titulo"], $estudiante, (($producto[$y]["Concluida"] == 0) ? "En proceso" : "Concluida"), "", ($tipo_copei[$i]["Puntuacion_Max"] / $director[0]["Total"]));
					}
					unset($producto);
					$x++;
					$cad = "";
				}
			}
			unset($tipo);
			echo "</div>";
			echo '<div class="repercusion_academica">';
			//repercusion
			echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br>".$tipo_copei[$i + 1]["Tipo"]." ".$tipo_copei[$i + 1]["Descripcion"]."<br><br>"."</h2>";
			$producto = $conexion->Consultas("SELECT Nombre_Completo, Etiqueta_Copei, Tipo, ISSN FROM Articulos, Alias, Journal, Tipo_Copei WHERE FK_Tipo = ID_Tipo AND FK_Journal = ID_Journal AND FK_Articulo = ID_Articulo AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Factor_Impacto > '".$impacto."' Order by Factor_Impacto");
			for($y = 0; $y < count($producto); $y++)
				crear_elementos("no_editar", $tipo_copei[$i]["Tipo"], "", "", 'Artículo: '.$producto[$y]["Tipo"].".".$producto[$y]["Etiqueta_Copei"], $producto[$y]["Nombre_Completo"], 'ISSN '.$producto[$y]["ISSN"], "", "");
			unset($producto);
			$i += 2;
			echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br>"."</h2>";
			$producto = $conexion->Consultas("SELECT Volumen, Numero, Paginas, Fecha, Nombre_Completo, Numero_Citas FROM Articulos, Alias, Journal WHERE FK_Journal = ID_Journal AND FK_Articulo = ID_Articulo AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Numero_Citas NOT LIKE '0' Order by Numero_Citas");
			for($y = 0; $y < count($producto); $y++)
			{
				$inicial = explode("-", $producto[$y]["Fecha"]);	
				crear_elementos("no_editar", $tipo_copei[$i]["Tipo"], 'Número de Citas: '.$producto[$y]["Numero_Citas"], "", $producto[$y]["Nombre_Completo"], (($producto[$y]["Volumen"] != "") ? "Vol. ".$producto[$y]["Volumen"].", " : "").(($producto[$y]["Numero"] != "") ? "No. ".$producto[$y]["Numero"].", " : "").(($producto[$y]["Paginas"] != "") ? "Pag. ".$producto[$y]["Paginas"].", " : "").$inicial[2]."/".$inicial[1]."/".$inicial[0], '', "", "");
			}
			unset($producto);
			$i++;
			for(;$tipo_copei[$i]["Tipo"] != "4.12"; $i++)
			{
				echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br></h2>";
				$producto = $conexion->Consultas("SELECT ID_Repercusion, Fecha_Inicial, Fecha_Final, Descripcion_Localidad, Congreso_Discutido_Estu_Miemb_Otorga_Respon, Titulo_Proyecto_MedioDiscusion_Revista_Puesto FROM Repercusion WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo = ".$tipo_copei[$i]["ID_Tipo"]." ORDER BY Fecha_Inicial");
				for($y = 0; $y < count($producto); $y++)
				{
					$titulo = "";
					if($tipo_copei[$i]["Tipo"] == "4.3" || $tipo_copei[$i]["Tipo"] == "4.4" || $tipo_copei[$i]["Tipo"] == "4.5" || $tipo_copei[$i]["Tipo"] == "4.7" || $tipo_copei[$i]["Tipo"] == "4.8" || $tipo_copei[$i]["Tipo"] == "4.10" || $tipo_copei[$i]["Tipo"] == "4.11")
						$titulo = $producto[$y]["Descripcion_Localidad"];		
					else if($tipo_copei[$i]["Tipo"] == "4.9" || $tipo_copei[$i]["Tipo"] == "4.6")
						$titulo = $producto[$y]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];	
					$autores = "";
					if($tipo_copei[$i]["Tipo"] == "4.5" || $tipo_copei[$i]["Tipo"] == "4.10" || $tipo_copei[$i]["Tipo"] == "4.11")		
						$autores = $producto[$y]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];
					else if($tipo_copei[$i]["Tipo"] == "4.6")		
						$autores = $producto[$y]["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"];
					else if($tipo_copei[$i]["Tipo"] == "4.9")
						$autores = $producto[$y]["Descripcion_Localidad"];			
					$inicial = explode("-", $producto[$y]["Fecha_Inicial"]);
					$detalles = "";
					if($tipo_copei[$i]["Tipo"] != "4.11")
						$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0];	
					else 
					{
						$final = explode("-", $producto[$y]["Fecha_Final"]);
						$detalles = $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0];	
					}		
					crear_elementos($producto[$y]["ID_Repercusion"], $tipo_copei[$i]["Tipo"], '', "", $titulo, $autores, $detalles, "", "");
				}
				unset($producto);
			}
			echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br></h2>";
			$producto = $conexion->Consultas("SELECT ID_Proyecto, Fecha_Inicial, Fecha_Final, Titulo, Gastos_Inversion, Gastos_Corr, Moneda FROM Proyecto, Usuario_Proyecto WHERE FK_Proyecto = ID_Proyecto AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." ORDER BY Fecha_Inicial");
			for($y = 0; $y < count($producto); $y++)
			{
				$inicial = explode("-", $producto[$y]["Fecha_Inicial"]);
				$final = explode("-", $producto[$y]["Fecha_Final"]);	
				crear_elementos($producto[$y]["ID_Proyecto"], $tipo_copei[$i]["Tipo"], '', "", $producto[$y]["Titulo"], ($producto[$y]["Gastos_Inversion"] + $producto[$y]["Gastos_Corr"])." ".$producto[$y]["Moneda"], $inicial[2]."/".$inicial[1]."/".$inicial[0]." - ".$final[2]."/".$final[1]."/".$final[0], "", "");
			}
			unset($producto);
			$i++;
			for(;$tipo_copei[$i]["Tipo"] != "5"; $i++)
			{
				echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br></h2>";
				$producto = $conexion->Consultas("SELECT ID_Repercusion, Fecha_Inicial, Descripcion_Localidad, Congreso_Discutido_Estu_Miemb_Otorga_Respon, Titulo_Proyecto_MedioDiscusion_Revista_Puesto, SNI_ISSN_NoPatente_Subpro FROM Repercusion WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo = ".$tipo_copei[$i]["ID_Tipo"]." ORDER BY Fecha_Inicial");
				for($y = 0; $y < count($producto); $y++)
				{		
					$titulo = "";
					if($tipo_copei[$i]["Tipo"] == "4.13" || $tipo_copei[$i]["Tipo"] == "4.15")
						$titulo = $producto[$y]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];		
					else if($tipo_copei[$i]["Tipo"] == "4.14" || $tipo_copei[$i]["Tipo"] == "4.17" || $tipo_copei[$i]["Tipo"] == "4.18")
						$titulo = $producto[$y]["Descripcion_Localidad"];	
					else if($tipo_copei[$i]["Tipo"] == "4.16")
							$titulo = "No Patente ".$producto[$y]["SNI_ISSN_NoPatente_Subpro"];		
					$autores = "";
					if($tipo_copei[$i]["Tipo"] == "4.13")		
						$autores = $producto[$y]["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"];
					$inicial = explode("-", $producto[$y]["Fecha_Inicial"]);
					crear_elementos($producto[$y]["ID_Repercusion"], $tipo_copei[$i]["Tipo"], '', "", $titulo, $autores, $inicial[2]."/".$inicial[1]."/".$inicial[0], "", "");
				}
				unset($producto);
			}
			echo "</div>";
			echo '<div class="criterios_adicionales">';
			//criterios
			echo '<h2 style="margin-top: 0;">'.$tipo_copei[$i]["Tipo"]." ".$tipo_copei[$i]["Descripcion"]."<br><br></h2>";
			$producto = $conexion->Consultas("SELECT * FROM Criterio WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." ORDER BY Etiqueta_Copei");
			for($y = 0; $y < count($producto); $y++)
			{
				$inicial = explode("-", $producto[$y]["Fecha"]);
				crear_elementos($producto[$y]["ID_Criterio"], $tipo_copei[$i]["Tipo"], $tipo_copei[$i]["Tipo"].".".$producto[$y]["Etiqueta_Copei"], "", $producto[$y]["Descripcion"], "", $inicial[2]."/".$inicial[1]."/".$inicial[0], "", "");
			}
			unset($producto);
			echo "</div>";
		?>
	</body>
</html>
