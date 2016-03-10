$.errores_uno = function(entrar, n_div, n_caja, texto, texto_comparar)
{
	if(!$(n_div).is(":hidden") && $(n_caja).val() == "" && $(texto).text() == texto_comparar)
	{
		$(n_caja).addClass("error_margen");
		entrar = false;
	}
	return entrar;
}

$.errores_fecha = function(entrar, n_div, dia, texto_dia, mes, texto_mes, anio, texto_anio)
{
	if(!$(n_div).is(":hidden") && $(dia).attr("value") == texto_dia && $(mes).attr("value") == texto_mes && $(anio).attr("value") == texto_anio)
	{
		$(dia).addClass("error_margen");
		$(mes).addClass("error_margen");
		$(anio).addClass("error_margen");
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
	
	$(".fechas").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".fechas").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$(".agregar_nivel").click(function(e){
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
			$("#dialogo_publicacion").removeClass("dialogo_publicacion");
		}).done(function(){
			$.post("../Perfil/Modificar_CUD.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".mensaje").hide();
				$(".CUD_Editar").hide();
				$("#servicio_sni").val("");
				$(".link_accion_regresar").hide();
			});
		});
		e.stopPropagation();
	});
	
	$(".editar").click(function(e){
		var value = $(this).attr("value");
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
			$("#dialogo_publicacion").removeClass("dialogo_publicacion");
		}).done(function(){
			$.post("../Perfil/Modificar_CUD.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".mensaje").hide();
				$(".CUD_Editar").hide();
				$("#servicio_sni").val(value);
				$(".eliminar").val(value);
				$(".link_accion_regresar").show();
				$.post("../Scripts/consulta.php", {opcion: "sni", id: value}, function(data){
					var inicial = ((data.Fecha_Otorgacion == null) ? "0000-00-00" : data.Fecha_Otorgacion).split("-");
					$("#ndia_").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
					$("#nmes_").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
					$("#nanio_").val(inicial[0]);
					$("#nnivel").val(data.Nivel);
				}, "json");
			});
		});
		e.stopPropagation();
	});
});
