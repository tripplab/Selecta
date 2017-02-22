<html>
	<?php
		session_start();
		echo "<input type=hidden id=tipo value=".$_GET["t"].">";
		echo "<input type=hidden id=id value=".$_GET["i"].">";
		echo "<input type=hidden id=nom value=".$_GET["n"].">";
		echo "<input type=button id=boton style='display: none;'>";
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
					$("#contenedor_principal").load("./editar_caratula.php",  {t: $("#tipo").val(), i: $("#id").val(), n: $("#nom").val()});
				});
				
				$("#boton").click(function(){
					$("#contenedor_principal").empty();
					$("#contenedor_principal").load("./editar_caratula.php",  {t: $("#tipo").val(), i: $("#id").val(), n: $("#nom").val()});
				});
			});
		</script>
	</head>
	<body>
	</body>
</html>
 
