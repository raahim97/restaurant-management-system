<?php
class Database{
	private static $dbName='restaurant management system';
	private static $userName='root';
	private static $password='root';
	private static $dbHost='localhost';
	private static $cont=NULL;
	public function __construct(){
		die('Init function is not allowed');
	}
	public static function connect(){
		if(null==self::$cont){
			try{
				self::$cont=new PDO("mysql:host=".self::$dbHost.";"."dbName=".self::$dbName.self::$userName.self::password);
			}
			catch(PDOException $e){
				die($e->getMessage());
			}
		}
		return self::cont;
	}
	public static function disconnect(){
		self::$cont=null;
	}
	
}


?>