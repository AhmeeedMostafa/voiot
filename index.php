<?php
	$page_title = 'Welcome To Voiot - Comic Photos And Videos';
	require_once 'includes/header.php';
	if(!isset($_SESSION['uid'])){
?>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="js/bjqs-1.3.min.js"></script>
	<link type="text/css" rel="Stylesheet" href="styles/bjqs.css" />
	<div id="banner-slide">
	    <ul class="bjqs">
	        <li><img src='/images/pslider_1' /></li>
	        <li><img src='/images/pslider_2' /></li>
	        <li><img src='/images/pslider_3' /></li>
	    </ul>
	</div>
	<script type='text/javascript'>
	jQuery(document).ready(function($) {
	  
	  $('#banner-slide').bjqs({
	    animtype      : 'slide',
	width : $(window).width(),
	height : $(window).height()-43,
	    responsive    : true,
	    randomstart   : true,
	    showcontrols  : false,
	    usecaptions	  : false,
	    hoverpause	  : false,
	    showmarkers	  : false,
	    centermarkers : false,
	    centercontrols: false
	  });
	  
	});
	</script>
	<div id='sliders_texts'>
	<div><b>Voiot</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Smile the world in your hands</div>
	<a href='/signup' class='signup'>Sign up for voiot</a>
	</div>
<?php
	}else{
?>
	<div class='lblock'><div id='up_ads'>Advertisement</div>
		<?php
			$get_photos = get("*", "photos", "ORDER BY id DESC");
			$get_videos = get("*", "videos", "ORDER BY id DESC");
			while($photos_result = $get_photos->fetch_object()){
				echo "<div class='photos_show'><a href='/photos/show?id=".$photos_result->id."'><span class='photo_title'>".substr($photos_result->title, 0, 40)."</span><img src='/".$photos_result->source."' width='300' height='150' title='".$photos_result->title."' /></a></div>";
			}
			while($videos_result = $get_videos->fetch_object()){
					echo "<div class='videos_show'><a href='/videos/show?id=".$videos_result->id."'><span class='video_title'>".substr($videos_result->title, 0, 40)."</span><span id='vide_start_ico'><img src='images/video_start.png' height='60' width='60' /></span><video src='/".$videos_result->source."' width='350' height='300' title='".$videos_result->title."'></video></a></div>";
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
<?php
	}
	ob_end_flush();
?>