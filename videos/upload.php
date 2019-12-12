<?php
	$page_title = 'Upload Video';
	$style_path = '../';
	require_once '../includes/header.php';
	if(isset($_SESSION['uid'])){
?>
<div class='lblock'>
<div id='up_ads'>Advertisement</div>
	<h1 style='color: blue; margin-bottom: 15px'>Upload Video With Voiot</h1>
	<form method='POST' action='' enctype='multipart/form-data'>
		<input type='text' name='vname' class='txt' placeholder='Video Title' size='41'><br />
		<textarea name='vcontent' placeholder='The Subject For The Video' cols='32' rows='8' class='txt'></textarea><br />
		<input type='file' name='video' placeholder='Choose The Video' class='txt'><br />
		<input type='submit' name='vupload' class='btns' value='Upload'>
	</form>
<?php
$videos_types = array(
'application/annodex', 'application/mp4', 'application/ogg', 'application/vnd.rn-realmedia', 'application/x-matroska', 'video/3gpp',
'video/3gpp2', 'video/annodex', 'video/divx', 'video/flv', 'video/h264', 'video/mp4', 'video/mp4v-es', 'video/mpeg', 'video/mpeg-2',
'video/mpeg4', 'video/ogg', 'video/ogm', 'video/quicktime', 'video/ty', 'video/vdo', 'video/vivo', 'video/vnd.rn-realvideo', 'video/vnd.vivo',
'video/webm', 'video/x-bin', 'video/x-cdg', 'video/x-divx', 'video/x-dv', 'video/x-flv', 'video/x-la-asf', 'video/x-m4v',
'video/x-matroska', 'video/x-motion-jpeg', 'video/x-ms-asf', 'video/x-ms-dvr', 'video/x-ms-wm', 'video/x-ms-wmv', 'video/x-msvideo',
'video/x-sgi-movie', 'video/x-tivo', 'video/avi', 'video/x-ms-asx', 'video/x-ms-wvx', 'video/x-ms-wmx');

	if(isset($_POST['pupload'])){
		$pname 	  = $DB->real_escape_string($_POST['vname']);
		$pcontent = $DB->real_escape_string($_POST['vcontent']);

		if(empty($pname)){
			echo "<div class='Failed'>Video Title Required, Please Enter it .</div>";
		}elseif(strlen($pname) < 4 || strlen($pname) > 400){
			echo "<div class='Failed'>Video Title Must be Four Characters at least and 400 characters at most .</div>";
		}elseif(empty($pcontent)){
			echo "<div class='Failed'>Video Content Required, Please Enter it .</div>";
		}else{
			if(empty($_FILES['video']['tmp_name'])){
				echo "<div class='Failed'>Please Choose The video You want upload it .</div>";
			}elseif(!getimagesize($_FILES['video']['tmp_name'])){
				echo "<div class='Failed'>Sorry, You Can Upload videos Only .</div>";
			}elseif($_FILES['video']['error'] > 0){
				echo "<div class='Failed'>There is something wrong in upload this file .</div>";
			}elseif(!in_array($_FILES['video']['type'], $videos_types)){
				echo "<div class='Failed'>Sorry, You Can Upload Videos Only .</div>";
			}else{
				$folder_path = dirname(__file__).'/uploads/';
				$file_path 	 = $_FILES['video']['tmp_name'];
				$nfile_name  = $_SESSION['uid'].rand(00,9999).$_FILES['video']['name'];
				$upload_file = move_uploaded_file($file_path,$folder_path.$nfile_name);
				$video_new_path = $folder_path.$nfile_name;

				if(isset($upload_file)){
					$sub_add = add("videos","(uid,title,content,source) VALUE('".$_SESSION['uid']."','".$pname."','".$pcontent."','".$video_new_path."')");
					if(isset($sub_add)){
						$get_video = get("videos", "WHERE source='".$video_new_path."'");
						$res_video = $get_video->fetch_object();
						header("Location: /videos/show?id=".$res_video->id."");
					}
				}
			}
		}
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
	}else{
		header("Location: /signin");
	}
	ob_start();
?>