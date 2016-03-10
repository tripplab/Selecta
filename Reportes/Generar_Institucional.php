<?php      
	include "../Scripts/query.php"; 
	include "./Generar.php"; 
	$conexion = new Querys();
	
	$pdf=new PDF();
	$pdf->AddPage();
	
	$ids = trim($_GET["us"], ",");
	$fecha_inicial = $_GET["i"];
	$fecha_final = $_GET["f"];
	if($fecha_inicial == "Año-Mes-Día")
		$fecha_inicial = "0000-00-00";
	if($fecha_final == "Año-Mes-Día")
		$fecha_final = "2050-01-01";
	$ids = explode(",", $ids);
	$users = array();
	$departamento = array();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('Liderazgo Científico y Tecnológico'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('a. Investigadores Cinvestav'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('a) Investigadores Cinvestav'), 0, 0, 'L');
	$pdf->Ln();
	for($x = 0; $x < count($ids); $x++)
	{
		$nombre = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, FK_Unidad, FK_Departamento FROM Usuario, Unidad_Departamento WHERE FK_Unidad_Departamento = ID_Unidad_Departamento AND ID_Usuario = ".$ids[$x]);
		$users[$x] = substr($nombre[0]["Nombre"], 0, 1).substr($nombre[0]["Apellido_Paterno"], 0, 1).substr($nombre[0]["Apellido_Materno"], 0, 1);
		if($nombre[0]["FK_Departamento"] == null)
		{
			$unidad = $conexion->Consultas("SELECT Abreviacion FROM Unidad WHERE ID_Unidad = ".$nombre[0]["FK_Unidad"]);
			$departamento[$x] = $unidad[0]["Abreviacion"];
		}
		else
		{
			$unidad = $conexion->Consultas("SELECT Nombre FROM Departamento WHERE ID_Departamento = ".$nombre[0]["FK_Departamento"]);
			$departamento[$x] = $unidad[0]["Nombre"];
		}
		$pdf->Cell(15,5, "", 0, 0, 'L');
		$pdf->Cell(0,5, utf8_decode($nombre[0]["Nombre"])." ".utf8_decode($nombre[0]["Apellido_Paterno"])."-".utf8_decode($nombre[0]["Apellido_Materno"])." (".$users[$x].")", 0, 0, 'L');
		$pdf->Ln();
	}
	$pdf->Ln();
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('b) Membresía en el Sistema Nacional de Investigadores (SNI)'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_5(25, 40, "",20, "NIVEL I", 20, "NIVEL II", 20, "NIVEL III", 40, "NO PERTENECE");
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$sni = $conexion->Consultas("SELECT Nivel FROM SNI WHERE FK_Usuario = ".$ids[$x]);
		if(count($sni) > 0)
		{
			if($sni[count($sni) - 1]["Nivel"] == 1)
				$pdf->tabla_5(25, 40, $users[$x],20, "X", 20, "", 20, "", 40, "");
			else if($sni[count($sni) - 1]["Nivel"] == 2)
				$pdf->tabla_5(25, 40, $users[$x],20, "", 20, "X", 20, "", 40, "");
			else if($sni[count($sni) - 1]["Nivel"] == 3)
				$pdf->tabla_5(25, 40, $users[$x],20, "", 20, "", 20, "X", 40, "");
		}
		else
			$pdf->tabla_5(25, 40, $users[$x],20, "", 20, "", 20, "", 40, "X");
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('c) Promociones de categoría'), 0, 0, 'L');
	$pdf->Ln();
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Categoria, Subcategoria FROM Categoria WHERE FK_Usuario = ".$ids[$x]." AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		if(count($consulta) > 0)
		{
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, utf8_decode("Promoción de ").$users[$x].utf8_decode(", Categoría ").$consulta[0]["Categoria"]."-".$consulta[0]["Subcategoria"], 0, 0, 'L');
			$pdf->Ln();
		}
	}
	
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('d) Estancias de Investigadores en el Cinvestav Irapuato (posdoctorados / sabáticos)'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_4(5, 50, utf8_decode("Estancias Posdoctorales* y Sabáticas** activas"), 27, 40, "Fuente de Financiamiento", 22, 45, utf8_decode("Investigador Anfitrión"), 27, 40, "Departamento", 22);
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT FK_Laboratorio FROM Lab_Miembro WHERE FK_Usuario = ".$ids[$x]." AND Responsable = 1");
		if(count($consulta) > 0)
		{
			$consulta1 = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, Fuente_Financiamiento FROM Usuario, Lab_Miembro, Comision WHERE ID_Usuario = Lab_Miembro.FK_Usuario AND Usuario.Rol LIKE 'Posdoc%' AND ID_Usuario = Comision.FK_Usuario AND FK_Laboratorio = ".$consulta[0]["FK_Laboratorio"]." AND ID_Usuario <> ".$ids[$x]." AND Comision.Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."') AND Lab_Miembro.Fecha_Final = '0000-00-00'");
			for($y = 0; $y < count($consulta1); $y++)
				$pdf->tabla_4(5, 50, utf8_decode($consulta1[$y]["Nombre"])." ".utf8_decode($consulta1[$y]["Apellido_Paterno"])."-".utf8_decode($consulta1[$y]["Apellido_Materno"]), 27, 40, utf8_decode($consulta1[$y]["Fuente_Financiamiento"]), 22, 45, $users[$x], 27, 40, "LANGEBIO", 22);
			$consulta1 = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, Fuente_Financiamiento FROM Usuario, Lab_Miembro, Comision WHERE ID_Usuario = Lab_Miembro.FK_Usuario AND Tipo_Comision LIKE 'Sabatico' AND ID_Usuario = Comision.FK_Usuario AND FK_Laboratorio = ".$consulta[0]["FK_Laboratorio"]." AND ID_Usuario <> ".$ids[$x]." AND Comision.Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."') AND Lab_Miembro.Fecha_Final = '0000-00-00'");
			for($y = 0; $y < count($consulta1); $y++)
				$pdf->tabla_4(5, 50, utf8_decode($consulta1[$y]["Nombre"])." ".utf8_decode($consulta1[$y]["Apellido_Paterno"])."-".utf8_decode($consulta1[$y]["Apellido_Materno"]), 27, 40, utf8_decode($consulta1[$y]["Fuente_Financiamiento"]), 22, 45, $users[$x], 27, 40, $departamento[$x], 22);
		}
	}
	
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('e. Investigadores en receso sabático'), 0, 0, 'L');
	$pdf->Ln();
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT ID_Comision FROM Comision WHERE FK_Usuario = ".$ids[$x]." AND Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		if(count($consulta) > 0)
		{
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, $users[$x], 0, 0, 'L');
			$pdf->Ln();
		}
	}
	$pdf->Ln();
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('f. Distinciones y Reconocimientos (aquí se pueden incluir los ').'"Grants")', 0, 0, 'L');
	$pdf->Ln();
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Congreso_Discutido_Estu_Miemb_Otorga_Respon FROM Repercusion, Tipo_Copei WHERE FK_Usuario = ".$ids[$x]." AND Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."') AND FK_Tipo = ID_Tipo AND Tipo = '4.11'");
		for($x = 0; $x < count($consulta); $x++)
		{
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, $consulta[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"].". Otorgado a ".$users[$x], 0, 0, 'L');
			$pdf->Ln();
		}
	}
	$pdf->Ln();
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('g. Participación en Comisiones y Comités de Evaluación'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('g.i Comisiones dictaminadoras del SNI'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_2(30, 60, utf8_decode("Comisión"), 33, 60, "Investigador", 33);
	$pdf->SetFont('Arial', '', 10);
	$comite = $conexion->Consultas("SELECT ID_Comite FROM Comite WHERE Tipo LIKE 'g.i %'");
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Comite FROM Usuario_Comite WHERE FK_Usuario = ".$ids[$x]." AND FK_Comite = ".$comite[0]["ID_Comite"]." AND Fecha_Inicio BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_2(30, 60, utf8_decode($consulta[$y]["Nombre_Comite"]), 33, 60, $users[$x], 33);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('g.ii Comisiones de evaluación de los Fondos Sectoriales'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_3(18, 50, utf8_decode("Comisión"), 28, 50, "Investigador", 28, 50, "Departamento", 28);
	$pdf->SetFont('Arial', '', 10);
	$comite = $conexion->Consultas("SELECT ID_Comite FROM Comite WHERE Tipo LIKE 'g.ii %'");
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Comite FROM Usuario_Comite WHERE FK_Usuario = ".$ids[$x]." AND FK_Comite = ".$comite[0]["ID_Comite"]." AND Fecha_Inicio BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_3(18, 50,  utf8_decode($consulta[$y]["Nombre_Comite"]), 28, 50, $users[$x], 28, 50, $departamento[$x], 28);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('g.iii Comisiones de evaluación de los Fondos Mixtos'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_2(30, 60, "Investigador", 33, 60, utf8_decode("Comisión"), 33);
	$pdf->SetFont('Arial', '', 10);
	$comite = $conexion->Consultas("SELECT ID_Comite FROM Comite WHERE Tipo LIKE 'g.iii %'");
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Comite FROM Usuario_Comite WHERE FK_Usuario = ".$ids[$x]." AND FK_Comite = ".$comite[0]["ID_Comite"]." AND Fecha_Inicio BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_2(30, 60, $users[$x], 33, 60, utf8_decode($consulta[$y]["Nombre_Comite"]), 33);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('g.iv Comités y Comisiones de evaluación de otros programas Conacyt'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_3(18, 60, utf8_decode("Área"), 33, 45, "Investigador", 26, 45, "Departamento", 26);
	$pdf->SetFont('Arial', '', 10);
	$comite = $conexion->Consultas("SELECT ID_Comite FROM Comite WHERE Tipo LIKE 'g.iv %'");
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Comite FROM Usuario_Comite WHERE FK_Usuario = ".$ids[$x]." AND FK_Comite = ".$comite[0]["ID_Comite"]." AND Fecha_Inicio BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_3(18, 60,  utf8_decode($consulta[$y]["Nombre_Comite"]), 33, 45, $users[$x], 26, 45, $departamento[$x], 26);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('g.v Participación de investigadores Cinvestav en otros comités.'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_3(18, 50, utf8_decode("Comité"), 28, 50, "Investigador", 28, 50, "Departamento", 28);
	$pdf->SetFont('Arial', '', 10);
	$comite = $conexion->Consultas("SELECT ID_Comite FROM Comite WHERE Tipo LIKE 'g.v %'");
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Comite FROM Usuario_Comite WHERE FK_Usuario = ".$ids[$x]." AND FK_Comite = ".$comite[0]["ID_Comite"]." AND Fecha_Inicio BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_3(18, 50, utf8_decode($consulta[$y]["Nombre_Comite"]), 28, 50, $users[$x], 28, 50, $departamento[$x], 28);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('g.vi Investigadores integrantes de las comisiones internas'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_2(19, 75, utf8_decode("Área"), 33, 75, "Investigador", 33);
	$pdf->SetFont('Arial', '', 10);
	$comite = $conexion->Consultas("SELECT ID_Comite FROM Comite WHERE Tipo LIKE 'g.vi %'");
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Comite FROM Usuario_Comite WHERE FK_Usuario = ".$ids[$x]." AND FK_Comite = ".$comite[0]["ID_Comite"]." AND Fecha_Inicio BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_2(19, 75, utf8_decode($consulta[$y]["Nombre_Comite"]), 37, 75, $users[$x], 37);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$nac = 0;
	$inter = 0;
	$memorias = 0;
	$capitulos = 0;
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Count(Pais) AS NAC FROM Articulos, Alias, Tipo_Copei, Journal WHERE FK_Usuario = ".$ids[$x]." AND FK_Articulo = ID_Articulo AND FK_Tipo = ID_Tipo AND Tipo LIKE '2.1.A' AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."') AND FK_Journal = ID_Journal AND Pais LIKE '%Mexic%'");
		$nac += $consulta[0]["NAC"];
		$consulta = $conexion->Consultas("SELECT Count(Pais) AS INTER FROM Articulos, Alias, Tipo_Copei, Journal WHERE FK_Usuario = ".$ids[$x]." AND FK_Articulo = ID_Articulo AND FK_Tipo = ID_Tipo AND Tipo LIKE '2.1.A' AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."') AND FK_Journal = ID_Journal AND Pais NOT LIKE '%Mexic%'");
		$inter += $consulta[0]["INTER"];
		$consulta = $conexion->Consultas("SELECT Count(ID_Articulo) AS memoria FROM Articulos, Alias, Tipo_Copei WHERE FK_Usuario = ".$ids[$x]." AND FK_Articulo = ID_Articulo AND FK_Tipo = ID_Tipo AND Tipo LIKE '2.1.g' AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		$memorias += $consulta[0]["memoria"];
		$consulta = $conexion->Consultas("SELECT Count(ID_Articulo) AS capitulo FROM Articulos, Alias, Tipo_Copei WHERE FK_Usuario = ".$ids[$x]." AND FK_Articulo = ID_Articulo AND FK_Tipo = ID_Tipo AND Tipo LIKE '2.3' AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		$capitulos += $consulta[0]["capitulo"];
	}
	$pdf->Ln();
	$pdf->Cell(0,10, utf8_decode('Producción Científica'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_2(19, 65, utf8_decode("Productividad Académica"), 34, 40, "Langebio", 20);
	$pdf->SetFont('Arial', '', 10);
	$pdf->tabla_2(19, 65, utf8_decode("a. Artículos"), 40, 40, "", 20);
	$pdf->tabla_2(19, 65, "  Publicaciones en revistas nacionales", 40, 40, $nac, 20);
	$pdf->tabla_2(19, 65, "  Publicaciones en revistas internacionales", 40, 40, $inter, 20);
	$pdf->tabla_2(19, 65, "b. Memorias en Congresos nacionales e Internacionales", 40, 40, $memorias, 20);
	$pdf->tabla_2(19, 65, utf8_decode("c. Capítulos de libros"), 40, 40, $capitulos, 20);
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, 'Posgrado', 0, 0, 'L');	
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, 'a.- alumnos atendidos', 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, 'b.- cursos de posgrado impartidos', 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, 'c.- estudiantes extranjeros', 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, 'd.- Maestros en Ciencias y doctores en ciencias graduados', 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, 'e.- Becas y apoyos de estudios otorgados', 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, 'f.1. Apoyos complementarios otorgados por el Cinvestav', 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, 'g.2.Becas aprobadas por el Conacyt', 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('Intercambio académico y cooperación científica y tecnológica'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(20,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('a. Asistencia a eventos científicos y tecnológicos'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_3(18, 50, "Evento", 28, 50, "Participantes", 28, 50, "Objetivo", 28);
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Motivo, Objetivos FROM Comision WHERE Tipo_Comision LIKE 'Intercambio' AND FK_Usuario = ".$ids[$x]." AND Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_3(18, 50, utf8_decode($consulta[$y]["Motivo"]), 28, 50, $users[$x], 28, 50, utf8_decode($consulta[$y]["Objetivos"]), 28);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(20,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('b. Convenios de colaboración académica, científica y tecnológica.'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(18,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('b.i Instituciones internacionales'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_3(15, 30, utf8_decode("Nombre de la Institución"), 15, 50, "Nombre del proyecto y especificar si existe un convenio  firmado", 28, 40, "Responsable", 20);
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Proyecto, Convenio_Firmado, Nombre_Institucion FROM Convenios WHERE FK_Usuario = ".$ids[$x]." AND Nac_Inter = 1 AND Fecha_Inicio BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_3(15, 30, utf8_decode($consulta[$y]["Nombre_Institucion"]), 15, 50, utf8_decode($consulta[$y]["Nombre_Proyecto"]).". ".(($consulta[$y]["Convenio_Firmado"] == 1) ? "Si existe convenio" : "No existe convenio"), 28, 40, $users[$x], 28);
	}
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(18,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, utf8_decode('b.ii Instituciones nacionales'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_3(15, 30, utf8_decode("Nombre de la Institución"), 15, 50, "Nombre del proyecto y especificar si existe un convenio  firmado", 28, 40, "Responsable", 20);
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Proyecto, Convenio_Firmado, Nombre_Institucion FROM Convenios WHERE FK_Usuario = ".$ids[$x]." AND Nac_Inter = 0 AND Fecha_Inicio BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_3(15, 30, utf8_decode($consulta[$y]["Nombre_Institucion"]), 15, 50, utf8_decode($consulta[$y]["Nombre_Proyecto"]).". ".(($consulta[$y]["Convenio_Firmado"] == 1) ? "Si existe convenio" : "No existe convenio"), 28, 40, $users[$x], 28);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('Gestión tecnológica y vinculación con la industria e Instituciones'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(20,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, "a. Proyectos", 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(20,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, "b. Servicios de Laboratorio", 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(60, 4, "", 0, 0, 'L');
	$pdf->Cell(65, 4, "SERVICIOS DE LABORATORIO", "B", 0, 'L');
	$pdf->Ln();
	$pdf->Cell(60, 4, "", 0, 0, 'L');
	$pdf->Cell(65, 4, "", "T", 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_4(15, 30, utf8_decode("Nombre de la Institución"), 15, 50, "Servicio", 25, 50, "Objetivo", 25, 30, "Responsable", 15);
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Servicio, Objetivo, Institucion FROM Servicios_Laboratorio WHERE FK_Usuario = ".$ids[$x]." AND Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_4(15, 30, utf8_decode($consulta[$y]["Institucion"]), 15, 50, utf8_decode($consulta[$y]["Servicio"]), 25, 50, utf8_decode($consulta[$y]["Objetivo"]), 25, 30, $users[$x], 15);
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, 'e) Patentes y propiedad intelectual', 0, 0, 'L');
	$pdf->Ln();
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Titulo FROM Articulos, Alias, Tipo_Copei WHERE FK_Usuario = ".$ids[$x]." AND ID_Articulo = FK_Articulo AND FK_Tipo = ID_Tipo AND Tipo LIKE '2.8.%' AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
		{
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, $consulta[$y]["Titulo"].". Patentado por ".$users[$x], 0, 0, 'L');
			$pdf->Ln();
		}
	}
	$pdf->Ln();
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, "f. Cursos a terceros", 0, 0, 'L');
	$pdf->Ln();
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Curso.Nombre, Nombre_Programa, Total_Horas FROM Formacion_Curso, Curso, Programa_Unidad, Programa_Academico, Tipo_Copei WHERE FK_Curso = ID_Curso AND Curso.FK_Programa = Programa_Unidad.ID_Programa_Unidad AND Programa_Unidad.FK_Programa = ID_Programa AND FK_Usuario = ".$ids[$x]." AND FK_Tipo = ID_Tipo AND Tipo LIKE '3.1.c' AND Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
		{
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, "Investigador: ".$users[$x], 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, "Curso: ".utf8_decode($consulta[$y]["Nombre"]), 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, "Programa: ".utf8_decode($consulta[$y]["Nombre_Programa"]), 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, "Total de horas: ".utf8_decode($consulta[$y]["Total_Horas"]), 0, 0, 'L');
			$pdf->Ln();
			$pdf->Ln();
		}
	}
	$pdf->Ln();
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode("g. Asesorías"), 0, 0, 'L');
	$pdf->Ln();
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Curso.Nombre, Nombre_Programa, Total_Horas FROM Formacion_Curso, Curso, Programa_Unidad, Programa_Academico WHERE FK_Curso = ID_Curso AND Curso.FK_Programa = Programa_Unidad.ID_Programa_Unidad AND Programa_Unidad.FK_Programa = ID_Programa AND FK_Usuario = ".$ids[$x]." AND FK_Tipo IS NULL AND Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."') ");
		for($y = 0; $y < count($consulta); $y++)
		{
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, "Investigador: ".$users[$x], 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, "Curso: ".utf8_decode($consulta[$y]["Nombre"]), 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, "Programa: ".utf8_decode($consulta[$y]["Nombre_Programa"]), 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, "Total de horas: ".utf8_decode($consulta[$y]["Total_Horas"]), 0, 0, 'L');
			$pdf->Ln();
			$pdf->Ln();
		}
	}
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(15,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('Difusión, divulgación científica y tecnológica'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(20,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('a. Eventos académicos, científicos, tecnológicos y culturales'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_3(15, 45, "Evento", 23, 50, "Participantes", 25, 65, "Objetivo", 32);
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Evento, Objetivos FROM Difusion_Divulgacion WHERE FK_Usuario = ".$ids[$x]."  AND Fecha_Inicial BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
			$pdf->tabla_3(15, 45, utf8_decode($consulta[$y]["Evento"]), 28, 50, $users[$x], 25, 65, utf8_decode($consulta[$y]["Objetivos"]), 32);
	}	
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(20,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, utf8_decode("b. Visitas académicas y otros visitantes"), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, utf8_decode("Se recibieron y atendieron por parte del Langebio las siguientes visitas"), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_4(15, 20, "Fecha", 10, 60, "Nombre del visitante", 30, 40, "Objetivo de visita", 20, 40, utf8_decode("Profesor Anfitrión"), 20);
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Nombre_Visitante, Objetivo, Fecha FROM Visitas_Academicas WHERE FK_Usuario = ".$ids[$x]."  AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
		{
			$fecha = explode("-", $consulta[$y]["Fecha"]);
			$pdf->tabla_4(15, 20, $fecha[2]."/".$fecha[1]."/".$fecha[0],11 , 60, utf8_decode($consulta[$y]["Nombre_Visitante"]), 30, 40, utf8_decode($consulta[$y]["Objetivo"]), 20, 40, $users[$x], 20);
		}
	}	
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, "Medios", 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->tabla_4(15, 20, "Fecha", 10, 50, "Reportero/Medio", 25, 45, "Entrevistado", 22, 45, utf8_decode("Tema/Título"), 22);
	$pdf->SetFont('Arial', '', 10);
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Reportero_Medio, Tema, Fecha FROM Medios WHERE FK_Usuario = ".$ids[$x]."  AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
		{
			$fecha = explode("-", $consulta[$y]["Fecha"]);
			$pdf->tabla_4(15, 20, $fecha[2]."/".$fecha[1]."/".$fecha[0],11 , 50, utf8_decode($consulta[$y]["Reportero_Medio"]), 25, 45, $users[$x], 22, 45, utf8_decode($consulta[$y]["Tema"]), 22);
		}
	}	
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->Cell(0,5, "LOGROS", 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(15,5, "", 0, 0, 'L');
	$pdf->MultiCell(0,5, utf8_decode("Favor de reportar los hechos más sobresalientes, logros obtenidos, y cumplimiento de metas durante el semestre que se está reportando."), 0, 'L');
	for($x = 0; $x < count($ids); $x++)
	{
		$consulta = $conexion->Consultas("SELECT Descripcion FROM Criterio WHERE FK_Usuario = ".$ids[$x]."  AND Fecha BETWEEN DATE('".$fecha_inicial."') AND DATE('".$fecha_final."')");
		for($y = 0; $y < count($consulta); $y++)
		{
			$pdf->Cell(15,5, "", 0, 0, 'L');
			$pdf->Cell(0,5, utf8_decode($consulta[$y]["Descripcion"]), 0, 0, 'L');
			$pdf->Ln();
		}
	}	
	$pdf->Output('Reporte_Institucional.pdf', 'I'); 
?>
