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
	$(".actualizar").click(function(){
		if($("#sid").val() != "")
			$.post("../Scripts/guardar.php", $(".actualizar_jcr").serialize(), function(data){
				if(data == "")
					alert("Operación procesada correctamente");
				else
					alert("error al procesar la petición");
			});
		else 
			alert("La caja esta vacía");
	});
	
	$(".link_inherit").click(function(){
		$(".actualizar_jcr").show();
	});
	
	$(".actualizar_jcr .cerrar_editar_js").click(function(){
		$(".actualizar_jcr").hide();
		$("#sid").val("");
	});
	
	$(".formularios").hide();
	
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
	
	$(".caja_c .editar_tipo_copei").submit(function(){
		var id = $(this).attr("value");
		if($.errores_uno(true, "#c_" + id, "#descripcion_" + id, "#" + id + "_l", "Descripción *"))
		{
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$("." + id + "_li").show();
					$("." + id + "_form").hide();
					$("#" + id + "_a").text($("#descripcion_" + id).val());
				}
				else
					alert(data);
			});
		}
		return false;
	});
});
