<?php
		if(intval($_GET['id'])){
		$vid 			= $_GET['id'];
		$get_video 		= get("*", "videos", "WHERE id='".$vid."'");
		$num_rows_video	= $get_video->num_rows;
		if($num_rows_video == 0){
			echo "<div class='Failed'>The Video id is Wrong .</div>";
		}else{
		$video_result = $get_video->fetch_object();
if(isset($_POST['vedit'])){
	$epname 	= $DB->real_escape_string($_POST['vname']);
	$epcontent 	= $DB->real_escape_string($_POST['vcontent']);
	$eppath 	= $DB->real_escape_string($_POST['vpath']);

	$edit = edit("photos", "title='".$pname."', content='".$epcontent."', source='".$ppath."' WHERE id='".intval($vid)."'");
	if(isset($edit)){
		echo "<div class='Done'>Video has Been Edited Successfully, You Are Redirecting To Video Subject .<meta http-equiv='refresh' content='3; url=/videos/show?id=".$pid."' /></div>";
	}
}
	echo "<form method='POST' action=''>
		<input type='text' name='vname' value='".$video_result->title."' class='txt' placeholder='Video Title' size='41'><br />
		<textarea name='vcontent' placeholder='The Subject For The Video' cols='32' rows='8' class='txt'>".$video_result->content."</textarea><br />
		<input type='text' name='vpath' value='".$video_result->source."' class='txt' placeholder='Video Path' size='41' />
		<input type='submit' name='vedit' class='btns' value='Upload'>
	</form>";
}
}else{
	echo "<div class='Failed'>The Video Id is Wrong .</div>";
}
?>