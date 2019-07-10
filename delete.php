<?php
include_once 'dbnewssy.php';

if($_POST['del_id'])
{
	$id = $_POST['del_id'];
	$stmt=$db_con->prepare("DELETE FROM articles WHERE id=:aid");
	$stmt->execute(array(':aid'=>$id));
}
?>
