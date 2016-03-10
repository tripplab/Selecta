$(document).ready(function()
{     
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
	});
	
	$(".caja_c .colegio_formulario").submit(function(){
		var id = $(this).attr("value");
		$.post("../Scripts/guardar.php", $(this).serialize(), function(data){
			if(data == "")
			{
				$("." + id + "_li").show();
				$("." + id + "_form").hide();
			}
			else
				alert(data);
		});
		return false;
	});
	
	$(".eliminar_curso").click(function(){
		var confirmar = confirm("Desea eliminar a este usuario del colegio del programa");
		if(confirmar)
		{
			var id = $(this).attr("value"); 
			$.post("../Scripts/guardar.php", {opcion: "eliminar_colegio", id: id}, function(data){
				if(data == "")
					$("." + id +"_li").hide();
				else
					alert(data);
			});
		}
	});
});
