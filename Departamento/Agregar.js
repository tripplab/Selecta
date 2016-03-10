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
	
	$(".laboratorio_formulario .form_laboratorio").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar, "#nombre_div_", "#nombre_", "#nombre_l_", "Nombre *");
		entrar = $.errores_uno(entrar, ".numero_div", "#numero", "#numero_l", "Número *");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".laboratorio_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".columna_derecha_c").empty();
				$(".columna_derecha_c").load( "./Lista_Laboratorios.php", {id: $("#id_departamento").val()});
			});
		return false;
	});
});
