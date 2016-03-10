$(document).ready(function()
{
	$(".perfil_cabecera_personal .editar_link").hover(function(){
		$(".perfil_cabecera_personal").addClass("hover");
	}, function(){
		$(".perfil_cabecera_personal").removeClass("hover");
	});
	
	$("#sni_cargar").load("./sni.php", {id: $("#identificador").val()});
	
	$(".imagen_cabecera_perfil .informacion_no_imagen").click(function(){
		$("#subir_archivo").click();
	});
	
	$("#subir_archivo").change(function(){
		if($("#subir_archivo").attr("value") != "")
		{
			var fd = new FormData();
			var nombre = $("#nombre_usuario").val();
			fd.append("userfile", $("#subir_archivo")[0].files[0]);
			fd.append("opcion", "archivo");
			fd.append("tipo", "foto");
			fd.append("id", nombre);
			$.ajax({
				url: '../Scripts/guardar.php',
				type: 'POST',
				data: fd,
				cache: false,
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				success: function(data)
				{	
					if(data != "")
						alert(data);
					else
					{
						$(".placeholder_imagen img").attr("src", "../fotos_perfil/" + nombre + '.jpg');
						$("#menu_perfil_1 .p_desplegable_ign_js img").attr("src", "../fotos_perfil/" + nombre + '.jpg');
					}
				}
			});
		}
	});
	
	$(".arreglar_alinear .editar_link").click(function(e){
		var institucion = $("#institucion").text();
		var unidad = $("#unidad").text();
		var departamento = $("#departamento").text();
		var id_institucion = $("#institucion").attr("value");
		var id_unidad = $("#unidad").attr("value");
		var id_departamento = $("#departamento").attr("value");
		var usuario = $("#id_usuario").val();
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
			$("#dialogo_publicacion").removeClass("dialogo_publicacion");
		}).done(function(){
			$.post("../Perfil/Modificar_CUD.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".mensaje").hide();
				$(".Nivel_Nuevo").hide();
				$("#id_institucion").val(id_institucion);
				$("#id_unidad").val(id_unidad);
				$("#id_departamento").val(id_departamento);
				$("#institucion").val(institucion);
				$("#unidad").val(unidad);
				$("#departamento").val(departamento);
				$("#id_usuario").val(usuario);
				if(departamento != "")
					$("#departamento_div").show();
			});
		});
		e.stopPropagation();
	});
	
	$(".texto").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".texto").blur(function(){
		$(this).removeClass("activo_buscar");
	});
});
