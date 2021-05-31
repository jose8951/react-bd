<?php
	require_once('conexion.php');
	require_once('api.php');
	require_once('cors.php');
	$method=$_SERVER['REQUEST_METHOD'];
	
	if($method=="GET"){
		
		if(!empty($_GET['id'])){
			$id=$_GET['id'];
			$api=new Api();
			$obj=$api->getProducto($id);
			$json=json_encode($obj);
			echo $json;
		}else{
			$vector=array();
			$api=new Api();
			$vector=$api->getProductos();
			$json=json_encode($vector);
			echo $json;
		}
	};
	
		if($method=='POST'){
			$json=null;
			$data=json_decode(file_get_contents('php://input'), true);
			$nombre =$data['nombre'];
			$precio=$data['precio'];
			$api=new Api();
			$json=$api->addProducto($nombre, $precio);
			echo $json;
		}
		
		if($method=='DELETE'){
			$json=null;
			$id=$_REQUEST['id'];
			$api=new Api();
			$json=$api->deleteProducto($id);
			echo $json;
		}
		
		if($method=='PUT'){
			$json=null;
			$data=json_decode(file_get_contents('php://input'), true);
			$id=$data['id'];
			$nombre=$data['nombre'];
			$precio=$data['precio'];			
			$api=new Api();
			$json= $api->updateProducto($id,$nombre,$precio);
			echo $json;
		}

?>