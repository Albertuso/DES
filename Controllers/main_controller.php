<?php
//carga de clases
require_once("Models/persona_model.php");
require_once("Models/producto_model.php");
session_start();
//iniciar-cerrar sesion
if(isset($_GET['logout'])){
	session_destroy();
	header('location:index.php');
}
$db=Conectar::conexion();
//agregar al carrito
if(isset($_POST['ccc'])){
	$consulta="INSERT INTO carrito (`usuario`, `producto`, `cantidad`, `finalizado`) VALUES ('".$_SESSION['user']->getNombre()."', '".$_POST['product']."', '".$_POST['ccc']."', '0');";
	$result=$db->query($consulta);
}
//gestion de permisos admins
if(isset($_GET['admin'])&&$_SESSION['user']->getRol()==1){
	$consulta="update usuario set rol=".$_GET['rol']." where nombre='".$_GET['admin']."'";
	$result=$db->query($consulta);
}
//alta producto
if(isset($_POST['register'])){
	if($_FILES['avatar']['type']=="image/jpeg" || $_FILES['avatar']['type']=="image/jpg" || $_FILES['avatar']['type']=="image/png" || $_FILES['avatar']['type']=="image/gif"){
		if(move_uploaded_file($_FILES['avatar']['tmp_name'], './Views/img/'.$_FILES['avatar']['name'])){
			$consulta="INSERT INTO productos(nombre,foto,categoria,descripcion,precio,cantidad) VALUES ('".$_POST['nombre']."', '".$_FILES['avatar']['name']."','".$_POST['categoria']."','".$_POST['descripcion']."','".$_POST['precio']."','".$_POST['cantidad']."')";
			$result=$db->query($consulta);
		}
	}
}
//confirmar la compra
if(isset($_GET['comprar'])){
	$consulta="UPDATE carrito SET finalizado=1 WHERE usuario='".$_GET['usuario']."'";
	$result=$db->query($consulta);
}
//insertar tupla aunque modificado
// if(isset($_GET['add'])){
// 	$consulta="INSERT INTO carrito (producto,usuario) VALUES ('".$_GET['add']."', '".$_SESSION['nombre']."')";
// 	$result=$db->query($consulta);
// 	header('location:index.php');
// }
//alta usuario
if(isset($_POST['registerP'])){
	$consulta="INSERT INTO usuario (nombre,password,direccion,correo,telefono) VALUES ('".$_POST['userName']."', '".$_POST['password']."', '".$_POST['direccion']."', '".$_POST['correo']."', '".$_POST['telefono']."')";
	$result=$db->query($consulta);
}
//login usuario y redireccionamiento
if(isset($_POST['userName']) && isset($_POST['password'])){
	$_SESSION['user'] = new Persona($_POST['userName'], $_POST['password']);
	header('location:index.php');
}
else{
	require_once("./Controllers/persona_controller.phtml");
}
?>