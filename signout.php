<?php
	$page_title = 'Sign out';
	require_once 'includes/header.php';
	if(isset($_SESSION['uid'])){
		session_destroy();
		echo "<div class='Done'>You Have been signed out successfully, Please Come Back Later .</div>";
	}else{
		echo "<div class='Failed'>You Didn't Sign in To Sign Out !</div>";
	}
	ob_end_flush();
?>