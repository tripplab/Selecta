$.fn.most_ocul_form_prod = function(tipo, titulo)
{
	var partes = tipo.split(".");
	$.post("../Scripts/consulta.php", {opcion: "nombre"}, function(data){
		$("#autores").val(data);
	});
	//$("#titulo").removeClass("quitar_margen");
	//$("#titulo").addClass("quitar_margen");
	$("#titulo").val(titulo);
	$("#titulo_esc").val(titulo);
	$("#tipo_copei_").val(tipo);
	$("#tipo_copei_esc").val(tipo);
	$(".control_grupo").hide();
	$(".autores").hide();
	$("#anio_lic").hide();
	$("#vol").attr("placeholder", "Volumen");
	$("#num").attr("placeholder", "Numero");
	$("#pag").attr("placeholder", "Pagina(s)");
	$("#autor_l").text("Autores *");
	$("#cita_l").text("Cita");
	$("#fecha_l").text("Fecha *");
	$("#capitulo_l").text("Conferencia *");
	$("#localidad_l").text("Localidad");
	$("#editorial_l").text("Editorial");
	$("#tema_l").text("Libro");
	$("#referencia_l").text("No Reporte");
	$("#datos_l").text("Propedeútico/Nivel");
	$("#nocitas_l").text("Numero de Citas");
	$("#abstract_l").text("Abstract");
	$("#gra_an").text("Año/Grado *");
	$("#tema_pag_l").text("Tema");
	$("#escolaridad").show();
	$("#pag").show();
	$("#isbn").text("ISBN");	
	$("#propedeutico").show();	
	if(tipo == "0.1")
	{
		$(".a_30").show();
		$(".a_21").show();
		$("#tema_pag_l").text("Especialidad *");
	}
	else if(tipo == "0.2")
	{
		$("#tema_pag_l").text("Nombre *");
		$(".a_32").show();
	}
	else if(tipo == "1.2")
		$(".a_31").show();
	else if(tipo == "1.1")
	{
		$(".a_30").show();
		$(".a_21").show();
		$("#escolaridad").hide();
		$("#tema_pag_l").text("Nombre *");
		$("#gra_an").text("Año *");
	}
	else if(tipo == "0.3")
	{
		$("#cita_l").text("Posición *");
		$("#pag").hide();
		$(".a_1").show();
		$("#vol").attr("placeholder", "Categoria");
		$("#num").attr("placeholder", "Subcategoria");
		$("#localidad_l").text("Puesto");
		$(".a_31").show();
	}
	/*else if((partes[0] == "2" && (partes[1] == "1" || partes[1] == "2" || partes[1] == "3")) || tipo == "4.5" || tipo == "4.7" || tipo == "4.12")
		$(".a_1").show();*/
	else if(tipo == "2.4" || tipo == "2.5"){
		$(".a_24").show();
            	
            }
	else if(partes[0] == "2" && (partes[1] == "7" || partes[1] == "8" || partes[1] == "9" || partes[1] == "11" || partes[1] == "12"))
		$(".a_3").show();
	else if(partes[0] == "3" && partes[1] == "1" )
		$(".a_5").show();
	else if(partes[0] == "3" && (partes[1] == "3" || partes[1] == "2"))
	{
		$("#autor_l").text("Director(es) *");
		$(".a_6").show();	
		$("#nivel").hide();
		$("#datos_l").text("Concluido");
		$(".a_22").show();
		$(".a_31").show();
		$("#referencia_l").text("Alumno *");
		$("#localidad_l").text("Lugar *");
	}
	else if(tipo == "4.6")
	{
		$("#capitulo_l").text("Miembro");
		$("#localidad_l").text("Revista");
	}
	else if(tipo == "4.9")
		$("#capitulo_l").text("Congreso");
	else if(tipo == "4.10")
	{
		$(".a_16").show();	
		$("#capitulo_l").text("Responsabilidad");
	}
	else if(tipo == "4.11")
		$("#abstract_l").text("Quién Otorga");
	else if(tipo == "4.13")
	{
		$("#capitulo_l").text("Estudiante");
		$("#localidad_l").text("Puesto");
		$("#isbn").text("SNI");
	}
	else if(tipo == "4.15")
	{
		$("#capitulo_l").text("Responsable");
		$("#isbn").text("Subproducto");
	}
	else if(tipo == "4.16")
	{
		$("#referencia_l").text("No Patente");
		$(".a_22").show();	
	}
	else if(partes[0] == "5")
	{
		$(".a_28").show();
		$(".a_23").show();
		$("#abstract_l").text("Descripción *");
	}	
	if(tipo == "2.1.a" || tipo == "2.1.b" || tipo == "2.1.c" || tipo == "2.1.d")
		$(".a_10").show();	
	else if(tipo == "2.1.e")
		$(".a_14").show();
	else if(tipo == "2.1.f" || tipo == "2.1.g")
	{
		$(".a_11").show();
		$("#tema_l").text("Revista");
	}
	else if(tipo == "2.2" || tipo == "2.3" || tipo == "2.4" || tipo == "2.5")
		$(".a_2").show();
	else if(partes[0] == "2" && partes[1] == "7")
	{
		$("#editorial_l").text("Afiliación");
		$(".a_9").show();
	}
	else if(tipo == "2.8.a" || tipo == "2.8.b")
	{
		$(".a_12").show();	
		$("#referencia_l").text("No Referencia");
		$("#localidad_l").text("Pag. WEB");
	}	
	
	else if(tipo == "4.12")
	{
		$(".a_12").show();
		$("#referencia_l").text("Tipo Responsabilidad");
		$("#abstract_l").text("Objetivos");
		$("#capitulo_l").text("Pag. WEB");
		$("#cita_l").text("Gastos");
		$("#vol").attr("placeholder", "Gastos de inversión");
		$("#num").attr("placeholder", "Gastos de correlación");
		$("#pag").attr("placeholder", "Tipo de moneda");
		$(".a_27").show();	
	}
	else if(tipo == "2.9")
	{
		$(".a_17").show();	
		$("#tema_l").text("Impacto");
               
	}
	else if(partes[0] == "2" &&  partes[1] == "10")
	{
		$(".a_29").show();	
		$("#abstract_l").text("Descripción");
	}
	else if(tipo == "2.11.a" || tipo == "2.11.b" || tipo == "2.12.a")
		$(".a_4").show();
	else if(partes[0] == "3" && partes[1] == "1")
	{
		$("#fecha_l").text("Fecha Inicial *");
		$(".a_26").show();	
		$("#nocitas_l").text("Total de Horas *");
	}
	else if(tipo == "4.5")
	{
		$("#capitulo_l").text("Medio de Discución");
		$("#localidad_l").text("Discutido por");
	}
	if(tipo == "2.1.a")
		$(".a_13").show();	
	else if(tipo == "2.1.b" || tipo == "2.1.e" || tipo == "2.2")
	{
		$(".a_15").hide();
		$(".a_25").show();
		$("#tema_l").text("Revista");
	}
	else if(tipo == "2.3" || tipo == "2.11.b")
	{
		$(".a_16").show();	
		$("#capitulo_l").text("Capitulo");
	}
	else if(tipo == "4.11" || tipo == "4.15")
		$(".a_16").show();	
	else if(tipo == "3.1.c")
	{
		$("#nivel").hide();
		$("#anio_lic").show();
		$("#datos_l").text("Propedeútico/Año Lic.");
	}	
	else if(tipo == "4.5" || tipo == "4.6" || tipo == "4.9" || tipo == "4.12" || tipo == "4.13" || tipo == "2.1.c" || tipo == "2.1.d")
		$(".a_8").show();	
	else if(tipo == "2.12.a")
		$(".a_25").show();
	else if(tipo == "2.12.b")
		$(".a_16").show();
	if(tipo == "2.3" || tipo == "2.9" || tipo == "2.11.a")
		$(".a_25").show();
	else if(tipo == "4.12" || tipo == "1.2")
	{
		$(".a_20").show();
		$("#fecha_l").text("Fecha Inicial *");
	}
	if(tipo == "2.11.a" || tipo == "2.11.b"  || tipo == "2.12.a"  || tipo == "2.12.c"  || tipo == "4.6"  || tipo == "4.13" || tipo == "4.15")
		$(".a_19").show();	
	else if(tipo == "4.3" || tipo == "4.4" || tipo == "4.5" || tipo == "4.6" || tipo == "4.7" || tipo == "4.8" || tipo == "4.10" || tipo == "4.11" || tipo == "4.14" || tipo == "4.16" || tipo == "4.17" || tipo == "4.18")
	{
		$(".a_27").show();	
		$("#abstract_l").text("Descripción");
	}
	if(partes[0] == "2" || tipo == "3.3" || partes[0] == "3" && partes[1] == "2")
		$(".a_autores").show();	
	if((partes[0] == "3" && (partes[1] == "1")) || partes[0] == "4"|| tipo == "0.2" || tipo == "0.3" || tipo == "1.2")
		$(".a_7").show();
		
	if(tipo == "2.12.e" || tipo == "2.12.f" || tipo == "2.12.g" || tipo == "2.12.h")
	{
		$(".c_usuario").show();
		$(".a_3").hide();
		$(".autores").hide();
	}
	if(tipo == "2.12.e" || tipo == "2.12.f")
	{
		$(".c_usuario").show();
		$(".a_40").show();
		$("#fecha_l").text("Fecha Inicio *");
		$("#referencia_l").text("Evento *");
		$("#capitulo_l").text("Objetivos *");
	}
	else if(tipo == "2.12.g")
	{
		$(".c_usuario").show();
		$(".a_40").show();
		$("#referencia_l").text("Nombre Visitante *");
		$("#capitulo_l").text("Objetivos *");
		$("#termino_div").hide();
	}
	else if(tipo == "2.12.h")
	{
		$(".c_usuario").show();
		$(".a_40").show();
		$("#referencia_l").text("Reportero/Medios *");
		$("#capitulo_l").text("Tema *");
		$("#termino_div").hide();
	}
	else if(tipo == "3.1.d")
		$("#propedeutico").hide();
}

$(document).ready(function()
{       	
	/*$(".formulario_buscador .envoltura_busqueda_simple .input_buscar_js").focus(function(){
		$(".envoltura_busqueda_simple").addClass("activo_buscar");
	});
	
	$(".formulario_buscador .envoltura_busqueda_simple .input_buscar_js").blur(function(){
		$(".envoltura_busqueda_simple").removeClass("activo_buscar");
	});
	*/
	$(".umbral").hide();
	
	$(".menu_publicaciones .cargar_pagina_ajax").click(function(){
		$(".menu_publicaciones .cargar_pagina_ajax").removeClass("selected");
		$(this).addClass("selected");
		$(".umbral").hide();
		$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
		if($(this).hasClass("generales"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .datos_generales");	
		else if($(this).hasClass("antecedentes"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .antecedentes_academicos");	
		else if($(this).hasClass("productos_2"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .productos_menu_2");	
		else if($(this).hasClass("formacion"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .formacion_recursos");	
		else if($(this).hasClass("repercusion"))
		{
			$(".umbral").show();
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .repercusion_academica");	
		}
		else if($(this).hasClass("criterios"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .criterios_adicionales");	
	});
	
	$(".texto").focus(function(){
		$(this).addClass("activo_buscar");
	});
	
	$(".texto").blur(function(){
		$(this).removeClass("activo_buscar");
	});
	
	$(".esconder_cajas").hide();
	$(".toolbar_editar").hide();
	
	$(".umbral_").click(function(){
		$(".esconder_cajas").show();
		$(".span_umbral").hide();
		$(".umbral .umbral_").hide();
		$(".toolbar_editar").show();
	});
	
	$(".umbral .toolbar_editar .cerrar_editar").click(function(){
		$(".esconder_cajas").hide();
		$(".span_umbral").show();
		$(".umbral .umbral_").show();
		$(".toolbar_editar").hide();
		$("#umbral_factor").val($("#l_umbral_factor").text());
		$("#umbral_citas").val($("#l_umbral_citas").text());
	});
	
	$(".umbral .guardar_editar").click(function(){
		$(".esconder_cajas").hide();
		$(".span_umbral").show();
		$(".umbral .umbral_").show();
		$(".toolbar_editar").hide();
		$("#l_umbral_factor").text($("#umbral_factor").val());
		$("#l_umbral_citas").text($("#umbral_citas").val());
		$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
		if($(".menu_publicaciones .generales").hasClass("selected"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .datos_generales");	
		else if($(".menu_publicaciones .antecedentes").hasClass("selected"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .antecedentes_academicos");	
		else if($(".menu_publicaciones .productos_2").hasClass("selected"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .productos_menu_2");	
		else if($(".menu_publicaciones .formacion").hasClass("selected"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .formacion_recursos");	
		else if($(".menu_publicaciones .repercusion").hasClass("selected"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .repercusion_academica");	
		else if($(".menu_publicaciones .criterios").hasClass("selected"))
			$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .criterios_adicionales");
	});
	
	$(".cabecera_literatura .cabecera_contenedora .umbral").hover(function(){
		$(".cabecera_literatura .cabecera_contenedora .umbral").addClass("hover");
	}, function(){
		$(".cabecera_literatura .cabecera_contenedora .umbral").removeClass("hover");
	});
	
	$(".agregar_js").click(function(e){
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$.post("../Publicaciones/add_new_pub.php", function(data){
				$(".yu_widget_bd").append(data);
				$(".inicial").hide();
				$("#matches").hide();
				$(".nuevo").hide();
				$(".lectura").hide();
				$(".mensaje").hide();
			});
		});
		e.stopPropagation();
	});
	
	$(".lista_autores_sugeridos .temas_sugeridos_js .botones_acciones .si_js").click(function(){
		var identificador = $(this).attr("value");
		var tipo = $(this).attr("data-type");
		$("#" + identificador).hide();
		
		$.post("../Scripts/guardar.php", {opcion: "autor", tipo_copei_esc: tipo, id_publicacion: identificador}, function(data){
			if(data != "")
				alert(data);
			else 
			{
				$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").empty();
				if($(".menu_publicaciones .generales").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .datos_generales");	
				else if($(".menu_publicaciones .antecedentes").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .antecedentes_academicos");	
				else if($(".menu_publicaciones .productos_2").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .productos_menu_2");	
				else if($(".menu_publicaciones .formacion").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .formacion_recursos");	
				else if($(".menu_publicaciones .repercusion").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .repercusion_academica");	
				else if($(".menu_publicaciones .criterios").hasClass("selected"))
					$(".contenido_columna_c .publicaciones_p .publicacion_cuerpo_p").load( "../Publicaciones/Listado_Publicaciones.php .criterios_adicionales");
			}
		});
	});
	
	/******************************Editar publicacion*************************************/
	$(".contenido_c .abstract_publicacion .cambio_etiqueta_form").hide();
	
	$(".contenido_columna_c .abstract_publicacion .abrir_editar").hover(function(){
		$(".contenido_columna_c .abstract_publicacion").addClass("hover");
	}, function(){
		$(".contenido_columna_c .abstract_publicacion").removeClass("hover");
	});
	
	var etiqueta_copei;
	
	$(".contenido_columna_c .abstract_publicacion .abrir_editar").click(function(){
		$(".contenido_c .abstract_publicacion .cambio_etiqueta_form").show();
		$(".toolbar_editar").show();
		$(".contenido_c .etiqueta .arreglar_limpiar").hide();
		etiqueta_copei = $("#etiqueta").val();
	});
	
	$(".contenido_columna_c .cambio_etiqueta_form .cerrar_editar").click(function(){
		$(".contenido_c .abstract_publicacion .cambio_etiqueta_form").hide();
		$(".contenido_c .etiqueta .arreglar_limpiar").show();
		$("#etiqueta").val(etiqueta_copei);
	});
	
	$(".contenido_columna_c .cambio_etiqueta_form .envoltura_cambio_etiqueta").click(function(){
		$("#etiqueta").focus();
	});
	
	$(".subir_archivo").click(function(){
		if(!($(".subir_archivo").attr('disabled') == 'disabled'))
			$("#subir_archivo").click();
	});
	
	$(".descargar_archivo").click(function(){
		if(($(".descargar_archivo").attr('disabled') == 'disabled'))
			$(".descargar_archivo").attr("href", "#");
	});
	
	$("#subir_archivo").change(function(){
		if($("#subir_archivo").attr("value") != "")
		{
			var fd = new FormData();
			fd.append("userfile", $("#subir_archivo")[0].files[0]);
			fd.append("opcion", "archivo");
			fd.append("tipo", $("#subir_archivo").attr("data-type"));
			fd.append("id", $("#subir_archivo").attr("class"));
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
						$(".descargar_archivo").attr("disabled", false);
				}
			});
		}
	});
	
	$(".contenido_columna_c .contenedor_acciones .boton_editar").click(function(){
		var tipo = $(this).attr("data-type");
		var id = $(this).attr("value");
		var partes = tipo.split(".");
		$("body").addClass("superposicion");
		$("#pagina_contenedor").addClass("popup_arreglado");
		$.post("../popup/popup.php", function(data){
			$("#pagina_contenedor").before(data);
		}).done(function(){
			$(".yu_widget_bd").empty();
			$(".yu_widget_bd").load("../Publicaciones/add_new_pub.php", function(){
				$(".form_horizontal .link_accion_regresar").hide();
				$(".opcion").hide();
				$("#matches").hide();
				$(".inicial").hide();
				$(".lectura").hide();
				$(".mensaje").hide();
				
				$(".yu_widget_bd").most_ocul_form_prod(tipo, "");
				if(partes[0] == "0" || partes[0] == "1" || partes[0] == "2" && ( partes[1] == "10") || tipo == "2.12.a" || tipo == "2.12.b" || partes[0] == "3" && partes[1] == "1" || tipo == "4.3" || tipo == "4.4" || tipo == "4.5" || tipo == "4.6" || tipo == "4.7" || tipo == "4.8" || tipo == "4.9" || tipo == "4.10" || tipo == "4.11" || tipo == "4.13" || tipo == "4.14" || tipo == "4.15" || tipo == "4.16" || tipo == "4.17" || tipo == "4.18" || tipo == "5")
				{
                                   
					$("#tipo_copei").val("");
					$("#titulo").removeClass("quitar_margen");
					$("#titulo").addClass("quitar_margen");
					$("#titulo").attr("disabled", false);
				}
				else if((partes[0] == "2" && (partes[1] == "1" || partes[1] == "2" || partes[1] == "3" || partes[1] == "4" || partes[1] == "5" || partes[1] == "6" || partes[1] == "7" || partes[1] == "8" || partes[1] == "9" || partes[1] == "10" || partes[1] == "11" || partes[1] == "12" )|| partes[0] == "3" && (partes[1] == "2" || partes[1] == "3") || tipo == "4.12" || tipo == "2.9" || tipo == "2.5"))
						$(".a_titulo").show();
				
				$.post("../Scripts/consulta.php", {opcion: "copei", tipo: tipo, id: id}, function(data){
					
                                    $("#tipo_copei").val(tipo);
					$("#tipo_copei_esc").val(tipo);
					$("#guar_act_copei").val(id);
					$("#localidad").val(data.Localidad);
					$("#topic").val(data.Tema);
					$("#anio_esc").val(data.Anio);
					$("#escolaridad").val(data.Escolaridad);
					var inicial = ((data.Fecha == null) ? "0000-00-00" : data.Fecha).split("-");
					var final = ((data.Fecha_Final == null) ? "0000-00-00" : data.Fecha_Final).split("-");;
					$("#dia_pub").val((inicial[2] > 9) ? inicial[2] : inicial[2][1]);
					$("#mes_pub").val((inicial[1] > 9) ? inicial[1] : inicial[1][1]);
					$("#anio_pub").val(inicial[0]);
					$("#dia_pub_t").val((final[2] > 9) ? final[2] : final[2][1]);
					$("#mes_pub_t").val((final[1] > 9) ? final[1] : final[1][1]);
					$("#anio_pub_t").val(final[0]);
					$("#vol").val(data.Vol);
					$("#num").val(data.Num);
					$("#pag").val(data.Pag);
					$("#paginas").val(data.Pag);
					$("#titulo").val(data.Titulo);
					$("#titulo_esc").val(data.Titulo);
					$("#capitulo").val(data.Capitulo);
					$("#titulo_libro").val(data.Titulo_Libro);
					$("#abstract").val(data.Abstract);
					$("#referencia").val(data.Referencia);
					$("#editor").val(data.Editor);
					$("#editorial").val(data.Editorial);
					$("#edicion").val(data.Edicion);
					$("#isbn_c").val(data.ISBN);
					$("#citas").val(data.Numero_Citas);
					$("#tesis").val(data.Tesis);
					$("#id_tesis").val(data.ID_Tesis);
					$("#journal").val(data.Journal);
                                        $("#stado option").eq(0).before("<option value="+data.Estado+" selected>"+data.Estado+"</option")
                               
//                                       $("<option value="+data.Estado+" selected>"+data.Estado+"</option>").appendTo("#stado");
					$("#id_journal").val(data.FK_Journal);
					$("#anio_lic").val(data.Anio_Lic);
					$("#nivel").val(data.Nivel);
					$("#id_curso").val(data.FK_Curso);
					$("#curso").val(data.Curso);
					if(data.Propedeutico == 1)
						$("#prope_si").attr("checked");
					$("#programa").val(data.Nombre_Programa);
					$("#id_programa").val(data.ID_Programa_Unidad);
					$("#unidad").val(data.Unidad);
					$("#id_unidad").val(data.ID_Unidad);
					$("#institucion").val(data.Institucion);
					$("#id_institucion").val(data.ID_Institucion);
					$("#autores").val(data.Autores);
					$("#doi").val(data.DOI);
					$("#id_usuario").val(data.FK_Usuario);
					$("#usuario").val(data.Nombre + " " + data.Apellido_Paterno + "-" + data.Apellido_Materno);
				}, "json");
			});
		});
	});
	
	$(".texto_envoltura_cambio_etiqueta").focus(function(){
		$(".envoltura_cambio_etiqueta").addClass("activo_buscar");
	});
	
	$(".texto_envoltura_cambio_etiqueta").blur(function(){
		$(".envoltura_cambio_etiqueta").removeClass("activo_buscar");
	});
	
	$(".contenido_columna_c .cambio_etiqueta_form").submit(function(){
		$.post("../Scripts/guardar.php", $(".contenido_columna_c .cambio_etiqueta_form").serialize(), function(data){
			if(data == "")
			{
				$(".contenido_c .abstract_publicacion .cambio_etiqueta_form").hide();
				$(".contenido_c .etiqueta .arreglar_limpiar").show();
				etiqueta_copei = $("#etiqueta").val();
				$("#producto_tipo").text("." + etiqueta_copei);
			}
			else
				alert(data);
		});
		return false;
	});
	
	$(".contenido_columna_c .contenedor_acciones .boton_no_au").click(function(){
		var confirmar = confirm("Desea eliminar la relación con el producto");
		if(confirmar)
		{
			$.post("../Scripts/guardar.php", {opcion: "eliminar_copei",id: $(this).attr("value"), tipo: $(this).attr("data-type")}, function(data){
				if(data != "")
					alert(data);
			});
			if($(this).text() == "Eliminar")
				$(this).attr("href", "../Publicaciones/");
			else 
			{
				$(".contenido_columna_c .contenedor_acciones .boton_editar").hide();
				$(".contenido_columna_c .contenedor_acciones .boton_no_au").hide();
				$(".contenido_columna_c .contenedor_acciones .boton_si_au").show();
			}
		}
	});
	
	$(".contenido_columna_c .contenedor_acciones .boton_si_au").click(function(){
		$.post("../Scripts/guardar.php", {opcion: "autor", tipo_copei_esc: $(this).attr("data-type"), id_publicacion: $(this).attr("value")}, function(data){
			if(data == "")
			{
				$(".contenido_columna_c .contenedor_acciones .boton_editar").show();
				$(".contenido_columna_c .contenedor_acciones .boton_no_au").show();
				$(".contenido_columna_c .contenedor_acciones .boton_si_au").hide();
				$(".contenido_columna_c .contenedor_acciones .boton_no_au").text("No soy autor");
			}
			else
				alert(data);
		});
	});
});
