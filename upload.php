<?php
	$page_title = 'Choose Upload';
	require_once 'includes/header.php';
	if(isset($_SESSION['uid'])){
?>
<center style='color: red; margin-top: 10%; font-size: 25px;'>
	<h1>Choose The File You Want Upload It .</h1>
</center>
<center style='margin-top: 15%;'>
	<h1><a href='/photos/upload' class='signup'>Upload Photos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='/videos/upload' class='signup'>Upload Videos</a></h1>
</center>
<?php
	}else{
		header("Location: /index.php");
	}
	ob_end_flush();
?>