<?php
	class DB{
		
		private $pdo;
		public function __construct(){
			$this->connect();
		}

		public function connect(){
			/*if (!empty($args["hostname"]) &&
				!empty($args["username"]) && 
				(!empty($args["pass"]) || $args["pass"] == "") &&
				!empty($args["dbname"]))
			{*/
				//$dsn = "mysql:host='".$args["hostname"]."';dbname='".$args["dbname"]."';charset=utf8";
				//$dsn = "mysql:host=localhost;dbname=db_blog";
			/*	$settings = array (
					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
				);*/
			$dsn = "mysql:host=localhost;dbname=calendar;charset=utf8";
			$this->pdo = new PDO($dsn,'root','');

		}

		public function doQuery($query){
			//return mysqli_query($this->id, $query);
			return $this->pdo->query($query);
		}
		
		public function read_param($table,$db_column,$column) {
			$query = "SELECT * FROM ".$table." WHERE ".$db_column." = '".$column."'";
			return $this->doQuery($query);
		}


		public function read_limit($table, $id, $amount_rows) {
			$query = "SELECT * FROM ".$table." ORDER BY ".$id." DESC LIMIT ".$amount_rows;
			//SELECT * FROM news ORDER BY id DESK LIMIT 10
			return $this->doQuery($query);	
		}

	} /*var_dump or print_r google save the world. Do you understand me fucking lazy bitch?*/
?>