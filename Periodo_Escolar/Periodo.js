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
	$(".formularios").hide();
	
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
	
	$(".tema_informacion_institucion").hover(function(){
		$(this).addClass("hover");
	}, function(){
		$(this).removeClass("hover");
	});
	
	$(".abrir_editar .abrir_editar_js").click(function(){
		$("." + $(this).attr("value") + "_li").hide();
		$("." + $(this).attr("value") + "_form").show();
	});
	
	$(".formularios .abrir_editar_js").click(function(){
		$("." + $(this).attr("value") + "_li").show();
		$("." + $(this).attr("value") + "_form").hide();
	});
	
	$(".caja_c .periodo_formulario").submit(function(){
		var id = $(this).attr("value");
		if($.errores_uno(true, "#c_" + id, "#nombre_" + id, "#" + id + "_l", "Identificador *"))
		{
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$("." + id + "_li").show();
					$("." + id + "_form").hide();
					$("#" + id + "_a").text($("#nombre_" + id).val());
				}
				else
					alert(data);
			});
		}
		return false;
	});
	
	$(".eliminar_curso").click(function(){
		var confirmar = confirm("Desea eliminar este periodo escolar");
		if(confirmar)
		{
			var id = $(this).attr("value"); 
			$.post("../Scripts/guardar.php", {opcion: "eliminar_periodo", id: id}, function(data){
				if(data == "")
					$("." + id +"_li").hide();
				else
					alert(data);
			});
		}
	});
});
