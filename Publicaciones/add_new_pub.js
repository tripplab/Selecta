




$.fn.most_ocul_listas = function(valor, ocul_most)
{
	if(ocul_most == true)
	{
		$(valor).removeClass("yu_aclista_escondida");
		$(valor).attr("aria-hidden", "true");
	}
	else
		$(valor).ocul_listas(valor);
}

$.fn.ocul_listas = function(valor)
{
	$(valor).addClass("yu_aclista_escondida");
	$(valor).attr("aria-hidden", "false");
}

$.fn.keyup_listas = function(caja, div_contenedor, identificador, limpiar_ul)
{
	if($(caja).val().length > 1)
		$(caja).most_ocul_listas(div_contenedor, true);
	else
	{
		$(identificador).val("");
		$(caja).most_ocul_listas(div_contenedor, false);
		$(limpiar_ul).empty();
	}
}


$.errores_uno = function(entrar, n_div, n_caja, texto, texto_comparar)
{
	if(!$(n_div).is(":hidden") && $(n_caja).val() == "" && $(texto).text() == texto_comparar)
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.errores_dos = function(entrar, n_div, caja_1, texto_caja_1, caja_2, texto_caja_2, texto, texto_comparar)
{
	if(!$(n_div).is(":hidden") && $(caja_1).attr("value") == texto_caja_1 && $(caja_2).attr("value") == texto_caja_2 && $(texto).text() == texto_comparar)
	{
		$(caja_1).addClass("error_margen");
		$(caja_2).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.errores_lista = function(entrar, n_div, n_caja)
{
	if(!$(n_div).is(":hidden") && $(n_caja).val() == "")
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.errores_fecha = function(entrar, n_div, dia, texto_dia, mes, texto_mes, anio, texto_anio)
{
	if(!$(n_div).is(":hidden") && ($(dia).attr("value") == texto_dia || $(mes).attr("value") == texto_mes || $(anio).attr("value") == texto_anio))
	{
		$(dia).addClass("error_margen");
		$(mes).addClass("error_margen");
		$(anio).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.verificar_fecha = function(entrar, n_div_1, n_div_2, dia_1, mes_1, anio_1, dia_2, mes_2, anio_2)
{
	if(!$(n_div_2).is(":hidden") && entrar) 
	{
		var dtPrev = new Date();
		dtPrev.setFullYear($(anio_1).attr("value"), $(mes_1).attr("value"), $(dia_1).attr("value"));
		var dtToday = new Date();
		dtToday.setFullYear($(anio_2).attr("value"), $(mes_2).attr("value"), $(dia_2).attr("value"));
 
		if (dtPrev > dtToday) {
			$(dia_1).addClass("error_margen");
			$(mes_1).addClass("error_margen");
			$(anio_1).addClass("error_margen");
			$(dia_2).addClass("error_margen");
			$(mes_2).addClass("error_margen");
			$(anio_2).addClass("error_margen");
			entrar = false;
			alert("La fecha inicial debe ser menor que la final");
		} 	
	}
	return entrar;
}

$.fn.most_ocul_form_prod = function(tipo, titulo)
{
	var partes = tipo.split(".");
	$.post("../Scripts/consulta.php", {opcion: "nombre" }, function(data){
		$("#autores").val(data); 
                
	});
        
        $.post("../Scripts/consulta.php", {opcion: "Titule", Type:tipo}, function(data){
		$("#Name_producto").val(data);
                
	});
	//$("#titulo").removeClass("quitar_margen");
	//$("#titulo").addClass("quitar_margen");
	$("#titulo").val(titulo);
       
	$("#titulo_esc").val(titulo);
	$("#tipo_copei_").val(tipo);
	$("#tipo_copei_esc").val(tipo);
	$(".control_grupo").hide();
	$(".autores").hide();
        
	$("#anio_lic").hide();
	$("#vol").attr("placeholder", "Volumen");
	$("#num").attr("placeholder", "Numero");
	$("#pag").attr("placeholder", "Pagina(s)");
	$("#autor_l").text("Autores *");
        
	$("#cita_l").text("Cita");
	$("#fecha_l").text("Fecha *");
	$("#capitulo_l").text("Conferencia *");
	$("#localidad_l").text("Localidad");
	$("#editorial_l").text("Editorial");
	$("#tema_l").text("Libro");
	$("#referencia_l").text("No Reporte");
	$("#datos_l").text("Propedeútico/Nivel");
	$("#nocitas_l").text("Numero de Citas");
	$("#abstract_l").text("Abstract");
	$("#gra_an").text("Año/Grado *");
	$("#tema_pag_l").text("Tema");
	$("#escolaridad").show();
	$("#pag").show();
	$("#isbn").text("ISBN");	
	$("#propedeutico").show();	
	if(tipo == "0.1")
	{
		$(".a_30").show();
		$(".a_21").show();
		$("#tema_pag_l").text("Especialidad *");
	}
	else if(tipo == "0.2")
	{
		$("#tema_pag_l").text("Nombre *");
		$(".a_32").show();
	}
	else if(tipo == "1.2")
		$(".a_31").show();
	else if(tipo == "1.1")
	{
		$(".a_30").show();
		$(".a_21").show();
		$("#escolaridad").hide();
		$("#tema_pag_l").text("Nombre *");
		$("#gra_an").text("Año *");
	}
	else if(tipo == "0.3")
	{
		$("#cita_l").text("Posición *");
		$("#pag").hide();
		$(".a_1").show();
		$("#vol").attr("placeholder", "Categoria");
		$("#num").attr("placeholder", "Subcategoria");
		$("#localidad_l").text("Puesto");
		$(".a_31").show();
	}
	else if((partes[0] == "2" && (partes[1] == "1" || partes[1] == "2" || partes[1] == "3")) || tipo == "4.5" || tipo == "4.7" || tipo == "4.12")
		$(".a_1").show();
	else if(tipo == "2.4" || tipo == "2.5")
        {
		$(".a_24").show();
                $(".a_titulo").show();
            }
	else if(partes[0] == "2" && (partes[1] == "7" || partes[1] == "8" || partes[1] == "9" || partes[1] == "11" || partes[1] == "12"))
		$(".a_3").show();
	else if(partes[0] == "3" && partes[1] == "1" )
		$(".a_5").show();
	else if(partes[0] == "3" && (partes[1] == "3" || partes[1] == "2"))
	{
		$("#autor_l").text("Director 1 *");
                $("#autores2").show();
                
		$(".a_6").show();	
		$("#nivel").hide();
		$("#datos_l").text("Concluido");
		$(".a_22").show();
		$(".a_31").show();
		$("#localidad_l").text("Lugar *");
		$("#referencia_l").text("Alumno *");
	}
        else if(tipo == "3.3")
	{
            $("#nivel2").show();
        }
	else if(tipo == "4.6")
	{
		$("#capitulo_l").text("Miembro");
		$("#localidad_l").text("Revista");
	}
	else if(tipo == "4.9")
	{
		$("#capitulo_l").text("Conferencia");
		$("#localidad_l").text("Titulo");
		$(".a_27").show();	
		$("#abstract_l").text("Descripción");
	}
	else if(tipo == "4.10")
	{
		$(".a_16").show();	
		$("#capitulo_l").text("Responsabilidad");
	}
	else if(tipo == "4.11")
		$("#capitulo_l").text("Disctinción");
	else if(tipo == "4.13")
	{
		$("#capitulo_l").text("Estudiante");
		$("#localidad_l").text("Puesto");
		$("#isbn").text("SNI");
	}
	else if(tipo == "4.15")
	{
		$("#localidad_l").text("Titulo");
		$("#capitulo_l").text("Responsable");
		$("#isbn").text("Subproducto");
		$(".a_31").show();	
	}
	else if(tipo == "4.16")
	{
		$("#referencia_l").text("No Patente");
		$(".a_22").show();	
	}
	else if(partes[0] == "5")
	{
		$(".a_28").show();
		$(".a_23").show();
		$("#abstract_l").text("Descripción *");
	}	
	if(tipo == "2.1.a" || tipo == "2.1.b" || tipo == "2.1.c" || tipo == "2.1.d" || tipo == "2.2")
		$(".a_10").show();	
	else if(tipo == "2.1.e")
		$(".a_14").show();
	else if(tipo == "2.1.f" || tipo == "2.1.g")
	{
		$(".a_11").show();
		$("#tema_l").text("Revista");
	}
	else if(tipo == "2.3" || tipo == "2.4" || tipo == "2.5")
		$(".a_2").show();
            
	else if(partes[0] == "2" && partes[1] == "7")
	{
		$("#editorial_l").text("Afiliación");
		$(".a_9").show();
	}
	else if(partes[0] == "2" && partes[1] == "8")
	{
		$(".a_12").show();	
		$("#referencia_l").text("No Referencia");
		$("#localidad_l").text("Pag. WEB");
	}	
	
	else if(tipo == "4.12")
	{
		$(".a_12").show();
		$("#referencia_l").text("Tipo Responsabilidad");
		$("#abstract_l").text("Objetivos");
		$("#capitulo_l").text("Pag. WEB");
		$("#cita_l").text("Gastos");
		$("#vol").attr("placeholder", "Gastos de inversión");
		$("#num").attr("placeholder", "Gastos de correlación");
		$("#pag").attr("placeholder", "Tipo de moneda");
		$(".a_27").show();	
	}
	else if(tipo == "2.9")
	{
                $("#tema_div").hide();
                 $("#divdoi").hide();
                     $(".a_autores1").hide();
		$(".a_17").show();	
		$("#tema_l").text("Impacto");
		$("#abstract_l").text("Descripción");
	}
	else if(partes[0] == "2" &&  partes[1] == "10")
	{
		$(".a_29").show();	
		$("#abstract_l").text("Descripción");
	}
	else if(tipo == "2.11.a" || tipo == "2.11.b" || tipo == "2.12.a"){
		$(".a_4").show();
                if(tipo == "2.11.b" ){
                    $(".a_24").show();
                    
                }
            }
	else if(partes[0] == "3" && partes[1] == "1")
	{
		$("#fecha_l").text("Fecha Inicial *");
		$(".a_26").show();	
		$("#nocitas_l").text("Total de Horas *");
	}
	else if(tipo == "4.5")
	{
		$("#capitulo_l").text("Medio de Discución");
		$("#localidad_l").text("Discutido por");
	}
	if(tipo == "2.1.a")
		$(".a_13").show();	
	else if(tipo == "2.1.b" || tipo == "2.1.e" || tipo == "2.2")
	{
		$(".a_15").hide();
		$(".a_25").show();
		$("#tema_l").text("Revista");
	}
	else if(tipo == "2.3" || tipo == "2.11.b")
	{
		$(".a_16").show();	
		$("#capitulo_l").text("Capitulo");
	}
	else if(tipo == "4.11" || tipo == "4.15")
		$(".a_16").show();	
	else if(tipo == "3.1.c")
	{
		$("#nivel").show();
		$("#anio_lic").hide();
		
	}	
	else if(tipo == "4.5" || tipo == "4.6" || tipo == "4.9" || tipo == "4.12" || tipo == "4.13" || tipo == "2.1.c" || tipo == "2.1.d")
		$(".a_8").show();	
	else if(tipo == "2.12.a")
		$(".a_25").show();
	else if(tipo == "2.12.b")
	{
		$(".a_16").show();
		$(".a_31").show();
	}
	else if(tipo == "2.12.c")
	{
		$(".a_1").show();
		$(".a_31").show();
		$("#localidad_l").text("Revista");
	}
	if(tipo == "2.3" || tipo == "2.9" || tipo == "2.11.a")
		$(".a_25").show();
	else if(tipo == "4.12" || tipo == "1.2")
	{
		$(".a_20").show();
		$("#fecha_l").text("Fecha Inicial *");
	}
	if(tipo == "2.11.a" || tipo == "2.11.b"  || tipo == "2.12.a"  || tipo == "2.12.c" || tipo == "4.13" || tipo == "4.15")
		$(".a_19").show();	
	else if(tipo == "4.3" || tipo == "4.4" || tipo == "4.5" || tipo == "4.7" || tipo == "4.8" || tipo == "4.10" || tipo == "4.11" || tipo == "4.14" || tipo == "4.16" || tipo == "4.17" || tipo == "4.18")
	{
		$(".a_27").show();	
		$("#abstract_l").text("Descripción");
	}
	else if(tipo == "4.6")
	{
		$("#isbn").text("ISSN");	
		$(".a_19").show();
		$(".a_27").show();	
		$("#abstract_l").text("Descripción");
	}
	if(partes[0] == "2" || tipo == "3.3" || partes[0] == "3" && partes[1] == "2")
        {
		$(".a_autores").show();	
              if(partes[1] != "9"){
            $(".a_autores1").show();
        }
        else{
              $(".a_autores1").hide();
        }
        }
        if( tipo == "3.1" || tipo == "3.2" || tipo == "3.2.a" || tipo == "3.2.b" || tipo == "3.3")
        {
		
            $(".a_autores1").hide();
            
        }
        if(tipo == "3.1.a"){
            $("#institucion").val("Centro de Investigación de Estudios Avanzados");
            $("#nivel2").hide();
             
        }
         if(tipo == "3.1.b"  ){
            $("#institucion").val("");
             $("#nivel2").hide();
        }
         if(tipo == "3.1.c" ){
            $("#institucion").val("");
            
        }
         if(tipo == "3.2.a" || tipo == "3.2.b"){
       
             $("#nivel2").hide();
        }
         if(tipo == "3.3" ){
           
             $("#nivel2").show();
        }
	if((partes[0] == "3" && (partes[1] == "1")) || partes[0] == "4"|| tipo == "0.2" || tipo == "0.3" || tipo == "1.2")
		$(".a_7").show();
	if(tipo == "2.12.e" || tipo == "2.12.f" || tipo == "2.12.g" || tipo == "2.12.h")
	{
		$(".a_3").hide();
		$(".autores").hide();
	}
	if(tipo == "2.12.e" || tipo == "2.12.f")
	{
		$(".c_usuario").show();
		$(".a_40").show();
		$("#fecha_l").text("Fecha Inicio *");
		$("#referencia_l").text("Evento *");
		$("#capitulo_l").text("Objetivos *");
	}
	else if(tipo == "2.12.g")
	{
		$(".c_usuario").show();
		$(".a_40").show();
		$("#referencia_l").text("Nombre Visitante *");
		$("#capitulo_l").text("Objetivos *");
		$("#termino_div").hide();
	}
	else if(tipo == "2.12.h")
	{
		$(".c_usuario").show();
		$(".a_40").show();
		$("#referencia_l").text("Reportero/Medios *");
		$("#capitulo_l").text("Tema *");
		$("#termino_div").hide();
	}
	else if(tipo == "3.1.d")
		$("#propedeutico").hide();
}

$.fn.ocul_most_tit = function(valor)
{
	$("#titulo_producto").hide();
	$("#textarea_titulo").hide();
	$(".agrandar").attr("disabled", true);
	if(valor == true)
	{
		$("#titulo_producto").show();
		$("#textarea_titulo").show();
		if($("#textarea_titulo").val().length > 0)
			$(".agrandar").attr("disabled", false);
		$("#aceptar_titulo").val("si");
	}
	else
		$("#aceptar_titulo").val("no");
}

$(document).ready(function()
{
	$("body").click(function(){
		$(this).ocul_listas("#cargar_lista_journal");
		$(this).ocul_listas("#cargar_lista_institucion");
		$(this).ocul_listas("#cargar_lista_unidad");
		$(this).ocul_listas("#cargar_lista_programa");
		$(this).ocul_listas("#cargar_lista_curso");
		$(this).ocul_listas("#cargar_lista_tesis");
		$(this).ocul_listas("#cargar_lista_usuario");
	});
	/*******************************add_new_pub****************************************/
	$(".texto").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".texto").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$("#doi").focus(function(){
		$(".borde_doi").addClass("activo_buscar");
	});
	
	$("#doi").blur(function(){
		$(".borde_doi").removeClass("activo_buscar");
	});
	
	$(".fechas").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".fechas").blur(function(){
		$(this).removeClass("activo_buscar");
	});
/*	
	$("#textarea_titulo").keyup(function(){
		if($(this).val().length > 0)
			$(".agrandar").attr("disabled", false);
		else
			$(".agrandar").attr("disabled", true);
	});
*/	
	$(".contenedor_intercanbio_subir .contenedor_titulo_publicacion .submit_form_accion").submit(function(){
		var tipo = $("#tipo_copei").val();
		var titulo = ($("#aceptar_titulo").val() == "si") ? $("#textarea_titulo").val() : "";
		var partes = tipo.split(".");
		$(".inicial").hide();
		if((partes[0] == "2" && partes[1] == "1" || partes[0] == "3" && (partes[1] == "2" || partes[1] == "3") || tipo == "4.12") && titulo != "")
			$.post("../Scripts/consulta.php", {opcion: "matches", titulo: titulo, tipo: tipo}, function(data){
				if(data != "")
				{
					$("#titulo_e_matches").val(titulo);
					$("#tipo_e_matches").val(tipo);
					$("#matches").show();
					$("#matches .lista_duplicada").empty();
					$("#matches .lista_duplicada").append(data);
				}
				else
				{
					$(".nuevo").show();
					$(".yu_widget_bd").most_ocul_form_prod(tipo, titulo);
				}
				if($("#aceptar_titulo").val() == "si")
					$(".a_titulo").show();
			});
		else
		{
			$(".nuevo").show();
			$(".yu_widget_bd").most_ocul_form_prod(tipo, titulo);
			if($("#aceptar_titulo").val() == "si")
				$(".a_titulo").show();
		}
		return false;
	});
	
	$(".esconder_t_c_1").hide();
	$(".esconder_t_c_2").hide();
	$("#titulo_producto").hide();
	$("#textarea_titulo").hide();
	
	$(".mostrar_tipo_copei").click(function(){
		$("#tipo_copei").val($(this).attr("value"));
		$(".esconder_t_c_1").hide();
		$(".esconder_t_c_2").hide();
		$("." + $(this).attr("value")).show();
		$(this).ocul_most_tit(false);
		if($(this).attr("value") == "5" || $(this).attr("value") == "2.12.e" || $(this).attr("value") == "2.12.f" || $(this).attr("value") == "2.12.g" || $(this).attr("value") == "2.12.h" || $(this).attr("value") == "3.1.d")
		{
			$(".agrandar").attr("disabled", false);
			var tipo = $("#tipo_copei").val();
			var titulo = ($("#aceptar_titulo").val() == "si") ? $("#textarea_titulo").val() : "";
			var partes = tipo.split(".");
			$(".inicial").hide();
			if((partes[0] == "2" && partes[1] == "1" || partes[0] == "3" && (partes[1] == "2" || partes[1] == "3") || tipo == "4.12") && titulo != "")
				$.post("../Scripts/consulta.php", {opcion: "matches", titulo: titulo, tipo: tipo}, function(data){
					if(data != "")
					{
						$("#titulo_e_matches").val(titulo);
						$("#tipo_e_matches").val(tipo);
						$("#matches").show();
						$("#matches .lista_duplicada").empty();
						$("#matches .lista_duplicada").append(data);
					}
					else
					{
						$(".nuevo").show();
						$(".yu_widget_bd").most_ocul_form_prod(tipo, titulo);
					}
					if($("#aceptar_titulo").val() == "si")
						$(".a_titulo").show();
				});
			else
			{
				$(".nuevo").show();
				$(".yu_widget_bd").most_ocul_form_prod(tipo, titulo);
				if($("#aceptar_titulo").val() == "si")
					$(".a_titulo").show();
			}
		}
	});
	
	$(".mostrar_tipo_copei_1").click(function(){
		var partes = $(this).attr("value").split("_");
		$("#tipo_copei").val(partes[0] + "." + partes[1]);
		$(".esconder_t_c_2").hide();
		$("." + $(this).attr("value")).show();
		var tipo = $(this).attr("value");
		var valor = false;
		if(tipo == "2_2" || tipo == "2_3" || tipo == "2_4" || tipo == "2_9" || tipo == "3_3" || tipo == "4_12")
			valor = true;
		$(this).ocul_most_tit(valor);
		if(partes[0] == "0" || partes[0] == "1" || tipo == "2_5" || tipo == "4_2" || tipo == "4_3" || tipo == "4_4" || tipo == "4_5" || tipo == "4_6" || tipo == "4_7" || tipo == "4_8" || tipo == "4_9" || tipo == "4_10" || tipo == "4_11" || tipo == "4_13" || tipo == "4_14" || tipo == "4_15" || tipo == "4_16" || tipo == "4_17" || tipo == "4_18" || tipo == "2_2" || tipo == "2_3" || tipo == "2_4" || tipo == "2_9" || tipo == "3_3" || tipo == "4_12")
		{
			$(".agrandar").attr("disabled", false);
	 		
			var tipo = $("#tipo_copei").val();
			var titulo = ($("#aceptar_titulo").val() == "si") ? $("#textarea_titulo").val() : "";
			var partes = tipo.split(".");
			$(".inicial").hide();
			if((partes[0] == "2" && partes[1] == "1" || partes[0] == "3" && (partes[1] == "2" || partes[1] == "3") || tipo == "4.12") && titulo != "")
				$.post("../Scripts/consulta.php", {opcion: "matches", titulo: titulo, tipo: tipo}, function(data){
					if(data != "")
					{
						$("#titulo_e_matches").val(titulo);
						$("#tipo_e_matches").val(tipo);
						$("#matches").show();
						$("#matches .lista_duplicada").empty();
						$("#matches .lista_duplicada").append(data);
					}
					else
					{
						$(".nuevo").show();
						$(".yu_widget_bd").most_ocul_form_prod(tipo, titulo);
					}
					if($("#aceptar_titulo").val() == "si")
						$(".a_titulo").show();
				});
			else
			{
				$(".nuevo").show();
				$(".yu_widget_bd").most_ocul_form_prod(tipo, titulo);
				if($("#aceptar_titulo").val() == "si")
					$(".a_titulo").show();
			}
		}
	});
	
	$(".mostrar_tipo_copei_2").click(function(){
		$("#tipo_copei").val($(this).attr("value"));
		var tipo =  $(this).attr("value");
		var partes = $(this).attr("value").split(".");
		var valor = false;
		if(partes[0] == "2" && (partes[1] == "1" || partes[1] == "7" || partes[1] == "8" || partes[1] == "11") || tipo == "2.12.c" || tipo == "2.12.d" || partes[0] == "3" && partes[1] == "2")
			valor = true;
		$(this).ocul_most_tit(valor);
		if(partes[0] == "3" && partes[1] == "1" || partes[0] == "2" && partes[1] == "10" || tipo == "2.12.a" || tipo == "2.12.b" || partes[0] == "2" && (partes[1] == "1" || partes[1] == "7" || partes[1] == "8" || partes[1] == "11") || tipo == "2.12.c" || tipo == "2.12.d" || partes[0] == "3" && partes[1] == "2")
		{
			$(".agrandar").attr("disabled", false);
			
			var tipo = $("#tipo_copei").val();
			var titulo = ($("#aceptar_titulo").val() == "si") ? $("#textarea_titulo").val() : "";
			var partes = tipo.split(".");
			$(".inicial").hide();
			if((partes[0] == "2" && partes[1] == "1" || partes[0] == "3" && (partes[1] == "2" || partes[1] == "3") || tipo == "4.12") && titulo != "")
				$.post("../Scripts/consulta.php", {opcion: "matches", titulo: titulo, tipo: tipo}, function(data){
					if(data != "")
					{
						$("#titulo_e_matches").val(titulo);
						$("#tipo_e_matches").val(tipo);
						$("#matches").show();
						$("#matches .lista_duplicada").empty();
						$("#matches .lista_duplicada").append(data);
					}
					else
					{
						$(".nuevo").show();
						$(".yu_widget_bd").most_ocul_form_prod(tipo, titulo);
					}
					if($("#aceptar_titulo").val() == "si")
						$(".a_titulo").show();
				});
			else
			{
				$(".nuevo").show();
				$(".yu_widget_bd").most_ocul_form_prod(tipo, titulo);
				if($("#aceptar_titulo").val() == "si")
					$(".a_titulo").show();
			}
		}
	});
	
	/*******************************formulario publicacion*****************************************/
	var typingTimer;          

	$('#journal').keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$(this).keyup_listas("#journal", "#cargar_lista_journal", "#id_journal", "#contenedor_journal");
			if($('#journal').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "journal", nombre: $('#journal').val()}, function(data){
					$("#contenedor_journal").html(data);
				});
		}, 1000);
	});

	$("#institucion").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#institucion").keyup_listas("#institucion", "#cargar_lista_institucion", "#id_institucion", "#contenedor_institucion");
			if($('#institucion').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "institucion", nombre: $("#institucion").val()}, function(data){
					$("#contenedor_institucion").html(data);
				});
		}, 5);
	});
	
	$("#unidad").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#unidad").keyup_listas("#unidad", "#cargar_lista_unidad", "#id_unidad", "#contenedor_unidad");
			if($('#unidad').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "unidad", institucion: $("#id_institucion").val(), nombre: $("#unidad").val()}, function(data){
					$("#contenedor_unidad").html(data);
				});
		}, 5);
	});
	
	$("#programa").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#programa").keyup_listas("#programa", "#cargar_lista_programa", "#id_programa", "#contenedor_programa");
			if($('#unidad').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "programa", unidad: $("#id_unidad").val(), nombre: $("#programa").val()}, function(data){
					$("#contenedor_programa").html(data);
				});
		}, 5);
	});
	
	$("#curso").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#curso").keyup_listas("#curso", "#cargar_lista_curso", "#id_curso", "#contenedor_curso");
			if($('#curso').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "curso", programa: $("#id_programa").val(), nombre: $("#curso").val()}, function(data){
					$("#contenedor_curso").html(data);
				});
		}, 5);
	});
	
	$("#tesis").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#tesis").keyup_listas("#tesis", "#cargar_lista_tesis", "#id_tesis", "#contenedor_tesis");
			if($('#tesis').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "tesis", nombre: $("#tesis").val()}, function(data){
					$("#contenedor_tesis").html(data);
				});
		}, 5);
	});
	
	$("#usuario").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#usuario").keyup_listas("#usuario", "#cargar_lista_usuario", "#id_usuario", "#contenedor_usuario");
			if($('#usuario').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "usuario_profesor", nombre: $("#usuario").val()}, function(data){
					$("#contenedor_usuario").html(data);
				});
		}, 5);
	});
	
	$(".uno_por_uno .barra_footer .link_accion_regresar").click(function(){
		$("#matches").hide();
		$(".inicial").show();
		$(".nuevo").hide();
		$(".lectura").hide();
	});
	
	$(".eleccion .barra_footer .link_accion_regresar").click(function(){
		$("#matches").hide();
		$(".opcion").show();
		$(".nuevo").hide();
		$(".lectura").hide();
		$(".inicial").hide();
	});
	
	$(".contenedor_dialogo_publicacion .agregar_nuevo_producto").submit(function(){
		$(".agrandar").attr("disabled", true);
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar, "#referencia_div", "#referencia", "#referencia_l", "Reportero/Medios *");
		entrar = $.errores_uno(entrar, "#referencia_div", "#referencia", "#referencia_l", "Nombre Visitante *");
		entrar = $.errores_uno(entrar, "#referencia_div", "#referencia", "#referencia_l", "Evento *");
		entrar = $.errores_uno(entrar, "#capi_div", "#capitulo", "#capitulo_l", "Tema *");
		entrar = $.errores_uno(entrar, "#capi_div", "#capitulo", "#capitulo_l", "Objetivos *");
		entrar = $.errores_uno(entrar, ".a_autores", "#autores", "#autor_l", "Autores *");
		entrar = $.errores_uno(entrar, ".a_autores", "#autores", "#autor_l", "Director(es) *");
		entrar = $.errores_uno(entrar, "#tema_div", "#topic", "#tema_pag_l", "Especialidad *");
		entrar = $.errores_uno(entrar, "#tema_div", "#topic", "#tema_pag_l", "Nombre *");
		entrar = $.errores_uno(entrar, "#abs_div", "#abstract", "#abstract_l", "Descripción *");
		entrar = $.errores_uno(entrar, "#nocitas_div", "#citas", "#nocitas_l", "Total de Horas *");
		entrar = $.errores_uno(entrar, "#capi_div", "#capitulo", "#capitulo_l", "Conferencia *");
		entrar = $.errores_uno(entrar, "#referencia_div", "#referencia", "#referencia_l", "Alumno *");
		entrar = $.errores_lista(entrar, "#institucion_div", "#institucion");
		//entrar = $.errores_lista(entrar, "#unidad_div", "#unidad");
		entrar = $.errores_lista(entrar, "#programa_div", "#programa");
		entrar = $.errores_lista(entrar, "#curso_div", "#curso");
                entrar = $.errores_lista(entrar, "#Estado_div", "#stado");
                
//		entrar = $.errores_lista(entrar, "#journal_div", "#journal");
                entrar = $.errores_lista(entrar, "#titule", "#titulo");
		entrar = $.errores_lista(entrar, ".c_usuario", "#usuario");
//		entrar = $.errores_fecha(entrar, "#inicial_div", "#dia_pub", "Día", "#mes_pub", "Mes", "#anio_pub", "Año");
		entrar = $.errores_fecha(entrar, "#termino_div", "#dia_pub_t", "Día", "#mes_pub_t", "Mes", "#anio_pub_t", "Año");
		entrar = $.errores_dos(entrar, "#grado_anio_div", "#anio_esc", "Año", "#escolaridad", "Escolaridad", "#gra_an", "Año/Grado *");
		entrar = $.errores_dos(entrar, "#cita_div", "#vol", "", "#num", "", "#cita_l", "Posición *");
		entrar = $.errores_uno(entrar, "#localidad_div", "#localidad", "#localidad_l", "Lugar *");
		entrar = $.verificar_fecha(entrar, "#inicial_div", "#termino_div", "#dia_pub", "#mes_pub", "#anio_pub", "#dia_pub_t", "#mes_pub_t", "#anio_pub_t");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(".contenedor_dialogo_publicacion .form_horizontal").serialize(), function(data){
				if(data == "")
				{
					$(".nuevo").hide();
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".contenedor_dialogo_publicacion .contenedor_dialogo .form_horizontal").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
				if($(".menu_publicaciones .antecedentes").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .antecedentes_academicos");	
				else if($(".menu_publicaciones .productos_2").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .productos_menu_2");	
				else if($(".menu_publicaciones .formacion").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .formacion_recursos");	
				else if($(".menu_publicaciones .repercusion").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .repercusion_academica");	
				else if($(".menu_publicaciones .criterios").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .criterios_adicionales");
				$.post("./Puntaje.php", function(data){
					$(".menu_publicaciones #menu_antecedentes").text(data.puntaje_antecedentes_max);
					$(".menu_publicaciones #menu_productos").text(data.puntaje_publicaciones_min + " - " + data.puntaje_publicaciones_max);
					$(".menu_publicaciones #menu_formacion").text(data.puntaje_curso_max);
					$("#puntaje_total").text(data.puntaje_total_min + " - " + data.puntaje_total_max);
				}, "json");
			});
		$("#editar_publicacion_").empty();
		$("#boton").click();
		$(".agrandar").attr("disabled", false);
		return false;
	});
	
	/*************************************formulario matches**********************************************/	
	$(".contenedor_dialogo_publicacion .form_mat").submit(function(){
		if($('input:radio[name=id_publicacion]:checked').val() == "nuevo")
		{
			$("#matches").hide();
			$(".nuevo").show();
			$(".yu_widget_bd").most_ocul_form_prod($("#tipo_e_matches").val(), $("#titulo_e_matches").val());
		}
		else if($('input:radio[name=id_publicacion]:checked').val() != null)
			$.post("../Scripts/guardar.php", $(".contenedor_dialogo_publicacion .form_mat").serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$("#matches").hide();
				}
			}).done(function(){
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
				if($(".menu_publicaciones .antecedentes").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .antecedentes_academicos");	
		
				else if($(".menu_publicaciones .productos_2").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .productos_menu_2");	
				else if($(".menu_publicaciones .formacion").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .formacion_recursos");	
				else if($(".menu_publicaciones .repercusion").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .repercusion_academica");	
				else if($(".menu_publicaciones .criterios").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .criterios_adicionales");
				$.post("./Puntaje.php", function(data){
					$(".menu_publicaciones #menu_antecedentes").text(data.puntaje_antecedentes_max);
					$(".menu_publicaciones #menu_productos").text(data.puntaje_publicaciones_min + " - " + data.puntaje_publicaciones_max);
					$(".menu_publicaciones #menu_formacion").text(data.puntaje_curso_max);
					$("#puntaje_total").text(data.puntaje_total_min + " - " + data.puntaje_total_max);
				}, "json");
			});
		return false;
	});
	
	$("#contenedor_spin").hide();
	
	$("#buscar_doi").click(function(){
		$("#cargando_div").addClass("cargando");
		$("#contenedor_spin").show();
		$.post("../Scripts/consulta.php", {opcion: "doi", doi: $("#doi").val()}, function(data){
			$("#titulo_esc").val(data.Titulo);
			$("#titulo").val(data.Titulo);
			$("#abstract").val(data.Abstract);
			$("#journal").val(data.Segundo_Titulo);
			$("#id_journal").val(data.ID_Journal);
			$("#dia_pub").val((data.Dia > 9) ? data.Dia : data.Dia[1]);
			$("#mes_pub").val((data.Mes > 9) ? data.Mes : data.Mes[1]);
			$("#anio_pub").val(data.Anio);
			$("#vol").val(data.Volumen);
			$("#num").val(data.Issue);
			$("#pag").val(data.Paginas);
			$("#editorial").val(data.Afiliacion);
			$("#autores").val(data.Autores);
			if(data.ID_Journal == null)
			{
				if(!$("#titulo_libro").is(":hidden"))
					$("#titulo_libro").val(data.Segundo_Titulo);
				else if(!$("#capitulo").is(":hidden"))
					$("#capitulo").val(data.Segundo_Titulo);
			}
		}, "json").done(function(){
			$("#cargando_div").removeClass("cargando");
			$("#contenedor_spin").hide();
		}).fail(function() {
			alert("Verificar DOI");
			$("#cargando_div").removeClass("cargando");
			$("#contenedor_spin").hide();
		});
	});
	
	$(".opcion .agregar_articulo_producto_js").click(function(){
		$(".inicial").show();
		$(".opcion").hide();
	});
	
	$(".opcion .agregar_subir_archivo").click(function(){
		$(".lectura").show();
		$(".opcion").hide();
	});
	
	$(".contenedor_seleccionar_archivo .accion_seleccionar_archivo").click(function(){
		$("#subir_archivo").click();
	});
	
	$("#subir_archivo").change(function(){
		if($("#subir_archivo").attr("value") != "")
		{
			var fd = new FormData();
			fd.append("userfile", $("#subir_archivo")[0].files[0]);
			fd.append("opcion", "lectura");
			$.ajax({
				url: '../Scripts/guardar.php',
				type: 'POST',
				data: fd,
				cache: false,
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				success: function(data)
				{	
					if(data == 1)
						alert("Ingresar un archivo con extensión .txt");
					else
					{
						$(".leer_archivo .agregar_titulo_publicacion_publicaciones").val(data);
						$(".lectura_agregar").attr("disabled", false);
					}
				}
			});
		}
	});
	
	$(".lectura_agregar").attr("disabled", true);
	
	$("#lectura_text").keyup(function(){
		if($(this).val().length > 0)
			$(".lectura_agregar").attr("disabled", false);
		else
			$(".lectura_agregar").attr("disabled", true);
	});
	
	$(".leer_archivo").submit(function(){
		$.post("../Scripts/lectura.php", $(this).serialize(), function(data){
			alert(data);
		});
		return false;
	});
});
