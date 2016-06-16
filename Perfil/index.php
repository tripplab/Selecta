<html>
	<?php
        
		session_start();
		if(!isset($_SESSION["Rol"]) && !isset($_SESSION["ID"]) && !isset($_SESSION["Usuario_Temporal"]))
			header("Location: ../Logeo/");
		include '../Scripts/query.php';
                $conexion = new Querys();
		$id = (isset($_GET["i"])) ? $_GET["i"]: $_SESSION["ID"];
		$_SESSION["Usuario_Temporal"] = $id;
                 
              
                
                 if(is_numeric($id)) {
          $id = (isset($_GET["i"])) ? $_GET["i"]: $_SESSION["ID"];
		$_SESSION["Usuario_Temporal"] = $id;
    } else {
        
        
       $id = (isset($_GET["i"])) ? $_GET["i"]: $_SESSION["ID"];
      if (strpos($id, " "))
      {
       $iparr = split (" ", $id); 
       $nombre=$iparr[0];
        $apellido1=$iparr[1];
        $apellido2=$iparr[2];
       
        $idi= $conexion->Consultas("SELECT ID_Usuario FROM Usuario where Nombre='$nombre' and Apellido_Paterno='$apellido1' and Apellido_Materno='$apellido2'");
       $id=$idi[0]["ID_Usuario"];
       
		$_SESSION["Usuario_Temporal"] = $id;
                $_SESSION["Rol"]="sin rol";
      }
      else{
          echo"<script>alert('No se puede encontrar ese usuario')</script>";
      }
    }
                
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
					$("#contenedor_principal").load("./completar_caratula.php", {id: <?php echo $id;?>});
				});
			});
		</script>
	</head>
	<body>
	</body>
</html>
