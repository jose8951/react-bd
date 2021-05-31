<?php
class Conexion{
	public function getConexion(){
		//$host="localhost";
		//$db="dbproducto";
		//$user="root";
		//$password="";
		
		define('servidor', 'localhost');
		define('nombre_bd', 'dbproducto');
		define('usuario', 'root');
		define('password', '');
		
		$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		
		try{
				//$db=new PDO("mysql:host=$host;dbname=$db;", $user, $password, $opciones);;
				$db = new PDO("mysql:host=" . servidor . "; dbname=" . nombre_bd, usuario, password, $opciones);
				return $db;
		}catch(Exception $e){
			die("El error de conexión es ". $e->getMessage());
		}
		
	
	}
	
}

?>