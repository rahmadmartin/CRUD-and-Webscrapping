<?php
require_once 'dbnewssy.php';


	if($_POST)
	{
		$title = $_POST['title'];
		$description = $_POST['description'];
		$tag = $_POST['tag'];

		try{

			$stmt = $db_con->prepare("INSERT INTO articles(title,description,tag) VALUES(:atitle, :adesc, :atag)");
			$stmt->bindParam(":atitle", $title);
			$stmt->bindParam(":adesc", $description);
			$stmt->bindParam(":atag", $tag);

			if($stmt->execute())
			{
				echo "Successfully Added";
			}
			else{
				echo "Failed to Input Data";
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>
