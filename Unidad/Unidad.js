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
	$.post("../Scripts/consulta.php", {opcion: "mostrar_departamento", id: $("#id_unidad").val()}, function(data){
		if(data != 0)
			$(".facilitar_cabecera_acciones .facilitar_accion_primaria .laboratorio").hide();
	});
	
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
		if($(this).attr("value") == "nombre")
			$("#nombre_form").val($("#a_nombre").text());
		else if($(this).attr("value") == "ubicacion")
		{
			$("#domicilio_form").val(($("#h_domicilio").val() == "Agregar Dirección") ? "" : $("#h_domicilio").val());
			$("#ciudad_form").val(($("#h_ciudad").val() == "Agregar Ciudad") ? "" : $("#h_ciudad").val());
			$("#pais_form").val($("#h_pais").val());
		}
		else if($(this).attr("value") == "abreviacion")
			$("#abreviacion_form").val(($("#a_abreviacion").text() == "Agregar Abreviación") ? "" : $("#a_abreviacion").text());
		else if($(this).attr("value") == "pagina")
			$("#pagina_form").val(($("#a_pagina").text() == "Agregar Página Web") ? "" : $("#a_pagina").text());
		else if($(this).attr("value") == "telefono")
			$("#telefono_form").val(($("#a_telefono").text() == "Agregar Teléfono") ? "" : $("#a_telefono").text());
	});
	
	$(".seccion_editar .editar_informacion_unidad").submit(function(){
		var entrar = true;
		entrar = $.errores_uno(entrar, ".c_nombre", "#nombre_form", "#nombre_l", "Nombre *");
		entrar = $.errores_uno(entrar, ".c_pais", "#pais_form", "#l_pais", "Pais *");
		if(entrar == true)
		{
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data != "")
					alert(data);
			});
			$("." + $(this).attr("value") + "_li").show();
			$("." + $(this).attr("value") + "_form").hide();
			if($(this).attr("value") == "nombre")
				$("#a_nombre").text($("#nombre_form").val());
			else if($(this).attr("value") == "ubicacion")
			{
				$("#h_domicilio").val(($("#domicilio_form").val() == "") ? "Agregar Dirección" : $("#domicilio_form").val());
				$("#h_ciudad").val(($("#ciudad_form").val() == "") ? "Agregar Ciudad" : $("#ciudad_form").val());
				$("#h_pais").val($("#pais_form").val());
				$("#a_ubicacion").text((($("#ciudad_form").val() == "") ? "" : $("#ciudad_form").val() + ", ") + $("#pais_form").val());
			}
			else if($(this).attr("value") == "abreviacion")
				$("#a_abreviacion").text(($("#abreviacion_form").val() == "") ? "Agregar Abreviación" : $("#abreviacion_form").val());
			else if($(this).attr("value") == "pagina")
				$("#a_pagina").text(($("#pagina_form").val() == "") ? "Agregar Página Web" : $("#pagina_form").val());
			else if($(this).attr("value") == "telefono")
				$("#a_telefono").text(($("#telefono_form").val() == "" ? "Agregar Teléfono" : $("#telefono_form").val()));
		}
		return false;
	});
	
	$(".columna_derecha_has .facilitar_cabecera_acciones .departamento").click(function(){
		var id = $("#id_unidad").val(); 
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$.post("./Agregar.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".laboratorio_formulario").hide();
				$(".mensaje").hide();
				$(".form_departamento #id_unidad").val(id);
			});
		});
	});
	
	$(".columna_derecha_has .facilitar_cabecera_acciones .laboratorio").click(function(){
		var id = $("#id_unidad").val(); 
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$.post("./Agregar.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".departamento_formulario").hide();
				$(".mensaje").hide();
				$(".form_laboratorio #id_unidad").val(id);
			});
		});
	});
});
