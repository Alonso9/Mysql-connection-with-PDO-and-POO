<?php
	
	class Connection extends PDO{
		
		private $db_type = "mysql"; //Data Base type
		private $host = "localhost"; //Host
		private $db_name = "dbName"; //Name of the DB
		private $db_user = "root"; //User of the DB
		private $db_pass = ""; //Password of DB
		private $config_char = "utf8"; //type of charset
		
		public function __construct(){ 
			try{
				parent::__construct("{$this->db_type}:dbname={$this->db_name};dbhost={$this->host};charset={$this->config_char}", $this->db_user, $this->db_pass);
			}catch(PDOException $e){
				echo "Error, cannot connect to DB ".$this->db_name.": ".$e->getMessage;
				exit;
			}
		}
	}
?>
