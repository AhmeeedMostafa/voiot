<?php
	$page_title = 'Log in';
	require_once 'includes/header.php';
	if(!isset($_SESSION['uid'])){
?>
<center>
	<h1>Log in </h1>
	<form actin='' method='POST'>
		<input type='email' name='email' size='35' required='required' class='txt' placeholder='You E-Mail'><br />
		<input type='password' name='pass' size='35' required='required' class='txt' placeholder='Your Password'><br />
		<input type='submit' name='login' class='btns' value='Sign in'>
	</form>
</center>
<?php
	if(isset($_POST['login'])){
		$email = $DB->real_escape_string($_POST['email']);
		$pass = $DB->real_escape_string($_POST['pass']);
		$get = get("*","users","WHERE email='".$email."' AND pass='".md5($pass)."'");
		$num_rows = $get->num_rows;
		$res = $get->fetch_object();
		if($num_rows == 0){
			echo "<div class='Failed'>The Email or Password is wrong .</div>";
		}else{
			$_SESSION['uid'] = $res->id;
			header("Location: /index.php");
		}
	}
}else{
	header("Location: /index.php");
}
?>