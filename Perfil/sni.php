<html>
	<?php
		session_start();
		include '../Scripts/query.php';
		$id = $_POST["id"];
		$conexion = new Querys();
		$sni = $conexion->Consultas("SELECT * FROM SNI WHERE FK_Usuario = ".$id." ORDER BY Fecha_Otorgacion");
		$rol = (isset($_SESSION["Rol"])) ? $_SESSION["Rol"] : "";
	?>
<head>
		<script src="./sni.js"></script>
</head>
<body>

	<div class="caja_c informacion_institucion contenedor_js" style="margin: 0px;"><!--c-box info-institution js-widgetcontainer-->		
		<h4 class="ningun_margen"><!--no-margin-->SNI 
		<?php 
			if($rol == "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
			{
		?>
				<a class="rf agregar_nivel">Agregar Nuevo</a>
		<?php
			}
		?>
		</h4>
		<?php
			if(count($sni) > 0)
			{
		?>
				<table width="100%">
					<tbody>
						<tr>
						<?php
							$table = "<tr>";
							for($x = 0; $x < count($sni); $x++)
							{
								$fecha = explode("-", $sni[$x]["Fecha_Otorgacion"]);
								if($rol == "Administrador" || (isset($_SESSION['ID']) && $id == $_SESSION["ID"]))
									echo "<td>  <a class='editar' value='".$sni[$x]["ID_SNI"]."'>".$fecha[0]."</a></td>";
								else
									echo "<td>  <a value='".$sni[$x]["ID_SNI"]."'>".$fecha[0]."</a></td>";
								$table .= "<td>Nivel: ".$sni[$x]["Nivel"]."</td>";
							}
							$table .= "</tr>";
						?>
						</tr>
						<?php 
							echo $table;	
						?>
					</body>
				</table>
		<?php
			}
		?>
		<div class="limpiar"></div><!--clear-->
	</div>
</body>
</html>


