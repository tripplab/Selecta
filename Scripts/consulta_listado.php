<html>
	<head>
		<script src="../Scripts/listado.js"></script>
	</head>
	<body>
		<?php
			session_start();
			include './query.php';
			$conexion = new Querys();
			switch($_POST['opcion'])
			{
				case "journal":
					$journal = $conexion->Consultas("SELECT Nombre_Completo, ISSN, ID_Journal, Factor_Impacto FROM Journal WHERE Nombre_Completo LIKE '".$_POST["nombre"]."%'");
					for($i = 0; $i < count($journal); $i++)
					{
						echo '<li class="yu_tema_aclista listado_journal" role="option" data-text="'.$journal[$i]["Nombre_Completo"].'" data-type="'.$journal[$i]["ID_Journal"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$journal[$i]["Nombre_Completo"].'</span>';
						$factor = explode(".", $journal[$i]["Factor_Impacto"]);
						echo '<span class="texto_pequeño rf">ISSN: '.$journal[$i]["ISSN"].', IF: '.$factor[0].".".substr($factor[1], 0, 3).'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "institucion":
					$institucion = $conexion->Consultas("SELECT Nombre, ID_Institucion FROM Institucion ");
//                                    WHERE Nombre LIKE '".$_POST["nombre"]."%'");
					for($i = 0; $i < count($institucion); $i++)
					{
						echo '<li class="yu_tema_aclista listado_institucion" role="option" data-text="'.$institucion[$i]["Nombre"].'" data-type="'.$institucion[$i]["ID_Institucion"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$institucion[$i]["Nombre"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "unidad":
					$unidad = $conexion->Consultas("SELECT Nombre, ID_Unidad FROM Unidad WHERE FK_Institucion = ".$_POST["institucion"]);
					for($i = 0; $i < count($unidad); $i++)
					{
						echo '<li class="yu_tema_aclista listado_unidad" role="option" data-text="'.$unidad[$i]["Nombre"].'" data-type="'.$unidad[$i]["ID_Unidad"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$unidad[$i]["Nombre"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "programa":
					$programa = $conexion->Consultas("SELECT Nombre_Programa, ID_Programa_Unidad FROM Programa_Academico, Programa_Unidad WHERE Nombre_Programa LIKE '".$_POST["nombre"]."%' AND ID_Programa = FK_Programa AND FK_Unidad = ".$_POST["unidad"]);
					for($i = 0; $i < count($programa); $i++)
					{
						echo '<li class="yu_tema_aclista listado_programa" role="option" data-text="'.$programa[$i]["Nombre_Programa"].'" data-type="'.$programa[$i]["ID_Programa_Unidad"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$programa[$i]["Nombre_Programa"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "curso":
					$curso = $conexion->Consultas("SELECT Nombre, ID_Curso FROM Curso WHERE Nombre LIKE '".$_POST["nombre"]."%' AND FK_Programa = ".$_POST["programa"]);
					for($i = 0; $i < count($curso); $i++)
					{
						echo '<li class="yu_tema_aclista listado_curso" role="option" data-text="'.$curso[$i]["Nombre"].'" data-type="'.$curso[$i]["ID_Curso"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$curso[$i]["Nombre"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "departamento":
					$departamento = $conexion->Consultas("SELECT Nombre, ID_Departamento FROM Unidad_Departamento, Departamento WHERE FK_Departamento = ID_Departamento AND Nombre LIKE '".$_POST["nombre"]."%' AND FK_Unidad = ".$_POST["unidad"]);
					for($i = 0; $i < count($departamento); $i++)
					{
						echo '<li class="yu_tema_aclista listado_departamento" role="option" data-text="'.$departamento[$i]["Nombre"].'" data-type="'.$departamento[$i]["ID_Departamento"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$departamento[$i]["Nombre"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "usuario_laboratorio":
					$responsable = $conexion->Consultas("SELECT COUNT(ID_Miembro) AS Count FROM Lab_Miembro WHERE Responsable = 1 AND FK_Laboratorio = ".$_POST["laboratorio"]);
					$sql = ($responsable[0]["Count"] == 0) ? "" : " AND Rol NOT LIKE 'Profesor'";
					$usuario = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, ID_Usuario, Rol FROM Usuario WHERE Nombre LIKE '".$_POST["nombre"]."%'".$sql." ORDER BY Nombre");
					for($i = 0; $i < count($usuario); $i++)
					{
						echo '<li class="yu_tema_aclista listado_usuario_laboratorio" role="option" data-text="'.$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].'" data-type="'.$usuario[$i]["ID_Usuario"].'" data="'.$usuario[$i]["Rol"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "usuario_profesor":
					$usuario = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, ID_Usuario FROM Usuario WHERE Nombre LIKE '".$_POST["nombre"]."%' AND Rol LIKE 'Profesor' ORDER BY Nombre");
					for($i = 0; $i < count($usuario); $i++)
					{
						echo '<li class="yu_tema_aclista listado_usuario_laboratorio" role="option" data-text="'.$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].'" data-type="'.$usuario[$i]["ID_Usuario"].'" data="'.$usuario[$i]["Rol"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "buscar_usuario":
					echo '<ul class="aclist_lista_yu" role="listbox">';
					$usuario = $conexion->Consultas("SELECT Usuario.Nombre, Apellido_Paterno, Apellido_Materno, ID_Usuario, Unidad.Nombre as Unidad FROM Usuario, Unidad_Departamento, Unidad WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND ID_Unidad = FK_Unidad AND Usuario.Nombre LIKE '".$_POST["nombre"]."%' ORDER BY Usuario.Nombre LIMIT 3");
					for($i = 0; $i < count($usuario); $i++)
					{
						echo '<li class="aclist_tema_yu" role="option" data-text="'.$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].'">';
							echo '<a href="../Perfil/?i='.$usuario[$i]["ID_Usuario"].'&n='.$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].'">';
							
							echo '<div class="buscar_resultados_tema">';
								echo '<div class="indent_izquierda">';
									if(file_exists("../fotos_perfil/".$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].".jpg"))
										echo '<img src="../fotos_perfil/'.$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].'.jpg" class="buscar_resultado_imagen">';
									else
										echo '<img class="buscar_resultado_imagen" src="../fotos_perfil/default.jpg">';
								echo '</div>';
								echo '<div class="linea_simple_truncada linea_resultado">';
									echo '<b class="yu_destacado">'.$usuario[$i]["Nombre"]." ".$usuario[$i]["Apellido_Paterno"]."-".$usuario[$i]["Apellido_Materno"].'</b>';
								echo '</div>';
								echo '<div class="linea_simple_truncada linea_resultado" style="color: #eaeaea;">'.$usuario[$i]["Unidad"].'</div>';
							echo '</div>';
							echo '</a>';
						echo '</li>';
					}	
					echo '</ul>';
					echo '<div class="boton_ver_todo">';
						echo '<a class="linea_simple_truncada inner_ver_todo" href="../Usuario/Buscar.php?consulta='.$_POST["nombre"].'">Ver resultados de <strong>'.$_POST["nombre"].'</strong></a>';
					echo '</div>';
				break;
				case "periodo":
					$periodo = $conexion->Consultas("SELECT ID_Periodo_Escolar, Identificador FROM Programa_Unidad, Periodo_Escolar_Ingreso WHERE Identificador LIKE '".$_POST["nombre"]."%' AND ID_Programa_Unidad = ".$_POST["programa"]." ORDER BY Fecha_Inicio");
					for($i = 0; $i < count($periodo); $i++)
					{
						echo '<li class="yu_tema_aclista listado_periodo" role="option" data-text="'.$periodo[$i]["Identificador"].'" data-type="'.$usuario[$i]["ID_Periodo_Escolar"].'">';
						echo '<div class="ac_journal">';
						echo '<span class="lf">'.$periodo[$i]["Identificador"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
				case "tesis":
					$tesis = $conexion->Consultas("SELECT Titulo, ID_Tesis FROM Usuario_Tesis, Tesis WHERE ID_Tesis = FK_Tesis AND Titulo LIKE '".$_POST["nombre"]."%' AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
					for($i = 0; $i < count($tesis); $i++)
					{
						echo '<li class="yu_tema_aclista listado_tesis" role="option" data-text="'.$tesis[$i]["Titulo"].'" data-type="'.$tesis[$i]["ID_Tesis"].'">';
						echo '<div class="ac_tesis">';
						echo '<span class="lf">'.$tesis[$i]["Titulo"].'</span>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
				break;
			}	
		?>
	</body>
</html>
