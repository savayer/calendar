<?php 
	class DB {
		
		public static function getConnection() 
		{
			$path = ROOT . '/config/db_params.php';
			$params = include($path);
			
			$dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$params['charset']}";
			$db = new PDO($dsn,$params['user'],$params['pass']);
			
			return $db;
		}
	}
?>