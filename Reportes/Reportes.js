$.errores_uno = function(entrar, n_caja)
{
	if($(n_caja).val() == "")
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.errores_fecha = function(entrar, dia, mes, anio)
{
	if(!(($(dia).attr("value") == "Día" && $(mes).attr("value") == "Mes" && $(anio).attr("value") == "Año") || ($(dia).attr("value") != "Día" && $(mes).attr("value") != "Mes" && $(anio).attr("value") != "Año")))
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
	
	$(".columna_derecha_c .abrir_editar_js .link_inherit").click(function(){
		$(".columna_derecha_c .editarform_laboratorio_perfil").show();
		$(this).hide();
	});
	
	$(".columna_derecha_c .abrir_editar_js .toolbar_editar .cerrar_editar_js").click(function(){
		$(".columna_derecha_c .editarform_laboratorio_perfil").hide();
		$(".columna_derecha_c .abrir_editar_js .link_inherit").show();
	});
	
	$(".columna_derecha_c .abrir_editar_js .toolbar_editar .cv_link").click(function(){
		var entrar = true;
		entrar = $.errores_uno(entrar, "#factor_impacto");
		entrar = $.errores_uno(entrar, "#no_citas");
                entrar = $.errores_uno(entrar, "#Estado_Art");
		entrar = $.errores_fecha(entrar, "#dia_i", "#mes_i", "#anio_i");
		entrar = $.errores_fecha(entrar, "#dia_f", "#mes_f", "#anio_f");
		if(entrar == true)
		{
			$(".columna_derecha_c .editarform_laboratorio_perfil").hide();
			$(".columna_derecha_c .abrir_editar_js .link_inherit").show();
			$(this).attr("href", "./Generar_CV.php?i=" + $("#anio_i").val() + "-" + $("#mes_i").val() + "-" + $("#dia_i").val() + "&f=" + $("#anio_f").val() + "-" + $("#mes_f").val() + "-" + $("#dia_f").val() + "&fac=" + $("#factor_impacto").val() + "&c=" + $("#no_citas").val()+ "&est=" + $("#Estado_Art").val());
		}
	});
});
