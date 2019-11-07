<?php
class ProductoRepo {

	public static function getProductos(){
		$temp=NULL;
		$db=Conectar::conexion();
		if($result=$db->query("SELECT * FROM productos")){
			while($row=$result->fetch_assoc()){
				$temp[]=$row;
			}
		}
		return $temp;
	}
	public static function getUsuarios(){
		$temp=NULL;
		$db=Conectar::conexion();
		if($result=$db->query("SELECT * FROM usuario")){
			while($row=$result->fetch_assoc()){
				$temp[]=$row;
			}
		}
		return $temp;
	}	
	public static function getPedidos($user){
		$temp=NULL;
		$db=Conectar::conexion();
		if($result=$db->query("SELECT * FROM carrito where usuario='".$user."' AND finalizado='0'")){
			while($row=$result->fetch_assoc()){
				$temp[]=$row;
			}
		}
		return $temp;	
	}
}	
?>