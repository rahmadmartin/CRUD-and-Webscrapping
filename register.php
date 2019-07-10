<?php
require_once 'dbnewssy.php';

	if($_POST)
	{
    $username = $_POST['username'];
    $email = $_POST['email'];
		$password = $_POST['password'];

		$password = md5($password);

		try{

			$stmt = $db_con->prepare("INSERT INTO user(username,email,password) VALUES(:auser, :aemail, :apass)");
			$stmt->bindParam(":auser", $username);
      $stmt->bindParam(":aemail", $email);
			$stmt->bindParam(":apass", $password);

			if($stmt->execute())
			{
				echo "Successfully Register, You can Login now";
			}
			else{
				echo "Failed to Register";
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>
