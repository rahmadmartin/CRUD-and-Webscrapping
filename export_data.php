<?php
include_once('dbnewssy.php');
$stmt = $db_con->prepare("SELECT * FROM articles ORDER BY id ASC");
$stmt->execute();
$developer_records = array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
	$developer_records[] = $row;
}			
if(isset($_POST["export_data"])) {	
	$filename = "data_export_".date('Ymd') . ".xls";			
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename\"");	
	$show_coloumn = false;
	if(!empty($developer_records)) {
	  foreach($developer_records as $record) {
		if(!$show_coloumn) {
		  // display field/column names in first row
		  echo implode("\t", array_keys($record)) . "\n";
		  $show_coloumn = true;
		}
		echo implode("\t", array_values($record)) . "\n";
	  }
	}
	exit;  
}
?>