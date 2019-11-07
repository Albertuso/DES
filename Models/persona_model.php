<?php
class Persona {

	private $rol;
	private $nombre;

	function __construct($nombre,$pass){
	$db=Conectar::conexion();
		if($result=$db->query("SELECT * FROM usuario WHERE nombre ='".$nombre."' AND password='".$pass."'")){
				if($datos=$result->fetch_assoc()){
					$this->rol=$datos['rol'];
					$this->nombre=$datos['nombre'];
				}
		}else{
			$this->nombre="Anonimo";
		}
	}
	function getRol(){
		return $this->rol;
	}
	function getNombre(){
		return $this->nombre;
	}
}
?>