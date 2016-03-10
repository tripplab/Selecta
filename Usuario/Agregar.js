$.errores_uno_ = function(entrar, n_div, n_caja)
{
	if(!$(n_div).is(":hidden") && $(n_caja).val() === "")
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

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
	$(".texto").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".texto").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$("body").click(function(){
		$(this).ocul_listas("#cargar_lista_institucion");
		$(this).ocul_listas("#cargar_lista_unidad");
		$(this).ocul_listas("#cargar_lista_departamento");
		$(this).ocul_listas("#cargar_lista_programa");
		$(this).ocul_listas("#cargar_lista_periodo");
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
	
	$("#programa").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#programa").keyup_listas("#programa", "#cargar_lista_programa", "#id_programa", "#contenedor_programa");
			if($('#unidad').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "programa", unidad: $("#id_unidad").val(), nombre: $("#programa").val()}, function(data){
					$("#contenedor_programa").html(data);
				});
		}, 1000);
	});
	
	$("#periodo").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			$("#periodo").keyup_listas("#periodo", "#cargar_lista_periodo", "#id_periodo", "#contenedor_periodo");
			if($('#periodo').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "periodo", unidad: $("#id_unidad").val(), programa: $("#id_programa").val(), nombre: $("#periodo").val()}, function(data){
					$("#contenedor_periodo").html(data);
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
	
	$(".CUD").submit(function(){
		var entrar = true;
		entrar = $.errores_uno(entrar, ".c_institucion", "#institucion", "#institucion_l", "Institucion *");
		entrar = $.errores_uno(entrar, ".c_unidad", "#unidad", "#unidad_l", "Unidad *");
		entrar = $.errores_uno(entrar, ".CUD .c_departamento", ".CUD #departamento", ".CUD #departamento_l", ".CUD Departamento *");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data != "")
					alert(data);
				else 
				{
					$(".mensaje").html("Elemento Ingresado Satisfactoriamente").show();
					$(".editar_institucion_").hide();
				}
			});
		return false;
	});
	
	$(".contrasenia").submit(function(){
		var entrar = true;
		entrar = $.errores_uno_(entrar, ".c_contrasenia", "#contrasenia");
		entrar = $.errores_uno_(entrar, ".c_contrasenia", "#r_contrasenia");
		if(entrar == true)
			$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
				if(data != "")
					alert(data);
				else 
				{
					$(".mensaje").html("Elemento Ingresado Satisfactoriamente").show();
					$(".editar_constrasenia").hide();
				}
			});
		return false;
	});
});
