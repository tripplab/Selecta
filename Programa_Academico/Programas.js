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
		$("#nombre_form").val($("#a_nombre").text());
	});
	
	$(".seccion_editar .editar_informacion_programa").submit(function(){
		if($.errores_uno(true, ".c_nombre", "#nombre_form", "#nombre_l", "Nombre *"))
		{
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data != "")
					alert(data);
			});
			$("." + $(this).attr("value") + "_li").show();
			$("." + $(this).attr("value") + "_form").hide();
			$("#a_nombre").text($("#nombre_form").val());
		}
		return false;
	});
	
	$(".columna_derecha_has .cabecera_contenedora_derecha .agregar_js").click(function(){
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$.post("./Agregar.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".programa_unidad_formulario").hide();
				$(".mensaje").hide();
			});
		});
	});
	
	$(".columna_derecha_has .facilitar_cabecera_acciones .boton_invitar").click(function(){
		var id = $("#id_programa").val();
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$.post("./Agregar.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".programa_formulario").hide();
				$(".mensaje").hide();
				$("#programa_id").val(id);
			});
		});
	});
});
