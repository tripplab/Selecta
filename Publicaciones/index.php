<html>
	<?php
		session_start();
		if(!isset($_SESSION["Rol"]) && !isset($_SESSION["ID"]) && !isset($_SESSION["Usuario_Temporal"]))
			header("Location: ../Logeo/");
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="../Scripts/Selecta.css" type="text/css" rel="stylesheet"/>
		<script src="../Scripts/jquery-1.7.1.min.js"></script>
		<script>
			$(document).ready(function()
			{     
				$.post("../Caratula/caratula.php", function(data){
					$("body").append(data);
				}).done(function(){
					$(".tema").removeClass("menu_activo");
					$(".publicaciones").addClass("menu_activo");
					$("#contenedor_principal").load("./completar_caratula.php", function(data){
						$.post("./Puntaje.php", function(data){
							$(".menu_publicaciones #menu_antecedentes").text(data.puntaje_antecedentes_max);
							$(".menu_publicaciones #menu_productos").text(data.puntaje_publicaciones_min + " - " + data.puntaje_publicaciones_max);
							$(".menu_publicaciones #menu_formacion").text(data.puntaje_curso_max);
							$("#puntaje_total").text(data.puntaje_total_min + " - " + data.puntaje_total_max);
						}, "json");
					});
				});
			});
		</script>
	</head>
	<body>
	</body>
</html>
 
