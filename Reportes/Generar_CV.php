<?php
header("Content-Type: text/html; charset=iso-8859-1 ");
	session_start();
	$id_usuario = $_SESSION['ID']; 
	$inicial = ($_GET["i"] == "Año-Mes-Día") ? "1900-00-00" : $_GET["i"];
	$final =  ($_GET["f"] == "Año-Mes-Día") ? "2050-00-00" : $_GET["f"];
     
	if($inicial != "1900-00-00")
	{
		$inicial = explode("-", $inicial);
		$inicial = $inicial[0]."-".(($inicial[1] < 10) ? "0".$inicial[1] : $inicial[1])."-".(($inicial[2] < 10) ? "0".$inicial[2] : $inicial[2]);
	}
	if($final != "2050-00-00")
	{
		$final = explode("-", $final);
		$final = $final[0]."-".(($final[1] < 10) ? "0".$final[1] : $final[1])."-".(($final[2] < 10) ? "0".$final[2] : $final[2]);
	}
	$impacto = $_GET["fac"];
	$citas = $_GET["c"];
           $estado=$_GET["est"];
	/*$id_usuario = $_SESSION['ID'];     
	$inicial = $_GET['inicial'];
	$final = $_GET['final'];*/
	/**
	* Incluir archivos
	* 
	* Se incluye la dirección del archivo donde se encuentra la función que permite
	* la conexión a la base de datos. Así también, se incluye el archivo donde se 
	* encuentran las funciones restantes con las que cuenta el sistema.
	*/
        
        //require("../../Caratula/Scripts/conexionCLS.php");        
	require ("../Scripts/query.php");     /*   Que es funciones*/	
	require ("../fpdf/fpdf.php");
	/**
	* Documento CV
	* 
	* El siguiente coódigo es el encargado de generar el CV de un usuario del sistema,
	* así también de incluir todos los productos que ha realizado clasificando cada uno
	* de ellos como lo estipula el reglamento de productividad.
	*/
      
	class PDF extends FPDF
	{
		Function Footer()
		{
			$this->SetY(-10);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'C');
		}                
	}
          
	//Encabezado
	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', '', 20);
	$inicial = explode("-", $inicial);
	$final = explode("-", $final);
	if($inicial == "1900-00-00" || $final == "2050-00-00")
            $pdf->Cell(0, 15, 'Curriculum Vitae '.$inicial[2]."/".$inicial[1]."/".$inicial[0].' a '.$final[2]."/".$final[1]."/".$final[0], 0, 0, 'C');
	else
            $pdf->Cell(0, 15, 'Curriculum Vitae', 0, 0, 'C');
	$pdf->Ln();
            
        $conexion = new Querys();
        

        //Nombre Usuario
	//Datos Generales
	$pdf->SetFont('Arial', '', 15);
        $pdf->SetTextColor(51,51,255);
        $pdf->setFillColor(230,230,230); 
	$pdf->Cell(0,10, '1  Datos Generales.', 0,1,'L',1);
         
	$pdf->Ln();
	$result = $conexion->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno, Lugar_Nacimiento, Fecha_Nacimiento FROM Usuario WHERE ID_Usuario = ".$id_usuario);
	 $pdf->SetTextColor(0,0,0);
        if(count($result) > 0)
	{
		$pdf->SetFont('Arial', '', 10);                
		$pdf->MultiCell(0,5,"Nombre: ".utf8_decode($result[0]["Nombre"])." ".utf8_decode($result[0]["Apellido_Paterno"])." ".utf8_decode($result[0]["Apellido_Materno"]).".", 0, 'L');
		$pdf->SetFont('Arial', '', 10);
		$pdf->MultiCell(0,5,"Lugar de nacimiento: ".$result[0]["Lugar_Nacimiento"].".", 0, 'L');
		$fecha = explode("-", $result[0]["Fecha_Nacimiento"]);
		$pdf->MultiCell(0,5,"Fecha de nacimiento: ".$fecha[2]."/".$fecha[1]."/".$fecha[0].".", 0, 'L');
	}
	unset($result);
        
    //Escolaridad
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 14);
	$pdf->Cell(0,10, 'Escolaridad:', 0, 'L');
	$pdf->Ln();
	$result = $conexion->Consultas("SELECT * FROM Escolaridad WHERE FK_Usuario = ".$id_usuario." ORDER BY Grado");
    for($x = 0; $x < count($result); $x++)
	{
		$pdf->SetFont('Arial', '', 10);
		$pdf->MultiCell(0,5,"         -  ".utf8_decode($result[$x]["Grado"])." en ".utf8_decode($result[$x]["Nombre"]).", ".utf8_decode($result[$x]["Localidad"])." (".$result[$x]["Anio"].").", 0, 'L');
	}
	unset($result);
        
        
	//Experiencia Profesional
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 14);
	$pdf->Cell(0,10, 'Experiencia Profesional:', 0, 'L');
	$pdf->Ln();
	$result = $conexion->Consultas("SELECT * FROM Experiencia WHERE FK_Usuario = ".$id_usuario ." order by Estancia");	
	for($x = 0; $x < count($result); $x++)
	{
		$fecha_Inicial = explode("-", $result[$x]["Fecha_Inicial"]);
		$fecha_Final = explode("-", $result[$x]["Fecha_Final"]);
		$pdf->SetFont('Arial', '', 10);            
		if($result[$x]["Estancia"] == "1")
			$pdf->MultiCell(0,5,"         -  Estancia Posdoctoral, ".utf8_decode($result[$x]["Nombre_Localidad"]).", ".$fecha_Inicial[2]."/".$fecha_Inicial[1]."/".$fecha_Inicial[0]." a ".$fecha_Final[2]."/".$fecha_Final[1]."/".$fecha_Final[0].".", 0, 'L');	
		else
			$pdf->MultiCell(0,5,"         -  ".utf8_decode($result[$x]["Nombre_Localidad"]).", ".$fecha_Inicial[2]."/".$fecha_Inicial[1]."/".$fecha_Inicial[0].".", 0, 'L');	
	}
	unset($result);
        
	//Posicion y cat actuales        
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 14);
	$pdf->Cell(0,10,utf8_decode("Posición y Categoría Actuales:"), 0, 'L'); 
	$pdf->Ln();
	$result = $conexion->Consultas("SELECT Puesto, Categoria, Subcategoria, Unidad.Nombre as Unidad, Institucion.Nombre as Institucion, "."Fecha FROM Categoria, Usuario, Unidad_Departamento, Unidad, Institucion WHERE ID_Institucion = FK_Institucion "."AND ID_Unidad = FK_Unidad AND ID_Unidad_Departamento = FK_Unidad_Departamento AND ID_Usuario = ".$id_usuario." ". "AND ID_Usuario = FK_Usuario ORDER BY Fecha");	
	if(count($result) > 0)
	{
		$pdf->SetFont('Arial', '', 10);
		$fecha = explode("-", $result[count($result) - 1]["Fecha"]);
		$pdf->MultiCell(0,5,"         -  ".utf8_decode($result[count($result) - 1]["Puesto"])." ".utf8_decode($result[count($result) - 1]["Categoria"])."- ".utf8_decode($result[count($result) - 1]["Subcategoria"]).", ".utf8_decode($result[count($result) - 1]["Unidad"]).", ".utf8_decode($result[count($result) - 1]["Institucion"]).", ".$fecha[2]."/".$fecha[1]."/".$fecha[0]." - a la fecha.", 0, 'L');	                  
	}        
	unset($result);	
        
     
   // * TODOS LOS PUNTOS DEL 2
	$pdf->Ln();
	$bandera = false;  
	$parasoloundato = 0;        
	$arrayarti = array("2.1.a","2.1.b" ,"2.1.c", "2.1.d", "2.1.e", "2.1.f", "2.1.g", "2.2","2.3" ,"2.4", "2.5", "2.6", "2.7.a", "2.7.b",
                           "2.7.c", "2.7.d", "2.8.a", "2.8.b", "2.8.c", "2.8.d", "2.8.e", "2.8.f", "2.9", "2.10.a", "2.10.b", "2.10.c", 
                           "2.11.a", "2.11.b", "2.11.c", "2.12.a", "2.12.b", "2.12.c", "2.12.d");
        
	for($arti = 0; $arti < 33; $arti++)
	{
		$bandera2 = false;
		if ($arrayarti[$arti] == "2.1.d" ){
                    if($estado=="Todos"){
                        $result = $conexion->Consultas("SELECT ID_Articulo, Alias, Titulo, Abstract, Conferencia_Capitulo, Numero, Localidad_PagWeb, Doi, Volumen, Paginas, Fecha, Etiqueta_Copei, Descripcion, Tipo, Editor, Edicion, Editorial_Afiliacion, ISBN, Tema, Impacto_TituloLibro,No_Referencia_Rerporte, FK_Journal FROM Articulos, Alias, Tipo_Copei WHERE Tipo_Copei.Tipo = '".$arrayarti[$arti]."' AND Articulos.Fk_tipo = Tipo_Copei.ID_Tipo AND Articulos.ID_Articulo = Alias.FK_Articulo AND Alias.FK_Usuario = ".$id_usuario." ORDER BY Tipo, Etiqueta_Copei ASC");
                    }
                    else{
                        
                   
			$result = $conexion->Consultas("SELECT ID_Articulo, Alias, Titulo, Abstract, Conferencia_Capitulo, Numero, Localidad_PagWeb, Doi, Volumen, Paginas, Fecha, Etiqueta_Copei, Descripcion, Tipo, Editor, Edicion, Editorial_Afiliacion, ISBN, Tema, Impacto_TituloLibro,No_Referencia_Rerporte, FK_Journal FROM Articulos, Alias, Tipo_Copei WHERE Tipo_Copei.Tipo = '".$arrayarti[$arti]."' AND  Estado='$estado' AND Articulos.Fk_tipo = Tipo_Copei.ID_Tipo AND Articulos.ID_Articulo = Alias.FK_Articulo AND Alias.FK_Usuario = ".$id_usuario." ORDER BY Tipo, Etiqueta_Copei ASC");	                     
                
                         }
                    }
                        else{
                            if($estado=="Todos"){
                             $result = $conexion->Consultas("SELECT ID_Articulo, Alias, Titulo, Abstract, Conferencia_Capitulo, Numero, Localidad_PagWeb, Doi, Volumen, Paginas, Fecha, Etiqueta_Copei, Descripcion, Tipo, Editor, Edicion, Editorial_Afiliacion, ISBN, Tema, Impacto_TituloLibro,No_Referencia_Rerporte, FK_Journal FROM Articulos, Alias, Tipo_Copei WHERE Tipo_Copei.Tipo = '".$arrayarti[$arti]."' AND Articulos.Fk_tipo = Tipo_Copei.ID_Tipo AND Articulos.Fecha > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND Articulos.Id_articulo = Alias.Fk_articulo AND Alias.Fk_usuario = ".$id_usuario." ORDER BY Tipo, Etiqueta_Copei ASC;");	    
                            }
                            else{
			$result = $conexion->Consultas("SELECT ID_Articulo, Alias, Titulo, Abstract, Conferencia_Capitulo, Numero, Localidad_PagWeb, Doi, Volumen, Paginas, Fecha, Etiqueta_Copei, Descripcion, Tipo, Editor, Edicion, Editorial_Afiliacion, ISBN, Tema, Impacto_TituloLibro,No_Referencia_Rerporte, FK_Journal FROM Articulos, Alias, Tipo_Copei WHERE Tipo_Copei.Tipo = '".$arrayarti[$arti]."' AND Estado='$estado' AND Articulos.Fk_tipo = Tipo_Copei.ID_Tipo AND Articulos.Fecha > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND Articulos.Id_articulo = Alias.Fk_articulo AND Alias.Fk_usuario = ".$id_usuario." ORDER BY Tipo, Etiqueta_Copei ASC;");	                     
                        
                            }
                            }
                        if(count($result) > 0 && $arrayarti[$arti] !="2.6")
		{                        
			$pdf->SetFont('Arial', '', 14);
			if($bandera == false)
			{
                            $pdf->SetFont('Arial', '', 15);
        $pdf->SetTextColor(51,51,255);
        $pdf->setFillColor(230,230,230); 
       
				$pdf->Multicell(0,10,utf8_decode("2  Productos de Investigación o Desarrollo."), 0, 1,'L',1);
				$pdf->Ln();
				$bandera = true;   
                                 $pdf->SetTextColor(0,0,0);
			}  
			for($x = 0; $x < count($result); $x++)
			{                                        
				$result2 = $conexion->Consultas("SELECT Alias FROM Alias WHERE FK_Articulo = ".$result[$x]["ID_Articulo"].";");
				$cadena_alias="";
				$cadena="";
			   
				for($y = 0; $y < count($result2); $y++)
				{
					$cadena_alias  = $cadena_alias.utf8_decode($result2[$y]["Alias"]); 
					if ($y+1 == count($result2))
						$cadena_alias  = $cadena_alias.". ";
					else
						$cadena_alias  = $cadena_alias.", ";                                
				}
				if($bandera2 == false)
				{
					$pdf->SetFont('Arial', '', 14);
                                        $pdf->setFillColor(230,230,230); 
					$pdf->Multicell(0,7,$arrayarti[$arti]." ".utf8_decode($result[$x]["Descripcion"]).".", 0, 1,'L',1);            
					$pdf->Ln();
					$bandera2 = true;                    
				}  
				if($result[$x]["Fecha"] != "")
					$fecha = explode("-", $result[count($result) - 1]["Fecha"]);                
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(0,5,$arrayarti[$arti].".".$result[$x]["Etiqueta_Copei"], 0, 'L'); 
				
				if($cadena_alias != "" && $arrayarti[$arti] != "2.1.f" && $arrayarti[$arti] != "2.5" && $arrayarti[$arti] != "2.5" && $arrayarti[$arti] != "2.8.a" && $arrayarti[$arti] != "2.8.b" && $arrayarti[$arti] != "2.8.c" && $arrayarti[$arti] != "2.8.d" && $arrayarti[$arti] != "2.8.e" && $arrayarti[$arti] != "2.8.f" && $arrayarti[$arti] != "2.11.a" && $arrayarti[$arti] != "2.11.b" && $arrayarti[$arti] != "2.11.c" && $arrayarti[$arti] != "2.12.a" && $arrayarti[$arti] != "2.12.b" && $arrayarti[$arti] != "2.12.c" && $arrayarti[$arti] != "2.12.d")
					$pdf->MultiCell(0,5,$cadena_alias, 0, 'L'); 
				
				if($result[$x]["Titulo"] != "" && $arrayarti[$arti] != "2.10.a" && $arrayarti[$arti] != "2.10.b" && $arrayarti[$arti] != "2.10.c")
					$pdf->MultiCell(0,5,utf8_decode($result[$x]["Titulo"]).".", 0, 'L'); 
				if($result[$x]["Tema"] != "")
					$pdf->MultiCell(0,5,utf8_decode($result[$x]["Tema"]).".", 0, 'L'); 
				
				if($result[$x]["Impacto_TituloLibro"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Impacto_TituloLibro"].", "); 
				if($result[$x]["Conferencia_Capitulo"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Conferencia_Capitulo"].", "); 
				if($result[$x]["No_Referencia_Rerporte"] != "" && $arrayarti[$arti] != "2.8.a" && $arrayarti[$arti] != "2.8.b" && 
						$arrayarti[$arti] != "2.8.c" && $arrayarti[$arti] != "2.8.d" && $arrayarti[$arti] != "2.8.e" && $arrayarti[$arti] != "2.8.f")
					$cadena  = $cadena.utf8_decode($result[$x]["No_Referencia_Rerporte"].", "); 
				if($result[$x]["Editor"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Editor"].", "); 
				if($result[$x]["Edicion"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Edicion"].", "); 
				if($result[$x]["Editorial_Afiliacion"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Editorial_Afiliacion"].", ");
				if($result[$x]["FK_Journal"] != "")
				{
					$result3 = $conexion->Consultas("SELECT Nombre_Completo FROM Journal WHERE ID_Journal = ".$result[$x]["FK_Journal"].";");
					$cadena  = $cadena.utf8_decode($result3[$parasoloundato]["Nombre_Completo"].", ");
				}                    
				if($result[$x]["Volumen"] != "")
					$cadena  = $cadena."Vol: ".utf8_decode($result[$x]["Volumen"].", "); 
				 if($result[$x]["Numero"] != "")
					$cadena  = $cadena."No: ".utf8_decode($result[$x]["Numero"].", "); 
				if($result[$x]["Paginas"] != "")
					$cadena  = $cadena."Pp: ".utf8_decode($result[$x]["Paginas"].", "); 
				if($result[$x]["ISBN"] != "")
					$cadena  = $cadena."ISBN: ".utf8_decode($result[$x]["ISBN"].", "); 
				if($result[$x]["Doi"] != "")
					$cadena  = $cadena."DOI: ".utf8_decode($result[$x]["Doi"].", ");                     
				if($result[$x]["Localidad_PagWeb"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Localidad_PagWeb"].", "); 
				if($result[$x]["Fecha"] != "")
					$cadena  = $cadena.$fecha[2]."/".$fecha[1]."/".$fecha[0];
				$pdf->MultiCell(0,5,$cadena.".", 0, 'L'); 
				$pdf->MultiCell(0,5,"", 0, 'L'); 
			}
		}
		
		if(count($result) > 0 && $arrayarti[$arti] =="2.6")
		{   
			unset($result);	             
			unset($result2);	             
			$pdf->SetFont('Arial', '', 14);
             
			if($bandera == false)
			{
                              $pdf->SetFont('Arial', '', 15);
        $pdf->SetTextColor(51,51,255);
        $pdf->setFillColor(230,230,230); 
				$pdf->Multicell(0,5,utf8_decode("2  Productos de Investigación o Desarrollo."), 0, 1,'L',1);
				$pdf->Ln();
				$bandera = true;    
                                 $pdf->SetTextColor(0,0,0);
			}                                   
			$result = $conexion->Consultas("SELECT ID_Articulo, Titulo, Abstract, Conferencia_Capitulo, Numero, Localidad_PagWeb, Doi, ". "Volumen, Paginas, Fecha, Etiqueta_Copei, Editor, Edicion, Editorial_Afiliacion, ISBN, Tema, Impacto_TituloLibro, ". "No_Referencia_Rerporte, FK_Journal, Tipo, Fk_Tesis FROM Articulos, Alias, Tipo_Copei ". "WHERE Fk_Tipo = Id_Tipo AND Articulos.Fecha > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND Alias.FK_Articulo = ID_Articulo AND Alias.FK_Usuario = ".$id_usuario." AND FK_Tesis <> '';");	                     
			if(count($result))
			{  
				$result3 = $conexion->Consultas("SELECT Descripcion FROM Tipo_Copei WHERE Tipo = '2.6';");
				$pdf->SetFont('Arial', '', 14);
                                   $pdf->setFillColor(230,230,230); 
				$pdf->Multicell(0,5,"2.6  ".utf8_decode($result3[$parasoloundato]["Descripcion"]), 0, 1,'L',1);            
				$pdf->Ln();
				for($x = 0; $x < count($result); $x++)
				{                                        
					$result2 = $conexion->Consultas("SELECT Alias FROM Usuario_Tesis WHERE FK_Tesis = ".$result[$x]["Fk_Tesis"].";");
					$cadena_alias="";
					$cadena="";                   
					for($y = 0; $y < count($result2); $y++)
					{
						$cadena_alias  = $cadena_alias.utf8_decode($result2[$y]["Alias"]).", ";                                                        
					}
				if($result[$x]["Fecha"] != "")
					$fecha = explode("-", $result[count($result) - 1]["Fecha"]);                                         
				
				if($result[$x]["Titulo"] != "" && $result[$x]["Tipo"] != "2.10.a" && $result[$x]["Tipo"] != "2.10.b" && $result[$x]["Tipo"] != "2.10.c")
					$cadena  = $cadena.utf8_decode($result[$x]["Titulo"]).", "; 
				if($result[$x]["Tema"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Tema"]).", ";;                                              
				if($result[$x]["Impacto_TituloLibro"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Impacto_TituloLibro"].", "); 
				if($result[$x]["Conferencia_Capitulo"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Conferencia_Capitulo"].", "); 
				if($result[$x]["No_Referencia_Rerporte"] != "" && $result[$x]["Tipo"] != "2.8.a" && $result[$x]["Tipo"] != "2.8.b" && 
						$result[$x]["Tipo"] != "2.8.c" && $result[$x]["Tipo"] != "2.8.d" && $result[$x]["Tipo"] != "2.8.e" && $result[$x]["Tipo"] != "2.8.f")
					$cadena  = $cadena.utf8_decode($result[$x]["No_Referencia_Rerporte"].", "); 
				if($result[$x]["Editor"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Editor"].", "); 
				if($result[$x]["Edicion"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Edicion"].", "); 
				if($result[$x]["Editorial_Afiliacion"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Editorial_Afiliacion"].", ");
				if($result[$x]["FK_Journal"] != "")
				{
					$result3 = $conexion->Consultas("SELECT Nombre_Completo FROM Journal WHERE ID_Journal = ".$result[$x]["FK_Journal"].";");
					$cadena  = $cadena.utf8_decode($result3[$parasoloundato]["Nombre_Completo"].", ");
				}                    
				if($result[$x]["Volumen"] != "")
					$cadena  = $cadena."Vol: ".utf8_decode($result[$x]["Volumen"].", "); 
				 if($result[$x]["Numero"] != "")
					$cadena  = $cadena."No: ".utf8_decode($result[$x]["Numero"].", "); 
				if($result[$x]["Paginas"] != "")
					$cadena  = $cadena."Pp: ".utf8_decode($result[$x]["Paginas"].", "); 
				if($result[$x]["ISBN"] != "")
					$cadena  = $cadena."ISBN: ".utf8_decode($result[$x]["ISBN"].", "); 
				if($result[$x]["Doi"] != "")
					$cadena  = $cadena."DOI: ".utf8_decode($result[$x]["Doi"].", ");                     
				if($result[$x]["Localidad_PagWeb"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Localidad_PagWeb"].", "); 
				if($result[$x]["Fecha"] != "")
					$cadena  = $cadena.$fecha[2]."/".$fecha[1]."/".$fecha[0];
				
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(0,5,"2.6.".$x." ".$cadena_alias.$cadena.".", 0, 'L'); 
				$pdf->MultiCell(0,5,"", 0, 'L');                                                                     
				}
			}
			unset($result);	             
			unset($result2);
		}  
	}
	unset($result);
	unset($result2);      
	$bandera = false;
	$bandera2 = false;
        
        
	//  3 Formaci�n de Recursos Humanos.
       
	$arrayarti = array("3.1.a","3.1.b","3.1.c");   
       
	for($arti = 0; $arti < 3; $arti++)
	{
          
            
		$bandera2 = false;  
              
		$result = $conexion->Consultas("SELECT Curso.Nombre AS Nombre_Curso, Formacion_Curso.Propedeutico, Formacion_Curso.Nivel_AnioLic, ". "Tipo_Copei.Tipo, Programa_Academico.Nombre_Programa, Formacion_Curso.Total_Horas, Institucion.Nombre AS Nombre_Institucion, Tipo_Copei.Descripcion, ". "Unidad.Nombre AS Nombre_Unidad, Formacion_Curso.Fecha_Inicial, Formacion_Curso.Fecha_Final, Etiqueta_Copei FROM Formacion_Curso, Curso, Tipo_Copei, ". "Programa_Academico, Institucion, Unidad, Unidad_Departamento,Usuario WHERE Tipo_Copei.Tipo = '".$arrayarti[$arti]."' ". "AND Formacion_Curso.Fecha_Inicial > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND Formacion_Curso.Fecha_Final < '".$final[0]."-".$final[1]."-".$final[2]."' AND ID_Institucion = FK_Institucion AND ID_Unidad = FK_Unidad AND ID_Unidad_Departamento = FK_Unidad_Departamento ". "AND Usuario.ID_Usuario = ".$id_usuario." ORDER BY Formacion_Curso.Etiqueta_Copei;");
		
                if(count($result) > 0)
		{                                 
			$pdf->SetFont('Arial', '', 14);
			if($bandera == false)
			{
                                $pdf->SetFont('Arial', '', 15);
                                $pdf->SetTextColor(51,51,255);
                                $pdf->setFillColor(230,230,230); 
				$pdf->Multicell(0,5,utf8_decode("3  Formación de Recursos Humanos."), 0, 1,'L',1);
				$pdf->Ln();
				$bandera = true;  
                                 $pdf->SetTextColor(0,0,0);
			}              
			for($x = 0; $x < count($result); $x++)
			{ 
				$cadena="";
				if($bandera2 == false)
				{
					$pdf->SetFont('Arial', '', 14);
                                        $pdf->setFillColor(230,230,230); 
					$pdf->Multicell(0,5,$arrayarti[$arti]." ".utf8_decode($result[$x]["Descripcion"]).".",0, 1,'L',1);            
					$pdf->Ln();
					$bandera2 = true; 
                                        $pdf->SetTextColor(0,0,0);
				}
				$fecha_Inicial = explode("-", $result[$x]["Fecha_Inicial"]);
				$fecha_Final = explode("-", $result[$x]["Fecha_Final"]);
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(0,5,$arrayarti[$arti].".".$result[$x]["Etiqueta_Copei"], 0, 'L'); 
				if($result[$x]["Nombre_Curso"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Nombre_Curso"]).", "; 
				if($result[$x]["Propedeutico"] != "" && $result[$x]["Propedeutico"] != "0")
					$cadena = $cadena.", Propedeutico "; 
				if($result[$x]["Nivel_AnioLic"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Nivel_AnioLic"]); 
				if($result[$x]["Nombre_Programa"] != "")
					$cadena  = $cadena." en ".utf8_decode($result[$x]["Nombre_Programa"]).", ";                                                 
				if($result[$x]["Nombre_Institucion"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Nombre_Institucion"]).", ";                                                 
				if($result[$x]["Nombre_Unidad"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Nombre_Unidad"]).", ";                                                 
				$cadena  = $cadena.$fecha_Inicial[2]."/".$fecha_Inicial[1]."/".$fecha_Inicial[0]." a ".$fecha_Final[2]."/".$fecha_Final[1]."/".$fecha_Final[0].", "; 
				if($result[$x]["Total_Horas"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Total_Horas"])."hs";                                
				$pdf->MultiCell(0,5,$cadena.".", 0, 'L'); 
				$pdf->MultiCell(0,5,"", 0, 'L'); 
			}
		}
               
	}
	unset($result);
	unset($result2);              
	$bandera2 = false;
        
        global $fecha_Final;
        
	//...3.2       
	$bandera2 = false; 
	$result = $conexion->Consultas("SELECT FK_Tesis, Etiqueta_Copei, FK_Tipo, Titulo, Concluida, Fecha_Final, Lugar  FROM Usuario_Tesis, Tesis WHERE ID_Tesis = FK_Tesis AND Tesis.Fecha_Final < '".$fecha_Final[0]."-".$fecha_Final[1]."-".$fecha_Final[2]."' AND  FK_Usuario = ".$id_usuario." ORDER BY FK_Tipo;");        
	
        if(count($result) >0)
	{         
		$bandera3 = false;
		$bandera4 = false;
		$bandera5 = false;
		$pdf->SetFont('Arial', '', 14);
		if($bandera == false)
		{
                    $pdf->setFillColor(230,230,230); 
			$pdf->Multicell(0,5,utf8_decode("3  Formación de Recursos Humanos."), 0, 1,'L',1);
			$pdf->Ln();
			$bandera = true;  
		}
		for($x = 0; $x < count($result); $x++)
		{     
			if($bandera3 == false && $result[$x]["FK_Tipo"] == "54")
			{
				$pdf->SetFont('Arial', '', 14);
				$result5 = $conexion->Consultas("SELECT Descripcion, Tipo FROM Tipo_Copei WHERE ID_Tipo = ".$result[$x]["FK_Tipo"].";");
				$pdf->Multicell(0,5,utf8_decode("3.2.a  ".$result5[$parasoloundato]["Descripcion"]), 0, 'L');
				$pdf->Ln();
				$bandera3 = true;  
			}
			if($bandera4 == false && $result[$x]["FK_Tipo"] == "55")
			{
				$pdf->SetFont('Arial', '', 14);   
				$result5 = $conexion->Consultas("SELECT Descripcion, Tipo FROM Tipo_Copei WHERE ID_Tipo = ".$result[$x]["FK_Tipo"].";");
				$pdf->Multicell(0,5,utf8_decode("3.2.b  ".$result5[$parasoloundato]["Descripcion"]), 0, 'L');
				$pdf->Ln();
				$bandera4 = true;  
			}
			if($bandera5 == false && $result[$x]["FK_Tipo"] == "56")
			{
				$pdf->SetFont('Arial', '', 14);
				$result5 = $conexion->Consultas("SELECT Descripcion, Tipo FROM Tipo_Copei WHERE ID_Tipo = ".$result[$x]["FK_Tipo"].";");
				$pdf->Multicell(0,5,utf8_decode("3.3  ".$result5[$parasoloundato]["Descripcion"]), 0, 'L');
				$pdf->Ln();
				$bandera5 = true;  
			}
			$fecha_Final = explode("-", $result[$x]["Fecha_Final"]);
			$cadena_alias = "";
			$cadena = "";
			$colaboracion = "";
			$result2 = $conexion->Consultas("SELECT FK_Usuario, Estudiante, Alias FROM Usuario_Tesis WHERE FK_Tesis = ".$result[$x]["FK_Tesis"].";");
			$bandera3 = false;
			for($y = 0; $y < count($result2); $y++)
			{   
				
				if($result2[$y]["Estudiante"] == "1" && $result2[$y]["FK_Usuario"] != "")
				{
					$result3 = $conexion->Consultas("SELECT Institucion.Nombre AS Institucion, Unidad.Nombre AS Unidad, Usuario.Nombre, Usuario.Apellido_Paterno, Usuario.Apellido_Materno ". "FROM Institucion, Unidad, Unidad_Departamento, Usuario WHERE ID_Institucion = FK_Institucion AND ID_Unidad = FK_Unidad ". "AND ID_Unidad_Departamento = FK_Unidad_Departamento AND ID_Usuario = ".$result2[$y]["FK_Usuario"].";");                               
					$cadena_alias = utf8_decode($result3[$parasoloundato]["Nombre"]." ".$result3[$parasoloundato]["Apellido_Paterno"]." ".$result3[$parasoloundato]["Apellido_Materno"].", ".$result["Lugar"]);                                
				}
				if($result2[$y]["Estudiante"] == ""  && $result2[$y]["FK_Usuario"] != $id_usuario )
				{                                
					//$result4 = $conexion->Consultas("SELECT Usuario.Nombre, Usuario.Apellido_Paterno, Usuario.Apellido_Materno ". "FROM Usuario WHERE ID_Usuario = ".$result2[$y]["FK_Usuario"].";");
					if ($bandera3 == false)
					{
						$colaboracion = utf8_decode(" en Co-Dirección con el/la ").utf8_decode($result2[$y]["Alias"]);                                
						$bandera3 = true;
					}
					else
						$colaboracion = $colaboracion.", ".utf8_decode($result2[$y]["Alias"]);                                
				}
			}
			if($result[$x]["Titulo"] != "")
				$cadena  = $cadena.utf8_decode($result[$x]["Titulo"]);
			if($cadena_alias != "")
				$cadena = $cadena.", ".$cadena_alias;
			if($result[$x]["Concluida"] == "0")    
				$cadena = $cadena.", (En proceso)".$colaboracion;
			if($result[$x]["Concluida"] == "1")    
				$cadena = $cadena.", (Concluida)".$colaboracion;
			if($result[$x]["Fecha_Final"] != "0000-00-00")
				$cadena  = $cadena.", ".utf8_decode($fecha_Final[2]."/".$fecha_Final[1]."/".$fecha_Final[0]);
			$pdf->SetFont('Arial', '', 10);
			$pdf->MultiCell(0,5,$result5[$parasoloundato]["Tipo"].".".$result[$x]["Etiqueta_Copei"], 0, 'L'); 
			$pdf->MultiCell(0,5,$cadena.".", 0, 'L'); 
			$pdf->MultiCell(0,5,"", 0, 'L');
		}                   
	}
         $bandera = false;  
	// 4.1
	$result = $conexion->Consultas("SELECT DISTINCT FK_Journal FROM Articulos, Alias ". "WHERE Fk_Usuario = ".$id_usuario." AND FK_Articulo = ID_Articulo AND Articulos.Fecha > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND FK_Journal <> '' ORDER BY FK_Journal;");
	if(count($result) > 0 && count($result) > $impacto) 
	{                 
		$pdf->SetFont('Arial', '', 14);
		if($bandera == false)
		{
                                                                      $pdf->SetFont('Arial', '', 15);
               $pdf->SetTextColor(51,51,255);
             $pdf->setFillColor(230,230,230); 
			$pdf->Multicell(0,10,utf8_decode("4  Repercusión Académica."), 0, 1,'L',1);
			$pdf->Ln();
			$bandera = true;                    http://localhost/SELECTA_IMPROVED/Selecta
                             $pdf->SetTextColor(0,0,0);
                         $pdf->SetTextColor(0,0,0);
		}                   
		$result2 = $conexion->Consultas("SELECT Descripcion FROM Tipo_Copei WHERE Tipo = '4.1';");
		$pdf->SetFont('Arial', '', 14);
		$pdf->Multicell(0,5,"4.1  ".utf8_decode($result2[$parasoloundato]["Descripcion"]), 0, 'L');            
		$pdf->Ln();                                
			
		$pdf->SetFont('Arial', '', 10);
		for($x = 0; $x < count($result); $x++)
		{   
			$cadena="";  
			$result3 = $conexion->Consultas("SELECT Nombre_Completo, ISSN FROM Journal WHERE ID_Journal = ".$result[$x]["FK_Journal"].";");                    
			$result4 = $conexion->Consultas("SELECT Tipo, Etiqueta_Copei FROM Articulos, Alias, Tipo_copei ". "WHERE Fk_Usuario = ".$id_usuario." AND FK_Articulo = ID_Articulo AND FK_Tipo = ID_Tipo AND FK_Journal = ".$result[$x]["FK_Journal"]." ORDER BY Etiqueta_Copei;");                                        
			for($y = 0; $y < count($result4); $y++)
			{                        
				$cadena = $cadena.utf8_decode($result4[$y]["Tipo"]).".".utf8_decode($result4[$y]["Etiqueta_Copei"]);
				if ($y+1 == count($result4))
					$cadena  = $cadena.")";
				else
					$cadena  = $cadena.", ";                          
			}                    
			$pdf->MultiCell(0,5,count($result4).utf8_decode(" art�culos (").$cadena." en ".utf8_decode($result3[$parasoloundato]["Nombre_Completo"]).", ISSN ".utf8_decode($result3[$parasoloundato]["ISSN"]).".", 0, 'L');                     
			$pdf->SetFont('Arial', '', 10);                    
			$pdf->MultiCell(0,5,"", 0, 'L');                                            
		}                
	}                           
	unset($result);
	unset($result2);
	unset($result3);
	unset($result4);
        	
	//4.2
	$result = $conexion->Consultas("SELECT FK_Journal, Numero_Citas FROM Articulos, Alias ". "WHERE Fk_Usuario = ".$id_usuario." AND Articulos.Fecha > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND FK_Articulo = ID_Articulo AND FK_Journal <> '' ORDER BY Numero_Citas DESC;");
	if(count($result) > 0 && $result[$parasoloundato]["Numero_Citas"] > $citas)
	{                 
		$pdf->SetFont('Arial', '', 14);
		if($bandera == false)
		{
                                                                      $pdf->SetFont('Arial', '', 15);
        $pdf->SetTextColor(51,51,255);
        $pdf->setFillColor(230,230,230); 
			$pdf->Multicell(0,10,utf8_decode("4  Repercusión Académica."), 0, 1,'L',1);
			$pdf->Ln();
			$bandera = true;  
                         $pdf->SetTextColor(0,0,0);
		}                   
		$result2 = $conexion->Consultas("SELECT Descripcion FROM Tipo_Copei WHERE Tipo = '4.2';");
		$pdf->SetFont('Arial', '', 14);
                $pdf->setFillColor(230,230,230); 
		$pdf->Multicell(0,5,"4.2  ".utf8_decode($result2[$parasoloundato]["Descripcion"]), 0, 1,'L',1);            
		$pdf->Ln();                                                                                   
		$pdf->SetFont('Arial', '', 10);
		for($x = 0; $x < count($result); $x++)
		{   
			$cadena="";  
			$result3 = $conexion->Consultas("SELECT Nombre_Completo, ISSN FROM Journal WHERE ID_Journal = ".$result[$x]["FK_Journal"].";");                    
			$result4 = $conexion->Consultas("SELECT Tipo, Etiqueta_Copei, Numero_Citas, Volumen, Numero, Paginas FROM Articulos, Alias, Tipo_copei ". "WHERE Fk_Usuario = ".$id_usuario." AND FK_Articulo = ID_Articulo AND FK_Tipo = ID_Tipo AND FK_Journal = ".$result[$x]["FK_Journal"]." ORDER BY Numero_Citas DESC;");
								
			for($y = 0; $y < count($result4); $y++ )
			{                                              
				if($result4[$y]["Numero_Citas"] >= $citas && $result[$x]["Numero_Citas"] >= $citas)
				{
				$pdf->Cell(0,5,"4.2.".$result4[$y]["Etiqueta_Copei"]." ".utf8_decode($result3[$parasoloundato]["Nombre_Completo"])." Vol: ".utf8_decode($result4[$y]["Volumen"])." No: ".utf8_decode($result4[$y]["Numero"])." Pp: ".utf8_decode($result4[$y]["Paginas"]).".", 0, 0, 'L');                                                    
				$pdf->Cell(0,5,utf8_decode($result[$x]["Numero_Citas"])." citas.             ",0 ,1, 'R');
				}
			}                
		}
		$pdf->MultiCell(0,5,"", 0, 'L'); 
	}
	unset($result);
	unset($result2);
	unset($result3);
	unset($result4);
     
	//  4.3 hasta 4.11
	$arrayarti = array("4.3","4.4","4.5","4.6","4.7","4.8","4.9","4.10","4.11");
	for($arti = 0; $arti < 9; $arti++)
	{
		$bandera2 = false;
		if($arrayarti[$arti] == "4.11")
			$result= $conexion->Consultas("SELECT Congreso_Discutido_Estu_Miemb_Otorga_Respon, Titulo_Proyecto_MedioDiscusion_Revista_Puesto, ". "Descripcion_Localidad, Fecha_Inicial, Volumen, Numero, Paginas, SNI_ISSN_NoPatente_Subpro, Fecha_Final, Tipo_Copei.Descripcion FROM Repercusion, Tipo_Copei ". "WHERE Repercusion.FK_Tipo = Tipo_Copei.ID_Tipo AND Repercusion.Fecha_Inicial > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND Repercusion.Fecha_Final < '".$final[0]."-".$final[1]."-".$final[2]."' AND Tipo_Copei.Tipo = '".$arrayarti[$arti]."' AND Fk_Usuario = ".$id_usuario.";");
		else
			$result= $conexion->Consultas("SELECT Congreso_Discutido_Estu_Miemb_Otorga_Respon, Titulo_Proyecto_MedioDiscusion_Revista_Puesto, ". "Descripcion_Localidad, Fecha_Inicial, Volumen, Numero, Paginas, SNI_ISSN_NoPatente_Subpro, Fecha_Final, Tipo_Copei.Descripcion FROM Repercusion, Tipo_Copei ". "WHERE Repercusion.FK_Tipo = Tipo_Copei.ID_Tipo AND Repercusion.Fecha_Inicial > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND Tipo_Copei.Tipo = '".$arrayarti[$arti]."' AND Fk_Usuario = ".$id_usuario.";");
		if(count($result) > 0)
		{ 
			if($bandera == false)
			{
                                                                              $pdf->SetFont('Arial', '', 15);
        $pdf->SetTextColor(51,51,255);
        $pdf->setFillColor(230,230,230); 
				$pdf->Multicell(0,10,utf8_decode("4  Repercusión Académica."), 0, 1,'L',1);
				$pdf->Ln();
				$bandera = true; 
                                 $pdf->SetTextColor(0,0,0);
			}  
			for($x = 0; $x < count($result); $x++)
			{ 
				$fecha_Inicial = explode("-", $result[$x]["Fecha_Inicial"]);
				$fecha_Final = explode("-", $result[$x]["Fecha_Final"]);
			
				$cadena="";
				if($bandera2 == false)
				{                        
					$pdf->SetFont('Arial', '', 14);
					$pdf->Multicell(0,5,$arrayarti[$arti]." ".utf8_decode($result[$x]["Descripcion"]), 0, 'L');            
					$pdf->Ln();
					$bandera2 = true;                                        
				}
				if($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"] != "" && $arrayarti[$arti] == "4.6" || $arrayarti[$arti] == "4.9" || $arrayarti[$arti] == "4.10")
					$cadena  = $cadena.utf8_decode($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"]).", "; 
				if($result[$x]["Fecha_Inicial"] != "" && $arrayarti[$arti] == "4.6")
					$cadena  = $cadena.$fecha_Inicial[2]."/".$fecha_Inicial[1]."/".$fecha_Inicial[0].", ";
				if($result[$x]["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"] != "" && $arrayarti[$arti] == "4.6" || $arrayarti[$arti] == "4.9" || $arrayarti[$arti] == "4.10" || $arrayarti[$arti] == "4.11")
					$cadena  = $cadena.utf8_decode($result[$x]["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"]).", "; 
				if($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"] != "" && $arrayarti[$arti] == "4.11")
					$cadena  = $cadena.utf8_decode($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"]).", "; 
				if($result[$x]["SNI_ISSN_NoPatente_Subpro"] != "" && $arrayarti[$arti] == "4.6" || $arrayarti[$arti] == "4.15")
					$cadena  = $cadena.utf8_decode($result[$x]["SNI_ISSN_NoPatente_Subpro"]).", "; 
				if($result[$x]["Descripcion_Localidad"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Descripcion_Localidad"]).", ";                     
				if($result[$x]["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"] != "" && $arrayarti[$arti] != "4.6" && $arrayarti[$arti] != "4.9" && $arrayarti[$arti] != "4.10" )
					$cadena  = $cadena.utf8_decode($result[$x]["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"]).", "; 
				if($result[$x]["Volumen"] != "")
					$cadena  = $cadena."Vol: ".utf8_decode($result[$x]["Volumen"]).", "; 
				if($result[$x]["Numero"] != "")
					$cadena  = $cadena."No: ".utf8_decode($result[$x]["Numero"]).", "; 
				if($result[$x]["Paginas"] != "")
				  $cadena  = $cadena."Pp: ".utf8_decode($result[$x]["Paginas"]).", "; 
				if($result[$x]["Fecha_Inicial"] != "" && $arrayarti[$arti] != "4.6" )
					$cadena  = $cadena.$fecha_Inicial[2]."/".$fecha_Inicial[1]."/".$fecha_Inicial[0];
				if($result[$x]["Fecha_Final"] != "")
					$cadena  = $cadena." a ".$fecha_Final[2]."/".$fecha_Final[1]."/".$fecha_Final[0];
				if($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"] != "" && $arrayarti[$arti] == "4.5")
					$cadena  = $cadena." discutido por ".utf8_decode($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"]); 
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(0,5,$cadena.".", 0, 'L'); 
				$pdf->MultiCell(0,5,"", 0, 'L'); 
			}
			
		}
	}
	unset($result);
	unset($result2);      
        
	//--4.12
	$result= $conexion->Consultas("SELECT Tipo_Responsable, Titulo, Objetivos, Pag_Web, Localidad, Gastos_Inversion, Moneda, Fecha_Inicial,". "Fecha_Final FROM Proyecto, Usuario_Proyecto WHERE ID_Proyecto = FK_Proyecto AND Proyecto.Fecha_Inicial > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND Proyecto.Fecha_Final < '".$final[0]."-".$final[1]."-".$final[2]."' AND FK_Usuario = ".$id_usuario.";");
	if(count($result) > 0)
	{ 
		if($bandera == false)
			{
                                                                      $pdf->SetFont('Arial', '', 15);
        $pdf->SetTextColor(51,51,255);
        $pdf->setFillColor(230,230,230); 
				$pdf->Multicell(0,10,utf8_decode("4  Repercusión Académica."), 0, 1,'L',1);
				$pdf->Ln();
				$bandera = true; 
                                 $pdf->SetTextColor(0,0,0);
			}
			$pdf->SetFont('Arial', '', 14);
			$result2 = $conexion->Consultas("SELECT Descripcion FROM Tipo_Copei WHERE Tipo = '4.12';");
			$pdf->Multicell(0,5,"4.12  ".utf8_decode($result2[$parasoloundato]["Descripcion"]), 0, 'L');            
			$pdf->Ln();                
			for($x = 0; $x < count($result); $x++)
			{ 
				$pdf->SetFont('Arial', '', 10);
				$fecha_Inicial = explode("-", $result[$x]["Fecha_Inicial"]);
				$fecha_Final = explode("-", $result[$x]["Fecha_Final"]);
				if($result[$x]["Tipo_Responsable"] != "")
					$pdf->MultiCell(0,5,utf8_decode($result[$x]["Tipo_Responsable"]), 0, 'L'); 
				if($result[$x]["Titulo"] != "")
					$pdf->MultiCell(0,5,utf8_decode($result[$x]["Titulo"]), 0, 'L'); 
				if($result[$x]["Objetivos"] != "")
					$pdf->MultiCell(0,5,utf8_decode($result[$x]["Objetivos"]), 0, 'L'); 
				if($result[$x]["Pag_Web"] != "")
					$pdf->MultiCell(0,5,utf8_decode($result[$x]["Pag_Web"]), 0, 'L'); 
				if($result[$x]["Localidad"] != "")
					$pdf->Cell(0,5,utf8_decode($result[$x]["Localidad"]), 0,0, 'L');                     
				if($result[$x]["Gastos_Inversion"] != "" || $result[$x]["Moneda"] != "")
					$pdf->Cell(0,5,utf8_decode("$".$result[$x]["Gastos_Inversion"]." ".$result[$x]["Moneda"]."       "),0 ,1, 'R');                     
				$pdf->MultiCell(0,5,utf8_decode($fecha_Inicial[2]."/".$fecha_Inicial[1]."/".$fecha_Inicial[0]." - ".$fecha_Final[2]."/".$fecha_Final[1]."/".$fecha_Final[0]), 0, 'L');         
				$pdf->MultiCell(0,5,"", 0, 'L'); 
			}
	}        
	unset($result);
	unset($result2);   
        
	//----4.13 a 4.18
	$arrayarti = array("4.13","4.14","4.15","4.16","4.17","4.18");
	for($arti = 0; $arti < 6; $arti++)
	{
		$bandera2 = false;                
		$result= $conexion->Consultas("SELECT Congreso_Discutido_Estu_Miemb_Otorga_Respon, Titulo_Proyecto_MedioDiscusion_Revista_Puesto, ". "Descripcion_Localidad, Fecha_Inicial, Volumen, Numero, Paginas, SNI_ISSN_NoPatente_Subpro, Fecha_Final, Tipo_Copei.Descripcion FROM Repercusion, Tipo_Copei ". "WHERE Repercusion.FK_Tipo = Tipo_Copei.ID_Tipo AND Repercusion.Fecha_Inicial > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND Repercusion.Fecha_Final < '".$final[0]."-".$final[1]."-".$final[2]."' AND Tipo_Copei.Tipo = '".$arrayarti[$arti]."' AND Fk_Usuario = ".$id_usuario.";");
		if(count($result) > 0)
		{ 
			if($bandera == false)
			{
                                                             $pdf->SetFont('Arial', '', 15);
        $pdf->SetTextColor(51,51,255);
        $pdf->setFillColor(230,230,230); 
				$pdf->Multicell(0,10,utf8_decode("4  Repercusión Académica."), 0, 1,'L',1);
				$pdf->Ln();
				$bandera = true;    
                                 $pdf->SetTextColor(0,0,0);
			}  
			for($x = 0; $x < count($result); $x++)
			{ 
				$fecha_Inicial = explode("-", $result[$x]["Fecha_Inicial"]);
				$fecha_Final = explode("-", $result[$x]["Fecha_Final"]);
			
				$cadena="";
				if($bandera2 == false)
				{                        
					$pdf->SetFont('Arial', '', 14);
					$pdf->Multicell(0,5,$arrayarti[$arti]." ".utf8_decode($result[$x]["Descripcion"]), 0, 'L');            
					$pdf->Ln();
					$bandera2 = true;                                        
				}
				if($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"] && $arrayarti[$arti] == "4.13")
					$cadena  = $cadena.utf8_decode($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"]).", "; 
				if($result[$x]["SNI_ISSN_NoPatente_Subpro"] != "" && $arrayarti[$arti] == "4.13")
					$cadena  = $cadena."SNI(".utf8_decode($result[$x]["SNI_ISSN_NoPatente_Subpro"])."), ";                     
				if($result[$x]["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Titulo_Proyecto_MedioDiscusion_Revista_Puesto"]).", "; 
				if($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"] && $arrayarti[$arti] == "4.14" || $arrayarti[$arti] == "4.15")
					$cadena  = $cadena.utf8_decode($result[$x]["Congreso_Discutido_Estu_Miemb_Otorga_Respon"]).", "; 
				if($result[$x]["SNI_ISSN_NoPatente_Subpro"] != "" && $arrayarti[$arti] == "4.13")
					$cadena  = $cadena."SNI(".utf8_decode($result[$x]["SNI_ISSN_NoPatente_Subpro"])."), ";                     
				if($result[$x]["SNI_ISSN_NoPatente_Subpro"] != "" && $arrayarti[$arti] == "4.15" || $arrayarti[$arti] == "4.16")
					$cadena  = $cadena.utf8_decode($result[$x]["SNI_ISSN_NoPatente_Subpro"]).", ";                     
				if($result[$x]["Descripcion_Localidad"] != "")
					$cadena  = $cadena.utf8_decode($result[$x]["Descripcion_Localidad"]).", ";                     
				if($result[$x]["Fecha_Inicial"] != "")
					$cadena  = $cadena.$fecha_Inicial[2]."/".$fecha_Inicial[1]."/".$fecha_Inicial[0];
				if($result[$x]["Fecha_Final"] != "")
					$cadena  = $cadena." a ".$fecha_Final[2]."/".$fecha_Final[1]."/".$fecha_Final[0];                                                          
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(0,5,$cadena.".", 0, 'L'); 
				$pdf->MultiCell(0,5,"", 0, 'L'); 
			}
			
		}
	}
	unset($result);
	unset($result2); 
	 
	//   5
	$result= $conexion->Consultas("SELECT Descripcion, Fecha, Etiqueta_Copei FROM Criterio WHERE Criterio.Fecha > '".$inicial[0]."-".$inicial[1]."-".$inicial[2]."' AND FK_Usuario = ".$id_usuario.";");
	if(count($result) > 0)
	{ 
		                                                               $pdf->SetFont('Arial', '', 15);
        $pdf->SetTextColor(51,51,255);
        $pdf->setFillColor(230,230,230);
		$pdf->Multicell(0,10,utf8_decode("5  Criterios Adicionales."), 0, 1,'L',1);
		$pdf->Ln();
		$bandera = true;   
                 $pdf->SetTextColor(0,0,0);
                
		for($x = 0; $x < count($result); $x++)
		{ 
			$pdf->SetFont('Arial', '', 10);
			$fecha = explode("-", $result[count($result) - 1]["Fecha"]);                
			$cadena="";
			if($result[$x]["Etiqueta_Copei"] != "")                      
				$pdf->MultiCell(0,5,"5.".$result[$x]["Etiqueta_Copei"], 0, 'L'); 
			if($result[$x]["Descripcion"] != "")
				  $cadena  = $cadena.utf8_decode($result[$x]["Descripcion"]).", ";                
			if($result[$x]["Fecha"] != "")
				  $cadena  = $cadena.$fecha[2]."/".$fecha[1]."/".$fecha[0];                 
			$pdf->MultiCell(0,5,$cadena.".", 0, 'L'); 
			$pdf->MultiCell(0,5,"", 0, 'L'); 
		}
	}
        
	$pdf->Output('Curriculum_Vitae.pdf', 'I'); 
?>
