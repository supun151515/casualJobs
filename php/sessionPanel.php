<?php

if (session_status() == PHP_SESSION_NONE) {
   ini_set('session.gc_maxlifetime', 28800);
   session_set_cookie_params(28800);
   session_start();
}


if(isset($_SESSION['email'])){
	if($_SESSION['type'] == 1){
		header('Location: ../employer');
	}else {
		header('Location: ../seeker');
	}
}
?>