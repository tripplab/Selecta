$(document).ready(function()
{          	  	
	$(".navegador_izquierdo .tema").hover(function(){
		$(this).addClass("hover");
	}, function(){
		$(this).removeClass("hover");
	});
	
	$(".iluminar").hover(function(){
		$(this).addClass("hover");
	}, function(){
		$(this).removeClass("hover");
	});
	
	$(".buscado_form_text").hover(function(){
		$(".estado_form_busqueda").addClass("hover");
	}, function(){
		$(".estado_form_busqueda").removeClass("hover");
	});
	
	$(".buscado_form_text").focus(function(){
		$(".estado_form_busqueda").addClass("activar_buscador");
	});
	
	$(".buscado_form_text").blur(function(){
		$(".estado_form_busqueda").removeClass("activar_buscador");
	});
	
	$("body").click(function(){
		$(".desplegar").removeClass("abrir_desplegar");
		$("#b_e").addClass("barra_estado");
		$(".menu_navegar_a .buscar_tipo_dropdown").removeClass("abrir_desplegable");
		$(".widget_posicionado_yu").addClass("aclist_escondida_yu");
	});
	
	$(".desplegar").click(function(e){
		$(".desplegar").removeClass("abrir_desplegar");
		$(this).addClass("abrir_desplegar");
		$("#b_e").removeClass("barra_estado");
		e.stopPropagation();
	});
	
	$(".link_perfil").click(function(e){
		$(".desplegar").removeClass("abrir_desplegar");
		e.stopPropagation();
	});
	
	$(".admin").click(function(e){
		$(".menu_navegar_a .buscar_tipo_dropdown").removeClass("abrir_desplegable");
		$(".menu_navegar_a .admin_menu").addClass("abrir_desplegable");
		e.stopPropagation();
	});
	
	$(".ayuda").click(function(e){
		$(".menu_navegar_a .buscar_tipo_dropdown").removeClass("abrir_desplegable");
		$(".menu_navegar_a .ayuda_menu").addClass("abrir_desplegable");
		e.stopPropagation();
	});
	
	var typingTimer;   
	
	$(".buscado_form_text").keyup(function(){
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){ 
			if($('.buscado_form_text').val().length > 1)
				$.post("../Scripts/consulta_listado.php", {opcion: "buscar_usuario", nombre: $(".buscado_form_text").val()}, function(data){
					$(".aclist_contenedor_yu").html(data);
					$(".widget_posicionado_yu").removeClass("aclist_escondida_yu");
				});
		}, 1000);
	});
	
	$(".reporte").click(function(){
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
			$("#dialogo_publicacion").removeClass("dialogo_publicacion");
		}).done(function(){
			$.post("../Caratula/Reportes.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".uno_por_uno").hide();
				$(".institucional").hide();
			});
		});
	});
	
});
