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
	
	$(".proyecto_").change(function(){
		if($(this).attr("value") == "Si")
			$(".a_3").show();
		else
			$(".a_3").hide();
	});
	
	$(".form_horizontal .link_accion_regresar").click(function(){
		$(".contenedor_dialogo_publicacion .form_horizontal").each(function(){ 
			this.reset();
		});
		$(".inicial").show();
		$(".comision_formulario").hide();
	});	
	
	$(".comision_formulario .form_comision").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_fecha(entrar, "#inicial_div", "#dia_i", "Día", "#mes_i", "Mes", "#anio_i", "Año");
		entrar = $.errores_fecha(entrar, "#termino_div", "#dia_t", "Día", "#mes_t", "Mes", "#anio_t", "Año");
		entrar = $.errores_fecha(entrar, "#solicitud_div", "#dia_s", "Día", "#mes_s", "Mes", "#anio_s", "Año");
		entrar = $.errores_uno(entrar, "#motivos_div", "#motivos", "#motivos_l", "Motivos *");
		entrar = $.errores_uno(entrar, ".lugar_div", "#lugar", "#lugar_l", "Lugar *");
		entrar = $.errores_uno(entrar, "#financiamiento_div", "#financiamiento", "#financiamiento_l", "Fuente Financiamiento *");
		entrar = $.errores_uno(entrar, "#profesor_div", "#profesor", "#profesor_l", "Profesor Responsable *");
		entrar = $.errores_dos(entrar, "#transporte_div", "#f_transporte", "#m_transporte");
		entrar = $.errores_dos(entrar, "#viaticos_div", "#f_viaticos", "#m_viaticos");
		entrar = $.errores_dos(entrar, "#otros_div", "#f_otros", "#m_otros");
		entrar = $.verificar_fecha(entrar, "#solicitud_div", "#inicial_div", "#dia_s", "#mes_s", "#anio_s", "#dia_i", "#mes_i", "#anio_i");
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
				$.post("./Listado_Comisiones.php",  {mostrar: 'nope'}, function(data){
					$(".comisiones_columna").empty();
					$(".comisiones_columna").append(data);
				});
			});
		$("#boton").click();
		return false;
	});
	
	$(".evento").change(function(){
		if($(this).val() == "Otros")
			$(".a_4").show();
		else
			$(".a_4").hide();
	});
	
	$(".informe_comision .form_informe").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar, "#descripcion_div", "#descripcion", "#descripcion_l", "Describir *");
		
		entrar = $.errores_fecha(entrar, "#informe_div", "#dia_in", "Día", "#mes_in", "Mes", "#anio_in", "Año");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(".contenedor_dialogo_publicacion .form_informe").serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".informe_comision").hide();
				}
				else
					alert(data);
			}).done(function(){
				$.post("./Listado_Comisiones.php", {mostrar: 'nope'}, function(data){
					$(".comisiones_columna").empty();
					$(".comisiones_columna").append(data);
				});
			});
		$("#boton").click();
		return false;
	});
});
