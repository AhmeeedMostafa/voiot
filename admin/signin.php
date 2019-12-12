<?php
	$page_title = 'Admin Sign In';
	$style_path = '../';
	require_once '../includes/header.php';
	if(isset($_SESSION['uid'])){
		if(!isset($_SESSION['admin_id'])){
?>
<center>
	<h1>Admin Sign in </h1>
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
			$get = get("*","users","WHERE email='".$email."' AND pass='".md5($pass)."' AND permissions='admin'");
			$num_rows = $get->num_rows;
			$res = $get->fetch_object();
			if($num_rows == 0){
				echo "<div class='Failed'>The Email or Password is wrong or you aren't admin .</div>";
			}else{
				$_SESSION['admin_id'] = $res->id;
				header("Location: /admin/");
			}
		}
	}else{
		header("Location: /admin/");
	}
}else{
	echo "<h2>Go Sign In As User First Then Sign In As Admin, <a href='/signin'>Sign In As User</a. .</h2>";
}
?>