<?php
	$page_title = 'Sign Up';
	require_once 'includes/header.php';
	if(!isset($_SESSION['uid'])){
?>
<center>
	<h1 style='color: blue; margin-top: 6%; margin-bottom: 6%;'>Sign up free, To get more features and control your uploads .</h1>
	<form action='' method='POST'>
		<input type='text' class='txt' name='fname' placeholder='First Name' size='19'>&nbsp;&nbsp;<input type='text' name='lname' class='txt' size='19' placeholder='Last Name'><br />
		<input type='email' name='email' class='txt' size='46' placeholder='Your E-Mail'><br />
		<input type='email' name='email_sure' class='txt' size='46' placeholder='Re-Enter Your E-Mail'><br />
		<input type='password' name='pass' class='txt' size='46' placeholder='Your Password'><br />
		<input type='submit' name='signup' value='Sign up' class='btns'>
	</form>
</center>
<?php
	if(isset($_POST['signup'])){
		$fname 		= $DB->real_escape_string($_POST['fname']);
		$lname 		= $DB->real_escape_string($_POST['lname']);
		$email 		= $DB->real_escape_string($_POST['email']);
		$email_sure = $DB->real_escape_string($_POST['email_sure']);
		$pass  		= $DB->real_escape_string($_POST['pass']);
		$ip 		= $_SERVER['REMOTE_ADDR'];

		if(empty($fname)){
			echo "<div class='Failed'>Sorry, First Name Required .</div>";
		}elseif(strlen($fname) < 3 || strlen($fname) > 35){
			echo "<div class='Failed'>First Name Must be more than three characters and little than 35 characters .</div>";
		}elseif(empty($lname)){
			echo "<div class='Failed'>Sorry, Last Name Required .</div>";
		}elseif(strlen($lname) < 3 || strlen($lname) > 40){
			echo "<div class='Failed'>Last Name Must be more than three characters and little than 40 characters .</div>";
		}elseif(empty($email)){
			echo "<div class='Failed'>Sorry, E-Mail Required .</div>";
		}elseif(empty($email_sure)){
			echo "<div class='Failed'>Sorry, Re-Enter E-Mail Required .</div>";
		}elseif($email != $email_sure){
			echo "<div class='Failed'>Emails Don't Match, Please Try Again .</div>";
		}elseif(empty($pass)){
			echo "<div class='Failed'>Sorry, The Password Required .</div>";
		}elseif(strlen($pass) < 6){
			echo "<div class='Failed'>Password Must be more than six characters .</div>";
		}else{
			$add_user = add("users","(fname, lname, email, pass, permissions, ip, picture) VALUE ('".$fname."', '".$lname."', '".$email."', '".md5($pass)."', 'user', '".$ip."', 'images/start.jpeg')");
			if(isset($add_user)){
				echo "<div class='Done'>You Have Been Registered Successfully, Go To <a href='/signin' style='text-decoration: none; color: green;'>Sign in</a> .";
			}
		}
	}
}else{
	header("Location: /index.php");
}
ob_end_flush();
?>