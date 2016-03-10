 $(document).ready(function()
{          	    
	$(".cerrar a").click(function(e){
		$("#pagina_contenedor").removeClass("popup_arreglado");
		$("body").removeClass("superposicion");
		$(".mascara_sobrepuesta").remove();
		$(".yu_widget").remove();
		e.stopPropagation();
	});
});
