<?php

class Conexion{
	var $servidor;
	var $usuario;
	var $contrasenia;
	var $base_datos;
	
	function Conexion($servidor = 'localhost', $usuario = 'selectausr', $contrasenia = 's3l3ct4', $base_datos = 'selecta')
	{
		$this->servidor = $servidor;
		$this->usuario = $usuario;
		$this->contrasenia = $contrasenia;
		$this->base_datos = $base_datos;
	}
	
	function Conexion_BD()
	{
		$conexion = new mysqli($this->servidor, $this->usuario, $this->contrasenia, $this->base_datos);
		
		if ($conexion->connect_errno) {
    		echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
		} else {
		echo $conexion->host_info . "\n"
		return($conexion);;
		}
	}
}
?>
