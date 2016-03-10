$(document).ready(function()
{       		
	$.post("./Listado_Comites.php", function(data){
		$(".comisiones_columna").empty();
		$(".comisiones_columna").append(data);
	});
	
	$(".mostrar_js").click(function(){
		if($(this).text() == "Mostrar Pasados")
		{
			$(this).text("Ocultar Pasados");
			$.post("./Listado_Comites.php", function(data){
				$(".comisiones_columna").empty();
				$(".comisiones_columna").append(data);
			});
		}
		else
		{
			$(this).text("Mostrar Pasados");
			$.post("./Listado_Comites.php", function(data){
				$(".comisiones_columna").empty();
				$(".comisiones_columna").append(data);
			});
		}
	});
	
	/*
	/******************************Editar publicacion*************************************/
	$(".contenido_columna_c .contenedor_acciones .boton_editar").click(function(){
		var id = $(this).attr("value");
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$(".yu_widget_bd").empty();
			$(".yu_widget_bd").load("./Agregar.php", function(){
				$(".form_horizontal .link_accion_regresar").hide();
				$(".inicial").hide();
				$(".mensaje").hide();
				$.post("../Scripts/consulta.php", {opcion: "comite", id: id}, function(data){
					$("#servicio_comite").val(data.ID_Usuario_Comite);
					$("#tipo_comite_").val(data.FK_Comite);
					$("#tipo_").text(data.Tipo);
					var inicial = ((data.Fecha_Inicio == null) ? "0000-00-00" : data.Fecha_Inicio).split("-");
					var final = ((data.Fecha_Final == null) ? "0000-00-00" : data.Fecha_Final).split("-");
					$("#dia_i").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
					$("#mes_i").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
					$("#anio_i").val(inicial[0]);
					$("#dia_t").val((final[2] > 9) ? final[2] : final[2][1]);
					$("#mes_t").val((final[1] > 9) ? final[1] : final[1][1]);
					$("#anio_t").val(final[0]);
					$("#dia_s").val((final[2] > 9) ? final[2] : final[2][1]);
					$("#mes_s").val((final[1] > 9) ? final[1] : final[1][1]);
					$("#anio_s").val(final[0]);
					$("#motivos").val(data.Nombre_Comite);		
				}, "json");
			});
		});
	});
	
	$(".contenido_columna_c .contenedor_acciones .boton_eliminar").click(function(){
		var confirmar = confirm("Desea eliminar el comité");
		if(confirmar)
		{
			$.post("../Scripts/guardar.php", {opcion: "comite_eliminar", id: $(this).attr("value")});
			$(".contenido_columna_c .contenedor_acciones .boton_eliminar").attr("href", "./");
		}
	});
});
