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
	$("#columna_derecha").load("./Lista_Miembros.php", {id: $("#id_laboratorio").val()});
		
	$(".tema_informacion_institucion").hover(function(){
		$(this).addClass("hover");
	}, function(){
		$(this).removeClass("hover");
	});
	
	$(".formularios").hide();
	
	/*$(".laboratorio_perfil .editar_link").click(function(){
		$("#acerca_laboratorio_" + $(this).attr("value")).addClass("caja_c laboratorio_perfil");
		$("#laboratorio_estatico_" + $(this).attr("value")).hide();
		$("#laboratorio_dinamico_" + $(this).attr("value")).show();
	});
	
	$(".editarform_laboratorio_perfil .cerrar_editar_js").click(function(){
		$("#acerca_laboratorio_" + $(this).attr("value")).removeClass("caja_c laboratorio_perfil");
		$("#laboratorio_estatico_" + $(this).attr("value")).show();
		$("#laboratorio_dinamico_" + $(this).attr("value")).hide();
	});*/
	
	$(".texto").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".texto").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$(".facilitar_envoltura .facilitar_cabecera_acciones .boton_invitar").click(function(){
		var laboratorio = $("#id_laboratorio").val();
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
			$("#dialogo_publicacion").removeClass("dialogo_publicacion");
		}).done(function(){
			$.post("../Laboratorio/Modificar_Lab.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".mensaje").hide();
				$(".a_1").hide();
				$("#id_laboratorio").val(laboratorio);
				$.post("../Scripts/consulta.php", {opcion: "usuario_rol"}, function(data){
					if(data.Rol != "Profesor")
					{
						$("#usuario").val(data.Nombre + " " + data.Apellido_Paterno + "-" + data.Apellido_Materno).attr("disabled", true);
						$("#id_usuario").val(data.ID_Usuario);
					}
				}, "json");
			});
		});
	});
	
	$("body").click(function(){
		$(this).ocul_listas("#cargar_lista_institucion");
		$(this).ocul_listas("#cargar_lista_unidad");
		$(this).ocul_listas("#cargar_lista_departamento");
	});
	
	var typingTimer;    
	
	$("#institucion").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#institucion").keyup_listas("#institucion", "#cargar_lista_institucion", "#id_institucion", "#contenedor_institucion");
			if($('#institucion').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "institucion", nombre: $("#institucion").val()}, function(data){
					$("#contenedor_institucion").html(data);
				});
		}, 1000);
	}); 
	
	$("#unidad").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#unidad").keyup_listas("#unidad", "#cargar_lista_unidad", "#id_unidad", "#contenedor_unidad");
			if($('#unidad').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "unidad", institucion: $("#id_institucion").val(), nombre: $("#unidad").val()}, function(data){
					$("#contenedor_unidad").html(data);
				});
		}, 1000);
	}); 
	
	$("#departamento").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#departamento").keyup_listas("#departamento", "#cargar_lista_departamento", "#id_departamento", "#contenedor_departamento");
			if($('#departamento').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "departamento", unidad: $("#id_unidad").val(), nombre: $("#departamento").val()}, function(data){
					$("#contenedor_departamento").html(data);
				});
		}, 1000);
	});
	
	var institucion;
	var unidad;
	var departamento;
	$(".abrir_editar .abrir_editar_js").click(function(){
		$("." + $(this).attr("value") + "_li").hide();
		$("." + $(this).attr("value") + "_form").show();
		institucion = $("#id_institucion").val();
		unidad = $("#id_unidad").val();
		departamento = $("#id_departamento").val();
		if($("#id_departamento").val() != "")
			$("#departamento_div").show();
		else
			$("#departamento_div").hide();
	});
	
	$(".formularios .abrir_editar_js").click(function(){
		$("." + $(this).attr("value") + "_li").show();
		$("." + $(this).attr("value") + "_form").hide();
		if($(this).attr("value") == "CUD")
		{
			$("#id_institucion").val(institucion);
			$("#id_unidad").val(unidad);
			$("#id_departamento").val(departamento);
			$("#institucion").val($("#a_institucion").text());
			$("#unidad").val($("#a_unidad").text());
			$("#departamento").val($("#a_departamento").text());
		}
		else if($(this).attr("value") == "numero")
			$("#numero_form").val($("#a_numero").text());
		else if($(this).attr("value") == "nombre")
			$("#nombre_form").val($("#a_nombre").text());
		else if($(this).attr("value") == "descripcion")
			$("#descripcion_form").val(($("#a_descripcion").text() == "Agregar Descripción") ? "" : $("#a_descripcion").text());
		else if($(this).attr("value") == "telefono")
			$("#telefono_form").val(($("#a_telefono").text() == "Agregar Telefono") ? "" : $("#a_telefono").text());
		else if($(this).attr("value") == "pagina")
			$("#pagina_form").val(($("#a_pagina").text() == "Agregar Página Web") ? "" : $("#a_pagina").text());
		else if($(this).attr("value") == "cupo")
			$("#cupo_form").val(($("#a_cupo").text() == "Agregar Cupo") ? "" : $("#a_cupo").text());
	});
	
	$(".seccion_editar .editar_informacion_laboratorio").submit(function(){
		var entrar = true;
		entrar = $.errores_uno(entrar, ".c_institucion", "#institucion", "#institucion_l", "Institucion *");
		entrar = $.errores_uno(entrar, ".c_unidad", "#unidad", "#unidad_l", "Unidad *");
		entrar = $.errores_uno(entrar, ".c_departamento", "#departamento", "#departamento_l", "Departamento *");
		entrar = $.errores_uno(entrar, ".c_numero", "#numero_form", "#numero_l", "Numero *");
		entrar = $.errores_uno(entrar, ".c_nombre", "#nombre_form", "#nombre_l", "Nombre *");
		if(entrar == true)
		{
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data != "")
					alert(data);
			});
			$("." + $(this).attr("value") + "_li").show();
			$("." + $(this).attr("value") + "_form").hide();
			if($(this).attr("value") == "CUD")
			{
				$("#a_institucion").text($("#institucion").val());
				$("#a_unidad").text($("#unidad").val());
				$("#a_departamento").text($("#departamento").val());
			}
			else if($(this).attr("value") == "numero")
				$("#a_numero").text($("#numero_form").val());
			else if($(this).attr("value") == "nombre")
				$("#a_nombre").text($("#nombre_form").val());				
			else if($(this).attr("value") == "descripcion")
				$("#a_descripcion").text(($("#descripcion_form").val() == "") ? "Agregar Descripción" : $("#descripcion_form").val());
			else if($(this).attr("value") == "telefono")
				$("#a_telefono").text(($("#telefono_form").val() == "") ? "Agregar Telefono" : $("#telefono_form").val());
			else if($(this).attr("value") == "pagina")
				$("#a_pagina").text(($("#pagina_form").val() == "") ? "Agregar Página Web" : $("#pagina_form").val());
			else if($(this).attr("value") == "cupo")
				$("#a_cupo").text(($("#cupo_form").val() == "") ? "Agregar Cupo" : $("#cupo_form").val());
		}
		return false;
	});
});
