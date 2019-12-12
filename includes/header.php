<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		if(!isset($style_path)){
			$style_path = NULL;
		}
		includes($style_path);
		meta_tags($page_title);
	?>
</head>
<body>
	<div id='header'>
		<div id='logo'>voiot</div>
		<div id='lmenu'>
			<ul>
				<li><a href='/videos'>Videos</a></li>
				<li><a href='/photos'>Photos</a></li>
				<li><a href='/upload'>Upload</a></li>
				<?php if(isset($_SESSION['uid'])){
					echo "<li><a href='/users/?id=".$_SESSION['uid']."'>Profile</a></li>";
				}
				if(isset($_SESSION['admin_id'])){
					echo "<li><a href='/admin/'>Admin CP</a></li>";
				}
				?>
			</ul>
		</div>
		<div id='rmenu'>
			<ul>
				<li>
					<form action='search' method='GET'>
						<input type='text' id='search_text' class='txt' name='search_string'><label id='sbutton_label' for='search_button'><img src='/images/search-icon.gif'></label>
						<input type='submit' name='search' id='search_button' style='display: none;' value='Search'>
					</form>
				</li>
				<?php
				if(isset($_SESSION['uid'])){
					echo "<li><a href='/signout'>Sign Out</a></li>";
				}else{
					echo "<li><a href='/signin' style='padding-right: 15px;'>Sign In</a></li>";
				}
				?>
			</ul>
		</div>
	</div>
	<div style='padding-top: 43px;'></div>