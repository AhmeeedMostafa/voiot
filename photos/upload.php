<?php
	$page_title = 'Upload Photo';
	$style_path = '../';
	require_once '../includes/header.php';
	if(isset($_SESSION['uid'])){
?>
<div class='lblock'>
<div id='up_ads'>Advertisement</div>
	<h1 style='color: blue; margin-bottom: 15px'>Upload Photo With Voiot</h1>
	<form method='POST' action='' enctype='multipart/form-data'>
		<input type='text' name='pname' class='txt' placeholder='Photo Title' size='41'><br />
		<textarea name='pcontent' placeholder='The Subject For The Photo' cols='32' rows='8' class='txt'></textarea><br />
		<input type='file' name='photo' placeholder='Choose The Photo' class='txt'><br />
		<input type='submit' name='pupload' class='btns' value='Upload'>
	</form>
<?php
$photos_types = array('image/gif', 'image/jpeg', 'image/png',
            'application/x-shockwave-flash', 'image/psd', 'image/bmp',
            'image/tiff', 'image/tiff', 'application/octet-stream',
            'image/jp2', 'application/octet-stream', 'application/octet-stream',
            'application/x-shockwave-flash', 'image/iff', 'image/vnd.wap.wbmp', 'image/xbm');

	if(isset($_POST['pupload'])){

		$pname 	  = $DB->real_escape_string($_POST['pname']);
		$pcontent = $DB->real_escape_string($_POST['pcontent']);

		if(empty($pname)){
			echo "<div class='Failed'>Photo Title Required, Please Enter it .</div>";
		}elseif(strlen($pname) < 4 || strlen($pname) > 400){
			echo "<div class='Failed'>Photo Title Must be Four Characters at least and 400 characters at most .</div>";
		}elseif(empty($pcontent)){
			echo "<div class='Failed'>Photo Content Required, Please Enter it .</div>";
		}else{
			if(empty($_FILES['photo']['tmp_name'])){
				echo "<div class='Failed'>Please Choose The photo You want upload it .</div>";
			}elseif(!getimagesize($_FILES['photo']['tmp_name'])){
				echo "<div class='Failed'>Sorry, You Can Upload Photos Only .</div>";
			}elseif($_FILES['photo']['error'] > 0){
				echo "<div class='Failed'>There is something wrong in upload this file .</div>";
			}elseif(!in_array($_FILES['photo']['type'], $photos_types)){
				echo "<div class='Failed'>Sorry, You Can Upload Photos Only .</div>";
			}else{
				$folder_path = dirname(__file__).'/uploads/';
				$file_path 	 = $_FILES['photo']['tmp_name'];
				$nfile_name  = $_SESSION['uid'].rand(00,9999).$_FILES['photo']['name'];
				$upload_file = move_uploaded_file($file_path,$folder_path.$nfile_name);
				$photo_new_path = $folder_path.$nfile_name;

				if(isset($upload_file)){
					$sub_add = add("photos","(uid,title,content,source) VALUE('".$_SESSION['uid']."','".$pname."','".$pcontent."','".$photo_new_path."')");
					if(isset($sub_add)){
						$get_photo = get("photos", "WHERE source='".$photo_new_path."'");
						$res_photo = $get_photo->fetch_object();
						header("Location: /photos/show?id=".$res_photo->id."");
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
		header("Location: /signin.php");
	}
	ob_end_flush();
?>