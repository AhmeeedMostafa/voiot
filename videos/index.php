<?php
	$page_title = 'Videos';
	$style_path = '../';
	require_once '../includes/header.php';
?>
<div class='lblock'>
	<div id='up_ads'>Advertisement</div>
	<?php
		$get_videos = get("*", "videos", "ORDER BY id DESC");
		while($result = $get_videos->fetch_object()){
			echo "<div class='videos_show'><a href='show?id=".$result->id."'><span class='video_title'>".substr($result->title, 0, 40)."</span><span id='vide_start_ico'><img src='../images/video_start.png' height='60' width='60' /></span><video src='".$result->source."' width='350' height='300' title='".$result->title."'></video></a></div>";
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