<?php

class Conexion{
	var $servidor;
	var $usuario;
	var $contrasenia;
	var $base_datos;
	
	function Conexion($servidor = 'localhost', $usuario = 'selectaapp', $contrasenia = 's3l3ct4', $base_datos = 'selecta')
	{
		$this->servidor = $servidor;
		$this->usuario = $usuario;
		$this->contrasenia = $contrasenia;
		$this->base_datos = $base_datos;
	}
	
	function Conexion_BD()
	{
		$conexion = new mysqli($this->servidor, $this->usuario, $this->contrasenia, $this->base_datos);
		return($conexion);
	}
}
?>
