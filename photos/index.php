<?php
	$page_title = 'Photos';
	$style_path = '../';
	require_once '../includes/header.php';
?>
<div class='lblock'>
	<div id='up_ads'>Advertisement</div>
	<?php
		$get_photos = get("*", "photos", "ORDER BY id DESC");
		while($result = $get_photos->fetch_object()){
			echo "<div class='photos_show'><a href='show?id=".$result->id."'><span class='photo_title'>".substr($result->title, 0, 40)."</span><img src='".$result->source."' width='300' height='150' title='".$result->title."' /></a></div>";
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