<?php
	include './Scripts/query.php';
	$conexion = new Querys();
	$conexion->Guardar("INSERT INTO Usuario (Nombre, Rol, Estatus, Contrasenia, Nick, FK_Unidad_Departamento) VALUES ('Administrador', 'Administrador', 'Activo', '".sha1("admin")."', 'admin', 2)");		

?>
