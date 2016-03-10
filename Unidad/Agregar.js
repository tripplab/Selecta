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
	
	$(".departamento_formulario .form_departamento").submit(function(){
		$(".texto").removeClass("error_margen");
		var entrar = true;
		entrar = $.errores_uno(entrar, "#nombre_div", "#nombre", "#nombre_l", "Nombre *");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$(".mensaje").html("Producto ingresado satisfactoriamente").show();
					$(".departamento_formulario").hide();
				}
				else
					alert(data);
			}).done(function(){
				$(".columna_derecha_c").empty();
				$(".columna_derecha_c").load( "./Lista_Departamentos.php", {id: $(".form_departamento #id_unidad").val()});
				$.post("../Scripts/consulta.php", {opcion: "mostrar_departamento", id: $("#id_unidad").val()}, function(data){
					$(".facilitar_cabecera_acciones .facilitar_accion_primaria .laboratorio").show();
					$(".facilitar_cabecera_acciones .facilitar_accion_primaria .departamento").show();
					if(data != 0)
						$(".facilitar_cabecera_acciones .facilitar_accion_primaria .laboratorio").hide();
					else
						$(".facilitar_cabecera_acciones .facilitar_accion_primaria .departamento").hide();
				});
			});
		return false;
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
				$(".columna_derecha_c").load( "./Lista_Departamentos.php", {id: $(".form_laboratorio #id_unidad").val()});
				$.post("../Scripts/consulta.php", {opcion: "mostrar_departamento", id: $("#id_unidad").val()}, function(data){
					$(".facilitar_cabecera_acciones .facilitar_accion_primaria .laboratorio").show();
					$(".facilitar_cabecera_acciones .facilitar_accion_primaria .departamento").show();
					if(data != 0)
						$(".facilitar_cabecera_acciones .facilitar_accion_primaria .laboratorio").hide();
					else
						$(".facilitar_cabecera_acciones .facilitar_accion_primaria .departamento").hide();
				});
			});
		return false;
	});
});
