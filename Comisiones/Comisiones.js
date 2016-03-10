$(document).ready(function()
{       	
	$.post("./Listado_Comisiones.php", {mostrar: 'nope'}, function(data){
		$(".comisiones_columna").empty();
		$(".comisiones_columna").append(data);
	});
	
	$(".mostrar_js").click(function(){
		if($(this).text() == "Mostrar Pasados")
		{
			$(this).text("Ocultar Pasados");
			$.post("./Listado_Comisiones.php", {mostrar: 'ok'}, function(data){
				$(".comisiones_columna").empty();
				$(".comisiones_columna").append(data);
			});
		}
		else
		{
			$(this).text("Mostrar Pasados");
			$.post("./Listado_Comisiones.php", {mostrar: 'nope'}, function(data){
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
				$(".informe_comision").hide();
				$(".inicial").hide();
				$(".mensaje").hide();
				$.post("../Scripts/consulta.php", {opcion: "comision", id: id}, function(data){
					$("#servicio_comision").val(data.ID_Comision);
					$("#tipo_comision_").val(data.Tipo_Comision);
					$("#tipo_").text(data.Tipo_Comision);
					if(data.Tipo_Comision == "Internacional")
					{
						$(".a_2").show();
						$(".a_1").show();
					}
					else if(data.Tipo_Comision == "Nacional")
					{
						$(".a_1").show();
						$(".a_2").hide();
					}
					else
						$(".a_1").hide();
					if(data.Fuente_Financiamiento != "")
					{
						$(".a_3").show();
						$("#vinculo_si").attr("checked", true);
					}
					else
					{
						$("#vinculo_no").attr("checked", true);
						$(".a_3").hide();
					}
					var inicial = ((data.Fecha_Inicial == null) ? "0000-00-00" : data.Fecha_Inicial).split("-");
					var final = ((data.Fecha_Final == null) ? "0000-00-00" : data.Fecha_Final).split("-");
					var solicitud = ((data.Solicitud == null) ? "0000-00-00" : data.Solicitud).split("-");
					$("#dia_i").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
					$("#mes_i").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
					$("#anio_i").val(inicial[0]);
					$("#dia_t").val((final[2] > 9) ? final[2] : final[2][1]);
					$("#mes_t").val((final[1] > 9) ? final[1] : final[1][1]);
					$("#anio_t").val(final[0]);
					$("#dia_s").val((final[2] > 9) ? final[2] : final[2][1]);
					$("#mes_s").val((final[1] > 9) ? final[1] : final[1][1]);
					$("#anio_s").val(final[0]);
					$("#motivos").val(data.Motivo);
					$("#lugar").val(data.Lugar);
					$("#f_transporte").val(data.Fuente_Transporte);
					$("#m_transporte").val(data.Monto_Transporte);
					$("#f_viaticos").val(data.Fuente_Viatico);
					$("#m_viaticos").val(data.Monto_Viatico);
					$("#f_otros").val(data.Fuente_Otros);
					$("#m_otros").val(data.Monto_Otros);
					$("#financiamiento").val(data.Fuente_Financiamiento);
					$("#profesor").val(data.Responsable);				
					$("#objetivos").val(data.Objetivos);						
				}, "json");
			});
		});
	});
	
	$(".contenido_columna_c .contenedor_acciones .boton_aceptar").click(function(){
		var aceptado = ($(this).text() == "Aceptado") ? "1" : 0;
		$.post("../Scripts/guardar.php", {opcion: "comision_aceptar", id: $(this).attr("value"), aceptado: aceptado}, function(data){
			if(data == "")
				$(".contenido_columna_c .contenedor_acciones .boton_aceptar").text((aceptado == 1) ? "Rechazado" : "Aceptado");
			else
				alert(data);
		});
	});
	
	$(".contenido_columna_c .contenedor_acciones .boton_eliminar").click(function(){
		var confirmar = confirm("Desea eliminar comisión");
		if(confirmar)
		{
			$.post("../Scripts/guardar.php", {opcion: "comision_eliminar", id: $(this).attr("value")});
			$(".contenido_columna_c .contenedor_acciones .boton_eliminar").attr("href", "./");
		}
	});
	
	$(".contenido_columna_c .contenedor_acciones .boton_informe").click(function(){
		var id = $(this).attr("value");
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$(".yu_widget_bd").empty();
			$(".yu_widget_bd").load("./Agregar.php", function(){
				$(".inicial").hide();
				$(".comision_formulario").hide();
				$(".mensaje").hide();
				$(".a_4").hide();
				$("#servicio_informe").val("");
				$(".informe_comision #id_comision").val(id);
			});
		});
	});
	
	$(".contenido_columna_c .contenedor_acciones .boton_editar_informe").click(function(){
		var id = $(this).attr("value");
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$(".yu_widget_bd").empty();
			$(".yu_widget_bd").load("./Agregar.php", function(){
				$(".comision_formulario").hide();
				$(".inicial").hide();
				$(".mensaje").hide();
				$.post("../Scripts/consulta.php", {opcion: "informe_comision", id: id}, function(data){
					$("#servicio_informe").val(data.ID_Informe);
					var inicial = ((data.Fecha == null) ? "0000-00-00" : data.Fecha).split("-");
					$("#dia_in").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
					$("#mes_in").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
					$("#anio_in").val(inicial[0]);
					$("#objetivos").val(data.Descipcion);
					$(".a_4").hide();
					if(data.Evento == "Congreso o Reunión Académica")
						$("#1").attr("checked", true);
					else if(data.Evento == "Congreso o Reunión Académica internacional")
						$("#2").attr("checked", true);
					else if(data.Evento == "Estancia de trabajo en institución internacional")
						$("#3").attr("checked", true);
					else if(data.Evento == "Participación como jurado de examen de grado")
						$("#4").attr("checked", true);
					else
					{
						$("#5").attr("checked", true);
						$("#descripcion").val(data.Evento);
						$(".a_4").show();
					}	
				}, "json");
			});
		});
	});	
	
	$(".contenido_columna_c .contenedor_acciones .boton_eliminar_informe").click(function(){
		var confirmar = confirm("Desea eliminar informe de comisión");
		if(confirmar)
		{
			$.post("../Scripts/guardar.php", {opcion: "informe_comision_eliminar", id: $(this).attr("value")}, function(data){
				$.post("./Listado_Comisiones.php", {mostrar: 'nope'},  function(data){
					$(".comisiones_columna").empty();
					$(".comisiones_columna").append(data);
					$("#boton").click();
				});
			});
		}
	});	
});
