<?php
	session_start();
	require_once 'dbnewssy.php';

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$username = $_POST['username'];
		$password = trim($_POST['password']);

		$password = md5($password);

		try
		{

			$stmt = $db_con->prepare("SELECT * FROM user WHERE username=:username");
			$stmt->execute(array(":username"=>$username));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();

			if($row['password']==$password){

				echo "ok"; // log in
				$_SESSION['user_session'] = $row['id'];
			}
			else{

				echo "email or password does not exist"; // wrong details
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>
