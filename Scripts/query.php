<?php
include '../Scripts/conexion.php';

class Querys extends Conexion{
	var $error;
	var $identificador;
	var $mensaje;
	
	function Querys()
	{
		parent::Conexion();
	}
	
	function Guardar($sql)
	{
		$conexion = parent::Conexion_BD();
		$conexion->query("SET NAMES 'utf8'");
		$conexion->query($sql);
		$this->identificador = $conexion->insert_id;
		$this->error = $conexion->error;
		$conexion->close();
	}
	
	function Consultas($sql)
	{
		$array = array();
		$conexion = parent::Conexion_BD();
		$conexion->query("SET NAMES 'utf8'");
		$resultado = $conexion->query($sql);
		while($row = $resultado->fetch_array())
                {
			$array[] = $row;
		      
                }
                  $conexion->close();
		        return $array;
	}
	
	function Eliminar($sql)
	{
		$conexion = parent::Conexion_BD();
		$conexion->query("SET NAMES 'utf8'");
		$conexion->query($sql);
		$conexion->close();
	}
	
	function Autores_Articulos_Tesis($identificador, $autores, $sql_1, $sql_2)
	{
		$autor = $this->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE ID_Usuario = ".$_SESSION["Usuario_Temporal"]);
		$autor =  $autor[0];
		$nombre = explode(" ", $autor["Nombre"]);
		$nombre_av = "";
		for($i = 0; $i < count($nombre); $i++)
			$nombre_av .= substr($nombre[$i], 0, 1).". ";
		$nombre_av = trim($nombre_av);
		for($i = 0; $i < count($autores); $i++)
		{
			$autores[$i] = trim($autores[$i]);
			if(strcmp($autores[$i], $autor["Nombre"]." ".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]) == 0 || strcmp($autores[$i], $autor["Nombre"]." ".$autor["Apellido_Paterno"]) == 0 || strcmp($autores[$i], $nombre_av." ".$autor["Apellido_Paterno"]) == 0 || strcmp($autores[$i], $nombre_av." ".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]) == 0 || strcmp($autores[$i], $autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]." ".$nombre_av) == 0 || strcmp($autores[$i], $autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]." ".$autor["Nombre"]) == 0)
			{
				$maximo = $this->Consultas($sql_2);
				$maximo = $maximo[0]["Max"] + 1;			
				$sql_1 .= " ('".$autores[$i]."', ".$maximo.", ".$_SESSION["Usuario_Temporal"].", ".$identificador.")";
			}
			else if($autores[$i] != "")
				$sql_1 .= " ('".$autores[$i]."', 1, null, ".$identificador.")";
			$sql_1 .= ",";
		}
		$sql_1 = trim($sql_1, ',');
		$this->Guardar($sql_1);
		//$this->error = $conexion->error;
	}
	
	function Actualizar_Autores_Articulos_Tesis($tabla, $campo, $identificador, $sql_1, $sql_2)
	{
		$autor = $this->Consultas("SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Usuario WHERE ID_Usuario = ".$_SESSION["Usuario_Temporal"]);
		$autor =  $autor[0];
		$nombre = explode(" ", $autor["Nombre"]);
		$nombre_av = "";
		for($i = 0; $i < count($nombre); $i++)
			$nombre_av .= substr($nombre[$i], 0, 1).". ";
		$nombre_av = trim($nombre_av);
		$autores = $this->Consultas($sql_1);
		$sql = "";
		for($i = 0; $i < count($autores); $i++)
		{
			if(strcmp($autores[$i]["Alias"], $autor["Nombre"]." ".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]) == 0 || strcmp($autores[$i]["Alias"], $autor["Nombre"]." ".$autor["Apellido_Paterno"]) == 0 || strcmp($autores[$i]["Alias"], $nombre_av." ".$autor["Apellido_Paterno"]) == 0 || strcmp($autores[$i]["Alias"], $nombre_av." ".$autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]) == 0 || strcmp($autores[$i]["Alias"], $autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]." ".$nombre_av) == 0 || strcmp($autores[$i], $autor["Apellido_Paterno"]."-".$autor["Apellido_Materno"]." ".$autor["Nombre"]) == 0)
			{
				$maximo = $this->Consultas($sql_2);		
				$maximo = $maximo[0]["Max"] + 1;			
				$sql = "UPDATE ".$tabla." SET FK_Usuario = ".$_SESSION["Usuario_Temporal"].", Etiqueta_Copei = ".$maximo." WHERE ".$campo." = ".$autores[$i]["ID"];
			
                               
                        }
		}
		if($sql != "")
		{
			$this->Guardar($sql);
			$this->error = $conexion->error;
		}
	}
	
	function Editar_Autores_Articulos_Tesis($autores_bd, $autores_caja, $tabla, $campo, $identificador, $sql_1, $sql_2)
	{
		$autores = array();
		for($x = 0; $x < count($autores_bd) && $x < count($autores_caja); $x++)
			if($autores_bd[$x]["Alias"] != $autores_caja[$x])
				$this->Guardar("UPDATE ".$tabla." SET Alias = '".$autores_caja[$x]."' WHERE ".$campo." = ".$autores_bd[$x]["ID_Alias"]);
		for(; $x < count($autores_caja); $x++)
			$autores[] = $autores_caja[$x];
		if(count($autores) > 0)
			$this->Autores_Articulos_Tesis($identificador, $autores, $sql_1, $sql_2);
		unset($autores);
		for(; $x < count($autores_bd); $x++)
			$this->Eliminar("DELETE FROM ".$tabla." WHERE ".$campo." = ".$autores_bd[$x]["ID_Alias"]);
	}
	
	function encontrar_doi($doi)
	{		
		$datos = array();
		$doi = trim($doi);           
		##########	open esearch, fetch PMID	##########
		$request_url = "http://www.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=Pubmed&term=" . $doi . "[AID]&usehistory=y&retstart=&retmax=1&sort=&tool=I,Librarian&email=i.librarian.software@gmail.com";

		$xml = $this->proxy_simplexml_load_file($request_url);
		if (empty($xml)) die('Error!');
		$count = $xml->Count;
		if ($count == 1)
			$pmid = $xml->IdList->Id;
        if (!empty($pmid)) {
            ##########	open efetch, read xml	##########
            $request_url = "http://www.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=Pubmed&rettype=abstract&retmode=XML&id=" . urlencode($pmid) . "&tool=I,Librarian&email=i.librarian.software@gmail.com";

            $xml = $this->proxy_simplexml_load_file($request_url);
            if (empty($xml)) die('Error!');
            $istitle = '';
            if (!empty($xml))
                $istitle = $xml->PubmedArticle->MedlineCitation->Article->ArticleTitle;
            if (!empty($istitle)) {
                if (!isset($doi)) {
                    foreach ($xml->PubmedArticle->PubmedData->ArticleIdList->ArticleId as $articleid) {
                        preg_match('/10\.\d{4}\/\S+/i', $articleid, $doi);
                        if (count($doi) > 0) {
                            $doi = current($doi);
                            break;
                        }
                    }
                }
                //$_POST['reference_type'] = strtolower($xml->PubmedArticle->MedlineCitation->Article->PublicationTypeList->PublicationType[0]);
                $datos["Titulo"] = (string) $xml->PubmedArticle->MedlineCitation->Article->ArticleTitle;
                $abstract_array = array();
                $xml_abstract = $xml->PubmedArticle->MedlineCitation->Article->Abstract->AbstractText;

                if (!empty($xml_abstract)) {
                    foreach ($xml_abstract as $mini_ab) {
                        foreach ($mini_ab->attributes() as $a => $b) {
                            if ($a == 'Label')
                                $mini_ab = $b . ": " . $mini_ab;
                        }
                        $abstract_array[] = "$mini_ab";
                    }
                   $datos["Abstract"] = implode(' ', $abstract_array);
                }

				$datos["Segundo_Titulo"] = (string) $xml->PubmedArticle->MedlineCitation->Article->Journal->Title;
                $day = (string) $xml->PubmedArticle->MedlineCitation->Article->Journal->JournalIssue->PubDate->Day;
                $month = (string) $xml->PubmedArticle->MedlineCitation->Article->Journal->JournalIssue->PubDate->Month;
                $year = (string) $xml->PubmedArticle->MedlineCitation->Article->Journal->JournalIssue->PubDate->Year;
                if (empty($year)) {
                    $year = (string) $xml->PubmedArticle->MedlineCitation->Article->Journal->JournalIssue->PubDate->MedlineDate;
                    preg_match('/\d{4}/', $year, $year_match);
                    $year = $year_match[0];
                }
                if (!empty($year)) {
                    if (empty($day))
                        $day = '01';
                    if (empty($month))
                        $month = '01';
                   $datos["Dia"] = $day;
                   $datos["Mes"] = $month;
                   $datos["Anio"] = $year;
                }
				$datos['Volumen'] = (string) $xml->PubmedArticle->MedlineCitation->Article->Journal->JournalIssue->Volume;
                $datos['Issue'] = (string) $xml->PubmedArticle->MedlineCitation->Article->Journal->JournalIssue->Issue;
                $datos['Paginas'] = (string) $xml->PubmedArticle->MedlineCitation->Article->Pagination->MedlinePgn;
                $datos['Journal_Abreviacion'] = (string) $xml->PubmedArticle->MedlineCitation->MedlineJournalInfo->MedlineTA;
                $datos['Afiliacion'] = (string) $xml->PubmedArticle->MedlineCitation->Article->Affiliation;
                $authors = $xml->PubmedArticle->MedlineCitation->Article->AuthorList->Author;
                $name_array = array();
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        $name_array[] = $author->LastName . ' ' . $author->ForeName;
                    }
                }
                /*$mesh = $xml->PubmedArticle->MedlineCitation->MeshHeadingList->MeshHeading;
                if (!empty($mesh)) {
                    foreach ($mesh as $meshheading) {
                        $mesh_array[] = $meshheading->DescriptorName;
                    }
                }*/
                if (isset($name_array))
                    $datos['Autores'] = join(", ", $name_array);
                /*if (isset($mesh_array))
                    $datos['Palabras_Claves'] = join(" / ", $mesh_array);*/
            }
        }
        if (!empty($doi) || empty($pmid)) {
            if (!empty($doi)) {
                $lookfor = 'doi=' . urlencode($doi);
            }
            ############ NASA ADS ##############
            $request_url = "http://adsabs.harvard.edu/cgi-bin/abs_connect?" . $lookfor . "&data_type=XML&return_req=no_params&start_nr=1&nr_to_return=1";

            $xml = $this->proxy_simplexml_load_file($request_url);
            if (empty($xml)) die('Error!');
            foreach ($xml->attributes() as $a => $b) {
                if ($a == 'selected') {
                    $count = $b;
                    break;
                }
            }
            if ($count == 1) {
                $record = $xml->record;
                $bibcode = $record->bibcode;
				$datos["Titulo"] = (string) $record->title;
                $journal = $record->journal;
                if (strstr($journal, ","))
                    $datos["Segundo_Titulo"] = substr($journal, 0, strpos($journal, ','));
                $eprintid = $record->eprintid;
                if (!empty($eprintid))
                    $eprintid = substr($eprintid, strpos($eprintid, ":") + 1);
                if (strstr($journal, "arXiv"))
                    $eprintid = substr($journal, strpos($journal, ":") + 1);
                $doi = $record->DOI;
              
                $datos['Volumen'] = (string) $record->volume;
                $datos['Paginas'] = (string) $record->page;
                $last_page = $record->lastpage;
                if (!empty($last_page))
                   $datos['Paginas'] = $datos['Paginas'] . '-' . $last_page;
                $datos['Afiliacion'] = (string) $record->affiliation;
                $year = $record->pubdate;
                $datos['Fecha'] = date('Y-m-d', strtotime($year));
                $datos['Abstract'] = (string) $record->abstract;
                $nasa_url = $record->url;
                foreach ($record->link as $links) {
                    foreach ($links->attributes() as $a => $b) {
                        if ($a == 'type' && $b == 'EJOURNAL') {
                            $ejournal_url = $links->url;
                        } elseif ($a == 'type' && $b == 'PREPRINT') {
                            $preprint_url = $links->url;
                        } elseif ($a == 'type' && $b == 'GIF') {
                            $gif_url = $links->url;
                        }
                    }
                }
                $authors = $record->author;
                $name_array = array();
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        $author_array = explode (",", $author);
                        $name_array[] = trim($author_array[0]).' '.trim($author_array[1]);
                    }
                }
                if (isset($name_array))
                    $datos['Autores'] = join(", ", $name_array);
                /*$keywords = $record->keywords;
                if (!empty($keywords)) {
                    foreach ($keywords as $keyword) {
                        $keywords_array[] = $keyword->keyword;
                    }
                }
                if (isset($keywords_array))
                    $datos['Palabras_Claves'] = join(" / ", $keywords_array);
                $uid_array = array();
                if (!empty($bibcode))
                    $uid_array[] = "NASAADS:$bibcode";
                if (!empty($eprintid))
                    $uid_array[] = "ARXIV:$eprintid";
                $_POST['uid'] = join("|", $uid_array);

                $url_array = array();
                $url_array[] = $nasa_url;
                if (!empty($eprintid))
                    $url_array[] = "http://arxiv.org/abs/$eprintid";
                $_POST['url'] = join("|", $url_array);*/
            }
            if ($count < 1) {
                ############ CrossRef ##############
                $request_url = "http://www.crossref.org/openurl/?id=doi:" . urlencode($doi) . "&noredirect=true&pid=i.librarian.software@gmail.com";
                $xml = $this->proxy_simplexml_load_file($request_url);
                if (empty($xml)) die('Error!');
                $resolved = false;
                if (!empty($xml)) {
					if($xml->query_result->body->query)
					{
						$record = $xml->query_result->body->query;
						foreach ($record->attributes() as $a => $b) {
							if ($a == 'status' && $b == 'resolved') {
								$resolved = true;
								break;
							}
						}
					}
                }
                if ($resolved) {
                    $datos["Segundo_Titulo"] = (string) $record->journal_title;
                    if(empty($datos["Segundo_Titulo"])) $datos["Segundo_Titulo"] = (string) $record->volume_title;
                    $datos['Anio'] = (string) $record->year;
                    $datos['Mes'] = "01";
                    $datos['Dia'] = "01";
                    $datos['Volumen'] = (string) $record->volume;
                    $datos['Issue'] = (string) $record->issue;
                    $datos['Paginas'] = (string) $record->first_page;
                    $last_page = $record->last_page;
                    if (!empty($last_page))
                       $datos['Paginas'] = $datos['Paginas'] . "-" . $last_page;
                    $datos["Titulo"] = (string) $record->article_title;
                    $authors = array();
                    foreach ($record->contributors->contributor as $contributor) {
                        $authors1 = $contributor->surname;
                        $authors2 = $contributor->given_name;
                        $authors[] = $authors1.' '. $authors2;
                    }
                    $datos['Autores'] = join(", ", $authors);
                }
            }
        }
        return $datos;
	}
	
	function proxy_simplexml_load_file($url) {
		global $xml;
		$xml = false;
		$xml_string = '';
		$xml_string2 = '';
		ini_set('user_agent', $_SERVER['HTTP_USER_AGENT']);
		$xml = @simplexml_load_file($url);
		#JSTOR hack
		if (strpos($url, 'jstor') !== false) {
			$xml = new XMLReader();
			$xml->open($url);
		}
		#NASA PHYS hack
		if (empty($xml) && strpos($url, 'adsabs') !== false) {
			$xml_string2 = '';
			$host = parse_url($url, PHP_URL_HOST);
			$path = parse_url($url, PHP_URL_PATH);
			$query = parse_url($url, PHP_URL_QUERY);
			$proxy_fp = @fsockopen($host, 80);
			if ($proxy_fp) {
				fputs($proxy_fp, "GET $path?$query HTTP/1.0\r\n");
				fputs($proxy_fp, "Host: $host\r\n");
				fputs($proxy_fp, "User-Agent: \"$_SERVER[HTTP_USER_AGENT]\"\r\n\r\n");
				while (!feof($proxy_fp)) {
					$xml_string2 .= fgets($proxy_fp, 128);
				}
				fclose($proxy_fp);
				$response = array();
				$response = explode("\r\n", $xml_string2);
				while (list($key, $value) = each($response)) {
					if (stripos($value, "Location: ") === 0) {
						$new_url = trim(substr($value, 10));
						if ($new_url != $url)
							break;
					}
				}
				if (!empty($new_url)) {
					if (stripos($new_url, "http") !== 0)
						$new_url = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST) . $new_url;
					ini_set('user_agent', $_SERVER['HTTP_USER_AGENT']);
					$xml = @simplexml_load_file($url);
				
                                        
                                }
			}
		}
		return $xml;
	}
}	
?>
