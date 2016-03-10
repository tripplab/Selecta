$(document).ready(function()
{       	
	$.post("./Listado_Temporal.php", function(data){
		$(".publicacion_cuerpo_p").empty();
		$(".publicacion_cuerpo_p").append(data);
	});
	
	$(".agregar_js").click(function(e){
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$.post("./Agregar.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".comision_formulario").hide();
				$(".mensaje").hide();
			});
		});
		e.stopPropagation();
	});
	
	$(".boton_editar").click(function(){
		var id = $(this).attr("value");
		var opcion = $(this).attr("data-type");
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$.post("./Agregar.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".inicial").hide();
				$(".mensaje").hide();
				if(opcion == "convenio")
				{
					$(".a_1").show();
					$(".a_2").hide();
					$("#proyecto_l").text("Proyecto *");
					$.post("../Scripts/consulta.php", {opcion: "convenio", id: id}, function(data){
						$("#tipo_").text("Convenios de colaboración académica, científica y tecnológica. Institución " + (data.Nac_Inter == 0) ? "Internacional" : ("Nacional"));
						$("#tipo_comision_").val((data.Nac_Inter == 0) ? "Internacional" : ("Nacional"));
						$("#tipo_").text((data.Nac_Inter == 0) ? "Internacional" : ("Nacional"));
						$("#servicio_comision").val(data.ID_Convenio);
						$("#proyecto").val(data.Nombre_Proyecto);
						var inicial = ((data.Fecha_Inicio == null) ? "0000-00-00" : data.Fecha_Inicio).split("-");
						var final = ((data.Fecha_Final == null) ? "0000-00-00" : data.Fecha_Final).split("-");;
						$("#dia_i").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
						$("#mes_i").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
						$("#anio_i").val(inicial[0]);
						$("#dia_t").val((final[2] > 9) ? final[2] : final[2][1]);
						$("#mes_t").val((final[1] > 9) ? final[1] : final[1][1]);
						$("#anio_t").val(final[0]);
						$("#institucion").val(data.Nombre_Institucion);
						$("#usuario").val(data.Nombre + " " + data.Apellido_Paterno + "-" + data.Apellido_Materno);
						$("#id_usuario").val(data.FK_Usuario);
						if(data.Convenio_Firmado == 1)
							$("#vinculo_si").attr("checked", true);
					}, "json");
				}
				else if(opcion == "logro")
				{					
					$("#proyecto_l").text("Logro *");
					$(".a_1").hide();
					$(".a_2").hide();
					$("#termino_div").hide();
					$("#institucion_div").hide();
					$("#fecha_l").text("Fecha *");
					$.post("../Scripts/consulta.php", {opcion: "logros", id: id}, function(data){
						$("#tipo_").text("Logros");
						$("#tipo_comision_").val("Logros");
						$("#tipo_").text("Logros");
						$("#servicio_comision").val(data.ID_Logro);
						$("#proyecto").val(data.Descripcion);
						var inicial = ((data.Fecha == null) ? "0000-00-00" : data.Fecha).split("-");
						$("#dia_i").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
						$("#mes_i").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
						$("#anio_i").val(inicial[0]);
						$("#usuario").val(data.Nombre + " " + data.Apellido_Paterno + "-" + data.Apellido_Materno);
						$("#id_usuario").val(data.FK_Usuario);
					}, "json");
				}
				else if(opcion == "proyecto")
				{
					$(".a_1").hide();
					$(".a_2").show();
					$("#tipo_").text("Proyecto");
					$("#proyecto_l").text("Proyecto *");
					$("#tipo_comision_").val("Proyecto");
					$("#tipo_").text("Proyecto");
					$.post("../Scripts/consulta.php", {opcion: "proyecto", id: id}, function(data){
						$("#servicio_comision").val(data.ID_Proyecto);
						$("#proyecto").val(data.Titulo);
						var inicial = ((data.Fecha_Inicial == null) ? "0000-00-00" : data.Fecha_Inicial).split("-");
						var final = ((data.Fecha_Final == null) ? "0000-00-00" : data.Fecha_Final).split("-");;
						$("#dia_i").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
						$("#mes_i").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
						$("#anio_i").val(inicial[0]);
						$("#dia_t").val((final[2] > 9) ? final[2] : final[2][1]);
						$("#mes_t").val((final[1] > 9) ? final[1] : final[1][1]);
						$("#anio_t").val(final[0]);
						$("#institucion").val(data.Institucion);
						$("#objetivo").val(data.Objetivos);
						$("#usuario").val(data.Nombre + " " + data.Apellido_Paterno + "-" + data.Apellido_Materno);
						$("#id_usuario").val(data.FK_Usuario);
					}, "json");
				}
				else
				{
					$(".a_1").hide();
					$(".a_2").show();
					$("#tipo_").text("Servicios de Laboratorio");
					$("#proyecto_l").text("Servicio *");
					$("#tipo_comision_").val("Servicios");
					$("#tipo_").text("Servicios");
					$.post("../Scripts/consulta.php", {opcion: "servicio", id: id}, function(data){
						$("#servicio_comision").val(data.ID_Servicio);
						$("#proyecto").val(data.Servicio);
						var inicial = ((data.Fecha_Inicial == null) ? "0000-00-00" : data.Fecha_Inicial).split("-");
						var final = ((data.Fecha_Final == null) ? "0000-00-00" : data.Fecha_Final).split("-");;
						$("#dia_i").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
						$("#mes_i").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
						$("#anio_i").val(inicial[0]);
						$("#dia_t").val((final[2] > 9) ? final[2] : final[2][1]);
						$("#mes_t").val((final[1] > 9) ? final[1] : final[1][1]);
						$("#anio_t").val(final[0]);
						$("#institucion").val(data.Institucion);
						$("#objetivo").val(data.Objetivo);
						$("#usuario").val(data.Nombre + " " + data.Apellido_Paterno + "-" + data.Apellido_Materno);
						$("#id_usuario").val(data.FK_Usuario);
					}, "json");
				}
			});
		});
	});
	
	$(".boton_eliminar").click(function(){
		var confirmar = confirm("Desea eliminar registro");
		if(confirmar)
		{
			var id = $(this).attr("value");
			var opcion = $(this).attr("data-type");
			$.post("../Scripts/guardar.php", {opcion: "eliminar_" + opcion, id: id}, function(data){
				$.post("./Listado_Temporal.php", function(data){
					$("#contenedor_principal").load("./completar_caratula.php");
				});
			});
		}
	});	
});
