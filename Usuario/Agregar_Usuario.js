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

$.errores_uno = function(entrar, n_caja)
{
	if($(n_caja).val() == "")
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.errores_uno_lista = function(entrar, n_div, n_caja, texto, texto_comparar)
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
		$(this).removeClass("error_margen");
	});
	
	$(".texto").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$("body").click(function(){
		$(this).ocul_listas("#cargar_lista_institucion");
		$(this).ocul_listas("#cargar_lista_unidad");
		$(this).ocul_listas("#cargar_lista_departamento");
		$(this).ocul_listas("#cargar_lista_programa");
		$(this).ocul_listas("#cargar_lista_periodo");
	});
	
	var typingTimer;    
	
	$("#institucion").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#institucion").keyup_listas("#institucion", "#cargar_lista_institucion", "#id_institucion", "#contenedor_institucion");
			if($('#institucion').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "institucion", nombre: $("#institucion").val()}, function(data){
					$("#contenedor_institucion").html(data);
				});
		}, 1000);
	});  
	
	$("#unidad").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#unidad").keyup_listas("#unidad", "#cargar_lista_unidad", "#id_unidad", "#contenedor_unidad");
			if($('#unidad').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "unidad", institucion: $("#id_institucion").val(), nombre: $("#unidad").val()}, function(data){
					$("#contenedor_unidad").html(data);
				});
		}, 1000);
	});
	
	$("#departamento").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#departamento").keyup_listas("#departamento", "#cargar_lista_departamento", "#id_departamento", "#contenedor_departamento");
			if($('#departamento').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "departamento", unidad: $("#id_unidad").val(), nombre: $("#departamento").val()}, function(data){
					$("#contenedor_departamento").html(data);
				});
		}, 1000);
	});
	
	$("#guardar_usuario_").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar,"#nombre_usuario");
		entrar = $.errores_uno(entrar,"#a_paterno_usuario");
		entrar = $.errores_uno(entrar,"#a_materno_usuario");
		entrar = $.errores_uno(entrar,"#lugar_nacimiento_usuario");
		entrar = $.errores_uno(entrar,"#correo_usuario");
		entrar = $.errores_uno(entrar,"#nivel_usuario");
		entrar = $.errores_uno(entrar,"#institucion");
		entrar = $.errores_uno(entrar,"#unidad");
		entrar = $.errores_uno_lista(entrar, "#departamento_div","#departamento", "#departamento_l", "Departamento *");
		entrar = $.errores_fecha(entrar, "#fecha_nacimiento", "#dia_nacimiento_usuario", "Día", "#mes_nacimiento_usuario", "Mes", "#anio_nacimiento_usuario", "Año");
		if(entrar)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data != "")
					alert(data);
				else 
				{
					$(".mensaje").html("Elemento Ingresado Satisfactoriamente").show();
					$(".agregar_contenido_diaglogo_js").hide();
				}
			});
		return false;
	});
});
