<?php
	
	require_once("conn.php");
	
	class User{
		
		private $id;
		private $email;
		private $user_name;
		private $password;
		
		const TABLE = "users_data";
		
		public function getName(){
				return $this->user_name;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function __construct($id=NULL, $email, $user_name, $password){
			
			$this->id = $id;
			$this->email = $email;
			$this->user_name = $user_name;
			$this->password = $password;
		}
		
		public function save_user(){
			
			$conn = new Connection();
			$query = $conn->prepare("INSERT INTO ".self::TABLE." (id, email, user_name, password) VALUES (NULL, :email, :user_name, :password)");
			$query->bindParam(":email",$this->email);
			$query->bindParam(":user_name",$this->user_name);
			$query->bindParam(":password",$this->password);
			$query->execute();
			$this->id = $conn->lastInsertId();
			}
		public function get_all_elements(){
			
			$conn = new Connection();
			$query = $conn->prepare("SELECT * FROM ".self::TABLE);
			$query->execute();
			return $query->fetchAll();
		}
		public function delete($user_name,$email,$password){
			
			$conn = new Connection;
			$query = $conn->prepare("DELETE FROM ".self::TABLE. " WHERE user_name=:user_name AND email=:email AND password=:password");
			$query->bindParam(":email",$this->email);
			$query->bindParam(":user_name",$this->user_name);
			$query->bindParam(":password",$this->password);
			$query->execute();
			$row = $query->rowCount();
			if($row!=0){
				echo '<script type="text/javascript">
					alert("User deleted!");
				</script>';
			}else{
				echo '<script type="text/javascript">
					alert("Could not delte user!");
				</script>';
			}
		}
	}
	
	//$obj = new User(Null,"emailUser@gmail.com","userName","userPassword"); //Create the Object and insert the parameters
	//$obj->save_user(); //Save the data in the table
	//print_r($obj->get_all_elements());//Pirnt all element of the table
	//$obj->delete("pdero","pedro",1212121) //Dlete ine user using the name, email and password
?>
