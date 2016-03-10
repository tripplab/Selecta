<?php
	session_start();
	include './query.php';
	$conexion = new Querys();
	$conte = nl2br($_POST['lectura_text']);
	$conte = explode('<br />', $conte); 
	foreach ($conte as $k => $v) 
		$contenido[] = preg_replace("[^\s+|\s+$]","",$v);
	
	class Lectura
	{
		var $errores;
		var $producto;
		
		function lineas_vacias($arreglo, $indice)
		{
			for(; $indice < count($arreglo); $indice++)
				if($arreglo[$indice] != "")
					break;
			if($indice >= count($arreglo))
			{
				$this->errores .= "Error al ingresar el producto: ".$this->producto."\n";
				$indice = -1;
			}
			return $indice;
		}
		
		function verificar($arreglo, $indice, $bandera)
		{
			if(strlen($arreglo[$indice]) > 2)
				$tipo = $arreglo[$indice][0].$arreglo[$indice][1];
			else
				$tipo = $arreglo[$indice];
			if($tipo === "0." || $tipo === "1." || $tipo === "2." || $tipo === "3." || $tipo === "4." || $tipo === "5.")
			{
				$this->errores .= "Error al ingresar el producto: ".$this->producto."\n";
				return false;
			}
			return $bandera;
		}
		
		function buscar_similitud($sql)
		{
			$conexion = new Querys();
			$resultado = $conexion->Consultas($sql);
			if($resultado[0]["Total"] > 0)
				$this->errores .= "El producto ".$this->producto." ya esta almacenado en la Base de Datos\n";
			return $resultado[0]["Total"];
		}
		
		function particionar_datos($cadena)
		{
			$datos = explode(';', $cadena);
			for($x = 0; $x < count($datos); $x++)
				$datos[$x] = trim($datos[$x]);
			return $datos;
		}
		
		function fecha($fecha)
		{
			$bandera = true;
			if(strlen($fecha) == 4 && ($fecha < 1950 || $fecha > 2050))
				$bandera = false;
			else if(strlen($fecha) == 10)
			{
				$arreglo = explode("-", $fecha);
				if(count($arreglo) != 3)
					$arreglo = explode("/", $fecha);
				if(count($arreglo) == 3 && strlen($arreglo[0]) == 2 && strlen($arreglo[1]) == 2 && strlen($arreglo[2]) == 4)
				{
					if($arreglo[2] < 1950 || $arreglo[2] > 2050 || $arreglo[1] < 0 || $arreglo[1] > 12 || $arreglo[0] < 0 || $arreglo[0] > 31)
						$bandera = false;
				}
				else
					$bandera = false;
			}
			else if(strlen($fecha) != 10 && strlen($fecha) != 4)
				$bandera = false;
			if(!$bandera)
				$this->errores .= "La fecha del producto ".$this->producto." no es correcta\n";
			return $bandera;
		}
		
		function formato_fecha($fecha)
		{
			if(strlen($fecha) == 4)
				$fecha = $fecha."-00-00";
			else if(strlen($fecha) == 10)
			{
				$arreglo = explode("-", $fecha);
				if(count($arreglo) != 3)
					$arreglo = explode("/", $fecha);
				$fecha = $arreglo[2]."-".$arreglo[1]."-".$arreglo[0];
			}
			return $fecha;
		}
		
		function recortar($cadena)
		{
			if(stripos($cadena, 'Vol') === 0)
				$cadena = trim(substr($cadena, 3));
			else if(stripos($cadena, 'No') === 0)
				$cadena = trim(substr($cadena, 2));
			else if(stripos($cadena, 'Pp') === 0)
				$cadena = trim(substr($cadena, 2));
			else if(stripos($cadena, 'ISBN') === 0)
				$cadena = trim(substr($cadena, 4));
			else if(stripos($cadena, 'Horas') === 0)
				$cadena = trim(substr($cadena, 6));
			else if(stripos($cadena, 'proceso') === 0)
				$cadena = 1;
			return $cadena;
		}
	}
	
	$lectura = new Lectura();
	for($x = 0; $x < count($contenido); $x++)
	{
		$conexion->error = "";
		$x = $lectura->lineas_vacias($contenido, $x);
		if($x == -1)
			break;
		$lectura->producto = $contenido[$x];
		$guardar = true;
		if(($contenido[$x][0] == "0" || $contenido[$x][0] == "1") && $contenido[$x][2] == "1" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$tipo = explode(".", $lectura->producto);
			unset($tipo[count($tipo) - 1]);
			$tipo = implode(".", $tipo);
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if($tipo == "0.1" && count($datos) != 4)
				$guardar = false;
			else if($tipo == "1.1" && count($datos) != 3)
				$guardar = false;
			if($guardar)
			{
				if($datos[count($datos) - 1] < 1950 || $datos[count($datos) - 1] > 2050)
					$lectura->errores .= "El año del producto ".$lectura->producto." no es correcto\n";
				else if($lectura->buscar_similitud("SELECT COUNT(ID_Escolaridad) AS Total FROM Escolaridad WHERE Nombre LIKE '".$datos[0]."' AND Localidad LIKE '".$datos[1]."' AND Grado LIKE '".(($tipo == "0.1") ? $datos[2] : "Doctorado")."' AND Anio = '".$datos[count($datos) - 1]."' AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]) == 0)
				{
					$conexion->Guardar("INSERT INTO Escolaridad (Nombre, Localidad, Anio, FK_Usuario, Grado) values ('".$datos[0]."', '".$datos[1]."', '".$datos[count($datos) - 1]."', ".$_SESSION['Usuario_Temporal'].", '".(($tipo == "0.1") ? $datos[2] : "Doctorado")."')");
					$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
				}
			}	
			else
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";
		}
		else if(($contenido[$x][0] == "0" || $contenido[$x][0] == "1") && $contenido[$x][2] == "2" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$tipo = explode(".", $lectura->producto);
			unset($tipo[count($tipo) - 1]);
			$tipo = implode(".", $tipo);
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if($tipo == "0.2" && count($datos) != 2)
				$guardar = false;
			else if($tipo == "1.2" && count($datos) != 3)
				$guardar = false;
			if($guardar)
			{
				if(($tipo == "0.2" && $lectura->fecha($datos[count($datos) - 1])) || ($tipo == "1.2" && $lectura->fecha($datos[count($datos) - 1]) && $lectura->fecha($datos[1])))
				{
					$fecha_inicial = $lectura->formato_fecha($datos[1]);
					$fecha_final = ($tipo == "0.2") ? "0000-00-00" : $lectura->formato_fecha($datos[2]);
					if($lectura->buscar_similitud("SELECT COUNT(ID_Experiencia) AS Total FROM Experiencia WHERE Nombre_Localidad LIKE '".$datos[0]."' AND Fecha_Inicial = '".$fecha_inicial."' AND Fecha_Final = '".$fecha_final."' AND Estancia = '".(($tipo == "1.2") ? 1 : 0)."' AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]) == 0)
					{
						$conexion->Guardar("INSERT INTO Experiencia (Nombre_Localidad, Fecha_Inicial, Fecha_Final, FK_Usuario, Estancia) values ('".$datos[0]."', '".$fecha_inicial."', '".$fecha_final."', ".$_SESSION['Usuario_Temporal'].", '".(($tipo == "1.2") ? 1 : 0)."')");
						$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
					}
				}
			}	
			else
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";	
		}
		else if($contenido[$x][0] == "0" && $contenido[$x][2] == "3" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if(count($datos) == 4)
			{
				if($lectura->fecha($datos[count($datos) - 1]))
				{
					$fecha_inicial = $lectura->formato_fecha($datos[count($datos) - 1]);
					if($lectura->buscar_similitud("SELECT COUNT(ID_Promocion) AS Total FROM Categoria WHERE Categoria LIKE '".$datos[1]."' AND Subcategoria LIKE '".$datos[2]."' AND Puesto LIKE '".$datos[0]."' AND Fecha = '".$fecha_inicial."' AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]) == 0)
					{
						$conexion->Guardar("INSERT INTO Categoria (Categoria, Subcategoria, Puesto, Fecha, FK_Usuario) values ('".$datos[1]."', '".$datos[2]."', '".$datos[0]."', '".$fecha_inicial."', '".$_SESSION["Usuario_Temporal"]."')");
						$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
					}
				}
			}
			else
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";		
		}
		else if($contenido[$x][0] == "2" && $contenido[$x][2] != "6" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$tipo_temp = explode(".", $lectura->producto);
			$etiqueta = $tipo_temp[count($tipo_temp) - 1];
			unset($tipo_temp[count($tipo_temp) - 1]);
			$tipo = implode(".", $tipo_temp);
			$datos = "";
			$autores = "";
			$patente = "";
			$descripcion = "";
			$doi = "";
			if(stripos($contenido[$x], 'DOI:') === 0)
				$doi = trim(substr($contenido[$x], 4));
			if($doi == "" && $tipo_temp[1] != 5 && $tipo_temp[1] != 10 && $tipo_temp[1] != 11 && $tipo != "2.12.a" && $tipo != "2.12.b" && $tipo != "2.12.d")
			{
				if($tipo[2] == "8")
					$patente = $contenido[$x++];
				else if($tipo[2] == "9")
					$descripcion = $contenido[$x++];
				else
					$autores = $contenido[$x++];
				if(($x = $lectura->lineas_vacias($contenido, $x)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
					$datos = $contenido[$x++];
			}
			else
				$datos = $contenido[$x++];
			if($guardar)
			{
				$datos = $lectura->particionar_datos($datos);
				if($doi == "" && ($tipo == "2.1.a" || $tipo == "2.1.b" || $tipo == "2.1.e" || $tipo == "2.2" || $tipo == "2.12.a" || $tipo == "2.12.c") && count($datos) != 6)
					$guardar = false;
				else if($doi == "" && ($tipo == "2.1.c" || $tipo == "2.1.d" || $tipo == "2.1.f" || $tipo == "2.4" || $tipo == "2.5" || $tipo == "2.11.a" || $tipo == "2.11.b") && count($datos) != 7)
					$guardar = false;
				else if($doi == "" && ($tipo == "2.1.g" || $tipo == "2.11.c" || $tipo == "2.12.b" || $tipo == "2.12.d") && count($datos) != 3)
					$guardar = false;
				else if($doi == "" && $tipo == "2.3" && count($datos) != 11)
					$guardar = false;
				else if($doi == "" && ($tipo == "2.9" || $tipo_temp[1] == 10) && count($datos) != 2)
					$guardar = false;
				else if($doi == "" && $tipo_temp[1] == 7 && count($datos) != 4)
					$guardar = false;
				else if($doi == "" && $tipo_temp[1] == 8 && (count($datos) != 2 && count($datos) != 3))
					$guardar = false;
				else if($doi != "" && count($datos) != 1)
					$guardar = false;
				if($guardar)
				{
					$fecha = "0000-00-00";
					$journal = "null";
					$titulo = "";
					$conferencia = "";
					$impacto_libro = "";
					$referencia_reporte = "";
					$vol = "";
					$num = "";
					$pag = "";
					$editor = "";
					$editorial_afiliacion = "";
					$edicion = "";
					$isbn = "";
					$localidad_pagina = "";
					$tesis = "null";
					if($doi == "" && $tipo_temp[1] == 8 && count($datos) == 3)
					{
						if($guardar = $lectura->fecha($datos[count($datos) - 2]))
							$fecha = $lectura->formato_fecha($datos[count($datos) - 2]);
					}
					else if($doi == "")
					{
						if($guardar = $lectura->fecha($datos[count($datos) - 1]))
							$fecha = $lectura->formato_fecha($datos[count($datos) - 1]);
					}
					if($doi == "" && ($tipo == "2.1.a" || $tipo == "2.1.b" || $tipo == "2.1.e" || $tipo == "2.2"))
					{
						$journal = $conexion->Consultas("SELECT ID_Journal FROM Journal WHERE Nombre_Completo LIKE '".$datos[1]."'");
						if(count($journal) > 0 )
							$journal = $journal[0]["ID_Journal"];	
						else
						{
							$guardar = false;
							$lectura->errores .= "El Journal del producto ".$lectura->producto." no existe en la Base de Datos\n";	
						}
					}
					$tipo_copei = $tipo;
					$tipo = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$tipo."'");
					if(count($tipo) > 0 )
						$tipo = $tipo[0]["ID_Tipo"];
					else
					{
						$guardar = false;
						$lectura->errores .= "El Tipo del producto ".$lectura->producto." no existe en la Base de Datos\n";	
					}
					if($doi == "" && $autores == "" && $guardar)
					{
						$datos_autor = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE ID_Usuario = ".$_SESSION["Usuario_Temporal"]);
						$autores = substr($datos_autor[0]["Nombre"], 0, 1).". ".$datos_autor[0]["Apellido_Paterno"]."-".$datos_autor[0]["Apellido_Materno"];
					}			
					if($guardar && $doi == "")
					{
					    if($tipo_temp[1] != 9 && $tipo_temp[1] != 10 && $tipo_copei != "2.12.a" && $tipo_copei != "2.12.b")
							$titulo = $datos[0];
						else if($tipo_temp[1] == 10)	
							$descripcion = $datos[0];
						else if($tipo_temp[1] == 9 || $tipo_copei == "2.12.a")	
							$impacto_libro = $datos[0];
						else if($tipo_copei == "2.12.b")
						{	
							$conferencia = $datos[0];
							$localidad_pagina = $datos[1];
						}
						if($tipo_copei == "2.1.c" || $tipo_copei == "2.1.d" || $tipo_temp[1] == 3 || $tipo_copei == "2.11.b")
							$conferencia = $datos[1];
						else if($tipo_copei == "2.1.f" || $tipo_copei == "2.1.g" || $tipo_copei == "2.11.a" || $tipo_copei == "2.12.c")	
							$impacto_libro = $datos[1];
						else if($tipo_temp[1] == 4 || $tipo_temp[1] == 5 || $tipo_copei == "2.12.a")
						{
							$editorial_afiliacion = $datos[1];
							$edicion = $datos[2];
							$editor = $datos[3];
							$isbn = $lectura->recortar($datos[4]);
						}
						else if($tipo_temp[1] == 7)
							$referencia_reporte = $datos[1];
						else if($tipo_copei == "2.11.c" || $tipo_copei == "2.12.d")
							$descripcion = $datos[1];
						if($tipo_copei == "2.1.a" || $tipo_copei == "2.1.b" || $tipo_copei == "2.1.e" || $tipo_copei == "2.1.f" || $tipo_copei == "2.2" || $tipo_copei == "2.12.c")
						{
							$vol = $lectura->recortar($datos[2]);
							$num = $lectura->recortar($datos[3]);
							$pag = $lectura->recortar($datos[4]);
						}
						else if($tipo_copei == "2.1.c" || $tipo_copei == "2.1.d" || ($tipo_temp[1] == 8 && count($datos) == 3))
							$localidad_pagina = $datos[2];
						else if($tipo_temp[1] == 3)
						{
							$impacto_libro = $datos[2];
							$editorial_afiliacion = $datos[3];
							$edicion = $datos[4];
							$editor = $datos[5];
							$isbn = $lectura->recortar($datos[6]);
							$vol = $lectura->recortar($datos[7]);
							$num = $lectura->recortar($datos[8]);
							$pag = $lectura->recortar($datos[9]);
						}
						else if($tipo_temp[1] == 7 || $tipo_copei == "2.11.a" || $tipo_copei == "2.11.b")
							$editorial_afiliacion = $datos[2];
						if($tipo_copei == "2.1.c" || $tipo_copei == "2.1.d")
						{
							$vol = $datos[3];
							$num = $datos[4];
							$pag = $datos[5];
						}
						else if($tipo_copei == "2.11.a" || $tipo_copei == "2.11.b")
						{
							$edicion = $datos[3];
							$editor = $datos[4];	
							$isbn = $datos[5];		
						}
						else if($tipo_copei == "2.1.f")
							$localidad_pagina = $datos[5];
						else if($tipo_temp[1] == 4 || $tipo_temp[1] == 5)
							$pag = $lectura->recortar($datos[5]);
					}
					else if($doi != "")
					{
						$datos = $conexion->encontrar_doi($doi);
						if(count($datos) > 0)
						{
							$titulo = str_replace("'", "", $datos["Titulo"]);
							$descripcion = str_replace("'", "", $datos["Abstract"]);
							$autores = $datos["Autores"];
							$editorial_afiliacion = $datos["Afiliacion"];
							$pag = $datos["Paginas"];
							$num = $datos["Issue"];
							$vol = $datos["Volumen"];
							$journal = $conexion->Consultas("SELECT ID_Journal FROM Journal WHERE Nombre_Completo LIKE '".$datos["Segundo_Titulo"]."'");
							$journal = $journal[0]["ID_Journal"];
							$fecha = $datos["Anio"]."-".$datos["Mes"]."-".$datos["Dia"];
						}
						else
						{
							$lectura->errores .= "El DOI del producto ".$lectura->producto." no es valido\n";	
							$guardar = false;
						}
					}
					if($guardar)
					{
						$num = ($num == "") ? 0 : $num;
						$id_articulo = $conexion->Consultas("SELECT ID_Articulo FROM Articulos WHERE Titulo LIKE '".$titulo."' AND Conferencia_Capitulo LIKE '".$conferencia."' AND Impacto_TituloLibro LIKE '".$impacto_libro."' AND No_Referencia_Rerporte LIKE '".$referencia_reporte."' AND Volumen LIKE '".$vol."' AND Numero LIKE '".$num."' AND Paginas LIKE '".$pag."' AND Editor LIKE '".$editor."' AND Editorial_Afiliacion LIKE '".$editorial_afiliacion."' AND Edicion LIKE '".$edicion."' AND ISBN LIKE '".$isbn."' AND Localidad_PagWeb LIKE '".$localidad_pagina."'");
						if(count($id_articulo) > 0)
						{
							$autores_caja = explode(", ", $autores);
							$autores_bd = $conexion->Consultas("SELECT Alias, ID_Alias FROM Alias WHERE FK_Articulo = ".$id_articulo[0]["ID_Articulo"]);
							$conexion->Editar_Autores_Articulos_Tesis($autores_bd, $autores_caja, "Alias", "ID_Alias", $id_articulo[0]["ID_Articulo"], "INSERT INTO Alias(Alias, Etiqueta_Copei, FK_Usuario, FK_Articulo) VALUES", "SELECT MAX(Etiqueta_Copei) as Max FROM Alias, Articulos WHERE FK_Articulo = ID_Articulo AND FK_Tipo = ".$tipo." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
						}
						else
						{							
							$conexion->Guardar("INSERT INTO Articulos (Titulo, Conferencia_Capitulo, Impacto_TituloLibro, Abstract, No_Referencia_Rerporte, Volumen, Numero, Paginas, Editor, Editorial_Afiliacion, Edicion, ISBN, DOI, Localidad_PagWeb, Fecha, FK_Tipo, FK_Tesis, FK_Journal) values ('".$titulo."', '".$conferencia."', '".$impacto_libro."', '".$descripcion."', '".$referencia_reporte."', '".$vol."', '".$num."', '".$pag."', '".$editor."', '".$editorial_afiliacion."', '".$edicion."', '".$isbn."', '".$doi."', '".$localidad_pagina."', '".$fecha."', ".$tipo.", ".$tesis.", ".$journal.")");
							$autores = explode(",", $autores);
							$conexion->Autores_Articulos_Tesis($conexion->identificador, $autores, "INSERT INTO Alias(Alias, Etiqueta_Copei, FK_Usuario, FK_Articulo) VALUES", "SELECT MAX(Etiqueta_Copei) as Max FROM Alias, Articulos WHERE FK_Articulo = ID_Articulo AND FK_Tipo = ".$tipo." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
						}
						$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
					}
				}
				else
					$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";	
			}
			unset($tipo_temp);
		}
		else if($contenido[$x][0] == "2" && $contenido[$x][2] == "6" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1)
		{
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if(count($datos) == 2)
			{
				$tipo_articulo = explode(".", $datos[0]);
				$etiqueta_articulo = $tipo_articulo[count($tipo_articulo) - 1];
				unset($tipo_articulo[count($tipo_articulo) - 1]);
				$tipo_articulo = implode(".", $tipo_articulo);
				$tipo_tesis = explode(".", $datos[1]);
				$etiqueta_tesis = $tipo_tesis[count($tipo_tesis) - 1];
				unset($tipo_tesis[count($tipo_tesis) - 1]);
				$tipo_tesis = implode(".", $tipo_tesis);
				$tipo_articulo = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$tipo_articulo."'");
				if(count($tipo_articulo) > 0 )
					$tipo_articulo = $tipo_articulo[0]["ID_Tipo"];
				else
				{
					$guardar = false;
					$lectura->errores .= "El tipo del resultado del producto".$lectura->producto." no existe en la Base de Datos\n";	
				}
				$tipo_tesis = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$tipo_tesis."'");
				if(count($tipo_tesis) > 0 )
					$tipo_tesis = $tipo_tesis[0]["ID_Tipo"];
				else
				{
					$guardar = false;
					$lectura->errores .= "El tipo de tesis del producto ".$lectura->producto." no existe en la Base de Datos\n";	
				}
				if(!is_numeric($etiqueta_articulo))
				{
					$guardar = false;
					$lectura->errores .= "El identificador del tipo del resultado del producto ".$lectura->producto." contiene caracteres incorrectos\n";
				}
				if(!is_numeric($etiqueta_tesis))
				{
					$guardar = false;
					$lectura->errores .= "El identificador del tipo de tesis del producto ".$lectura->producto." contiene caracteres incorrectos\n";
				}
				if($guardar)
				{
					$id_articulo = $conexion->Consultas("SELECT ID_Articulo FROM Articulos, Alias WHERE ID_Articulo = FK_Articulo AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]." AND FK_Tipo = ".$tipo_articulo." AND Etiqueta_Copei = ".$etiqueta_articulo);
					$id_tesis = $conexion->Consultas("SELECT ID_Tesis FROM Tesis, Usuario_Tesis WHERE FK_Tesis = ID_Tesis AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]." AND FK_Tipo = ".$tipo_tesis." AND Etiqueta_Copei = ".$etiqueta_tesis);
					if(count($id_articulo) == 0)
						$lectura->errores .= "El resultado del producto ".$lectura->producto." no existe en la Base de Datos\n";
					if(count($id_tesis) == 0)
						$lectura->errores .= "La tesis del producto ".$lectura->producto." no existe en la Base de Datos\n";
					if(count($id_articulo) > 0 && count($id_tesis) > 0)
					{
						$conexion->Guardar("UPDATE Articulos SET FK_Tesis = ".$id_tesis." WHERE ID_Articulo = ".$id_articulo);
						$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
					}	
				}
			}
			else
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";		
		}
		else if($contenido[$x][0] == "3" && $contenido[$x][2] == "1" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if(count($datos) == 9)
			{
				$tipo = explode(".", $lectura->producto);
				$etiqueta = $tipo[count($tipo) - 1];
				unset($tipo[count($tipo) - 1]);
				$tipo = implode(".", $tipo);
				$tipo = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$tipo."'");
				if(count($tipo) > 0 )
					$tipo = $tipo[0]["ID_Tipo"];
				else
				{
					$guardar = false;
					$lectura->errores .= "El tipo del resultado del producto".$lectura->producto." no existe en la Base de Datos\n";	
				}
				if($guardar = $lectura->fecha($datos[count($datos) - 2]))
					$fecha_inicial = $lectura->formato_fecha($datos[count($datos) - 2]);
				if($guardar = $lectura->fecha($datos[count($datos) - 1]))
					$fecha_final = $lectura->formato_fecha($datos[count($datos) - 1]);
				$institucion = $conexion->Consultas("SELECT ID_Institucion FROM Institucion WHERE Nombre LIKE '".$datos[4]."'");
				if(count($institucion) > 0)
					$institucion = $institucion[0]["ID_Institucion"];
				else
				{
					$guardar = false;
					$lectura->errores .= "El nombre de la institución del producto ".$lectura->producto." no existe en la Base de Datos\n";	
				}
				$unidad = $conexion->Consultas("SELECT ID_Unidad FROM Unidad WHERE Nombre LIKE '".$datos[5]."'");
				if(count($unidad) > 0)
					$unidad = $unidad[0]["ID_Unidad"];
				else
				{
					$unidad = $conexion->Consultas("SELECT ID_Unidad FROM Unidad WHERE Abreviacion LIKE '".$datos[5]."'");
					if(count($unidad) > 0)
						$unidad = $unidad[0]["ID_Unidad"];
					else
					{
						$guardar = false;
						$lectura->errores .= "El nombre de la unidad del producto ".$lectura->producto." no existe en la Base de Datos\n";	
					}
				}
				$programa = $conexion->Consultas("SELECT ID_Programa FROM Programa_Academico WHERE Nombre_Programa LIKE '".$datos[3]."'");
				if(count($programa) > 0)
					$programa = $programa[0]["ID_Programa"];
				else
				{
					$guardar = false;
					$lectura->errores .= "El nombre del programa del producto ".$lectura->producto." no existe en la Base de Datos\n";	
				}
				if($guardar)
				{
					$total = $conexion->Consultas("SELECT COUNT(ID_Unidad) AS TOTAL FROM Unidad WHERE ID_Unidad = '".$unidad."' AND FK_Institucion = ".$institucion);
					if($total[0]["TOTAL"] == 0)
					{
						$guardar = false;
						$lectura->errores .= "La unidad del producto ".$lectura->producto." no forma parte de la institución\n";	
					}
				}
				if($guardar)
				{
					$programa = $conexion->Consultas("SELECT ID_Programa_Unidad FROM Programa_Unidad WHERE FK_Programa = ".$programa." AND FK_Unidad = ".$unidad);
					if(count($programa) > 0)
					{
						$curso = $conexion->Consultas("SELECT ID_Curso FROM Curso WHERE Nombre LIKE '".$datos[0]."' AND FK_Programa = ".$programa[0]["ID_Programa_Unidad"]);
						if(count($curso) > 0)
						{
							$maximo = $conexion->Consultas("SELECT MAX(Etiqueta_Copei) as Max FROM Formacion_Curso WHERE FK_Tipo = ".$tipo." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
							$maximo = $maximo[0]["Max"] + 1;			
							$conexion->Guardar("INSERT INTO Formacion_Curso(Nivel_AnioLic, Fecha_Inicial, Fecha_Final, Total_Horas, Propedeutico, Etiqueta_Copei, FK_Tipo, FK_Curso, FK_Usuario) VALUES ('".$datos[1]."', '".$fecha_inicial."', '".$fecha_final."', '".$lectura->recortar($datos[6])."', '".$datos[2]."', '".$maximo."', '".$tipo."', '".$curso[0]["ID_Curso"]."', '".$_SESSION["Usuario_Temporal"]."')");
							$conexion->Guardar("CALL Etiqueta_Formacion_Editar_SP(".$conexion->identificador.", ".$_SESSION["Usuario_Temporal"].", ".$etiqueta.")");
							$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
						}	
						else
							$lectura->errores .= "El curso del producto ".$lectura->producto." no forma parte del programa\n";
					}
					else
						$lectura->errores .= "El programa del producto ".$lectura->producto." no forma parte de la unidad\n";
				}
			}
			else
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";		
		}
		else if($contenido[$x][0] == "3" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if(count($datos) == 6 || count($datos) == 7)
			{
				$tipo = explode(".", $lectura->producto);
				$etiqueta = $tipo[count($tipo) - 1];
				unset($tipo[count($tipo) - 1]);
				$tipo = implode(".", $tipo);
				$tipo = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$tipo."'");
				if(count($tipo) > 0 )
					$tipo = $tipo[0]["ID_Tipo"];
				else
				{
					$guardar = false;
					$lectura->errores .= "El tipo del resultado del producto".$lectura->producto." no existe en la Base de Datos\n";	
				}
				if(count($datos) == 6 && ($guardar = $lectura->fecha($datos[count($datos) - 1])))
					$fecha = $lectura->formato_fecha($datos[count($datos) - 1]);
				else if(count($datos) == 7 && ($guardar = $lectura->fecha($datos[count($datos) - 2])))
					$fecha = $lectura->formato_fecha($datos[count($datos) - 2]);
				if($guardar)
				{
					$director = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE ID_Usuario = ".$_SESSION["Usuario_Temporal"]);
					$director = substr($director[0]["Nombre"], 0, 1).". ".$director[0]["Apellido_Paterno"]."-".$director[0]["Apellido_Materno"];
					if(count($datos) == 7)
						$director .= ", ".$datos[6];
					$concluida = 1;
					$concluida_arreglo = explode(" ", $datos[2]);
					for($x = 0; $x < count($concluida_arreglo); $x++)
					{
						$concluida_arreglo[$x] = trim($concluida_arreglo[$x], "().");
						if($lectura->recortar($concluida_arreglo[$x]) == 1)
						{
							$concluida = 0;
							break;
						}
					}
					$conexion->Guardar("INSERT INTO Tesis (Titulo, Lugar, Fecha_Final, Concluida, FK_Tipo) VALUES ('".$datos[1]."', '".$datos[3].", ".$datos[4]."', '".$fecha."', '".$concluida."', '".$tipo."')");
					$autores = explode(",", $director);
					$identificador = $conexion->identificador;
					$conexion->Autores_Articulos_Tesis($identificador, $autores, "INSERT INTO Usuario_Tesis(Alias, Etiqueta_Copei, FK_Usuario, FK_Tesis) VALUES", "SELECT MAX(Etiqueta_Copei) as Max FROM Usuario_Tesis, Tesis WHERE ID_Tesis = FK_Tesis AND FK_Tipo = ".$tipo." AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]);
					$conexion->Guardar("INSERT INTO Usuario_Tesis(Alias, Etiqueta_Copei, FK_Usuario, FK_Tesis, Estudiante) VALUES ('".$datos[0]."', 1, null, ".$identificador.", 1)");
					$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
				}
			}
			else
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";	
		}
		else if($contenido[$x][0] == "4" && (($contenido[$x][2] == "1" && $contenido[$x][3] == ".") || $contenido[$x][2] == "2") && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
			$lectura->errores .= "El producto ".$lectura->producto." se genera automáticamente\n";	
		else if($contenido[$x][0] == "4" && $contenido[$x][2] == "1" && $contenido[$x][3] == "2" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$tipo_temp = explode(".", $lectura->producto);
			unset($tipo_temp[count($tipo_temp) - 1]);
			$tipo = implode(".", $tipo_temp);
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if(count($datos) != 7)
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";	
			else
			{
				if($guardar = $lectura->fecha($datos[3]) && $guardar = $lectura->fecha($datos[4]))
				{
					$fecha_inicial = $lectura->formato_fecha($datos[3]);
					$fecha_final = $lectura->formato_fecha($datos[4]);
				}
				$tipo = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$tipo."'");
				if(count($tipo) > 0 )
					$tipo = $tipo[0]["ID_Tipo"];
				else
				{
					$guardar = false;
					$lectura->errores .= "El Tipo del producto ".$lectura->producto." no existe en la Base de Datos\n";	
				}
				if($guardar && $lectura->buscar_similitud("SELECT COUNT(ID_Proyecto) AS Total FROM Proyecto, Usuario_Proyecto WHERE ID_Proyecto = FK_Proyecto AND Tipo_Responsable LIKE '".$datos[0]."' AND Titulo LIKE '".$datos[1]."' AND Localidad LIKE '".$datos[2]."' AND Fecha_Inicial = '".$fecha_inicial."' AND Fecha_Final = '".$fecha_final."' AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]) == 0)
				{
					$conexion->Guardar("INSERT INTO Proyecto(Tipo_Responsable, Titulo, Gastos_Inversion, Moneda, Fecha_Inicial, Fecha_Final, Localidad) VALUES ('".$datos[0]."', '".$datos[1]."', '".$datos[5]."', '".$datos[6]."', '".$fecha_inicial."', '".$fecha_final."', '".$datos[2]."')");
					$conexion->Guardar("INSERT INTO Usuario_Proyecto(FK_Usuario, FK_Proyecto) values (".$_SESSION["Usuario_Temporal"].", ".$conexion->identificador.")");
					$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
				}
			}
		}
		else if($contenido[$x][0] == "4" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$tipo_temp = explode(".", $lectura->producto);
			unset($tipo_temp[count($tipo_temp) - 1]);
			$tipo = implode(".", $tipo_temp);
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if(($tipo == "4.3" || $tipo == "4.4" || $tipo == "4.8" || $tipo == "4.14" || $tipo == "4.17" || $tipo == "4.18")&& count($datos) != 2)
				$guardar = false;
			else if($tipo == "4.5" && count($datos) != 7)
				$guardar = false;
			else if(($tipo == "4.6" || $tipo == "4.7") && count($datos) != 5)
				$guardar = false;
			else if(($tipo == "4.9" || $tipo == "4.15") && count($datos) != 3 && count($datos) != 4)
				$guardar = false;
			else if(($tipo == "4.10" || $tipo == "4.16") && count($datos) != 3)
				$guardar = false;
			else if(($tipo == "4.11" || $tipo == "4.13") && count($datos) != 4)
				$guardar = false;
			if($guardar)
			{
				$fecha_final = "0000-00-00";
				if($tipo == "4.11")
				{
					if($guardar = $lectura->fecha($datos[count($datos) - 2]) && $guardar = $lectura->fecha($datos[count($datos) - 1]))
					{
						$fecha_inicial = $lectura->formato_fecha($datos[count($datos) - 2]);
						$fecha_final = $lectura->formato_fecha($datos[count($datos) - 1]);
					}
				}
				else if($tipo == "4.5")
				{
					if($guardar = $lectura->fecha($datos[count($datos) - 2]))
					{
						$fecha_inicial = $lectura->formato_fecha($datos[count($datos) - 2]);
					}
				}
				else if($tipo == "4.9" || $tipo == "4.15" && count($datos) == 4)
				{
					if($guardar = $lectura->fecha($datos[count($datos) - 2]))
					{
						$fecha_inicial = $lectura->formato_fecha($datos[count($datos) - 2]);
					}
				}
				else 
				{
					if($guardar = $lectura->fecha($datos[count($datos) - 1]))
						$fecha_inicial = $lectura->formato_fecha($datos[count($datos) - 1]);
				}
				$tipo_copei = $tipo;
				$tipo = $conexion->Consultas("SELECT ID_Tipo FROM Tipo_Copei WHERE Tipo LIKE '".$tipo."'");
				if(count($tipo) > 0 )
					$tipo = $tipo[0]["ID_Tipo"];
				else
				{
					$guardar = false;
					$lectura->errores .= "El Tipo del producto ".$lectura->producto." no existe en la Base de Datos\n";	
				}
				if($guardar)
				{
					$titulo = "";
					$congreso = "";
					$descripcion = "";
					$sni = "";
					$vol = "";
					$num = "";
					$pp = "";
					if($tipo_copei == "4.3" || $tipo_copei == "4.4" || $tipo_copei == "4.5" || $tipo_copei == "4.7" || $tipo_copei == "4.8" || $tipo_copei == "4.14" || $tipo_copei == "4.17" || $tipo_copei == "4.18")
						$descripcion = $datos[0];
					else if($tipo_copei == "4.6" || $tipo_copei == "4.9" || $tipo == "4.10" || $tipo_copei == "4.11" || $tipo_copei == "4.13")
						$congreso = $datos[0];
					else if($tipo_copei == "4.15")
					{
						$titulo = $datos[0];
						$congreso = $datos[1];
					}
					else if($tipo_copei == "4.16")
						$sni = $datos[0];
					if($tipo_copei == "4.5" || $tipo_copei == "4.6" || $tipo_copei == "4.9")
						$titulo = $datos[1];
					else if($tipo_copei == "4.7")
					{
						$vol = $datos[1];
						$num = $datos[2];
						$pp = $datos[3];
					}
					else if($tipo_copei == "4.10" || $tipo_copei == "4.11" || $tipo_copei == "4.16")
						$descripcion = $datos[1];
					else if($tipo_copei == "4.13")
					{
						$sni = $datos[1];
						$titulo = $datos[2];
					}
					if($tipo_copei == "4.5")
					{
						$vol = $datos[2];
						$num = $datos[3];
						$pp = $datos[4];
					}
					else if($tipo_copei == "4.6")
					{
						$descripcion = $datos[2];
						$sni = $datos[3];
					}
					if($tipo_copei == "4.9" && count($datos) == 4)
						$descripcion = $datos[3];
					else if($tipo_copei == "4.15" && count($datos) == 4)
						$sni = $datos[3];
					if($lectura->buscar_similitud("SELECT COUNT(ID_Repercusion) AS Total FROM Repercusion WHERE Titulo_Proyecto_MedioDiscusion_Revista_Puesto LIKE '".$titulo."' AND Congreso_Discutido_Estu_Miemb_Otorga_Respon LIKE '".$congreso."' AND Descripcion_Localidad LIKE '".$descripcion."' AND Fecha_Inicial = '".$fecha_inicial."' AND Fecha_Final = '".$fecha_final."' AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]) == 0)
					{
						$conexion->Guardar("INSERT INTO Repercusion(Titulo_Proyecto_MedioDiscusion_Revista_Puesto, Congreso_Discutido_Estu_Miemb_Otorga_Respon, Descripcion_Localidad, SNI_ISSN_NoPatente_Subpro, Volumen, Numero, Paginas, Fecha_Inicial, Fecha_Final, FK_Tipo, FK_Usuario) VALUES ('".$titulo."', '".$congreso."', '".$descripcion."', '".$sni."', '".$vol."', '".$num."', '".$pp."', '".$fecha_inicial."', '".$fecha_final."', '".$tipo."', '".$_SESSION['Usuario_Temporal']."')");
						$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
					}
				}
			}
			else
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";	
		}
		else if($contenido[$x][0] == "5" && ($x = $lectura->lineas_vacias($contenido, $x + 1)) != -1 && ($guardar = $lectura->verificar($contenido, $x, $guardar)))
		{
			$etiqueta = explode(".", $lectura->producto);
			$etiqueta = $etiqueta[count($etiqueta) - 1];
			$datos = $lectura->particionar_datos($contenido[$x++]);
			if(count($datos) == 2)
			{
				if($lectura->fecha($datos[count($datos) - 1]))
				{
					$fecha_inicial = $lectura->formato_fecha($datos[count($datos) - 1]);
					if($lectura->buscar_similitud("SELECT COUNT(ID_Criterio) AS Total FROM Criterio WHERE Descripcion LIKE '".$datos[0]."' AND Fecha LIKE '".$fecha_inicial."' AND FK_Usuario = ".$_SESSION["Usuario_Temporal"]) == 0)
					{
						$maximo = $conexion->Consultas("SELECT MAX(Etiqueta_Copei) as Max FROM Criterio WHERE FK_Usuario = ".$_SESSION["Usuario_Temporal"]);			
						$maximo = $maximo[0]["Max"] + 1;
						$conexion->Guardar("INSERT INTO Criterio (Descripcion, Fecha, FK_Usuario, Etiqueta_Copei) values ('".$datos[0]."', '".$fecha_inicial."', '".$_SESSION["Usuario_Temporal"]."', ".$maximo.")");
						$conexion->Guardar("CALL Etiqueta_Criterio_Editar_SP(".$conexion->identificador.", ".$etiqueta.")");
						$lectura->errores .= ($conexion->error == "") ? "El producto ".$lectura->producto." se almaceno correctamente\n" : $conexion->error;
					}
				}
			}
			else
				$lectura->errores .= "El producto ".$lectura->producto." no cuenta con todos los campos\n";	
		}
		if($x == -1)
			break;
	}
	echo $lectura->errores;
?>
