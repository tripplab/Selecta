<?php
	include "../Scripts/query.php";
	include "../fpdf/fpdf.php"; 
	$conexion = new Querys();
	
	$id = $_GET["i"];
	$comision = $conexion->Consultas("SELECT ID_Usuario, Tipo_Comision, Motivo, Objetivos, Lugar, Fuente_Transporte, Monto_Transporte, Fuente_Viatico, Monto_Viatico, Fuente_Otros, Monto_Otros, Fuente_Financiamiento, Responsable, Comision.Fecha_Inicial, Comision.Fecha_Final, Fecha_Solicitud, Usuario.Nombre AS Nombre, Apellido_Paterno, Apellido_Materno, Unidad.Nombre AS Unidad, Abreviacion FROM Comision, Usuario, Unidad_Departamento, Unidad WHERE FK_Usuario = ID_Usuario AND FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ID_Unidad AND ID_Comision = ".$id);
	$comision = $comision[0];
	$pdf=new FPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Image('Langebio.jpg', 165, 20, 18);
	$pdf->SetY(32);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(10, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, utf8_decode('CENTRO DE INVESTIGACIÓN Y DE ESTUDIOS AVANZADOS DEL I.P.N.'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, utf8_decode((($comision["Abreviacion"] != "") ? $comision["Abreviacion"] : $comision["Unidad"])), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, utf8_decode("SOLICITUD DE COMISIÓN ").strtoupper($comision["Tipo_Comision"]), 0, 0, 'L');
	$pdf->SetY(63);
	$pdf->SetFont('Arial', 'I', 11);
	$pdf->Cell(125, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, utf8_decode("Elaboró: ").substr($comision["Nombre"], 0, 1).substr($comision["Apellido_Paterno"], 0, 1).substr($comision["Apellido_Materno"], 0, 1), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$fecha = explode("-", $comision["Fecha_Solicitud"]);
	$pdf->Cell(15, 5, "Fecha: ".$fecha[2]."/".$fecha[1]."/".$fecha[0], 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(10, 7, "", 0, 0, 'L');
	$pdf->Cell(120, 7, "NOMBRE: ".utf8_decode($comision["Nombre"]." ".$comision["Apellido_Paterno"]." ".$comision["Apellido_Materno"]), 0, 0, 'L');
	$pdf->Cell(15, 7, "FIRMA:", 0, 0, 'L');
	$pdf->Cell(30, 6, "", "B", 0, 'L');
	/*****************************SOLO NACIONAL******************************************/
	if($comision["Tipo_Comision"] == "Nacional")
	{
		$categoria = $conexion->Consultas("SELECT Puesto FROM Categoria WHERE FK_Usuario = ".$comision["ID_Usuario"]." ORDER BY Fecha");
		if(count($categoria) > 0)
		{
			$pdf->Ln();
			$pdf->Cell(10, 6, "", 0, 0, 'L');
			$pdf->Cell(0, 6, "CATEGORIA: ".$categoria[count($categoria) - 1]["Puesto"], 0, 0, 'L');
		}
	}
	/************************************************************************************/
	$pdf->Ln();
	$pdf->Cell(10, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, "DEPARTAMENTO: ".utf8_decode(($comision["Abreviacion"] != "") ? $comision["Abreviacion"] : $comision["Unidad"]), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->MultiCell(0, 5, utf8_decode("MOTIVO DE LA COMISIÓN: ".$comision["Motivo"].". ".$comision["Objetivos"]), 0, 'L');
	$pdf->Cell(10, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, "LUGAR: ".utf8_decode($comision["Lugar"]), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, utf8_decode("FECHAS DE INICIO Y TÉRMINO:"), 0, 0, 'L');
	$pdf->Ln();
	$fecha_inicial = explode("-", $comision["Fecha_Inicial"]);
	$fecha_final = explode("-", $comision["Fecha_Final"]);
	$pdf->Cell(10, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, $fecha_inicial[2]."/".$fecha_inicial[1]."/".$fecha_inicial[0]." - ".$fecha_final[2]."/".$fecha_final[1]."/".$fecha_final[0], 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 6, "", 0, 0, 'L');
	$pdf->Cell(0, 6, "FUENTE DE FINANCIAMIENTO:", 0, 0, 'L');
	$pdf->Ln();
	/*****************************SOLO NACIONAL******************************************/
	if($comision["Tipo_Comision"] == "Nacional" && ($categoria) > 0)
		$pdf->SetY(135);
	/************************************************************************************/
	$pdf->SetFont('Arial', 'BI', 11);
	$pdf->Cell(35, 6, "", 0, 0, 'L');
	$pdf->Cell(30, 6, "CONCEPTO", "TLR", 0, 'L');
	$pdf->Cell(65, 6, "FUENTE DE FINANCIAMIENTO", "TLR", 0, 'L');
	$pdf->Cell(30, 6, "MONTO", "TLR", 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', 'BI', 8);
	$pdf->Cell(35, 3, "", 0, 0, 'L');
	$pdf->Cell(30, 3, "", "LR", 0, 'L');
	$pdf->Cell(65, 3, "(proyecto/gastos de profesor", "LR", 0, 'L');
	$pdf->Cell(30, 3, "(importe en M.N)", "LR", 0, 'L');
	$pdf->Ln();
	$pdf->Cell(35, 6, "", 0, 0, 'L');
	$pdf->Cell(30, 6, "", "BLR", 0, 'L');
	$pdf->Cell(65, 6, "cinvestav )", "BLR", 0, 'L');
	$pdf->Cell(30, 6, "", "BLR", 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 11);
	$pdf->Cell(35, 6, "", 0, 0, 'L');
	$pdf->Cell(30, 6, "Transporte", "BLR", 0, 'L');
	$pdf->Cell(65, 6, utf8_decode($comision["Fuente_Transporte"]), "BLR", 0, 'L');
	$pdf->Cell(30, 6, $comision["Monto_Transporte"], "BLR", 0, 'L');
	$pdf->Ln();
	$pdf->Cell(35, 6, "", 0, 0, 'L');
	$pdf->Cell(30, 6, utf8_decode("Viáticos"), "BLR", 0, 'L');
	$pdf->Cell(65, 6, utf8_decode($comision["Fuente_Viatico"]), "BLR", 0, 'L');
	$pdf->Cell(30, 6, $comision["Monto_Viatico"], "BLR", 0, 'L');
	$pdf->Ln();
	$pdf->Cell(35, 6, "", 0, 0, 'L');
	$pdf->Cell(30, 6, "Otros", "BLR", 0, 'L');
	$pdf->Cell(65, 6, utf8_decode($comision["Fuente_Otros"]), "BLR", 0, 'L');
	$pdf->Cell(30, 6, $comision["Monto_Otros"], "BLR", 0, 'L');
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(35, 6, "", 0, 0, 'L');
	$pdf->Cell(30, 6, "TOTAL:", "BLR", 0, 'L');
	$pdf->Cell(65, 6, "", "BLR", 0, 'L');
	$pdf->Cell(30, 6, ($comision["Monto_Transporte"] + $comision["Monto_Viatico"] + $comision["Monto_Otros"]), "BLR", 0, 'L');
	/***************************************FUENTE DE FINANCIAMIENTO***********************************************/
	if($comision["Fuente_Financiamiento"] != "" && $comision["Responsable"] != "")
	{ 
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(10, 5, "", 0, 0, 'L');
		$pdf->Cell(170, 6, "NOMBRE DE LA FUENTE DE FINANCIAMIENTO", "TBLR", 0, 'C');
		$pdf->Ln();
		$pdf->Cell(10, 5, "", 0, 0, 'L');
		$pdf->Cell(170, 6, utf8_decode($comision["Fuente_Financiamiento"]), "BLR", 0, 'L');
		$pdf->Ln();
		$pdf->Cell(10, 5, "", 0, 0, 'L');
		$pdf->Cell(170, 6, utf8_decode("AUTORIZACIÓN: NOMBRE Y FIRMA DEL PROFESOR RESPONSABLE DEL PRESUPUESTO."), "BLR", 0, 'C');	
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 11);
		$pdf->Cell(10, 5, "", 0, 0, 'L');
		$pdf->Cell(115, 6, "Nombre del Responsable del Presupuesto:", "L", 0, 'L');
		$pdf->Cell(55, 6, "Firma:", "R", 0, 'L');	
		$pdf->Ln();
		$pdf->Cell(10, 5, "", 0, 0, 'L');
		$pdf->Cell(115, 6, utf8_decode($comision["Responsable"]), "L", 0, 'L');
		$pdf->Cell(55, 6, "", "R", 0, 'L');		
		$pdf->Ln();
		$pdf->Cell(10, 5, "", 0, 0, 'L');
		$pdf->Cell(115, 6, "", "BL", 0, 'L');
		$pdf->Cell(55, 6, "", "RB", 0, 'L');	
	}
	/***************************************************************************************************************/
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(0, 5, utf8_decode("AUTORIZACIÓN"), 0, 0, 'C');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$margen = ($comision["Tipo_Comision"] == "Internacional") ? 10 : 65;
	$pdf->Cell($margen, 5, "", 0, 0, 'L');
	$pdf->Cell(60, 6, "", "B", 0, 'L');
	/******************************SOLO INTERNACIONAL******************************************/
	if($comision["Tipo_Comision"] == "Internacional")
	{
		$pdf->Cell(40, 5, "", 0, 0, 'L');
		$pdf->Cell(60, 6, "", "B", 0, 'L');
	}
	/****************************************************************************************/
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell($margen, 5, "", 0, 0, 'L');
	$pdf->Cell(60, 5, "Dr. Luis Rafael Herrera Estrella", 0, 0, 'L');
	/******************************SOLO INTERNACIONAL******************************************/
	if($comision["Tipo_Comision"] == "Internacional")
	{
		$pdf->Cell(38, 5, "", 0, 0, 'L');
		$pdf->Cell(60, 5, utf8_decode("Dr. José Pablo René Asomoza y Palacio"), 0, 0, 'L');
	}
	/****************************************************************************************/
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell($margen, 5, "", 0, 0, 'L');
	$pdf->Cell(60, 5, "Director Langebio", 0, 0, 'C');
	/******************************SOLO INTERNACIONAL******************************************/
	if($comision["Tipo_Comision"] == "Internacional")
	{
		$pdf->Cell(38, 5, "", 0, 0, 'L');
		$pdf->Cell(60, 5, "Director General", 0, 0, 'C');	
	}
	/****************************************************************************************/
	$pdf->Output($comision["Motivo"].'.pdf', 'I'); 
?>
