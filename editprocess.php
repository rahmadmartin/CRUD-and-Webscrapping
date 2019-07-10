<?php
require_once 'dbnewssy.php';


	if($_POST)
	{
		$id = $_POST['id'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$tag = $_POST['tag'];

		$stmt = $db_con->prepare("UPDATE articles SET title=:atitle, description=:adesc, tag=:atag WHERE id=:aid");
		$stmt->bindParam(":aid", $id);
		$stmt->bindParam(":atitle", $title);
		$stmt->bindParam(":adesc", $description);
		$stmt->bindParam(":atag", $tag);

		if($stmt->execute())
		{
			echo "Successfully updated";
		}
		else{
			echo "Failed to Update Data";
		}
	}

?>
