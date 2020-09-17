<?php
if (session_status() == PHP_SESSION_NONE) {
   ini_set('session.gc_maxlifetime', 288000);
   session_set_cookie_params(28800);
   session_start();
}
ini_set('max_execution_time', 12000); 

$DateNow = date("Y-m-d H:i:s");
$dbname = 'casualjobs';
$user = 'root';
$password = 'supun123';
try{
$con = new PDO("mysql:host=localhost; dbname=".$dbname."; charset=utf8", $user, $password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


error_reporting(E_ALL);
ini_set('display_errors', 'On');
}catch(PDOException $e){
echo $e->getMessage();
die();
}

?>