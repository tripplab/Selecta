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
	var text;
	$(".mostrar_tipo_copei").click(function(){
		tipo = $(this).attr("value");
		text = $("#" + tipo + "_l").text();
	});
	
	$(".form_horizontal .link_accion_regresar").click(function(){
		$(".contenedor_dialogo_publicacion .form_horizontal").each(function(){ 
			this.reset();
		});
		$(".inicial").show();
		$(".comite_formulario").hide();
	});
	
	$(".comite_formulario .form_comite").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_fecha(entrar, "#inicial_div", "#dia_i", "Día", "#mes_i", "Mes", "#anio_i", "Año");
		//entrar = $.errores_fecha(entrar, "#termino_div", "#dia_t", "Día", "#mes_t", "Mes", "#anio_t", "Año");
		entrar = $.errores_uno(entrar, "#motivos_div", "#motivos", "#motivos_l", "Nombre Comité *");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".comite_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$.post("./Listado_Comites.php", function(data){
					$(".comisiones_columna").empty();
					$(".comisiones_columna").append(data);
				});
			});
		$("#boton").click();
		return false;
	});
});
