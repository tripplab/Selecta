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

$.errores_dos = function(entrar, n_div, caja_1, caja_2)
{
	if(!$(n_div).is(":hidden") && ($(caja_1).attr("value") == "" || $(caja_2).attr("value") == ""))
	{
		$(caja_1).addClass("error_margen");
		$(caja_2).addClass("error_margen");
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

$(document).ready(function()
{
	$("body").click(function(){
		$(this).ocul_listas("#cargar_lista_usuario");
	});
	
	$(".texto").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".texto").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$(".fechas").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".fechas").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	var tipo;
	$(".mostrar_tipo_copei").click(function(){
		tipo = $(this).attr("value");
	});
	
	$(".contenedor_intercanbio_subir .contenedor_titulo_publicacion .submit_form_accion").submit(function(){
		if(tipo != null)
		{
			$(".inicial").hide();
			$(".comision_formulario").show();
			$("#tipo_comision_").val(tipo);
			$("#tipo_").text(tipo);
			$("#fecha_l").text("Fecha Inicio *");
			if(tipo == "Internacional" || tipo == "Nacional")
			{
				$(".a_1").show();
				$(".a_2").hide();
				$("#tipo_").text("Convenios de colaboración académica, científica y tecnológica. Institución " + tipo );
				$("#proyecto_l").text("Proyecto *");
			}
			else if(tipo == "Logros")
			{
				$("#proyecto_l").text("Logro *");
				$(".a_1").hide();
				$(".a_2").hide();
				$("#termino_div").hide();
				$("#institucion_div").hide();
				$("#fecha_l").text("Fecha *");
			}
			else if(tipo == "Servicios")
			{
				$(".a_1").hide();
				$(".a_2").show();
				$("#tipo_").text("Servicios de Laboratorio");
				$("#proyecto_l").text("Servicio *");
			}
			else
			{
				$(".a_1").hide();
				$(".a_2").show();
				$("#tipo_").text(tipo);
				$("#proyecto_l").text("Proyecto *");
			}
		}
		return false;
	});
	
	$(".form_horizontal .link_accion_regresar").click(function(){
		$(".contenedor_dialogo_publicacion .form_horizontal").each(function(){ 
			this.reset();
		});
		$(".inicial").show();
		$(".comision_formulario").hide();
	});
	
	var typingTimer;  
	
	$("#usuario").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#usuario").keyup_listas("#usuario", "#cargar_lista_usuario", "#id_usuario", "#contenedor_usuario");
			if($('#usuario').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "usuario_profesor", nombre: $("#usuario").val()}, function(data){
					$("#contenedor_usuario").html(data);
				});
		}, 1000);
	});
	
	$(".comision_formulario .form_comision").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_fecha(entrar, "#inicial_div", "#dia_i", "Día", "#mes_i", "Mes", "#anio_i", "Año");
		entrar = $.errores_fecha(entrar, "#termino_div", "#dia_t", "Día", "#mes_t", "Mes", "#anio_t", "Año");
		entrar = $.errores_uno(entrar, "#proyecto_div", "#proyecto", "#proyecto_l", "Proyecto *");
		entrar = $.errores_uno(entrar, "#proyecto_div", "#proyecto", "#proyecto_l", "Servicio *");
		entrar = $.errores_uno(entrar, "#proyecto_div", "#proyecto", "#proyecto_l", "Proyecto *");
		entrar = $.errores_uno(entrar, "#proyecto_div", "#proyecto", "#proyecto_l", "Logro *");
		entrar = $.errores_uno(entrar, "#institucion_div", "#institucion", "#institucion_l", "Institución *");
		entrar = $.errores_uno(entrar, "#objetivo_div", "#objetivo", "#objetivo_l", "Objetivos *");
		entrar = $.verificar_fecha(entrar, "#inicial_div", "#termino_div", "#dia_i", "#mes_i", "#anio_i", "#dia_t", "#mes_t", "#anio_t");
		
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".comision_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$.post("./Listado_Temporal.php", function(data){
					$(".publicacion_cuerpo_p").empty();
					$(".publicacion_cuerpo_p").append(data);
				});
			});
		$("#boton").click();
		return false;
	});
});
