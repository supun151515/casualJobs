<?php
include ('../php/db.php');
if(isset($_POST['jobid'])){
$jobid = explode(',',$_POST['jobid']);
$jobid = implode(',', $jobid);

	$sql = "SELECT id, skill FROM `tags` where jobid IN ($jobid)";
	$smt = $con->prepare($sql);
	$smt->execute(array());
	$row = $smt->fetchAll(PDO::FETCH_OBJ);
	//$num_rows = $smt->rowCount();
	print json_encode($row);
}
	
?>