<?php
	session_start();
	include './query.php';
	date_default_timezone_set('UTC');
	$conexion = new Querys();
	switch($_POST['opcion'])
	{
		case 'copei':
			switch($_POST['tipo_copei_esc'])
			{
				case "0.1": case "1.1":
					$escolaridad = ($_POST['tipo_copei_esc'] == "0.1") ? $_POST['escolaridad'] : "Doctorado";
					if($_POST['guar_act'] == null)
						$conexion->Guardar("INSERT INTO Escolaridad (Nombre, Localidad, Anio, FK_Usuario, Grado) values ('".$_POST['topic']."', '".$_POST['localidad']."', '".$_POST['anio_esc']."', ".$_SESSION['Usuario_Temporal'].", '".$escolaridad."')");
					else
						$conexion->Guardar("UPDATE Escolaridad SET Nombre = '".$_POST['topic']."', Localidad = '".$_POST['localidad']."', Anio = '".$_POST['anio_esc']."', Grado = '".$escolaridad."' WHERE ID_Escolaridad = ".$_POST['guar_act']);
				break;
				case "0.2": case "1.2";
					$estancia = ($_POST['tipo_copei_esc'] == "0.2") ? 0 : 1;
					$nombre = ($_POST['tipo_copei_esc'] == "0.2") ? $_POST['topic'] : $_POST['localidad'];
					$fecha_final = ($_POST['tipo_copei_esc'] == "0.2") ? '0000-00-00' :  $_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t'];
					if($_POST['guar_act'] == null)
						$conexion->Guardar("INSERT INTO Experiencia (Nombre_Localidad, Fecha_Inicial, Fecha_Final, FK_Usuario, Estancia) values ('".$nombre."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', '".$fecha_final."', ".$_SESSION['Usuario_Temporal'].", ".$estancia.")");
					else
						$conexion->Guardar("UPDATE Experiencia SET Nombre_Localidad = '".$nombre."', Fecha_Inicial = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', Fecha_Final = '".$fecha_final."', Estancia = ".$estancia." WHERE ID_Experiencia = ".$_POST['guar_act']);
				break;
				case "0.3":
					if($_POST['guar_act'] == null)
						$conexion->Guardar("INSERT INTO Categoria (Categoria, Subcategoria, Puesto, Fecha, FK_Usuario) values ('".$_POST['vol']."', '".$_POST['num']."', '".$_POST['localidad']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', ".$_SESSION['Usuario_Temporal'].")");
					else
						$conexion->Guardar("UPDATE Categoria SET Categoria = '".$_POST['vol']."', Subcategoria = '".$_POST['num']."', Puesto = '".$_POST['localidad']."', Fecha = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."' WHERE ID_Promocion = ".$_POST['guar_act']);
				break;
				case "2.1.a": case "2.1.b": case "2.1.c": case "2.1.d": case "2.1.e": case "2.1.f": case "2.1.g": case "2.2": case "2.3":
				case "2.4": case "2.5": case "2.7.a": case "2.7.b": case "2.7.c": case "2.7.d": case "2.8.a": case "2.8.b": case "2.8.c":
				case "2.8.d": case "2.8.e": case "2.8.f": case "2.9": case "2.10.a": case "2.10.b": case "2.10.c": case "2.11.a": 
				case "2.11.b": case "2.11.c": case "2.12.a": case "2.12.b": case "2.12.c": case "2.12.d":
					$tipo_copei = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$_POST['tipo_copei_esc']."'");
					$tipo_copei = $tipo_copei[0]["ID_Tipo"];
					$tesis = ($_POST['id_tesis'] != null && $_POST['tesis'] != "") ? $_POST['id_tesis'] : "null";
					$journal = ($_POST['id_journal'] != null) ? $_POST['id_journal'] : "null";
					$pag = ($_POST['tipo_copei_esc'] == '2.4' || $_POST['tipo_copei_esc'] == '2.5') ? $_POST['paginas']: $_POST['pag'];
					if($_POST['guar_act'] == null)
					{
						$conexion->Guardar("INSERT INTO Articulos (Titulo, Conferencia_Capitulo, Impacto_TituloLibro, Tema, Abstract, No_Referencia_Rerporte, Volumen, Numero, Paginas, Estado,Editor, Editorial_Afiliacion, Edicion, ISBN, DOI, Numero_Citas, Localidad_PagWeb, Fecha, FK_Tipo, FK_Tesis, FK_Journal) values ('".$_POST['titulo']."', '".$_POST['capitulo']."', '".$_POST['titulo_libro']."', '".$_POST['topic']."', '".$_POST['abstract']."', '".$_POST['referencia']."', '".$_POST['vol']."', '".$_POST['num']."', '".$pag."','".$_POST['stado']."' ,'".$_POST['editor']."', '".$_POST['editorial']."', '".$_POST['edicion']."', '".$_POST['isbn']."', '".$_POST['doi']."', '".$_POST['citas']."', '".$_POST['localidad']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', ".$tipo_copei.", ".$tesis.", ".$journal.")");
						$autores = explode(",", $_POST['autores']);
						$conexion->Autores_Articulos_Tesis($conexion->identificador, $autores, "INSERT INTO Alias(Alias, Etiqueta_Copei, FK_Usuario, FK_Articulo) VALUES", "SELECT MAX(Etiqueta_Copei) as Max FROM Alias, Articulos WHERE FK_Articulo = ID_Articulo AND FK_Tipo = ".$tipo_copei." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
					}
					else
					{
						$conexion->Guardar("UPDATE Articulos SET Titulo = '".$_POST['titulo']."', Conferencia_Capitulo = '".$_POST['capitulo']."', Impacto_TituloLibro = '".$_POST['titulo_libro']."', Tema = '".$_POST['topic']."', Abstract = '".$_POST['abstract']."', No_Referencia_Rerporte = '".$_POST['referencia']."', Volumen = '".$_POST['vol']."', Numero = '".$_POST['num']."', Paginas = '".$pag."', Estado='".$_POST['stado']."',Editor = '".$_POST['editor']."', Editorial_Afiliacion = '".$_POST['editorial']."', Edicion = '".$_POST['edicion']."', ISBN = '".$_POST['isbn']."', DOI = '".$_POST['doi']."', Numero_Citas = '".$_POST['citas']."', Localidad_PagWeb = '".$_POST['localidad']."', Fecha = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."',  FK_Tesis = ".$tesis.", FK_Journal = ".$journal." WHERE ID_Articulo = ".$_POST['guar_act']);
						$autores_caja = explode(", ", $_POST['autores']);
						$autores_bd = $conexion->Consultas("SELECT Alias, ID_Alias FROM Alias WHERE FK_Articulo = ".$_POST['guar_act']);
						$conexion->Editar_Autores_Articulos_Tesis($autores_bd, $autores_caja, "Alias", "ID_Alias", $_POST['guar_act'], "INSERT INTO Alias(Alias, Etiqueta_Copei, FK_Usuario, FK_Articulo) VALUES", "SELECT MAX(Etiqueta_Copei) as Max FROM Alias, Articulos WHERE FK_Articulo = ID_Articulo AND FK_Tipo = ".$tipo_copei." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
					}
				break;
				case "2.12.e":
					if($_POST['guar_act'] == null)
						$conexion->Guardar("INSERT INTO Comision (Tipo_Comision, Motivo, Objetivos, Fecha_Inicial, Fecha_Final, FK_Usuario) values ('Intercambio', '".$_POST['referencia']."', '".$_POST['capitulo']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', ".$_POST["id_usuario"].")");
					else
						$conexion->Guardar("UPDATE Comision SET FK_Usuario = ".$_POST["id_usuario"].", Motivo = '".$_POST['referencia']."', Objetivos = '".$_POST['capitulo']."', Fecha_Inicial = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', Fecha_Final = '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."' WHERE ID_Comision = ".$_POST['guar_act']);
				break;
				case "2.12.f":
					if($_POST['guar_act'] == null)
						$conexion->Guardar("INSERT INTO Difusion_Divulgacion (Evento, Objetivos, Fecha_Inicial, Fecha_Final, FK_Usuario) values ('".$_POST['referencia']."', '".$_POST['capitulo']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', ".$_POST["id_usuario"].")");
					else
						$conexion->Guardar("UPDATE Difusion_Divulgacion SET FK_Usuario = ".$_POST["id_usuario"].", Evento = '".$_POST['referencia']."', Objetivos = '".$_POST['capitulo']."', Fecha_Inicial = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', Fecha_Final = '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."' WHERE ID_DD = ".$_POST['guar_act']);
				break;
				case "2.12.g":
					if($_POST['guar_act'] == null)
						$conexion->Guardar("INSERT INTO Visitas_Academicas (Nombre_Visitante, Objetivo, Fecha, FK_Usuario) values ('".$_POST['referencia']."', '".$_POST['capitulo']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', ".$_POST["id_usuario"].")");
					else
						$conexion->Guardar("UPDATE Visitas_Academicas SET FK_Usuario = ".$_POST["id_usuario"].", Nombre_Visitante = '".$_POST['referencia']."', Objetivo = '".$_POST['capitulo']."', Fecha = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."' WHERE ID_Visita = ".$_POST['guar_act']);
				break;
				case "2.12.h":
					if($_POST['guar_act'] == null)
						$conexion->Guardar("INSERT INTO Medios (Reportero_Medio, Tema, Fecha, FK_Usuario) values ('".$_POST['referencia']."', '".$_POST['capitulo']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', ".$_POST["id_usuario"].")");
					else
						$conexion->Guardar("UPDATE Medios SET FK_Usuario = ".$_POST["id_usuario"].", Reportero_Medio = '".$_POST['referencia']."', Tema = '".$_POST['capitulo']."', Fecha = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."' WHERE ID_Medios = ".$_POST['guar_act']);
				break;
				case "3.1.a": case "3.1.b": case "3.1.c":
					$nivel = ($_POST['tipo_copei_esc'] == "3.1.c") ? $_POST['anio_lic'] : $_POST['nivel'];
					$tipo_copei = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$_POST['tipo_copei_esc']."'");
					$tipo_copei = $tipo_copei[0]["ID_Tipo"];
					if($_POST['guar_act'] == null)
					{
						$maximo = $conexion->Consultas("SELECT MAX(Etiqueta_Copei) as Max FROM Formacion_Curso WHERE FK_Tipo = ".$tipo_copei." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
						$maximo = $maximo[0]["Max"] + 1;			
						$conexion->Guardar("INSERT INTO Formacion_Curso(Nivel_AnioLic, Fecha_Inicial, Fecha_Final, Total_Horas, Propedeutico, Etiqueta_Copei, FK_Tipo, FK_Curso, FK_Usuario) VALUES ('".$nivel."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', '".$_POST['citas']."', '".$_POST['prope']."', '".$maximo."', '".$tipo_copei."', '".$_POST['id_curso']."', '".$_SESSION["Usuario_Temporal"]."')");
					}
					else
						$conexion->Guardar("UPDATE Formacion_Curso SET Nivel_AnioLic = '".$nivel."', Fecha_Inicial = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', Fecha_Final = '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', Total_Horas = '".$_POST['citas']."', Propedeutico = '".$_POST['prope']."', FK_Curso =  '".$_POST['id_curso']."' WHERE ID_Formacion = ".$_POST['guar_act']);
				break;
				case "3.1.d":
					if($_POST['guar_act'] == null)
						$conexion->Guardar("INSERT INTO Formacion_Curso(Nivel_AnioLic, Fecha_Inicial, Fecha_Final, Total_Horas, FK_Tipo, FK_Curso, FK_Usuario) VALUES ('Asesoria', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', '".$_POST['citas']."', null, '".$_POST['id_curso']."', '".$_SESSION["Usuario_Temporal"]."')");
					else
						$conexion->Guardar("UPDATE Formacion_Curso SET Fecha_Inicial = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', Fecha_Final = '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', Total_Horas = '".$_POST['citas']."', FK_Curso = '".$_POST['id_curso']."' WHERE ID_Formacion = ".$_POST['guar_act']);
					
				break;
				case "3.2.a": case "3.2.b": case "3.3": 
					$tipo_copei = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$_POST['tipo_copei_esc']."'");
					$tipo_copei = $tipo_copei[0]["ID_Tipo"];
					if($_POST['guar_act'] == null)				
					{
						$conexion->Guardar("INSERT INTO Tesis (Titulo, Lugar, Abstract, Fecha_Final, Concluida, FK_Tipo) VALUES ('".$_POST['titulo']."', '".$_POST['localidad']."', '".$_POST['abstract']."', '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', '".$_POST['prope']."', '".$tipo_copei."')");
						$autores = explode(",", $_POST['autores']);
						$identificador = $conexion->identificador;
						$conexion->Autores_Articulos_Tesis($identificador, $autores, "INSERT INTO Usuario_Tesis(Alias, Etiqueta_Copei, FK_Usuario, FK_Tesis) VALUES", "SELECT MAX(Etiqueta_Copei) as Max FROM Usuario_Tesis, Tesis WHERE ID_Tesis = FK_Tesis AND FK_Tipo = ".$tipo_copei." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
						$conexion->Guardar("INSERT INTO Usuario_Tesis(Alias, Etiqueta_Copei, FK_Usuario, FK_Tesis, Estudiante) VALUES ('".$_POST['referencia']."', 1, null, ".$identificador.", 1)");
					}	
					else
					{
						$conexion->Guardar("UPDATE Tesis  SET Titulo = '".$_POST['titulo']."', Lugar = '".$_POST['localidad']."', Abstract = '".$_POST['abstract']."', Fecha_Final = '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', Concluida = '".$_POST['prope']."' WHERE ID_Tesis = ".$_POST['guar_act']);
						$autores_caja = explode(", ", $_POST['autores']);
						$autores_caja[] = $_POST['referencia'];
						$autores_bd = $conexion->Consultas("SELECT Alias, ID_Usuario_Tesis as ID_Alias FROM Usuario_Tesis WHERE FK_Tesis = ".$_POST['guar_act']);
						$conexion->Editar_Autores_Articulos_Tesis($autores_bd, $autores_caja, "Usuario_Tesis", "ID_Usuario_Tesis", $_POST['guar_act'], "INSERT INTO Usuario_Tesis(Alias, Etiqueta_Copei, FK_Usuario, FK_Tesis) VALUES", "SELECT MAX(Etiqueta_Copei) as Max FROM Usuario_Tesis, Tesis WHERE ID_Tesis = FK_Tesis AND FK_Tipo = ".$tipo_copei." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
						for($x = 0; $x < count($autores_bd); $x++)
							$conexion->Guardar("UPDATE Usuario_Tesis SET Estudiante = NULL WHERE ID_Usuario_Tesis = ".$autores_bd[$x]["ID_Alias"]);
						unset($autores_bd);
						$autores_bd = $conexion->Consultas("SELECT ID_Usuario_Tesis FROM Usuario_Tesis WHERE FK_Tesis = ".$_POST['guar_act']);
						$conexion->Guardar("UPDATE Usuario_Tesis SET Estudiante = 1 WHERE ID_Usuario_Tesis = ".$autores_bd[count($autores_bd) - 1]["ID_Usuario_Tesis"]);
					}
				break;
				case "4.3": case "4.4": case "4.5": case "4.6": case "4.7": case "4.8": case "4.9": case "4.10": case "4.11": case "4.13":
				case "4.14": case "4.15": case "4.16": case "4.17": case "4.18":
					$titulo = ($_POST['tipo_copei_esc'] == "4.5") ? $_POST['capitulo'] : $_POST['localidad'];
					$congreso = ($_POST['tipo_copei_esc'] == "4.5") ? $_POST['localidad'] : $_POST['capitulo'];
					$localidad = $_POST['abstract'];
					$sni = ($_POST['tipo_copei_esc'] == "4.16") ? $_POST['referencia'] : $_POST['isbn'];
					$fecha_final = ($_POST['tipo_copei_esc'] == "4.11") ? $_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t'] : '0000-00-00';
					$tipo_copei = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$_POST['tipo_copei_esc']."'");
					$tipo_copei = $tipo_copei[0]["ID_Tipo"];
					if($_POST['guar_act'] == null)				
						$conexion->Guardar("INSERT INTO Repercusion(Titulo_Proyecto_MedioDiscusion_Revista_Puesto, Congreso_Discutido_Estu_Miemb_Otorga_Respon, Descripcion_Localidad, SNI_ISSN_NoPatente_Subpro, Volumen, Numero, Paginas, Fecha_Inicial, Fecha_Final, FK_Tipo, FK_Usuario) VALUES ('".$titulo."', '".$congreso."', '".$localidad."', '".$sni."', '".$_POST['vol']."', '".$_POST['num']."', '".$_POST['pag']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', '".$fecha_final."', '".$tipo_copei."', '".$_SESSION['Usuario_Temporal']."')");
					else
						$conexion->Guardar("UPDATE Repercusion SET Titulo_Proyecto_MedioDiscusion_Revista_Puesto = '".$titulo."', Congreso_Discutido_Estu_Miemb_Otorga_Respon = '".$congreso."', Descripcion_Localidad = '".$localidad."', SNI_ISSN_NoPatente_Subpro = '".$sni."', Volumen = '".$_POST['vol']."', Numero = '".$_POST['num']."', Paginas = '".$_POST['pag']."', Fecha_Inicial = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', Fecha_Final = '".$fecha_final."' WHERE ID_Repercusion = ".$_POST['guar_act']);
				break;
				case "4.12":
					if($_POST['guar_act'] == null)	
					{
						$conexion->Guardar("INSERT INTO Proyecto(Tipo_Responsable, Titulo, Objetivos, Gastos_Inversion, Gastos_Corr, Moneda, Fecha_Inicial, Fecha_Final, Localidad, Pag_Web) VALUES ('".$_POST['referencia']."', '".$_POST['titulo']."', '".$_POST['abstract']."', '".$_POST['vol']."', '".$_POST['num']."', '".$_POST['pag']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', '".$_POST['localidad']."', '".$_POST['capitulo']."')");
						$conexion->Guardar("INSERT INTO Usuario_Proyecto(FK_Usuario, FK_Proyecto) values (".$_SESSION["Usuario_Temporal"].", ".$conexion->identificador.")");
					}
					else
						$conexion->Guardar("UPDATE Proyecto SET Tipo_Responsable = '".$_POST['referencia']."', Titulo = '".$_POST['titulo']."', Objetivos = '".$_POST['abstract']."', Gastos_Inversion = '".$_POST['vol']."', Gastos_Corr = '".$_POST['num']."', Moneda = '".$_POST['pag']."', Fecha_Inicial = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', Fecha_Final = '".$_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t']."', Localidad = '".$_POST['localidad']."', Pag_Web = '".$_POST['capitulo']."' WHERE ID_Proyecto = ".$_POST['guar_act']);
				break;
				case "5":
					if($_POST['guar_act'] == null)	
					{
						$maximo = $conexion->Consultas("SELECT MAX(Etiqueta_Copei) as Max FROM Criterio WHERE FK_Usuario = ".$_SESSION["Usuario_Temporal"]);			
						$maximo = $maximo[0]["Max"] + 1;			
						$conexion->Guardar("INSERT INTO Criterio(Descripcion, Fecha, FK_Usuario, Etiqueta_Copei) Values ('".$_POST['abstract']."', '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."', ".$_SESSION["Usuario_Temporal"].", ".$maximo.")");
					}
					else
						$conexion->Guardar("UPDATE Criterio SET Descripcion = '".$_POST['abstract']."', Fecha = '".$_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub']."' WHERE ID_Criterio = ".$_POST['guar_act']);
				break;
			}
		break;
		case "autor":
			switch($_POST['tipo_copei_esc'])
			{
				case "2.1.a": case "2.1.b": case "2.1.c": case "2.1.d": case "2.1.e": case "2.1.f": case "2.1.g":
					$tipo_copei = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$_POST['tipo_copei_esc']."'");
					$tipo_copei = $tipo_copei[0]["ID_Tipo"];
					$conexion->Actualizar_Autores_Articulos_Tesis("Alias", "ID_Alias", $_POST['id_publicacion'], "SELECT Alias, ID_Alias AS ID FROM Alias WHERE FK_Articulo = ".$_POST['id_publicacion'], "SELECT MAX(Etiqueta_Copei) as Max FROM Alias, Articulos WHERE FK_Articulo = ID_Articulo AND FK_Tipo = ".$tipo_copei." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
				break;
				case "3.2.a": case "3.2.b": case "3.3":
					$tipo_copei = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$_POST['tipo_copei_esc']."'");
					$tipo_copei = $tipo_copei[0]["ID_Tipo"];
					$conexion->Actualizar_Autores_Articulos_Tesis("Usuario_Tesis", "ID_Usuario_Tesis", $_POST['id_publicacion'], "SELECT Alias, ID_Usuario_Tesis AS ID FROM Usuario_Tesis WHERE FK_Tesis = ".$_POST['id_publicacion'], "SELECT MAX(Etiqueta_Copei) as Max FROM Usuario_Tesis, Tesis WHERE FK_Tesis = ID_Tesis AND FK_Tipo = ".$tipo_copei." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
				break;
				case "4.12":
					$autor = $conexion->Consultas("SELECT ID_Usuario_Proyecto FROM Usuario_Proyecto WHERE FK_Proyecto = ".$_POST['id_publicacion']." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
					if($autor == null)
						$conexion->Guardar("INSERT INTO Usuario_Proyecto(FK_Usuario, FK_Proyecto) values (".$_SESSION["Usuario_Temporal"].", ".$_POST['id_publicacion'].")");
				break;
			}
		break;
		case "archivo":
			$carpeta = "";
			$tipo = "";
			switch($_POST["tipo"])
			{
				case "2.1.a": case "2.1.b": case "2.1.c": case "2.1.d": case "2.1.e": case "2.1.f": case "2.1.g": case "2.2": case "2.3":
				case "2.4": case "2.5": case "2.7.a": case "2.7.b": case "2.7.c": case "2.7.d": case "2.8.a": case "2.8.b": case "2.8.c":
				case "2.8.d": case "2.8.e": case "2.8.f": case "2.9": case "2.10.a": case "2.10.b": case "2.10.c": case "2.11.a": 
				case "2.11.b": case "2.11.c": case "2.12.a": case "2.12.b": case "2.12.c": case "2.12.d": case "5":
					$carpeta = "../Archivos/Articulos/";
					$tipo = "pdf";
				break;
				case "foto":
					$carpeta = "../fotos_perfil/";
					$tipo = "jpg";
				break;
			}
			$estado = "";
			if ($_FILES['userfile']["error"] > 0)
				$estado = "Error: " . $_FILES['userfile']['error'];
			else
			{
				$tmp_name = $_FILES["userfile"]["tmp_name"];
				$name = $_FILES["userfile"]["name"];
				$nombre = explode(".", $name);
				$name = $_POST["id"].".".$nombre[1];
				if($nombre[1] != $tipo)
					$estado = "Formato incorrecto";
				else if(!move_uploaded_file($tmp_name, $carpeta.$name))
					$estado = "Error";
			}
			$conexion->error = $estado;
		break;
		case "etiqueta_copei":
			switch($_POST["tipo"])
			{
				case "2.1.a": case "2.1.b": case "2.1.c": case "2.1.d": case "2.1.e": case "2.1.f": case "2.1.g": case "2.2": case "2.3":
				case "2.4": case "2.5": case "2.7.a": case "2.7.b": case "2.7.c": case "2.7.d": case "2.8.a": case "2.8.b": case "2.8.c":
				case "2.8.d": case "2.8.e": case "2.8.f": case "2.9": case "2.10.a": case "2.10.b": case "2.10.c": case "2.11.a": 
				case "2.11.b": case "2.11.c": case "2.12.a": case "2.12.b": case "2.12.c": case "2.12.d":
					$conexion->Guardar("CALL Etiqueta_Articulos_Editar_SP(".$_POST["identificador"].", ".$_SESSION["Usuario_Temporal"].", ".$_POST["etiqueta"].")");
				break;
				case "3.1.a": case "3.1.b": case "3.1.c":
					$conexion->Guardar("CALL Etiqueta_Formacion_Editar_SP(".$_POST["identificador"].", ".$_SESSION["Usuario_Temporal"].", ".$_POST["etiqueta"].")");
				break;
				case "3.2.a": case "3.2.b": case "3.3": 
					$conexion->Guardar("CALL Etiqueta_Tesis_Editar_SP(".$_POST["identificador"].", ".$_SESSION["Usuario_Temporal"].", ".$_POST["etiqueta"].")");
				break;
				case "5":
					$conexion->Guardar("CALL Etiqueta_Criterio_Editar_SP(".$_POST["identificador"].", ".$_POST["etiqueta"].")");
				break;
			}
		break;
		case "eliminar_copei":
			switch($_POST["tipo"])
			{
				case "0.1": case "1.1":
					$conexion->Eliminar("DELETE FROM Escolaridad WHERE ID_Escolaridad = ".$_POST["id"]);
				break;
				case "0.2": case "1.2";
					$conexion->Eliminar("DELETE FROM Experiencia WHERE ID_Experiencia = ".$_POST["id"]);
				break;
				case "0.3":
					$conexion->Eliminar("DELETE FROM Categoria WHERE ID_Promocion = ".$_POST["id"]);
				break;
				case "2.1.a": case "2.1.b": case "2.1.c": case "2.1.d": case "2.1.e": case "2.1.f": case "2.1.g": case "2.2": case "2.3":
				case "2.4": case "2.5": case "2.7.a": case "2.7.b": case "2.7.c": case "2.7.d": case "2.8.a": case "2.8.b": case "2.8.c":
				case "2.8.d": case "2.8.e": case "2.8.f": case "2.9": case "2.10.a": case "2.10.b": case "2.10.c": case "2.11.a": 
				case "2.11.b": case "2.11.c": case "2.12.a": case "2.12.b": case "2.12.c": case "2.12.d":
					$conexion->Guardar("CALL Etiqueta_Articulos_Eliminar_SP(".$_POST["id"].", ".$_SESSION["Usuario_Temporal"].")");
				break;
				case "2.12.e":
					$conexion->Eliminar("DELETE FROM Comision WHERE ID_Comision = ".$_POST["id"]);
				break;
				case "2.12.f":
					$conexion->Eliminar("DELETE FROM Difusion_Divulgacion WHERE ID_DD = ".$_POST["id"]);
				break;
				case "2.12.g":
					$conexion->Eliminar("DELETE FROM Visitas_Academicas WHERE ID_Visita = ".$_POST["id"]);
				break;
				case "2.12.h":
					$conexion->Eliminar("DELETE FROM Medios WHERE ID_Medios = ".$_POST["id"]);
				break;
				case "3.1.a": case "3.1.b": case "3.1.c":
					$conexion->Guardar("CALL Etiqueta_Formacion_Eliminar_SP(".$_POST["id"].")");
				break;
				case "3.1.d":
					$conexion->Eliminar("DELETE FROM Formacion_Curso WHERE ID_Formacion = ".$_POST["id"]);
				break;
				case "3.2.a": case "3.2.b": case "3.3": 
					$conexion->Guardar("CALL Etiqueta_Tesis_Eliminar_SP(".$_POST["id"].", ".$_SESSION["Usuario_Temporal"].")");
				break;
				case "4.3": case "4.4": case "4.5": case "4.6": case "4.7": case "4.8": case "4.9": case "4.10": case "4.11": case "4.13":
				case "4.14": case "4.15": case "4.16": case "4.17": case "4.18":
					$conexion->Eliminar("DELETE FROM Repercusion WHERE ID_Repercusion = ".$_POST["id"]);
				break;
				case "4.12":
					$conexion->Eliminar("CALL Proyecto_Eliminar_SP(".$_POST["id"].", ".$_SESSION["Usuario_Temporal"].")");
				break;
				case "5":
					$conexion->Guardar("CALL Etiqueta_Criterio_Eliminar_SP(".$_POST["id"].")");
				break;
			}
		break;
		case "cud_usuario":
			$departamento = ($_POST["id_departamento"] == null) ? "IS NULL" : "= ".$_POST["id_departamento"];
			$unidad_departamento = $conexion->Consultas("SELECT ID_Unidad_Departamento FROM Unidad_Departamento WHERE FK_Unidad = ".$_POST['id_unidad']." AND FK_Departamento ".$departamento);
			$unidad_departamento = $unidad_departamento[0];
			$conexion->Guardar("UPDATE Usuario SET FK_Unidad_Departamento = ".$unidad_departamento["ID_Unidad_Departamento"]." WHERE ID_Usuario = ".$_POST["id_usuario"]);
		break;
		case "lab_miembro":
			if(isset($_POST["id_institucion"]))
			{
				$departamento = ($_POST["id_departamento"] == null) ? "IS NULL" : "= ".$_POST["id_departamento"];
				$unidad_departamento = $conexion->Consultas("SELECT ID_Unidad_Departamento FROM Unidad_Departamento WHERE FK_Unidad = ".$_POST['id_unidad']." AND FK_Departamento ".$departamento);
				$unidad_departamento = $unidad_departamento[0]["ID_Unidad_Departamento"];
				$conexion->Guardar("UPDATE Laboratorio SET FK_Unidad_Departamento = ".$unidad_departamento." WHERE ID_Laboratorio = ".$_POST["id_laboratorio"]);
			}
			else if(isset($_POST["numero"]))
				$conexion->Guardar("UPDATE Laboratorio SET Numero = ".$_POST["numero"]." WHERE ID_Laboratorio = ".$_POST["id_laboratorio"]);
			else if(isset($_POST["nombre"]))
				$conexion->Guardar("UPDATE Laboratorio SET Nombre = '".$_POST["nombre"]."' WHERE ID_Laboratorio = ".$_POST["id_laboratorio"]);
			else if(isset($_POST["descripcion"]))
				$conexion->Guardar("UPDATE Laboratorio SET Descripcion = '".$_POST["descripcion"]."' WHERE ID_Laboratorio = ".$_POST["id_laboratorio"]);
			else if(isset($_POST["telefono"]))
				$conexion->Guardar("UPDATE Laboratorio SET Ext_Telefono = '".$_POST["telefono"]."' WHERE ID_Laboratorio = ".$_POST["id_laboratorio"]);
			else if(isset($_POST["pagina"]))
				$conexion->Guardar("UPDATE Laboratorio SET Pag_Web = '".$_POST["pagina"]."' WHERE ID_Laboratorio = ".$_POST["id_laboratorio"]);
			else if(isset($_POST["cupo"]))
				$conexion->Guardar("UPDATE Laboratorio SET Cupo_Integrantes = ".$_POST["cupo"]." WHERE ID_Laboratorio = ".$_POST["id_laboratorio"]);
		break;
		case "miembro_laboratorio";
			$responsable = ($_POST["rol"] == 'Profesor') ? "1" : "0";
			$fecha_inicial = $_POST['anio_pub']."-".$_POST['mes_pub']."-".$_POST['dia_pub'];
			$fecha_final = ($_POST['anio_pub_t'] == "Año" || $_POST['mes_pub_t'] == 'Mes' || $_POST['dia_pub_t'] == "Día") ? "" : $_POST['anio_pub_t']."-".$_POST['mes_pub_t']."-".$_POST['dia_pub_t'];		
 			if($_POST["servicio"] == null)
				$conexion->Guardar("CALL Lab_Miembro_Insert_SP('".$responsable."', '".$_POST["tipo"]."', '".$_POST["rol"]."', '".$fecha_inicial."', '".$fecha_final."', '".$_POST['id_usuario']."', '".$_POST['id_laboratorio']."')");
			else
				$conexion->Guardar("CALL Lab_Miembro_Update_SP('".$_POST["servicio"]."', '".$responsable."', '".$_POST["tipo"]."', '".$_POST["rol"]."', '".$fecha_inicial."', '".$fecha_final."', '".$_POST['id_usuario']."', '".$_POST['id_laboratorio']."')");
		break;
		case "miembro_laboratorio_baja":
			$conexion->Guardar("CALL Lab_Miembro_Baja_SP('".$_POST['id']."', '".$_POST['usuario']."')");
		break;
		case "miembro_laboratorio_eliminar":
			$conexion->Guardar("CALL Lab_Miembro_Delete_SP('".$_POST['id']."', '".$_POST['usuario']."')");
		break;
		case "comision":
			$inicial = $_POST['anio_i']."-".$_POST['mes_i']."-".$_POST['dia_i'];
			$final = $_POST['anio_t']."-".$_POST['mes_t']."-".$_POST['dia_t'];
			$solicitud = ($_POST['tipo_comision'] == "Vacacion" || $_POST['tipo_comision'] == "Sabatico") ? "" : $_POST['anio_s']."-".$_POST['mes_s']."-".$_POST['dia_s'];
			$financiamiento = ($_POST['vinculo_proyecto'] == "No") ? "" : $_POST["financiamiento"];
			$profesor = ($_POST['vinculo_proyecto'] == "No") ? "" : $_POST["profesor"];
			if($_POST["servicio"] == null)
				$conexion->Guardar("INSERT INTO Comision (Tipo_Comision, Motivo, Objetivos, Lugar, Fuente_Transporte, Monto_Transporte, Fuente_Viatico, Monto_Viatico, Fuente_Otros, Monto_Otros, Fuente_Financiamiento, Responsable, Fecha_Inicial, Fecha_Final, Fecha_Solicitud, FK_Usuario) VALUES ('".$_POST['tipo_comision']."', '".$_POST['motivos']."', '".$_POST["objetivos"]."', '".$_POST['lugar']."', '".$_POST['f_transporte']."', '".$_POST['m_transporte']."', '".$_POST['f_viaticos']."', '".$_POST['m_viaticos']."', '".$_POST['f_otros']."', '".$_POST['m_otros']."', '".$financiamiento."', '".$profesor."','".$inicial."', '".$final."', '".$solicitud."', '".$_SESSION['Usuario_Temporal']."')");
			else
				$conexion->Guardar("UPDATE Comision SET Motivo = '".$_POST['motivos']."', Objetivos = '".$_POST["objetivos"]."', Lugar = '".$_POST['lugar']."', Fuente_Transporte = '".$_POST['f_transporte']."', Monto_Transporte = '".$_POST['m_transporte']."', Fuente_Viatico = '".$_POST['f_viaticos']."', Monto_Viatico = '".$_POST['m_viaticos']."', Fuente_Otros = '".$_POST['f_otros']."', Monto_Otros = '".$_POST['m_otros']."', Fuente_Financiamiento = '".$financiamiento."', Responsable = '".$profesor."', Fecha_Inicial = '".$inicial."', Fecha_Final = '".$final."', Fecha_Solicitud = '".$solicitud."' WHERE ID_Comision = ".$_POST["servicio"]);
		break;
		case "comision_aceptar":
			$conexion->Guardar("UPDATE Comision SET Aceptado = ".$_POST['aceptado']." WHERE ID_Comision = ".$_POST["id"]);
		break;
		case "comision_eliminar":
			$conexion->Guardar("DELETE FROM Comision WHERE ID_Comision = ".$_POST["id"]);
		break;
		case "informe_comision":
			$inicial = $_POST['anio_in']."-".$_POST['mes_in']."-".$_POST['dia_in'];
			$evento = ($_POST["evento"] == "Otros") ? $_POST["descripcion"]: $_POST["evento"];
			if($_POST["servicio"] == null)
				$conexion->Guardar("INSERT INTO Informe_Comision (Evento, Descipcion, Fecha, FK_Comision) VALUES ('".$evento."', '".$_POST["objetivos"]."', '".$inicial."', '".$_POST["id"]."')");
			else
				$conexion->Guardar("UPDATE Informe_Comision SET Evento = '".$evento."', Descipcion = '".$_POST["objetivos"]."', Fecha ='".$inicial."' WHERE ID_Informe = ".$_POST["servicio"]);
		break;
		case "informe_comision_eliminar":
			$conexion->Guardar("DELETE FROM Informe_Comision WHERE ID_Informe = ".$_POST["id"]);
		break;
		case "lectura":
			copy($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name']);
			$fn = $_FILES['userfile']['name'];
			$tipo = explode(".", $fn);
			if($tipo[1] == 'txt')
				$conexion->error = readfile($fn); 
			else
				if(!empty($tipo[1]))
					$conexion->error = 1;
			$conexion->error = utf8_decode($conexion->error);
			unlink($fn);
		break;
		case "JCR":
			$tiempo_inicio = microtime(true);
			ini_set('max_execution_time', 5000);
			$i=1;
			$sql = "";
			while($i<=8461)
			{
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL,"http://admin-apps.webofknowledge.com/JCR/JCR");
				curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
				curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt ($ch, CURLOPT_COOKIEJAR, './cookies.txt');
				curl_setopt ($ch, CURLOPT_COOKIEFILE, './cookies.txt');
				curl_setopt ($ch, CURLOPT_POSTFIELDS, "SID=".$_POST['sid']);
				curl_setopt ($ch, CURLOPT_POST, TRUE);
				curl_exec ($ch);    
				curl_setopt($ch, CURLOPT_URL, 'http://admin-apps.webofknowledge.com/JCR/JCR?RQ=SELECT_ALL&cursor='.$i);
				curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
				curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);    
				//curl_setopt ($ch, CURLOPT_COOKIEJAR, './cookies.txt');
				//curl_setopt ($ch, CURLOPT_COOKIEFILE, './cookies.txt');
				$r=curl_exec($ch);
				$dom = new DOMDocument();
				@$dom->loadHTML($r);
				$dom->strictErrorChecking = false;
				$xp = new DOMXpath($dom);
				$posfila=3;   
				while($xp->query('//center//table//tr['.$posfila.']')->item(0)->nodeValue!='')
				{
					$Columna = $xp->query('//center//table//tr['.$posfila.']')->item(0)->getElementsByTagName('td');     
					$n=preg_replace('[^\s+|\s+$]','', $Columna->item(2)->nodeValue);
					curl_setopt($ch, CURLOPT_URL,'http://admin-apps.webofknowledge.com/JCR/JCR?RQ=RECORD&rank=1&journal='.urlencode($n));     
					curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
					curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, TRUE);
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
					$r1=curl_exec($ch);
					$dom1 = new DOMDocument();
					@$dom1->loadHTML($r1);
					$dom1->strictErrorChecking = false;
					$xp1 = new DOMXpath($dom1); 
					$pais = $xp1->query('//td[@valign="top"]')->item(14)->nodeValue;
					$titulo = $xp1->query('//span[@class="pageHeaderName"]')->item(0)->nodeValue;
					$pais = $xp1->query('//td[@valign="top"]')->item(14)->nodeValue;
					$titulo = str_replace("'", "", $titulo);
					$n = str_replace("'", "", $n);
					$pais = str_replace("'", "", $pais);
					$journal = $conexion->Consultas("SELECT ID_Journal FROM Journal WHERE Nombre_Completo LIKE '".$titulo."' LIMIT 0,1");
					if(count($journal) > 0)
						$journal = $conexion->Guardar("UPDATE Journal SET Nombre_Completo = '".$titulo."', Nombre_Abreviado = '".$n."', ISSN = '".$Columna->item(3)->nodeValue."', Factor_Impacto = '".$Columna->item(5)->nodeValue."' WHERE ID_Journal = ".$journal[0]["ID_Journal"]);
					else
						$sql .= "('".$titulo."', '".$n."', '".$Columna->item(3)->nodeValue."', '".$pais."', '".$Columna->item(5)->nodeValue."'), ";
					$posfila++;
				}
				$i+=20;
				curl_close($ch);
			 }
			if($sql != "")
			{
				$sql = trim($sql, " ");
				//echo "INSERT INTO Journal (Nombre_Completo, Nombre_Abreviado, ISSN, Pais, Factor_Impacto) VALUES ".substr($sql, 0, strlen($sql) - 1);
				$conexion->Guardar("INSERT INTO Journal (Nombre_Completo, Nombre_Abreviado, ISSN, Factor_Impacto) VALUES ".substr($sql, 0, strlen($sql) - 1));
			}
		break;
		case "institucion":
			if(isset($_POST["nombre"]))
				$conexion->Guardar("UPDATE Institucion SET Nombre = '".$_POST["nombre"]."' WHERE ID_Institucion = ".$_POST["id_institucion"]);
			else if(isset($_POST["pais"]))
				$conexion->Guardar("UPDATE Institucion SET Pais = '".$_POST["pais"]."', Ciudad = '".$_POST["ciudad"]."', Direccion = '".$_POST["domicilio"]."' WHERE ID_Institucion = ".$_POST["id_institucion"]);
			else if(isset($_POST["pagina"]))
				$conexion->Guardar("UPDATE Institucion SET Pagina_Web = '".$_POST["pagina"]."' WHERE ID_Institucion = ".$_POST["id_institucion"]);
			else if(isset($_POST["abreviacion"]))
				$conexion->Guardar("UPDATE Institucion SET Abreviacion = '".$_POST["abreviacion"]."' WHERE ID_Institucion = ".$_POST["id_institucion"]);
		break;
		case "unidad":
			if(isset($_POST["nombre"]))
				$conexion->Guardar("UPDATE Unidad SET Nombre = '".$_POST["nombre"]."' WHERE ID_Unidad = ".$_POST["id_unidad"]);
			else if(isset($_POST["pais"]))
				$conexion->Guardar("UPDATE Unidad SET Pais = '".$_POST["pais"]."', Ciudad = '".$_POST["ciudad"]."', Direccion = '".$_POST["domicilio"]."' WHERE ID_Unidad = ".$_POST["id_unidad"]);
			else if(isset($_POST["pagina"]))
				$conexion->Guardar("UPDATE Unidad SET Pagina_Web = '".$_POST["pagina"]."' WHERE ID_Unidad = ".$_POST["id_unidad"]);
			else if(isset($_POST["abreviacion"]))
				$conexion->Guardar("UPDATE Unidad SET Abreviacion = '".$_POST["abreviacion"]."' WHERE ID_Unidad = ".$_POST["id_unidad"]);
			else if(isset($_POST["telefono"]))
				$conexion->Guardar("UPDATE Unidad SET Telefono = '".$_POST["telefono"]."' WHERE ID_Unidad = ".$_POST["id_unidad"]);
		break;
		case "departamento":
			if(isset($_POST["nombre"]))
				$conexion->Guardar("UPDATE Departamento SET Nombre = '".$_POST["nombre"]."' WHERE ID_Departamento = ".$_POST["id_departamento"]);
			else if(isset($_POST["cupo"]))
				$conexion->Guardar("UPDATE Departamento SET Cupo_Disponible = '".$_POST["cupo"]."' WHERE ID_Departamento = ".$_POST["id_departamento"]);
			else if(isset($_POST["pagina"]))
				$conexion->Guardar("UPDATE Departamento SET Pagina_Web = '".$_POST["pagina"]."' WHERE ID_Departamento = ".$_POST["id_departamento"]);
			else if(isset($_POST["telefono"]))
				$conexion->Guardar("UPDATE Departamento SET Ext_Telefono = '".$_POST["telefono"]."' WHERE ID_Departamento = ".$_POST["id_departamento"]);
		break;
		case "institucion_nuevo":
			$conexion->Guardar("INSERT INTO Institucion (Nombre, Pais, Ciudad, Direccion, Pagina_Web, Abreviacion) VALUES ('".$_POST["nombre"]."', '".$_POST["pais"]."', '".$_POST["ciudad"]."', '".$_POST["domicilio"]."', '".$_POST["pagina"]."', '".$_POST["abreviacion"]."')");
		break;
		case "unidad_nuevo":
			$conexion->Guardar("INSERT INTO Unidad (Nombre, Pais, Ciudad, Direccion, Telefono, Pagina_Web, Abreviacion, FK_Institucion) VALUES ('".$_POST["nombre"]."', '".$_POST["pais"]."', '".$_POST["ciudad"]."', '".$_POST["domicilio"]."', '".$_POST["telefono"]."', '".$_POST["pagina"]."', '".$_POST["abreviacion"]."', '".$_POST["id"]."')");
		break;
		case "departamento_nuevo":
			$conexion->Guardar("CALL Unidad_Departamento_Departamento_Insert_SP ('".$_POST["nombre"]."', '".$_POST["telefono"]."', '".$_POST["pagina"]."', '".$_POST["cupo"]."', '".$_POST["unidad"]."')");
		break;
		case "laboratorio_u_d_nuevo":
			$conexion->Guardar("CALL Unidad_Departamento_Laboratorio_Insert_SP ('".$_POST["nombre"]."', '".$_POST["descripcion"]."', '".$_POST["telefono"]."', '".$_POST["pagina"]."', '".$_POST["cupo"]."', '".$_POST["numero"]."', '".$_POST["unidad"]."')");
		break;
		case "laboratorio_nuevo":
			$departamento = $conexion->Consultas("SELECT ID_Unidad_Departamento FROM Unidad_Departamento WHERE FK_Departamento = ".$_POST["departamento"]);
			$conexion->Guardar("INSERT INTO Laboratorio (Nombre, Descripcion, Ext_Telefono, Pag_Web, Cupo_Integrantes, Numero, FK_Unidad_Departamento) VALUES ('".$_POST["nombre"]."', '".$_POST["descripcion"]."', '".$_POST["telefono"]."', '".$_POST["pagina"]."', '".$_POST["cupo"]."', '".$_POST["numero"]."', '".$departamento[0]["ID_Unidad_Departamento"]."')");
		break;
		case "eliminar_Laboratorio":
			$conexion->Eliminar("DELETE FROM Laboratorio WHERE ID_Laboratorio = ".$_POST["id"]);
		break;
		case "eliminar_departamento":
			$conexion->Eliminar("DELETE FROM Departamento WHERE ID_Departamento = ".$_POST["id"]);
		break;
		case "eliminar_unidad":
			$conexion->Eliminar("DELETE FROM Unidad WHERE ID_Unidad = ".$_POST["id"]);
		break;
		case "eliminar_institucion":
			$conexion->Eliminar("DELETE FROM Institucion WHERE ID_Institucion = ".$_POST["id"]);
		break;
		case "tipo_copei":
			$conexion->Guardar("UPDATE Tipo_Copei SET Descripcion = '".$_POST["descripcion"]."', Puntuacion_Min = '".$_POST["puntuacion_min"]."', Puntuacion_Max = '".$_POST["puntuacion_max"]."' WHERE ID_Tipo = ".$_POST["id_tipo"]);
		break;
		case "programa_nuevo":
			$conexion->Guardar("INSERT INTO Programa_Academico (Nombre_Programa) VALUES ('".$_POST["nombre"]."')");
		break;
		case "eliminar_programa":
			$conexion->Eliminar("DELETE FROM Programa_Academico WHERE ID_Programa = ".$_POST["id"]);
		break;
		case "programa":
			$conexion->Guardar("UPDATE Programa_Academico SET Nombre_Programa = '".$_POST["nombre"]."' WHERE ID_Programa = ".$_POST["id_programa"]);
		break;
		case "programa_unidad":
			if($_POST["servicio"] == "")
				$conexion->Guardar("INSERT INTO Programa_Unidad (FK_Programa, FK_Unidad, Periodo_Escolar, Objetivos) VALUES ('".$_POST["programa"]."', '".$_POST["id_unidad"]."', '".$_POST["periodo"]."', '".$_POST["objetivos"]."')");
			else
				$conexion->Guardar("UPDATE Programa_Unidad SET FK_Unidad = '".$_POST["id_unidad"]."', Periodo_Escolar = '".$_POST["periodo"]."', Objetivos = '".$_POST["objetivos"]."' WHERE ID_Programa_Unidad = ".$_POST["servicio"]);
		break;
		case "eliminar_programa_unidad":
			$conexion->Eliminar("DELETE FROM Programa_Unidad WHERE ID_Programa_Unidad = ".$_POST["id"]);
		break;
		case "curso_nuevo":
			if($_POST["servicio"] == "")
				$conexion->Guardar("INSERT INTO Curso (Nombre, Objetivos, FK_Programa) VALUES ('".$_POST["nombre"]."', '".$_POST["objetivos"]."', '".$_POST["id_programa"]."')");
			else
				$conexion->Guardar("UPDATE Curso SET Nombre = '".$_POST["nombre"]."', Objetivos = '".$_POST["objetivos"]."' WHERE ID_Curso = ".$_POST["servicio"]);
		break;
		case "eliminar_curso":
			$conexion->Eliminar("DELETE FROM Curso WHERE ID_Curso = ".$_POST["id"]);
		break;
		case "periodo_nuevo":
			if($_POST["servicio"] == "")
				$conexion->Guardar("INSERT INTO Periodo_Escolar_Ingreso (FK_Programa, Identificador, Fecha_Inicio) VALUES ('".$_POST["id_programa"]."', '".$_POST["nombre"]."', '".$_POST["anio_pub"]."-".$_POST["mes_pub"]."-".$_POST["dia_pub"]."')");
			else
				$conexion->Guardar("UPDATE Periodo_Escolar_Ingreso SET Identificador = '".$_POST["nombre"]."', Fecha_Inicio = '".$_POST["anio_pub"]."-".$_POST["mes_pub"]."-".$_POST["dia_pub"]."' WHERE ID_Periodo_Escolar = ".$_POST["servicio"]);
		break;
		case "eliminar_periodo":
			$conexion->Eliminar("DELETE FROM Periodo_Escolar_Ingreso WHERE ID_Periodo_Escolar = ".$_POST["id"]);
		break;
		case "colegio_nuevo":
			$secretaria = (isset($_POST["secretario"])) ? $_POST["secretario"] : 0; 
			$coordinador = (isset($_POST["cordinador"])) ? $_POST["cordinador"] : 0; 
			if($_POST["servicio"] == "")
				$conexion->Guardar("INSERT INTO Colegio_Programa (Coordinador, Sec_Academica, FK_Usuario, FK_Programa) VALUES ('".$coordinador."', '".$secretaria."', '".$_POST["id_usuario"]."', '".$_POST["id_programa"]."')");
			else
				$conexion->Guardar("UPDATE Colegio_Programa SET Coordinador = '".$coordinador."', Sec_Academica = '".$secretaria."' WHERE ID_Colegio = ".$_POST["servicio"]);
		break;
		case "eliminar_colegio":
			$conexion->Eliminar("DELETE FROM Colegio_Programa WHERE ID_Colegio = ".$_POST["id"]);
		break;
		case "editar_usuario":
			$conexion->Guardar("UPDATE Usuario SET Nombre = '".$_POST["nombre"]."', Apellido_Paterno = '".$_POST["paterno"]."', Apellido_Materno = '".$_POST["materno"]."', Lugar_Nacimiento = '".$_POST["lugar"]."', Fecha_Nacimiento = '".$_POST["anio"]."-".$_POST["mes"]."-".$_POST["dia"]."', Apellido_Paterno = '".$_POST["paterno"]."', Correo_Electronico = '".$_POST["correo"]."', Num_Ser_Med = '".$_POST["seguro"]."', Ultimo_Nivel_Academico = '".$_POST["nivel"]."', Rol = '".$_POST["rol"]."', Estatus = '".$_POST["estatus"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
		break;
		case "editar_usuario_rol":
			if(isset($_POST["nombre"]))
				$conexion->Guardar("UPDATE Usuario SET Nombre = '".$_POST["nombre"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["paterno"]))
				$conexion->Guardar("UPDATE Usuario SET Apellido_Paterno = '".$_POST["paterno"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["materno"]))
				$conexion->Guardar("UPDATE Usuario SET Apellido_Materno = '".$_POST["materno"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["lugar"]))
				$conexion->Guardar("UPDATE Usuario SET Lugar_Nacimiento = '".$_POST["lugar"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["anio"]))
				$conexion->Guardar("UPDATE Usuario SET Fecha_Nacimiento = '".$_POST["anio"]."-".$_POST["mes"]."-".$_POST["dia"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["correo"]))
				$conexion->Guardar("UPDATE Usuario SET Correo_Electronico = '".$_POST["correo"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["seguro"]))
				$conexion->Guardar("UPDATE Usuario SET Num_Ser_Med = '".$_POST["seguro"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["nivel"]))
				$conexion->Guardar("UPDATE Usuario SET Ultimo_Nivel_Academico = '".$_POST["nivel"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["rol"]))
				$conexion->Guardar("UPDATE Usuario SET Rol = '".$_POST["rol"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["estatus"]))
				$conexion->Guardar("UPDATE Usuario SET Estatus = '".$_POST["estatus"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["nick"]))
				$conexion->Guardar("UPDATE Usuario SET Nick = '".$_POST["nick"]."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
			else if(isset($_POST["a_contrasenia"]))
			{
				$datos = $conexion->Consultas("SELECT COUNT(ID_Usuario) AS Contador FROM Usuario WHERE ID_Usuario = ".$_SESSION['ID']." AND Contrasenia LIKE '".sha1($_POST['a_contrasenia'])."'");
				if($datos[0]["Contador"] > 0)
				{
					if($_POST['contrasenia'] == $_POST['r_contrasenia'])
					{
						$conexion->Guardar("UPDATE Usuario SET Contrasenia = '".sha1($_POST['contrasenia'])."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
					}
					else
						echo "El campo Contraseña Nueva no coincide con el campo Repetir Contraseña";
				}
				else
					echo "El campo contraseña anterior no coincide con la contraseña actual";
			}
			else if(isset($_POST["contrasenia_"]))
			{
				
				if($_POST['contrasenia_'] == $_POST['r_contrasenia'])
				{
					$conexion->Guardar("UPDATE Usuario SET Contrasenia = '".sha1($_POST['contrasenia_'])."' WHERE ID_Usuario = ".$_POST["id_usuario"]);
				}
				else
					echo "El campo Contraseña Nueva no coincide con el campo Repetir Contraseña";
			}
		break;
		case "editar_institucion_cud":
			$departamento = ($_POST["id_departamento"] == null) ? "IS NULL" : "= ".$_POST["id_departamento"];
			$unidad_departamento = $conexion->Consultas("SELECT ID_Unidad_Departamento FROM Unidad_Departamento WHERE FK_Unidad = ".$_POST['id_unidad']." AND FK_Departamento ".$departamento);
			$unidad_departamento = $unidad_departamento[0];
			$conexion->Guardar("UPDATE Usuario SET FK_Unidad_Departamento = ".$unidad_departamento["ID_Unidad_Departamento"]." WHERE ID_Usuario = ".$_POST["id_usuario"]);
			/////////////////////////guardar programa, periodoingreso, matricula
		break;
		case "nivel_editar":
			if(isset($_POST["nivel"]))
				$conexion->Guardar("UPDATE SNI SET Nivel = '".$_POST["nivel"]."' WHERE ID_SNI = ".$_POST["id_nivel"]);
			else if(isset($_POST["dia_"]))
				$conexion->Guardar("UPDATE SNI SET Fecha_Otorgacion = '".$_POST["anio_"]."-".$_POST["mes_"]."-".$_POST["dia_"]."' WHERE ID_SNI = ".$_POST["id_nivel"]);
		break;
		case "nivel_nuevo":
			if($_POST["servicio"] == "")
				$conexion->Guardar("INSERT INTO SNI (Nivel, Fecha_Otorgacion, FK_Usuario) VALUES ('".$_POST["nivel"]."',  '".$_POST["anio_"]."-".$_POST["mes_"]."-".$_POST["dia_"]."', ".$_SESSION["Usuario_Temporal"].")");
			else
				$conexion->Guardar("UPDATE SNI SET Nivel = '".$_POST["nivel"]."', Fecha_Otorgacion = '".$_POST["anio_"]."-".$_POST["mes_"]."-".$_POST["dia_"]."' WHERE ID_SNI = ".$_POST["servicio"]);
		break;
		case "Eliminar_SNI":
			$conexion->Guardar("DELETE FROM SNI WHERE ID_SNI = ".$_POST["id"]);
		break;
		case "comite":
			if($_POST["servicio"] == "")
				$conexion->Guardar("INSERT INTO Usuario_Comite (Fecha_Inicio, Fecha_Final, Nombre_Comite, FK_Usuario, FK_Comite) VALUES ('".$_POST["anio_i"]."-".$_POST["mes_i"]."-".$_POST["dia_i"]."', '".$_POST["anio_t"]."-".$_POST["mes_t"]."-".$_POST["dia_t"]."', '".$_POST["motivos"]."', '".$_SESSION["Usuario_Temporal"]."', '".$_POST["tipo_comision"]."')");
			else
				$conexion->Guardar("UPDATE Usuario_Comite SET Fecha_Inicio = '".$_POST["anio_i"]."-".$_POST["mes_i"]."-".$_POST["dia_i"]."', Fecha_Final = '".$_POST["anio_t"]."-".$_POST["mes_t"]."-".$_POST["dia_t"]."', Nombre_Comite = '".$_POST["motivos"]."' WHERE ID_Usuario_Comite = ".$_POST["servicio"]);
		break;
		case "comite_eliminar":
			$conexion->Eliminar("DELETE FROM Usuario_Comite WHERE ID_Usuario_Comite = ".$_POST["id"]);
		break;
		case "terminar_comite":
			$conexion->Guardar("UPDATE Usuario_Comite SET Fecha_Final = '".date('Y-m-d')."' WHERE ID_Usuario_Comite = ".$_POST["id"]);
		break;
		case "convenio_servicio":
			switch($_POST["tipo_comision"])
			{
				case "Internacional": case "Nacional":
					$tipo = ($_POST["tipo_comision"] == "Internacional") ? 0 : 1;
					$convenio = ($_POST["vinculo_proyecto"] == "Si") ? 1 : 0; 
					if($_POST["servicio"] == "")
						$conexion->Guardar("INSERT INTO Convenios (Nac_Inter, Nombre_Proyecto, Convenio_Firmado, Fecha_Inicio, Fecha_Final, Nombre_Institucion, FK_Usuario) VALUES ('".$tipo."', '".$_POST["proyecto"]."', '".$convenio."', '".$_POST["anio_i"]."-".$_POST["mes_i"]."-".$_POST["dia_i"]."', '".$_POST["anio_t"]."-".$_POST["mes_t"]."-".$_POST["dia_t"]."', '".$_POST["institucion"]."', '".$_POST["id_usuario"]."')");
					else
						$conexion->Guardar("UPDATE Convenios SET FK_Usuario = ".$_POST["id_usuario"].", Nac_Inter = '".$tipo."', Nombre_Proyecto = '".$_POST["proyecto"]."', Convenio_Firmado = '".$convenio."', Fecha_Inicio = '".$_POST["anio_i"]."-".$_POST["mes_i"]."-".$_POST["dia_i"]."', Fecha_Final = '".$_POST["anio_t"]."-".$_POST["mes_t"]."-".$_POST["dia_t"]."', Nombre_Institucion = '".$_POST["institucion"]."' WHERE ID_Convenio = ".$_POST["servicio"]);
				break;
				case "Servicios":
					if($_POST["servicio"] == "")
						$conexion->Guardar("INSERT INTO Servicios_Laboratorio (Servicio, Objetivo, Institucion, Fecha_Inicial, Fecha_Final, FK_Usuario) VALUES ('".$_POST["proyecto"]."', '".$_POST["objetivo"]."', '".$_POST["institucion"]."', '".$_POST["anio_i"]."-".$_POST["mes_i"]."-".$_POST["dia_i"]."', '".$_POST["anio_t"]."-".$_POST["mes_t"]."-".$_POST["dia_t"]."', '".$_POST["id_usuario"]."')");
					else
						$conexion->Guardar("UPDATE Servicios_Laboratorio SET FK_Usuario = ".$_POST["id_usuario"].", Servicio = '".$_POST["proyecto"]."', Objetivo = '".$_POST["objetivo"]."', Institucion = '".$_POST["institucion"]."', Fecha_Inicial = '".$_POST["anio_i"]."-".$_POST["mes_i"]."-".$_POST["dia_i"]."', Fecha_Final = '".$_POST["anio_t"]."-".$_POST["mes_t"]."-".$_POST["dia_t"]."' WHERE ID_Servicio = ".$_POST["servicio"]);
				break;
				case "Proyecto":
					if($_POST["servicio"] == "")
						$conexion->Guardar("INSERT INTO Proyectos_Institucion (Titulo, Objetivos, Institucion, Fecha_Inicial, Fecha_Final, FK_Usuario) VALUES ('".$_POST["proyecto"]."', '".$_POST["objetivo"]."', '".$_POST["institucion"]."', '".$_POST["anio_i"]."-".$_POST["mes_i"]."-".$_POST["dia_i"]."', '".$_POST["anio_t"]."-".$_POST["mes_t"]."-".$_POST["dia_t"]."', '".$_POST["id_usuario"]."')");
					else
						$conexion->Guardar("UPDATE Proyectos_Institucion SET FK_Usuario = ".$_POST["id_usuario"].", Titulo = '".$_POST["proyecto"]."', Objetivos = '".$_POST["objetivo"]."', Institucion = '".$_POST["institucion"]."', Fecha_Inicial = '".$_POST["anio_i"]."-".$_POST["mes_i"]."-".$_POST["dia_i"]."', Fecha_Final = '".$_POST["anio_t"]."-".$_POST["mes_t"]."-".$_POST["dia_t"]."' WHERE ID_Proyecto = ".$_POST["servicio"]);
				break;
			}
		break;
		case "eliminar_convenio":
			$conexion->Eliminar("DELETE FROM Convenios WHERE ID_Convenio = ".$_POST["id"]);
		break;
		case "eliminar_servicio":
			$conexion->Eliminar("DELETE FROM Servicios_Laboratorio WHERE ID_Servicio = ".$_POST["id"]);
		break;
		case "eliminar_logro":
			$conexion->Eliminar("DELETE FROM Criterio WHERE ID_Criterio = ".$_POST["id"]);
		break;
		case "nuevo_usuario":
		$departamento = ($_POST["id_departamento"] == null) ? "IS NULL" : "= ".$_POST["id_departamento"];
		$unidad_departamento = $conexion->Consultas("SELECT ID_Unidad_Departamento FROM Unidad_Departamento WHERE FK_Unidad = ".$_POST['id_unidad']." AND FK_Departamento ".$departamento);
		$unidad_departamento = $unidad_departamento[0]["ID_Unidad_Departamento"];
		$nombre = $_POST["nombre_usuario"]." ".$_POST["a_paterno_usuario"]." ".$_POST["a_materno_usuario"];
		$nombre = explode(" ", $nombre);
		$iniciales = "";
		for($x = 0; $x < count($nombre); $x++)
			if($nombre[$x] != "")
				$iniciales .= substr($nombre[$x], 0, 1);
		$conexion->Guardar("INSERT INTO Usuario (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento, Correo_ELectronico, Num_Ser_Med, Ultimo_Nivel_Academico, Rol, Estatus, Contrasenia, Nick, FK_Unidad_Departamento) VALUES ('".$_POST["nombre_usuario"]."', '".$_POST["a_paterno_usuario"]."', '".$_POST["a_materno_usuario"]."', '".$_POST["lugar_nacimiento_usuario"]."', '".$_POST["anio_nacimiento_usuario"]."-".$_POST["mes_nacimiento_usuario"]."-".$_POST["dia_nacimiento_usuario"]."', '".$_POST["correo_usuario"]."', '".$_POST["seguro_usuario"]."', '".$_POST["nivel_usuario"]."', '".$_POST["rol_usuario"]."', ".$_POST["estatus_usuario"].", '".sha1($iniciales)."', '".$iniciales."', ".$unidad_departamento.")");
		break;
	}	
	echo $conexion->error;
?>
