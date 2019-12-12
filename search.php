<?php
	$page_title = 'Voiot Search';
	require_once 'includes/header.php';
	echo "<div id='up_ads'>Advertisement</div>";
	if(isset($_GET['search_string']) && !empty($_GET['search_string'])){
		$search_string = $DB->real_escape_string($_GET['search_string']);
		echo "<table><tr><td><h1>Photos :</h1>";
		$get_photos = get("*", "photos", "WHERE title LIKE '%".$search_string."%' OR content LIKE '%".$search_string."%'");
		$num_rows_photos = $get_photos->num_rows;
		if($num_rows_photos == 0){
			echo "<div class='Failed'>Sorry, We Didn't find Any Result In Photos For Your Search .</div>";
		}else{
			while($result = $get_photos->fetch_object()){
				echo "<div class='photos_show'><a href='photos/show?id=".$result->id."'><span class='photo_title'>".substr($result->title, 0, 40)."</span><img src='/".$result->source."' width='300' height='150' title='".$result->title."' /></a></div>";
			}	
		}
		echo "</td><td><h1>Videos :</h1>";
		$get_videos = get("*", "videos", "WHERE title LIKE '%".$search_string."%' OR content LIKE '%".$search_string."%'");
		$num_rows_videos = $get_videos->num_rows;
		if($num_rows_videos == 0){
			echo "<div class='Failed'>Sorry, We Didn't find Any Result In Videos For Your Search .</div>";
		}else{
			while($result = $get_videos->fetch_object()){
				echo "<div class='videos_show'><a href='videos/show?id=".$result->id."'><span class='video_title'>".substr($result->title, 0, 40)."</span><span id='vide_start_ico'><img src='images/video_start.png' height='60' width='60' /></span><video src='/".$result->source."' width='350' height='300' title='".$result->title."'></video></a></div>";
			}
		}
		echo "</td></tr></table>";
	}else{
		echo "<div class='Failed'>Pleae, Enter The Title OR Content for the photo or the video to search about it .</div>";
	}
?>