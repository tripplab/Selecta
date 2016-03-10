$(document).ready(function()
{ 
	$(".yu_tema_aclista").hover(function(){
		$(this).addClass("yu_tema_aclista_activo");
		$(this).addClass("yu_tema_aclista_hover");
	}, function(){
		$(this).removeClass("yu_tema_aclista_activo");
		$(this).removeClass("yu_tema_aclista_hover");
	});
	
	$(".listado_journal").click(function(){
		$("#id_journal").val($(this).attr("data-type"));
		$("#journal").val($(this).attr("data-text"));
	});
	
	$(".listado_tesis").click(function(){
		$("#id_tesis").val($(this).attr("data-type"));
		$("#tesis").val($(this).attr("data-text"));
	});
	
	$(".listado_institucion").click(function(){
		$("#id_institucion").val($(this).attr("data-type"));
		$("#institucion").val($(this).attr("data-text"));
	});
	
	$(".listado_periodo").click(function(){
		$("#id_periodo").val($(this).attr("data-type"));
		$("#periodo").val($(this).attr("data-text"));
	});
	
	$(".listado_unidad").click(function(){
		$("#id_unidad").val($(this).attr("data-type"));
		$("#unidad").val($(this).attr("data-text"));
		$.post("../Scripts/consulta.php", {opcion: "mostrar_departamento", id:$(this).attr("data-type")}, function(data){
			if(data != 0)
				$("#departamento_div").show();
			else
			{
				$("#departamento_div").hide();
				$("#departamento").val("");
				$("#id_departamento").val("");
				cargar_($("#id_unidad").val(), "u");
			}
		});	
	});
	
	$(".listado_programa").click(function(){
		$("#id_programa").val($(this).attr("data-type"));
		$("#programa").val($(this).attr("data-text"));
	});
	
	$(".listado_curso").click(function(){
		$("#id_curso").val($(this).attr("data-type"));
		$("#curso").val($(this).attr("data-text"));
	});
	
	$(".listado_departamento").click(function(){
		$("#id_departamento").val($(this).attr("data-type"));
		$("#departamento").val($(this).attr("data-text"));
		cargar_($("#id_departamento").val(), "d");
	});
	
	$(".listado_usuario_laboratorio").click(function(){
		$("#id_usuario").val($(this).attr("data-type"));
		$("#usuario").val($(this).attr("data-text"));
		$("#rol").val($(this).attr("data"));
		$(".a_1").hide();
		if($(this).attr("data") == "Estudiante" || $(this).attr("data") == "Pasante")
			$(".a_1").show();
		else 
			$("#tipo").val("");
	});
	
	$(".aclist_lista_yu .aclist_tema_yu").hover(function(){
		$(this).addClass("aclist_tema_activo_yu");
	}, function(){
		$(this).removeClass("aclist_tema_activo_yu");
	});
});
