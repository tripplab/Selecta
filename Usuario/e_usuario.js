$.errores_uno = function(entrar, n_div, n_caja)
{
	if(!$(n_div).is(":hidden") && $(n_caja).val() === "")
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
		if( $(this).attr("value") == "nombre")
			$("#nombre_form").val($("#a_nombre").text());
		else if( $(this).attr("value") == "paterno")
			$("#paterno_form").val($("#a_paterno").text());
		else if( $(this).attr("value") == "materno")
			$("#materno_form").val($("#a_materno").text());
		else if( $(this).attr("value") == "lugar")
			$("#lugar_form").val($("#a_lugar").text());
		else if( $(this).attr("value") == "correo")
			$("#correo_form").val($("#a_correo").text());
		else if( $(this).attr("value") == "seguro")
			$("#seguro_form").val($("#a_seguro").text());
		else if( $(this).attr("value") == "nivel")
			$("#nivel_form").val($("#a_nivel").text());
	});

	$(".caja_c .editar_informacion_laboratorio").submit(function(){
		var id = $(this).attr("value");
		var entrar = true;
		entrar = $.errores_uno(entrar, ".c_nombre", "#nombre_form");
		entrar = $.errores_uno(entrar, ".c_paterno", "#paterno_form");
		entrar = $.errores_uno(entrar, ".c_materno", "#materno_form");
		entrar = $.errores_uno(entrar, ".c_lugar", "#lugar_form");
		entrar = $.errores_uno(entrar, ".c_correo", "#correo_form");
		entrar = $.errores_uno(entrar, ".c_nivel", "#nivel_form");
		entrar = $.errores_uno(entrar, ".c_nivel", "#nivel_form");
		if(entrar)
		{
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					$("." + id + "_li").show();
					$("." + id + "_form").hide();
					if(id == "nombre")
						$("#a_nombre").text($("#nombre_form").val());
					else if(id == "paterno")
						$("#a_paterno").text($("#paterno_form").val());
					else if(id == "materno")
						$("#a_materno").text($("#materno_form").val());
					else if(id == "lugar")
						$("#a_lugar").text($("#lugar_form").val());
					else if(id == "correo")
						$("#a_correo").text($("#correo_form").val());
					else if(id == "seguro")
						$("#a_seguro").text($("#seguro_form").val());
					else if(id == "nivel")
						$("#a_nivel").text($("#nivel_form").val());
				}
				else
					alert(data);
			});
		}
		return false;
	});
	
	$(".nick_name .abrir_editar_js .link_inherit").click(function(){
		$(".nick_name .editarform_laboratorio_perfil").show();
		$(this).hide();
	});
	
	$(".nick_name .abrir_editar_js .toolbar_editar .cerrar_editar_js").click(function(){
		$(".nick_name .editarform_laboratorio_perfil").hide();
		$(".nick_name .abrir_editar_js .link_inherit").show();
	});
	
	$(".lista_personas_s .link_inherit").click(function(){
		$(".lista_personas_s .editarform_laboratorio_perfil").show();
		$(this).hide();
	});
	
	$(".lista_personas_s .toolbar_editar .cerrar_editar_js").click(function(){
		$(".lista_personas_s .editarform_laboratorio_perfil").hide();
		$(".lista_personas_s  .link_inherit").show();
	});
	
	$(".editarform_laboratorio_perfil").submit(function(){
		var id = $(this).attr("value");
		var entrar = true;
		entrar = $.errores_uno(entrar, ".c_nick", "#nick");
		entrar = $.errores_uno(entrar, ".c_contrasenia", "#a_contrasenia");
		entrar = $.errores_uno(entrar, ".c_contrasenia", "#contrasenia");
		entrar = $.errores_uno(entrar, ".c_contrasenia", "#r_contrasenia");
		if(entrar)
		{
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data == "")
				{
					if(id === "nick")
						$(".nick_name .abrir_editar_js .link_inherit").show();
					else if(id === "contrasenia")
						$(".lista_personas_s .link_inherit").show();
					else
						$("." + id + "_li").show();
					$("." + id + "_form").hide();
					if(id == "nombre")
						$("#a_nombre").text($("#nombre_form").val());
					else if(id == "paterno")
						$("#a_paterno").text($("#paterno_form").val());
					else if(id == "materno")
						$("#a_materno").text($("#materno_form").val());
					else if(id == "lugar")
						$("#a_lugar").text($("#lugar_form").val());
					else if(id == "correo")
						$("#a_correo").text($("#correo_form").val());
					else if(id == "seguro")
						$("#a_seguro").text($("#seguro_form").val());
					else if(id == "nivel")
						$("#a_nivel").text($("#nivel_form").val());
				}
				else
					alert(data);
			});
		}
		return false;
	});
});
