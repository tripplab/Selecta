<?php
	session_start();
	include './query.php';
	$conexion = new Querys();
	
	function agregar_nuevo_matche()
	{
		echo '<li class="lista_temas_c publicacion_li">';
			echo '<div class="apuntador">';
				echo '<div class="lf" style="margin-right: 10px;">';
					echo '<input type="radio" name="id_publicacion" value="nuevo" checked>';
				echo '</div>';
				echo '<div class="contenido_lista_c">';
					echo '<p>No, crear uno nuevo</p>';
				echo '</div>';
				echo '<div class="limpiar"></div>';
			echo '</div>';
		echo '</li>';
	}
	
	switch($_POST['opcion'])
	{
		
		case "usuario_rol":
			$nombre = $conexion->Consultas("SELECT ID_Usuario, Nombre, Apellido_Paterno, Apellido_Materno, Rol FROM Usuario WHERE ID_Usuario = ".$_SESSION["Usuario_Temporal"]);
			echo json_encode($nombre[0]);
		break;
		case "nombre":
			$nombre = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE ID_Usuario = ".$_SESSION["Usuario_Temporal"]);
			$nombre = $nombre[0];
			echo $nombre["Nombre"]." ".$nombre["Apellido_Paterno"]."-".$nombre["Apellido_Materno"];
		break;
		case "matches":
			switch($_POST['tipo'])
			{
				case "2.1.a": case "2.1.b": case "2.1.c": case "2.1.d": case "2.1.e": case "2.1.f": case "2.1.g":
					$articulos = $conexion->Consultas("SELECT Titulo, ID_Articulo, Fecha FROM Articulos WHERE Titulo LIKE '%".$_POST["titulo"]."%'");
					for($i = 0; $i < count($articulos); $i++)
					{
						echo '<li class="lista_temas_c publicacion_li contenido_js">';
						echo '<div class="apuntador">';
						echo '<div class="lf" style="margin-right: 10px;">';
						echo '<input type="radio" name="id_publicacion" value="'.$articulos[$i]["ID_Articulo"].'" >';
						echo '</div>';
						echo '<div class="contenido_lista_c">';
						echo '<h5><small>Artículo: </small>'.$articulos[$i]["Titulo"].'</h5>';
						$autor = $conexion->Consultas("SELECT Alias FROM Alias WHERE FK_Articulo = ".$articulos[$i]["ID_Articulo"]);
						$autores = "";
						for($x = 0; $x < count($autor); $x++)
							$autores .= $autor[$x]["Alias"].", ";
						$autores = trim($autores);
						$autores = trim($autores, ",");
						echo '<div class="autores">'.$autores.'</div>';
						$fecha = explode("-", $articulos[$i]["Fecha"]);
						echo '<div class="detalles">'.$fecha[2]."/".$fecha[1]."/".$fecha[0].'</div>';
						echo '</div>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
						unset($autores);
					}
					if(count($articulos) > 0)
						agregar_nuevo_matche();
				break;
				case "3.2.a": case "3.2.b": case "3.3":
					$tesis = $conexion->Consultas("SELECT Titulo, ID_Tesis, Fecha_Final FROM Tesis WHERE Titulo LIKE '%".$_POST["titulo"]."%'");
					for($i = 0; $i < count($tesis); $i++)
					{
						echo '<li class="lista_temas_c publicacion_li contenido_js">';
						echo '<div class="apuntador">';
						echo '<div class="lf" style="margin-right: 10px;">';
						echo '<input type="radio" name="id_publicacion" value="'.$tesis[$i]["ID_Tesis"].'" >';
						echo '</div>';
						echo '<div class="contenido_lista_c">';
						echo '<h5><small>Tesis: </small>'.$tesis[$i]["Titulo"].'</h5>';
						$autor = $conexion->Consultas("SELECT Alias FROM Usuario_Tesis WHERE FK_Tesis = ".$tesis[$i]["ID_Tesis"]);
						$autores = "";
						for($x = 0; $x < count($autor); $x++)
							$autores .= $autor[$x]["Alias"].", ";
						$autores = trim($autores);
						$autores = trim($autores, ",");
						echo '<div class="autores">'.$autores.'</div>';
						$fecha = explode("-", $tesis[$i]["Fecha_Final"]);
						echo '<div class="detalles">'.$fecha[2]."/".$fecha[1]."/".$fecha[0].'</div>';
						echo '</div>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
						unset($autor);
					}
					if(count($tesis) > 0)
						agregar_nuevo_matche();
				break;
				case "4.12":
					$proyecto = $conexion->Consultas("SELECT Titulo, ID_Proyecto, Fecha_Inicial, Fecha_Final FROM Proyecto WHERE Titulo LIKE '%".$_POST["titulo"]."%'");
					for($i = 0; $i < count($proyecto); $i++)
					{
						echo '<li class="lista_temas_c publicacion_li contenido_js">';
						echo '<div class="apuntador">';
						echo '<div class="lf" style="margin-right: 10px;">';
						echo '<input type="radio" name="id_publicacion" value="'.$proyecto[$i]["ID_Proyecto"].'" >';
						echo '</div>';
						echo '<div class="contenido_lista_c">';
						echo '<h5><small>Proyecto: </small>'.$proyecto[$i]["Titulo"].'</h5>';
						$fecha = explode("-", $proyecto[$i]["Fecha_Inicial"]);
						$fecha_f = explode("-", $proyecto[$i]["Fecha_Final"]);
						echo '<div class="detalles">'.$fecha[2]."/".$fecha[1]."/".$fecha[0].' - '.$fecha_f[2]."/".$fecha_f[1]."/".$fecha_f[0].'</div>';
						echo '</div>';
						echo '<div class="limpiar"></div>';
						echo '</div>';
						echo '</li>';
					}
					if(count($proyecto) > 0)
						agregar_nuevo_matche();
				break;
			}
		break;
		case 'copei':
			switch($_POST['tipo'])
			{
				case "0.1": case "1.1":
					$datos = $conexion->Consultas("SELECT Localidad, Nombre as Tema, Anio, Grado as Escolaridad FROM Escolaridad WHERE ID_Escolaridad = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "0.2": case "1.2";
					$datos = $conexion->Consultas("SELECT Nombre_Localidad as Tema, Nombre_Localidad as Localidad, Fecha_Inicial as Fecha, Fecha_Final FROM Experiencia WHERE ID_Experiencia = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "0.3":
					$datos = $conexion->Consultas("SELECT Categoria as Vol, Subcategoria as Num, Fecha, Puesto as Localidad FROM Categoria WHERE ID_Promocion = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "2.1.a": case "2.1.b": case "2.1.c": case "2.1.d": case "2.1.e": case "2.1.f": case "2.1.g": case "2.2": case "2.3":
				case "2.4": case "2.5": case "2.7.a": case "2.7.b": case "2.7.c": case "2.7.d": case "2.8.a": case "2.8.b": case "2.8.c":
				case "2.8.d": case "2.8.e": case "2.8.f": case "2.9": case "2.10.a": case "2.10.b": case "2.10.c": case "2.11.a": 
				case "2.11.b": case "2.11.c": case "2.12.a": case "2.12.b": case "2.12.c": case "2.12.d":
					$datos = $conexion->Consultas("SELECT Titulo, Conferencia_Capitulo as Capitulo, Impacto_TituloLibro as Titulo_Libro, Tema, Abstract, No_Referencia_Rerporte as Referencia, Volumen as Vol, Numero as Num, Paginas as Pag, Editor, Editorial_Afiliacion as Editorial, Edicion, ISBN, DOI, Numero_Citas, Localidad_PagWeb as Localidad, Estado,Fecha, FK_Tesis, FK_Journal FROM Articulos WHERE ID_Articulo = ".$_POST['id']);
					$datos = $datos[0];
					if($datos["FK_Tesis"] != null)
					{
						$tesis = $conexion->Consultas("SELECT Titulo, ID_Tesis FROM Tesis WHERE ID_Tesis = ".$datos["FK_Tesis"]);
						$datos["Tesis"] = $tesis[0]["Titulo"];
					}
					else
						$datos["Tesis"] = "";
					if($datos["FK_Journal"] != null)
					{
						$journal = $conexion->Consultas("SELECT Nombre_Completo FROM Journal WHERE ID_Journal = ".$datos["FK_Journal"]);
						$datos["Journal"] = $journal[0]["Nombre_Completo"];
					}
					else
						$datos["Journal"] = "";
					$autores = $conexion->Consultas("SELECT Alias FROM Alias WHERE FK_Articulo = ".$_POST['id']);	
					$l_autores = "";
					for($z = 0; $z < count($autores); $z++)
						$l_autores .= $autores[$z]["Alias"].", ";
					$datos["Autores"] = trim($l_autores, ", ");
					echo json_encode($datos);
				break;
				case "2.12.e":
					$datos = $conexion->Consultas("SELECT Motivo as Referencia, Objetivos as Capitulo, Fecha_Inicial as Fecha, Fecha_Final, FK_Usuario, Nombre, Apellido_Paterno, Apellido_Materno FROM Comision, Usuario WHERE FK_Usuario = ID_Usuario AND ID_Comision = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "2.12.f":
					$datos = $conexion->Consultas("SELECT Evento as Referencia, Objetivos as Capitulo, Fecha_Inicial as Fecha, Fecha_Final, FK_Usuario, Nombre, Apellido_Paterno, Apellido_Materno FROM Difusion_Divulgacion, Usuario WHERE FK_Usuario = ID_Usuario AND ID_DD = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "2.12.g":
					$datos = $conexion->Consultas("SELECT Nombre_Visitante as Referencia, Objetivo as Capitulo, Fecha, FK_Usuario, Nombre, Apellido_Paterno, Apellido_Materno FROM Visitas_Academicas, Usuario WHERE FK_Usuario = ID_Usuario AND ID_Visita = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "2.12.h":
					$datos = $conexion->Consultas("SELECT Reportero_Medio as Referencia, Tema as Capitulo, Fecha, FK_Usuario, Nombre, Apellido_Paterno, Apellido_Materno FROM Medios, Usuario WHERE FK_Usuario = ID_Usuario AND ID_Medios = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "3.1.a": case "3.1.b": case "3.1.c": case "3.1.d":
					$datos = $conexion->Consultas("SELECT Nivel_AnioLic as Anio_Lic, Nivel_AnioLic as Nivel, Fecha_Inicial as Fecha, Fecha_Final, Total_Horas as Numero_Citas, FK_Curso, Curso.Nombre as Curso, Propedeutico, Nombre_Programa, ID_Programa_Unidad, Unidad.Nombre as Unidad, ID_Unidad, Institucion.Nombre as Institucion, ID_Institucion FROM Formacion_Curso, Curso, Programa_Unidad, Programa_Academico, Unidad, Institucion WHERE FK_Unidad = ID_Unidad AND FK_Institucion = ID_Institucion AND ID_Programa = Programa_Unidad.FK_Programa AND Programa_Unidad.ID_Programa_Unidad = Curso.FK_Programa AND FK_Curso = ID_Curso AND ID_Formacion = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "3.2.a": case "3.2.b": case "3.3": 
					$datos = $conexion->Consultas("SELECT Titulo, Lugar AS Localidad, Abstract, Fecha_Final, Concluida as Propedeutico FROM Tesis WHERE ID_Tesis = ".$_POST['id']);
					$datos = $datos[0];
					$autores = $conexion->Consultas("SELECT Alias FROM Usuario_Tesis WHERE Estudiante IS NULL AND FK_Tesis = ".$_POST['id']);	
					$l_autores = "";
					for($z = 0; $z < count($autores); $z++)
						$l_autores .= $autores[$z]["Alias"].", ";
					$datos["Autores"] = trim($l_autores, ", ");
					$datos["Referencia"] = $conexion->Consultas("SELECT Alias FROM Usuario_Tesis WHERE Estudiante = 1 AND FK_Tesis = ".$_POST['id']);
					$datos["Referencia"] = $datos["Referencia"][0]["Alias"];
					echo json_encode($datos);
				break;
				case "4.3": case "4.4": case "4.5": case "4.6": case "4.7": case "4.8": case "4.9": case "4.10": case "4.11": case "4.13":
				case "4.14": case "4.15": case "4.16": case "4.17": case "4.18":
					$datos = $conexion->Consultas("SELECT Titulo_Proyecto_MedioDiscusion_Revista_Puesto, Congreso_Discutido_Estu_Miemb_Otorga_Respon, Descripcion_Localidad as Abstract, Descripcion_Localidad, SNI_ISSN_NoPatente_Subpro as ISBN, SNI_ISSN_NoPatente_Subpro as Referencia, Volumen as Vol, Numero as Num, Paginas as Pag, Fecha_Inicial as Fecha, Fecha_Final FROM Repercusion WHERE ID_Repercusion = ".$_POST['id']);
					$datos = $datos[0];
					if($_POST['tipo'] == "4.5")
					{
						$datos["Capitulo"] = $datos["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"];
						$datos["Localidad"] = $datos["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];
					}
					else if($_POST['tipo'] == "4.6" || $_POST['tipo'] == "4.13")
					{
						$datos["Capitulo"] = $datos["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];
						$datos["Localidad"] = $datos["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"];
					}
					else if($_POST['tipo'] == "4.9")
					{
						$datos["Capitulo"] = $datos["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];
						$datos["Localidad"] = $datos["Descripcion_Localidad"];
					}
					else if($_POST['tipo'] == "4.10" || $_POST['tipo'] == "4.11" || $_POST['tipo'] == "4.15")
						$datos["Capitulo"] = $datos["Congreso_Discutido_Estu_Miemb_Otorga_Respon"];
					echo json_encode($datos);
				break;
				case "4.12":
					$datos = $conexion->Consultas("SELECT Tipo_Responsable as Referencia, Titulo, Objetivos as Abstract, Gastos_Inversion as Vol, Gastos_Corr as Num, Moneda as Pag, Fecha_Inicial as Fecha, Fecha_Final, Localidad, Pag_Web as Capitulo FROM Proyecto WHERE ID_Proyecto = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
				case "5":
					$datos = $conexion->Consultas("SELECT Descripcion as Abstract, Fecha FROM Criterio WHERE ID_Criterio = ".$_POST['id']);
					$datos = $datos[0];
					echo json_encode($datos);
				break;
			}
		break;
		case "doi":
			$datos = $conexion->encontrar_doi($_POST["doi"]);
			$datos["Titulo"] = str_replace("'", "", $datos["Titulo"]);
			$datos["Abstract"] = str_replace("'", "", $datos["Abstract"]);
			if(array_key_exists('Fecha', $datos))
			{
				$fecha = explode("-", $datos["Fecha"]);
				$datos["Dia"] = $fecha[2];
				$datos["Mes"] = $fecha[1];
				$datos["Anio"] = $fecha[0];
			}
			$datos["ID_Journal"] = $conexion->Consultas("SELECT ID_Journal FROM Journal WHERE Nombre_Completo LIKE '".$datos["Segundo_Titulo"]."'");
			$datos["ID_Journal"] = $datos["ID_Journal"][0]["ID_Journal"];			
			echo json_encode($datos);
		break;
		case "mostrar_departamento":
			$datos = $conexion->Consultas("SELECT COUNT(ID_Unidad_Departamento) as Count FROM Unidad_Departamento WHERE FK_Unidad = ".$_POST["id"]." AND FK_Departamento IS NOT NULL");
			echo $datos[0]["Count"];
		break;
		case "usuario_laboratorio":
			$datos = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, ID_Usuario, Lab_Miembro.Rol, Tipo_Direccion, Lab_Miembro.Fecha_Inicial, Lab_Miembro.Fecha_Final FROM Usuario, Lab_Miembro WHERE ID_Usuario = FK_Usuario AND ID_Miembro = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "comision":
			$datos = $conexion->Consultas("SELECT * FROM Comision WHERE ID_Comision = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "informe_comision":
			$datos = $conexion->Consultas("SELECT * FROM Informe_Comision WHERE ID_Informe = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "programa_unidad":
			$datos = $conexion->Consultas("SELECT ID_Institucion, Institucion.Nombre as Institucion, ID_Unidad, Unidad.Nombre as Unidad, FK_Programa, Periodo_Escolar, Objetivos FROM Institucion, Unidad, Programa_Unidad WHERE FK_Unidad = ID_Unidad AND ID_Institucion = FK_Institucion AND ID_Programa_Unidad = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "colegio_programa":
			$coordinador = $conexion->Consultas("SELECT COUNT(ID_Colegio) AS Total FROM Colegio_Programa WHERE Coordinador = 1 AND FK_Programa = ".$_POST["id"]);
			$secretaria = $conexion->Consultas("SELECT COUNT(ID_Colegio) AS Total FROM Colegio_Programa WHERE Sec_Academica = 1 AND FK_Programa = ".$_POST["id"]);
			$datos["coordinador"] = $coordinador[0]["Total"];
			$datos["secretaria"] = $secretaria[0]["Total"];
			echo json_encode($datos);
		break;
		case "comite":
			$_POST["id"] = explode(" ", $_POST["id"]);
			$_POST["id"] = $_POST["id"][0];
			$datos = $conexion->Consultas("SELECT ID_Usuario_Comite, Fecha_Inicio, Fecha_Final, Nombre_Comite, Tipo FROM Comite, Usuario_Comite WHERE FK_Comite = ID_Comite AND ID_Usuario_Comite = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "convenio":
			$_POST["id"] = explode(" ", $_POST["id"]);
			$_POST["id"] = $_POST["id"][0];
			$datos = $conexion->Consultas("SELECT Convenio.*, Nombre, Apellido_Paterno, Apellido_Materno FROM Convenios, Usuario WHERE FK_Usuario = ID_Usuario AND ID_Convenio = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "servicio":
			$_POST["id"] = explode(" ", $_POST["id"]);
			$_POST["id"] = $_POST["id"][0];
			$datos = $conexion->Consultas("SELECT Servicios_Laboratorio.*, Nombre, Apellido_Parterno, Apellido_Materno FROM Servicios_Laboratorio, Usuario WHERE FK_Usuario = ID_Usuario AND ID_Servicio = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "proyecto":
			$_POST["id"] = explode(" ", $_POST["id"]);
			$_POST["id"] = $_POST["id"][0];
			$datos = $conexion->Consultas("SELECT Proyectos_Institucion.*, Nombre, Apellido_Paterno, Apellido_Materno FROM Proyectos_Institucion, Usuario WHERE FK_Usuario = ID_Usuario AND ID_Proyecto = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "cud":
			$datos = $conexion->Consultas("SELECT FK_Unidad_Departamento, FK_Unidad, Unidad.Nombre as Unidad, Institucion.Nombre as Institucion, FK_Institucion FROM Institucion, Unidad, Unidad_Departamento, Usuario WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ID_Unidad AND FK_Institucion = ID_Institucion AND ID_Usuario = ".$_SESSION["Usuario_Temporal"]);
			$unidad = $conexion->Consultas("SELECT ID_Departamento, Nombre FROM Departamento WHERE ID_Departamento = ".$datos[0]["FK_Unidad_Departamento"]);
			if(count($unidad) > 0)
			{
				$datos[0]["Departamento"] = $unidad[0]["Nombre"];
				$datos[0]["ID_Departamento"] = $unidad[0]["ID_Departamento"];
			}
			echo json_encode($datos[0]);
		break;
		case "usuarios_cud":
			$check = "";
			if($_POST["id"] != null)
			{
				$datos = $conexion->Consultas("SELECT ID_Usuario, Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE FK_Unidad_Departamento = ".$_POST["id"]." AND Rol LIKE 'Profesor'");
				for($x = 0; $x < count($datos); $x++)
					$check .= "<input type='checkbox' name='usuarios' value='".$datos[$x]["ID_Usuario"]."' ".(($datos[$x]["ID_Usuario"] == $_SESSION["Usuario_Temporal"]) ? "checked" : "").">".$datos[$x]["Nombre"]." ".$datos[$x]["Apellido_Paterno"]."-".$datos[$x]["Apellido_Materno"]."<br>";
			}
			echo $check;
		break;
		case "usuario_unidad":
			$datos = $conexion->Consultas("SELECT ID_Unidad_Departamento FROM Unidad_Departamento WHERE FK_Unidad = ".$_POST["id"]." AND FK_Departamento IS NULL");
			echo $datos[0]["ID_Unidad_Departamento"];
		break;
		case "usuario_departamento":
			$datos = $conexion->Consultas("SELECT ID_Unidad_Departamento FROM Unidad_Departamento WHERE FK_Departamento = ".$_POST["id"]);
			echo $datos[0]["ID_Unidad_Departamento"];
		break;
		case "sni":
			$datos = $conexion->Consultas("SELECT * FROM SNI WHERE ID_SNI = ".$_POST["id"]);
			echo json_encode($datos[0]);
		break;
		case "Logeo":
			$usuario = $conexion->Consultas("SELECT COUNT(Nick) as Nick FROM Usuario WHERE Nick LIKE '".$_POST["usuario"]."'");
			if($usuario[0]["Nick"] > 0)
			{
                            
                                $contrase=$_POST["contrasenia"];
              
				$datos = $conexion->Consultas("SELECT ID_Usuario, Rol FROM Usuario WHERE Nick LIKE '".$_POST["usuario"]."' AND Contrasenia LIKE '". sha1($contrase)."'");
				if(count($datos) > 0)
				{
					$_SESSION["ID"] = $datos[0]["ID_Usuario"];
					$_SESSION["Usuario_Temporal"] = $datos[0]["ID_Usuario"];
					$_SESSION["Rol"] = $datos[0]["Rol"];
					echo  "ok";
				}
				else
					echo "Contrasenia incorrecta";
			}
			else
				echo "Este usuario no existe";
			//$conexion->Guardar("INSERT INTO Usuario (Nombre, Rol, Estatus, Contrasenia, Nick, FK_Unidad_Departamento) VALUES ('Administrador', 'Administrador', 'Activo', '".sha1("admin")."', 'admin', 2)");		
		break;
	}	
?>
