$.errores_uno = function(entrar, n_div, n_caja, texto, texto_comparar)
{
	if(!$(n_div).is(":hidden") && $(n_caja).val() == "" && $(texto).text() == texto_comparar)
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

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

$.errores_lista = function(entrar, n_div, n_caja)
{
	if(!$(n_div).is(":hidden") && $(n_caja).val() == "")
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$(document).ready(function()
{
	$("body").click(function(){
		$(this).ocul_listas("#cargar_lista_institucion");
		$(this).ocul_listas("#cargar_lista_unidad");
	});
	
	$(".texto").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".texto").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$(".programa_formulario .form_programa").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar, "#nombre_div", "#nombre", "#nombre_l", "Nombre *");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".programa_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "./Listado_Programas.php");
			});
		return false;
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
	
	$(".programa_unidad_formulario .form_unidad_programa").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_lista(entrar, "#institucion_div", "#institucion");
		entrar = $.errores_lista(entrar, "#unidad_div", "#unidad");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".programa_unidad_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "./Listado_Programas.php");
			});
		return false;
	});
});
