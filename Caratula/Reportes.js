$.errores_uno = function(entrar, n_caja)
{
	if($(n_caja).val() == "")
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.errores_fecha = function(entrar, dia, mes, anio)
{
	if(!(($(dia).attr("value") == "Día" && $(mes).attr("value") == "Mes" && $(anio).attr("value") == "Año") || ($(dia).attr("value") != "Día" && $(mes).attr("value") != "Mes" && $(anio).attr("value") != "Año")))
	{
		$(dia).addClass("error_margen");
		$(mes).addClass("error_margen");
		$(anio).addClass("error_margen");
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

$.fn.cargar_usuarios = function(unidad_departamento)
{
	$.post("../Scripts/consulta.php", {opcion: "usuarios_cud", id: unidad_departamento}, function(data){
		$(".usuarios").html(data);
	});
}

function cargar_(id, tipo)
{
	if(tipo == "u")
		$.post("../Scripts/consulta.php", {opcion: "usuario_unidad", id: id}, function(data){
			$(".usuarios").cargar_usuarios(data);
		});
	else
		$.post("../Scripts/consulta.php", {opcion: "usuario_departamento", id: id}, function(data){
			$(".usuarios").cargar_usuarios(data);
		});
}

$.verificar_fecha = function(entrar, dia_1, mes_1, anio_1, dia_2, mes_2, anio_2)
{
	if(entrar) 
	{
		var dtPrev = new Date();
		dtPrev.setFullYear($(anio_1).attr("value"), $(mes_1).attr("value"), $(dia_1).attr("value"));
		var dtToday = new Date();
		dtToday.setFullYear($(anio_2).attr("value"), $(mes_2).attr("value"), $(dia_2).attr("value"));
 
		if (dtPrev > dtToday) {
			$(dia_1).addClass("error_margen");
			$(mes_1).addClass("error_margen");
			$(anio_1).addClass("error_margen");
			$(dia_2).addClass("error_margen");
			$(mes_2).addClass("error_margen");
			$(anio_2).addClass("error_margen");
			entrar = false;
			alert("La fecha inicial debe ser menor que la final");
		} 	
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
	
	$(".agregar_articulo_producto_js").click(function(){
		$(".publicacion_dialogo").hide();
		$(".uno_por_uno").show();
	});
	
	var unidad_departamento;
	
	$(".agregar_subir_archivo").click(function(){
		$(".publicacion_dialogo").hide();
		$(".institucional").show();
		$.post("../Scripts/consulta.php", {opcion: "cud"}, function(data){
			$("#institucion").val(data.Institucion);
			$("#id_institucion").val(data.FK_Institucion);
			$("#unidad").val(data.Unidad);
			$("#id_unidad").val(data.FK_Unidad);
			unidad_departamento = data.FK_Unidad_Departamento;
			if(data.Departamento != null)
			{
				$("#departamento").val(data.Departamento);
				$("#id_departamento").val(data.ID_Departamento);
			}
			$(this).cargar_usuarios(unidad_departamento);
		}, "json");
	});
	
	$(".cerrar_editar_js").click(function(){
		$(".publicacion_dialogo").show();
		$(".uno_por_uno").hide();
		$(".institucional").hide();
	});
	
	$(".cv_link").click(function(){
		var entrar = true;
		entrar = $.errores_uno(entrar, "#factor_impacto");
		entrar = $.errores_uno(entrar, "#no_citas");
		entrar = $.errores_fecha(entrar, "#dia_i", "#mes_i", "#anio_i");
		entrar = $.errores_fecha(entrar, "#dia_f", "#mes_f", "#anio_f");
		if(($("#dia_i").val() != "Día" || $("#dia_f").val() != "Día") && entrar)
			entrar = $.verificar_fecha(entrar, "#dia_i", "#mes_i", "#anio_i", "#dia_f", "#mes_f", "#anio_f");
		if(entrar == true)
		{
			$(".columna_derecha_c .editarform_laboratorio_perfil").hide();
			$(".columna_derecha_c .abrir_editar_js .link_inherit").show();
			$(this).attr("href", "../Reportes/Generar_CV.php?i=" + $("#anio_i").val() + "-" + $("#mes_i").val() + "-" + $("#dia_i").val() + "&f=" + $("#anio_f").val() + "-" + $("#mes_f").val() + "-" + $("#dia_f").val() + "&fac=" + $("#factor_impacto").val() + "&c=" + $("#no_citas").val()+ "&est=" + $("#Estado_Art").val());
		}
	});
	
	$(".institucional_button").click(function(){
		var entrar = true;
		entrar = $.errores_fecha(entrar, "#dia_i_", "#mes_i_", "#anio_i_");
		entrar = $.errores_fecha(entrar, "#dia_f_", "#mes_f_", "#anio_f_");
		//entrar = $.verificar_fecha(entrar, "#dia_i_", "#mes_i_", "#anio_i_", "#dia_f_", "#mes_f_", "#anio_f_");
		if(($("#dia_i").val() != "Día" || $("#dia_f").val() != "Día") && entrar)
			entrar = $.verificar_fecha(entrar, "#dia_i", "#mes_i", "#anio_i", "#dia_f", "#mes_f", "#anio_f");
		if(entrar == true)
		{
			var arreglo = "";
			$("input:checkbox:checked").each(function(){
				arreglo = arreglo + $(this).val() + ",";
			});
			arreglo = $.trim(arreglo);
			$(this).attr("href", "../Reportes/Generar_Institucional.php?us=" + arreglo + "&i=" + $("#anio_i_").val() + "-" + $("#mes_i_").val() + "-" + $("#dia_i_").val() + "&f=" + $("#anio_f_").val() + "-" + $("#mes_f_").val() + "-" + $("#dia_f_").val());
		}
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
});
