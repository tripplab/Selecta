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
	
	$("body").click(function(){
		$(this).ocul_listas("#cargar_lista_usuario");
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
	
	$(".colegio_formulario .form_colegio").submit(function(){
		$(".texto").removeClass("error_margen");
		if($.errores_uno(true, ".c_usuario", "#usuario", "#usuario_l", "Usuario *"))
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".colegio_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".contenedor_cursos").empty();
				$(".contenedor_cursos").load( "./Lista_Colegio.php", {id: $("#id_programa").val()});
			});
		return false;
	});
});
