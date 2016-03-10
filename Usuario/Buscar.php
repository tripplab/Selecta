<html>
	<?php
		echo '<input type="hidden" value="'.$_GET["consulta"].'" id="buscar">';
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
					$("#contenedor_principal").load("./completar_Buscar.php", {id: $("#buscar").val()});
				});
			});
		</script>
	</head>
	<body>
	</body>
</html>
