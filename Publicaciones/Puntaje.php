<?php
	session_start();
	include '../Scripts/query.php';
	$conexion = new Querys();
	date_default_timezone_set('UTC');
	
	$tipo_copei = $conexion->Consultas("SELECT ID_Tipo, Tipo, Descripcion, Puntuacion_Min, Puntuacion_Max FROM Tipo_Copei");
	$puntaje_antecedentes_min = 0;
	$puntaje_antecedentes_max = 0;
	$puntaje_publicaciones_min = 0;
	$puntaje_publicaciones_max = 0;
	$puntaje_curso_min = 0;
	$puntaje_curso_max = 0;
	for($x = 0; $x < count($tipo_copei); $x++)
	{
		$tipo = explode(".", $tipo_copei[$x]["Tipo"]);
		if($tipo_copei[$x]["Tipo"] == "1.1")
		{
			$producto = $conexion->Consultas("SELECT COUNT(ID_Escolaridad) AS Total FROM Escolaridad WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Grado LIKE '%Doctorado%'");
			$puntaje_antecedentes_max += ($tipo_copei[$x]["Puntuacion_Max"] * $producto[0]["Total"]);
		}
		else if($tipo_copei[$x]["Tipo"] == "1.2")
		{
			$total = 0;
			$producto = $conexion->Consultas("SELECT Fecha_Inicial, Fecha_Final FROM Experiencia WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Estancia = 1");
			for($y = 0; $y < count($producto); $y++)
			{
				$datetime1 = date_create($producto[$y]["Fecha_Inicial"]);
				$datetime2 = date_create($producto[$y]["Fecha_Final"]);
				$inicial = explode("-", $producto[$y]["Fecha_Inicial"]);
				$final = explode("-", $producto[$y]["Fecha_Final"]);	
				$interval = date_diff($datetime1, $datetime2);
				$total += ($interval->format('%Y') * $tipo_copei[$x]["Puntuacion_Max"]);
			}
			$puntaje_antecedentes_max += ($total < 4.5) ? $total : 4.5;
		}
		else if(count($tipo) > 1 && $tipo[0] == "2" && $tipo[1] != "6")
		{
			$producto = $conexion->Consultas("SELECT COUNT(ID_Articulo) AS Total FROM Articulos, Alias WHERE ID_Articulo = FK_Articulo AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND Estado not in ('Preparacion', 'Enviado',' ') AND FK_Tipo = ".$tipo_copei[$x]["ID_Tipo"]);
			$puntaje_publicaciones_min += ($tipo_copei[$x]["Puntuacion_Min"] * $producto[0]["Total"]);
			$puntaje_publicaciones_max += ($tipo_copei[$x]["Puntuacion_Max"] * $producto[0]["Total"]);
		}
		else if(count($tipo) > 1 && $tipo[0] == "2" && $tipo[1] == "6")
		{
			$tipo = array("2.1.a","2.1.b","2.1.c","2.1.d","2.1.e","2.1.f","2.1.g","2.2","2.3","2.4","2.5","2.7.a","2.7.b","2.7.c","2.7.d","2.7.e","2.7.f","2.8.a","2.8.b","2.8.c","2.8.d","2.8.e","2.8.f","2.9","2.10.a","2.10.b","2.10.c","2.11.a","2.11.b","2.11.c","2.12.a","2.12.b","2.12.c","2.12.d");
			for($y = 0; $y < count($tipo); $y++)
			{
				$copei = $conexion->Consultas("SELECT ID_Tipo, Puntuacion_Min, Puntuacion_Max FROM Tipo_Copei WHERE Tipo LIKE '".$tipo[$y]."'");
				$producto = $conexion->Consultas("SELECT COUNT(ID_Articulo) AS Total FROM Articulos, Alias WHERE ID_Articulo = FK_Articulo AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo = ".$tipo_copei[$x]["ID_Tipo"]."  AND Estado not in ('Preparacion', 'Enviado',' ') AND FK_Tesis IS NOT NULL");
				$puntaje_publicaciones_min += ($copei[0]["Puntuacion_Min"] * $producto[0]["Total"]);
				$puntaje_publicaciones_max += ($copei[0]["Puntuacion_Max"] * $producto[0]["Total"]);
			}			
		}
		else if(count($tipo) > 1 && $tipo[0] == "3" && $tipo[1] == "1")
		{
			$producto = $conexion->Consultas("SELECT Total_Horas FROM Formacion_Curso WHERE FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo = ".$tipo_copei[$x]["ID_Tipo"]);
			for($y = 0; $y < count($producto); $y++)
				$puntaje_curso_max += ($producto[$y]["Total_Horas"] * $tipo_copei[$x]["Puntuacion_Max"]);
		}
		else if($tipo[0] == "3")
		{
			$producto = $conexion->Consultas("SELECT ID_Tesis FROM Tesis, Usuario_Tesis WHERE FK_Tesis = ID_Tesis AND FK_Usuario = ".$_SESSION['Usuario_Temporal']." AND FK_Tipo = ".$tipo_copei[$x]["ID_Tipo"]." AND Concluida = 1");
			for($y = 0; $y < count($producto); $y++)
			{
				$autores = $conexion->Consultas("SELECT COUNT(ID_Usuario_Tesis) AS Total FROM Usuario_Tesis WHERE FK_Tesis = ".$producto[$y]["ID_Tesis"]." AND Estudiante = 1");
				$puntaje_curso_max += ($tipo_copei[$x]["Puntuacion_Max"] / $autores[0]["Total"]);
			}
		}
	}
	$datos["puntaje_antecedentes_max"] = $puntaje_antecedentes_max;
	$datos["puntaje_publicaciones_min"] = $puntaje_publicaciones_min;
	$datos["puntaje_publicaciones_max"] = $puntaje_publicaciones_max;
	$datos["puntaje_curso_max"] = $puntaje_curso_max;
	$datos["puntaje_total_min"] = $puntaje_antecedentes_min + $puntaje_publicaciones_min + $puntaje_curso_min;
	$datos["puntaje_total_max"] = $puntaje_antecedentes_max + $puntaje_publicaciones_max + $puntaje_curso_max;
	echo json_encode($datos);
?>
