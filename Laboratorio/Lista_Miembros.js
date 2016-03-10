$(document).ready(function()
{		
	$(".columna_derecha_c .perfil_miembros .editar_miembro_lab").click(function(){
		var miembro = $(this).attr("value");
		var laboratorio = $(this).attr("data-type");
		var rol = $(this).attr("data-text");
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
				$("#servicio_laboratorio").val(miembro);
				$("#id_laboratorio").val(laboratorio);
				$("#rol").val(rol);
				$.post("../Scripts/consulta.php", {opcion: "usuario_laboratorio", id: miembro}, function(data){
					$("#usuario").val(data.Nombre + " " + data.Apellido_Paterno + "-" + data.Apellido_Materno);
					$("#id_usuario").val(data.ID_Usuario);
					$("#usuario").attr("disabled", true);
					if(data.Rol != "Profesor")
					{
						$(".a_1").show();
						$("#tipo").val(data.Tipo_Direccion);
					}
					var inicial = ((data.Fecha_Inicial == null) ? "0000-00-00" : data.Fecha_Inicial).split("-");
					var final = ((data.Fecha_Final == null) ? "0000-00-00" : data.Fecha_Final).split("-");;
					$("#dia_pub").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
					$("#mes_pub").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
					$("#anio_pub").val(inicial[0]);
					$("#dia_pub_t").val((final[2] > 9) ? final[2] : final[2][1]);
					$("#mes_pub_t").val((final[1] > 9) ? final[1] : final[1][1]);
					$("#anio_pub_t").val(final[0]);
				}, "json");
			});
		});
	});
	
	$(".indent_contenedor .dar_baja").click(function(){
		$.post("../Scripts/guardar.php", {opcion: "miembro_laboratorio_baja", usuario: $(this).attr("data-text"), id: $(this).attr("value")}, function(data){
			if(data != "")
				alert(data);
			else
			{
				$("#columna_derecha").empty();
				$("#columna_derecha").load("./Lista_Miembros.php", {id: $("#id_laboratorio").val()});
			}
		});
	});
	
	$(".indent_derecha .eliminar_miembro_lab").click(function(){		
		var confirmar = confirm("Desea eliminar este usuario del laboratorio ");
		if(confirmar)
		{
			$.post("../Scripts/guardar.php", {opcion: "miembro_laboratorio_eliminar", usuario: $(this).attr("data-text"), id: $(this).attr("value")}, function(data){
				if(data != "")
					alert(data);
				else
				{
					$("#columna_derecha").empty();
					$("#columna_derecha").load("./Lista_Miembros.php", {id: $("#id_laboratorio").val()});
				}
			});
		}
	});
});
