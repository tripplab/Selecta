$.errores_uno = function(entrar, n_div, n_caja, texto, texto_comparar)
{
	if(!$(n_div).is(":hidden") && $(n_caja).val() == "" && $(texto).text() == texto_comparar)
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
	
	$(".periodo_formulario .form_periodo").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar, "#nombre_div", "#nombre", "#nombre_l", "Identificador *");
		entrar = $.errores_fecha(entrar, "#inicial_div", "#dia_pub", "Día", "#mes_pub", "Mes", "#anio_pub", "Año");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".periodo_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".contenedor_cursos").empty();
				$(".contenedor_cursos").load( "./Lista_Periodos.php", {id: $("#id_programa").val()});
			});
		return false;
	});
});
