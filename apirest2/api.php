<?php
	class Api{
		
		public function getProductos(){
			$vector=array();
			$conexion=new Conexion();
			$db=$conexion->getConexion();
			$sql="SELECT * FROM producto";
			$consulta=$db->prepare($sql);
			$consulta->execute();
			/*while($fila=$consulta->fetch()){
				$vector[]=array(
				"id"=>$fila["id"],
				"nombre"=>$fila["nombre"],
				"precio"=>$fila["precio"]
				);
			}*/
			$data=$consulta->fetchAll(PDO::FETCH_ASSOC);
			//return $vector;			
			return $data;
		}	
		
		
		public function getProducto($id){
			$vector=array();
			$conexion=new Conexion();
			$db=$conexion->getConexion();
			$sql="SELECT * FROM producto WHERE id=:id";
			$consulta=$db->prepare($sql);
			$consulta->bindParam(':id', $id);
			$consulta->execute();
			while($fila= $consulta->fetch()){
				$vector[]= array(
				"id"=>$fila['id'],
				"nombre"=>$fila['nombre'],
				"precio"=>$fila['precio']
				);
			}
			return $vector[0];
			/*$data = $consulta->fetch(PDO::FETCH_ASSOC);
			return $data;*/
		}

		public function addProducto($nombre, $precio){
				$conexion=new Conexion();
				$db=$conexion->getConexion();
				$sql="INSERT INTO producto (nombre, precio) VALUES (:nombre, :precio)";
				$consulta=$db->prepare($sql);
				$consulta->bindParam(':nombre',$nombre);
				$consulta->bindParam(':precio',$precio);
				$consulta->execute();	
				return '{"msg":"Producto agregado"}';
		}
		
		public function deleteProducto($id){
			try{
				$conexion=new Conexion();
				$db=$conexion->getConexion();
				$sql="DELETE FROM producto WHERE id=:id";
				$consulta=$db->prepare($sql);
				$consulta->bindParam(':id',$id);
				$consulta->execute();
				return '{"msg":"Producto Eliminado"}';	
			}catch(Exception $e){
				return '{"error":"error"}';
				
			}
			
			
				
		}

public function updateProducto($id, $nombre, $precio){
	$conexion=new Conexion();
	$db=$conexion->getConexion();
	$sql="UPDATE producto SET nombre=:nombre, precio=:precio WHERE id=:id";
	$consulta= $db->prepare($sql);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre',$nombre);
	$consulta->bindParam(':precio',$precio);
	$consulta->execute();
	return '{"msg":"prodcuto actualizado"}';
}


		
	}
	



?>