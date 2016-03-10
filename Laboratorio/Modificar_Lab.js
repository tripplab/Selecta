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

$.errores_fecha = function(entrar, n_div, dia, texto_dia, mes, texto_mes, anio, texto_anio)
{
	if(!$(n_div).is(":hidden") && $(dia).attr("value") == texto_dia && $(mes).attr("value") == texto_mes && $(anio).attr("value") == texto_anio)
	{
		$(dia).addClass("error_margen");
		$(mes).addClass("error_margen");
		$(anio).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.verificar_fecha = function(entrar, dia_1, mes_1, anio_1, dia_2, mes_2, anio_2)
{
	if(($(dia_2).val() != "Día" && $(mes_2).val() != "Mes" && $(anio_2).val() != "Año") && entrar) 
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
	
	$("select").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$("select").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$("body").click(function(){
		$(this).ocul_listas("#cargar_lista_usuario");
	});
	
	var typingTimer;   
	
	$("#usuario").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#usuario").keyup_listas("#usuario", "#cargar_lista_usuario", "#id_usuario", "#contenedor_usuario");
			if($('#usuario').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "usuario_laboratorio", nombre: $("#usuario").val(), laboratorio: $("#id_laboratorio").val()}, function(data){
					$("#contenedor_usuario").html(data);
				});
		}, 1000);
	});
	
	$(".miembro").submit(function(){
		var entrar = true;
		entrar = $.errores_uno(entrar, ".c_usuario", "#usuario", "#usuario_l", "Usuario *");
		entrar = $.errores_uno(entrar, ".c_tipo_direccion", "#tipo", "#tipo_l", "Tipo Direccion *");
		entrar = $.errores_fecha(entrar, "#inicial_div", "#dia_pub", "Día", "#mes_pub", "Mes", "#anio_pub", "Año");
		entrar = $.verificar_fecha(entrar, "#dia_pub", "#mes_pub", "#anio_pub", "#dia_pub_t", "#mes_pub_t", "#anio_pub_t");
		
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data != "")
					alert(data);
				else
				{
					$("#columna_derecha").empty();
					$("#columna_derecha").load("./Lista_Miembros.php", {id: $("#id_laboratorio").val()});
					$(".miembro").hide();
					$(".mensaje").html("Elemento almacenado satisfactoriamente").show();
				}
			});
		return false;
	});
});
