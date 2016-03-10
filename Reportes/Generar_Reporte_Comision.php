<?php
	include "../Scripts/query.php";
	include "../fpdf/fpdf.php";
	
	$conexion = new Querys();
	
	$id = $_GET["i"];
	$comision = $conexion->Consultas("SELECT ID_Usuario, Evento, Descipcion, Informe_Comision.Fecha, Tipo_Comision, Lugar, Comision.Fecha_Inicial, Usuario.Nombre AS Nombre, Apellido_Paterno, Apellido_Materno, Unidad.Nombre AS Unidad, Abreviacion FROM Informe_Comision, Comision, Usuario, Unidad_Departamento, Unidad WHERE ID_Comision = FK_Comision AND FK_Usuario = ID_Usuario AND FK_Unidad_Departamento = ID_Unidad_Departamento AND FK_Unidad = ID_Unidad AND ID_Informe = ".$id);
	$comision = $comision[0];
	$pdf=new FPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Image('Langebio.jpg', 165, 20, 18);
	$pdf->SetY(32);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(10,10, "", 0, 0, 'L');
	$pdf->Cell(0,10, utf8_decode('CENTRO DE INVESTIGACIÓN Y DE ESTUDIOS AVANZADOS DEL I.P.N.'), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10,10, "", 0, 0, 'L');
	$pdf->Cell(52,10, utf8_decode('INFORME DE COMISIÓN'), 0, 0, 'L');
	$pdf->Cell(40, 8, strtoupper($comision["Tipo_Comision"]), "B", 0, 'L');
	$pdf->SetY(63);
	$pdf->SetFont('Arial', '', 11);
	$pdf->Cell(135,10, "", 0, 0, 'L');
	$fecha = explode("-", $comision["Fecha"]);
	$pdf->Cell(0,10, "FECHA: ".$fecha[2]."/".$fecha[1]."/".$fecha[0], 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(0, 5, "NOMBRE: ".utf8_decode($comision["Nombre"]." ".$comision["Apellido_Paterno"]." ".$comision["Apellido_Materno"]), 0, 0, 'L');
	$categoria = $conexion->Consultas("SELECT Puesto FROM Categoria WHERE FK_Usuario = ".$comision["ID_Usuario"]." ORDER BY Fecha");
	if(count($categoria) > 0)
	{
		$pdf->Ln();
		$pdf->Cell(10, 5, "", 0, 0, 'L');
		$pdf->Cell(0, 5, utf8_decode("CATEGORÍA: ".$categoria[count($categoria) - 1]["Puesto"]), 0, 0, 'L');
	}
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(0, 5, utf8_decode("LUGAR DE ADSCRIPCIÓN: ".utf8_decode((($comision["Abreviacion"] != "") ? $comision["Abreviacion"] : $comision["Unidad"]))), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$fecha_inicial = explode("-", $comision["Fecha_Inicial"]);
	$pdf->Cell(0, 5, utf8_decode("FECHA DE LA COMISIÓN: ").$fecha_inicial[2]."/".$fecha_inicial[1]."/".$fecha_inicial[0], 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(0, 5, utf8_decode("LUGAR DONDE SE REALIZÓ: ".$comision["Lugar"]), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(0, 5, utf8_decode("EVENTO AL QUE ASISTIÓ:"), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$opcion = null;
	if($comision["Evento"] == "Congreso o Reunión Académica")
		$opcion = 1;
	else if($comision["Evento"] == "Congreso o Reunión Académica internacional")
		$opcion = 2;
	else if($comision["Evento"] == "Estancia de trabajo en institución internacional")
		$opcion = 3;
	else if($comision["Evento"] == "Participación como jurado de examen de grado")
		$opcion = 4;
	else
		$opcion = 5;
	$pdf->SetFont('Arial', '', 11);
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(3, 3, (($opcion == 1) ? "X" : ""), 1, 0, 'L');
	$pdf->Cell(0, 5, utf8_decode("Congreso o Reunión Académica"), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(3, 3, (($opcion == 2) ? "X" : ""), 1, 0, 'L');
	$pdf->Cell(0, 5, utf8_decode("Congreso o Reunión Académica internacional"), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(3, 3, (($opcion == 3) ? "X" : ""), 1, 0, 'L');
	$pdf->Cell(0, 5, utf8_decode("Estancia de trabajo en institución internacional"), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(3, 3, (($opcion == 4) ? "X" : ""), 1, 0, 'L');
	$pdf->Cell(0, 5, utf8_decode("Participación como jurado de examen de grado"), 0, 0, 'L');
	$pdf->Ln();
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(3, 3, (($opcion == 5) ? "X" : ""), 1, 0, 'L');
	$pdf->Cell(0, 5, utf8_decode("Otros, Describir :"), 0, 0, 'L');
	$pdf->Ln();
	if($opcion == 5)
	{
		$pdf->Cell(10, 5, "", 0, 0, 'L');
		$pdf->MultiCell(0, 5, utf8_decode($comision["Evento"]), 0, 'L');
	}	
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->MultiCell(0, 5, utf8_decode("DESCRIBA EL OBJETO DE LA COMISIÓN, ACTIVIDADES REALIZADAS, RESULTADOS OBTENIDOS, CONTRIBUCIONES PARA EL CENTRO (Adjuntar documentación):"), 0, 'L');
	$pdf->SetFont('Arial', '', 11);
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->MultiCell(0, 5, utf8_decode($comision["Descipcion"]), 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 11);
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(115, 5, "FIRMA", 0, 0, 'L');
	$pdf->Cell(0, 5, "VO.BO", 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();	
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(10, 5, "", 0, 0, 'L');
	$pdf->Cell(100, 5, utf8_decode($comision["Nombre"]." ".$comision["Apellido_Paterno"]." ".$comision["Apellido_Materno"]), 0, 0, 'L');
	$pdf->Cell(0, 5, "Dr. Luis Rafael Herrera Estrella", 0, 0, 'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(123, 5, "", 0, 0, 'L');
	$pdf->Cell(0, 5, "Director Langebio", 0, 0, 'L');
	$pdf->Output($comision["Motivo"].'.pdf', 'I'); 
?>
