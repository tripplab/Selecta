<html>
	<head>
		<script>
			$(document).ready(function()
			{     
				$(".link_accion_regresar").click(function(){
					var confirmar = confirm("Desea eliminar este programa");
					if(confirmar)
					{
						var id = $(this).attr("value"); 
						$.post("../Scripts/guardar.php", {opcion: "eliminar_programa", id: id}, function(data){
							if(data == "")
								$("#" + id).hide();
							else
								alert(data);
						});
					}
				});
			});
		</script>
	</head>
	<body>
		<?php
			session_start();
			include '../Scripts/query.php';
			$conexion = new Querys();
			
			function crear_elementos($id, $nombre)
			{
		?>	
				<li class="lista_temas_c publicacion_li contenido_js" id="<?php echo $id;?>">
					<div class="titulo_expandible" style="margin-top: -2px;">
						<div class="contenido_expandido titulo_js contenido_expandido_js expandido_colapsado_js" style="max-height: none;">
							<span class="titulo">	
								<span class="link_titulo_publicacion_js">
									<a class="titulo_publicacion titulo_publicacion_titulo_js editar_producto_copei" href="./Informacion.php?i=<?php echo $id; ?>&n=<?php echo $nombre?>"><?php echo $nombre; ?></a>	
								</span>		
							</span>
						</div>					
					</div>
					<?php
						if($_SESSION["Rol"] == "Administrador")
						{
					?>
					<div class="barra_footer"><!--footer-bar-->
						<a class="boton boton_plano link_accion_regresar rf" value="<?php echo $id;?>"><!--btn btn-plain action-libk-back-->Eliminar</a>
						<div class="limpiar"></div><!--clear-->
					</div>
					<?php
						}
					?>
				</li>
		<?php
			}
			$programa = $conexion->Consultas("SELECT * FROM Programa_Academico ORDER BY Nombre_Programa");
			for($x = 0; $x < count($programa); $x++)
				crear_elementos($programa[$x]["ID_Programa"], $programa[$x]["Nombre_Programa"]);
		?>
	</body>
</html>
