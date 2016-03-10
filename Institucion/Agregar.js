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
	
	$(".institucion_formulario .form_institucion").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar, "#nombre_div", "#nombre", "#nombre_l", "Nombre *");
		entrar = $.errores_uno(entrar, ".pais_div_", "#pais_", "#pais_l_", "País *");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".institucion_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "./Listado_Instituciones.php");
			});
		return false;
	});
	
	$(".unidad_formulario .form_unidad").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar, "#nombre_div_", "#nombre_", "#nombre_l_", "Nombre *");
		entrar = $.errores_uno(entrar, ".pais_div", "#pais", "#pais_l", "País *");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".unidad_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".columna_derecha_c").empty();
				$(".columna_derecha_c").load( "./Lista_Unidades.php", {id: $("#id_institucion").val()});
			});
		return false;
	});
});
