<?php
	require_once '../includes/functions.php';
	if(intval($_GET['id'])){
		$uid = $_GET['id'];
		$get_user = get("*", "users", "WHERE id='".$uid."'");
		$res_user = $get_user->fetch_object();
		$num_rows = $get_user->num_rows;
		if($num_rows == 0){
			$page_title = 'Wrong User';
			$style_path = '../';
			require_once '../includes/header.php';
			echo "<div class='lblock'><div id='up_ads'>Advertisement</div>";
			echo "<div class='Failed'>Wrong User, No User Exists With this id !</div>";
		}else{
			$page_title = $res_user->fname.' '.$res_user->lname;
			$style_path = '../';
			require_once '../includes/header.php';

			echo "<div class='lblock'><div id='up_ads'>Advertisement</div>
			<h1 style='color: green;'>:. All Photos & Videos For ".$page_title." .:</h1>";
				$get_uphotos = get("*", "photos", "WHERE uid='".$uid."'");
				while($res_uphotos = $get_uphotos->fetch_object()){
					echo "<div class='photos_show'><a href='/photos/show?id=".$res_uphotos->id."'><span class='photo_title'>".substr($res_uphotos->title, 0, 40)."</span><img src='".$res_uphotos->source."' width='300' height='150' title='".$res_uphotos->title."' /></a></div>";
				}
				$get_uvideos = get("*", "videos", "WHERE uid='".$uid."'");
				while($res_uvideos = $get_uvideos->fetch_object()){
					echo "<div class='videos_show'><a href='/videos/show?id=".$res_uvideos->id."'><span class='video_title'>".substr($res_uvideos->title, 0, 40)."</span><span id='vide_start_ico'><img src='/images/video_start.png' height='60' width='60' /></span><video src='".$res_uvideos->source."' width='350' height='300' title='".$res_uvideos->title."'></video></a></div>";
				}
		}
	}else{
		$page_title = 'Wrong User No User ID';
		$style_path = '../';
		require_once '../includes/header.php';
		echo "<div class='lblock'><div id='up_ads'>Advertisement</div>";
		echo "<div class='Failed'>Wrong User, Enter The id for the user you want to see his profile .</div>";
	}
?>
				</div>
<div class='rblock'>
<?php
	$get_rblock = get("*", "blocks", "ORDER BY b_order ASC");
	while ($result_rblock = $get_rblock->fetch_object()) {
		echo "<div>".$result_rblock->b_content."</div>";
	}
?>
</div>