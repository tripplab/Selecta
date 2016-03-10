<?php      
	include "../fpdf/fpdf.php"; 
	
	class PDF extends FPDF
	{		
		function arreglo($texto, $longitud)
		{
			$cadena = "";
			$a = array();
			$b = explode(" ", $texto);
			for($x = 0; $x < count($b); $x++)
			{ 
				if(strlen($b[$x]) + strlen($cadena) < $longitud)
					$cadena .= $b[$x]." ";
				else
				{
					$a[] = $cadena; 
					$cadena = $b[$x];
				}
			}
			if($cadena != "")
				$a[] = $cadena; 
			return $a;
		}
		
		function tabla_2($lon_1, $lon_2, $texto_1, $lon_texto_1, $lon_3, $texto_2, $lon_texto_2)
		{
			$arreglo_1 = $this->arreglo($texto_1, $lon_texto_1);
			$arreglo_2 = $this->arreglo($texto_2, $lon_texto_2);
			$longitud = (count($arreglo_1) > count($arreglo_2)) ? count($arreglo_1) : count($arreglo_2);
			for($x = 0; $x < $longitud; $x++)
			{
				if($x == 0 && $longitud == 1)
					$margen = "LTRB";
				else if($x == 0)
					$margen = "LTR";
				else if($x == $longitud - 1)
					$margen = "LRB";
				else
					$margen = "LR";
				$this->Cell($lon_1, 5, "", 0, 0, 'L');
				if($x < count($arreglo_1))
					$this->Cell($lon_2, 5, $arreglo_1[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_2, 5, "", $margen, 0, 'L');
				if($x < count($arreglo_2))
					$this->Cell($lon_3, 5, $arreglo_2[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_3, 5, "", $margen, 0, 'L');
				$this->Ln();
			}
		}       
		
		function tabla_3($lon_1, $lon_2, $texto_1, $lon_texto_1, $lon_3, $texto_2, $lon_texto_2, $lon_4, $texto_3, $lon_texto_3)
		{
			$arreglo_1 = $this->arreglo($texto_1, $lon_texto_1);
			$arreglo_2 = $this->arreglo($texto_2, $lon_texto_2);
			$arreglo_3 = $this->arreglo($texto_3, $lon_texto_3);
			$longitud = (count($arreglo_1) > count($arreglo_2)) ? count($arreglo_1) : count($arreglo_2);
			$longitud = ($longitud > count($arreglo_3)) ? $longitud : count($arreglo_3);
			for($x = 0; $x < $longitud; $x++)
			{
				if($x == 0 && $longitud == 1)
					$margen = "LTRB";
				else if($x == 0)
					$margen = "LTR";
				else if($x == $longitud - 1)
					$margen = "LRB";
				else
					$margen = "LR";
				$this->Cell($lon_1, 5, "", 0, 0, 'L');
				if($x < count($arreglo_1))
					$this->Cell($lon_2, 5, $arreglo_1[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_2, 5, "", $margen, 0, 'L');
				if($x < count($arreglo_2))
					$this->Cell($lon_3, 5, $arreglo_2[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_3, 5, "", $margen, 0, 'L');
				if($x < count($arreglo_3))
					$this->Cell($lon_4, 5, $arreglo_3[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_4, 5, "", $margen, 0, 'L');
				$this->Ln();
			}
		}       
		
		function tabla_4($lon_1, $lon_2, $texto_1, $lon_texto_1, $lon_3, $texto_2, $lon_texto_2, $lon_4, $texto_3, $lon_texto_3, $lon_5, $texto_4, $lon_texto_4)
		{
			$arreglo_1 = $this->arreglo($texto_1, $lon_texto_1);
			$arreglo_2 = $this->arreglo($texto_2, $lon_texto_2);
			$arreglo_3 = $this->arreglo($texto_3, $lon_texto_3);
			$arreglo_4 = $this->arreglo($texto_4, $lon_texto_4);
			$longitud = (count($arreglo_1) > count($arreglo_2)) ? count($arreglo_1) : count($arreglo_2);
			$longitud = ($longitud > count($arreglo_3)) ? $longitud : count($arreglo_3);
			$longitud = ($longitud > count($arreglo_4)) ? $longitud : count($arreglo_4);
			for($x = 0; $x < $longitud; $x++)
			{
				if($x == 0 && $longitud == 1)
					$margen = "LTRB";
				else if($x == 0)
					$margen = "LTR";
				else if($x == $longitud - 1)
					$margen = "LRB";
				else
					$margen = "LR";
				$this->Cell($lon_1, 5, "", 0, 0, 'L');
				if($x < count($arreglo_1))
					$this->Cell($lon_2, 5, $arreglo_1[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_2, 5, "", $margen, 0, 'L');
				if($x < count($arreglo_2))
					$this->Cell($lon_3, 5, $arreglo_2[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_3, 5, "", $margen, 0, 'L');
				if($x < count($arreglo_3))
					$this->Cell($lon_4, 5, $arreglo_3[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_4, 5, "", $margen, 0, 'L');
				if($x < count($arreglo_4))
					$this->Cell($lon_5, 5, $arreglo_4[$x], $margen, 0, 'L');
				else
					$this->Cell($lon_5, 5, "", $margen, 0, 'L');
				$this->Ln();
			}
		}       
		
		function tabla_5($lon_1, $lon_2, $texto_1, $lon_3, $texto_2, $lon_4, $texto_3, $lon_5, $texto_4, $lon_6,$texto_5)
		{
			$this->Cell($lon_1, 5, "", 0, 0, 'L');
			$this->Cell($lon_2, 5, $texto_1, 1, 0, 'L');
			$this->Cell($lon_3, 5, $texto_2, 1, 0, 'L');
			$this->Cell($lon_4, 5, $texto_3, 1, 0, 'L');
			$this->Cell($lon_5, 5, $texto_4, 1, 0, 'L');
			$this->Cell($lon_6, 5, $texto_5, 1, 0, 'L');
			$this->Ln();
		}          
	}
?>
