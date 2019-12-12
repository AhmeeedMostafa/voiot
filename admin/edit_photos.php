<?php
	if(intval($_GET['id'])){
		$pid 			= $_GET['id'];
		$get_photo 		= get("*", "photos", "WHERE id='".$pid."'");
		$num_rows_photo	= $get_photo->num_rows;
		if($num_rows_photo == 0){
			echo "<div class='Failed'>The Photo id is Wrong .</div>";
		}else{
		$photo_result = $get_photo->fetch_object();
if(isset($_POST['pedit'])){
	$epname 	= $DB->real_escape_string($_POST['pname']);
	$epcontent 	= $DB->real_escape_string($_POST['pcontent']);
	$eppath 	= $DB->real_escape_string($_POST['ppath']);

	$edit = edit("photos", "title='".$pname."', content='".$epcontent."', source='".$ppath."' WHERE id='".intval($pid)."'");
	if(isset($edit)){
		die ("<div class='Done'>Photo has Been Edited Successfully, You Are Redirecting To Photo Subject .<meta http-equiv='refresh' content='3; url=/photos/show?id=".$pid."' /></div>");
	}
}
	echo "<form method='POST' action=''>
		<input type='text' name='pname' value='".$photo_result->title."' class='txt' placeholder='Photo Title' size='41'><br />
		<textarea name='pcontent' placeholder='The Subject For The Photo' cols='32' rows='8' class='txt'>".$photo_result->content."</textarea><br />
		<input type='text' value='".$photo_result->source."' name='ppath' class='txt' placeholder='Photo Path' size='41' />
		<input type='submit' name='pedit' class='btns' value='Edit'>
	</form>";
}
}else{
	echo "<div class='Failed'>The Photo id is Wrong .</div>";
}
?>