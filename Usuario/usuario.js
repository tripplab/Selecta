$.errores_uno = function(entrar, n_caja)
{
	if($(n_caja).val() == "")
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

	$(".caja_c .editar_tipo_copei").submit(function(){
		var id = $(this).attr("value");
		var entrar = true;
		entrar = $.errores_uno(true, "#nombre_" + id);
		entrar = $.errores_uno(true, "#paterno_" + id);
		entrar = $.errores_uno(true, "#materno_" + id);
		if(entrar)
		{
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$("." + id + "_li").show();
					$("." + id + "_form").hide();
					$("#" + id + "_a").text($("#nombre" + id).val() + " " + $("#paterno_" + id).val() + "-" + $("#materno_" + id).val());
				}
				else
					alert(data);
			});
		}
		return false;
	});
	
	$(".editar_institucion").click(function(){
		var id = $(this).attr("value"); 
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
			$("#dialogo_publicacion").removeClass("dialogo_publicacion");
		}).done(function(){
			$.post("./Agregar.php", {id: id}, function(data){
				$(".yu_widget_bd").append(data);
				$(".mensaje").hide();
				$(".editar_constrasenia").hide();
			});
		});
	});
	
	
	$(".boton_invitar").click(function(){
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$.post("./Agregar_Usuario.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".mensaje").hide();
			});
		});
	});
	
	$(".cambiar_contrasenia").click(function(){
		var id = $(this).attr("value"); 
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
			$("#dialogo_publicacion").removeClass("dialogo_publicacion");
		}).done(function(){
			$.post("./Agregar.php", {id: id}, function(data){
				$(".yu_widget_bd").append(data);
				$(".mensaje").hide();
				$(".editar_institucion_").hide();
			});
		});
	});
});
