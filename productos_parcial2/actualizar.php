<?php

	include("conexion.php");
	$db_conexionPEditar = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$idEdit = utf8_decode($_POST["id"]);
	$txt_producto = utf8_decode($_POST['txt_producto']);
	$drop_marca = utf8_decode($_POST["drop_marca"]);
	$txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
	$txt_pcosto = utf8_decode($_POST["txt_pcosto"]);
	$txt_pventa = utf8_decode($_POST["txt_pventa"]);
	$txt_existencia = utf8_decode($_POST["txt_existencia"]);
	
	$sqlUpdate = "UPDATE productos SET producto = '".$txt_producto."', id_marca = '".$drop_marca."', descripcion = '".$txt_descripcion."', precio_costo = '".$txt_pcosto."', 
					precio_venta = '".$txt_pventa."', existencia = '".$txt_existencia."' WHERE productos.id_producto = $idEdit;";

	if($db_conexionPEditar->query($sqlUpdate)==true){
		echo 'REGISTRO MODIFICADO';
	}
	else{
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	echo"<br>SQL-->:  ".$sqlUpdate."<br>";
	$db_conexionPEditar -> close();
	header("Location: index.php");
    
?>