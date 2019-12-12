<?php
	if(intval($_GET['id'])){
	require_once '../includes/config.php';
	$pic_id = $_GET['id'];
	$get_title = $DB->query("SELECT * FROM `photos` WHERE id='".$pic_id."'");
	$num_rows = $get_title->num_rows;
	if($num_rows == 0){
		$page_title = 'The Photo id is Wrong';
		$style_path = '../';
		require_once '../includes/header.php';
		echo "<div class='lblock'>";
		echo "<div class='Failed'>The Photo id is Wrong .</div>";
		echo "</div>";
	}else{
		$title_res = $get_title->fetch_object();
		$style_path = '../';
		$page_title = $title_res->title;
		require_once '../includes/header.php';

			echo "<div class='lblock'>";
			if(isset($_GET['q']) && $_GET['q'] == 'delete'){
				if(isset($_SESSION['admin_id'])){
					$delete = delete("photos", "id='".$pic_id."'");
					if(isset($delete)){
						die("<div class='Done'>Photo Has Been Deleted Successfuly, You Are Redirecting To The Photos Main Page .<meta http-equiv='refresh' content='2; url=/photos/' </div>");
					}
				}else{
					echo "<div class='Failed'>You Don't Have The permissions To Delete any picture !</div>";
				}
			}
			$get_pic = get("*", "photos", "WHERE id='".$pic_id."'");
			$pic_res = $get_pic->fetch_object();
			$image_size = getimagesize($pic_res->source);
			if($image_size[0] <= 943){
				if(isset($_SESSION['admin_id'])){
					echo "<a href='show?id=".$pic_id."' class='sphoto_title'>
					<span style='font-size: 35px;'>".$pic_res->title."</span>
				</a><a href='/admin/?page=edit_photos&id=".$pic_id."'><img src='../images/edit.ico' width='20' height='20' /></a><a href='?id=".$pic_id."&q=delete'><img src='../images/delete.png' width='20' height='20' /></a>";
				}else{
					echo "<a href='show?id=".$pic_id."' class='sphoto_title'>
						<h1>".$pic_res->title."</h1>
					</a>";
				}
				echo "<img src='".$pic_res->source."' title='".$pic_res->title."' /><br />
				<h4>".$pic_res->content."</h4><br /><hr /><br />";
			}else{
				echo "<a href='show?id=".$pic_id."' class='sphoto_title'>
					<h1>".$pic_res->title."</h1>
				</a>
				<a href='".$pic_res->source."'><img src='".$pic_res->source."' width='943' title='".$pic_res->title."' /></a><br />
				<h4>".$pic_res->content."</h4><br /><hr /><br />";
			}
			echo "<h3 style='color: gray;'>:. Comments .:</h3><br />";
				$get_comments = get("*", "pcomments", "WHERE sid='".$pic_id."'");
				echo "<table>";
				while($res_comments = $get_comments->fetch_object()){
					$commenter_picture = get("*", "users", "WHERE id='".$res_comments->uid."'");
					$res_commenter = $commenter_picture->fetch_object();
					echo "<tr>
						<td><img src='".$res_commenter->picture."' height='50' width='50' /></td>
						<td><a href='' style='text-decoration: none; color: blue;'>".$res_comments->commenter."</a>  <span style='color: gray;'>".$res_comments->date."</span><br />".$res_comments->comment."</td>
					</tr>";
				}
				echo "</table>";
			if(isset($_SESSION['uid'])){
				$get_commenter = get("*", "users", "WHERE id='".$_SESSION['uid']."'");
				$result_commenter = $get_commenter->fetch_object();
				echo "<form action='' method='POST'>
					<img src='".$result_commenter->picture."' height='50' width='50' /> <textarea cols='100%' rows='4%' placeholder='Add a comment' style='padding: 6px;' name='comment'></textarea><br />
					<input type='submit' name='post_comment' style='background-color: blue; padding: 5px; margin-top: 5px; font-size: 22px; box-shadow: inset 0px 0px 65px lightblue; color: white; margin-left: 70%; border-radius: 7px; border: none;' value='Post Comment' />
				</form>";
				if(isset($_POST['post_comment'])){
					$commenter = $result_commenter->fname.' '.$result_commenter->lname;
					$comment   = $DB->real_escape_string($_POST['comment']);
					$date	   = date("Y/M/d - H:i:s A");

					if(empty($comment)){
						echo "<div class='Failed'>The Comment Is Empty !</div>";
					}else{
						$post_comment = add("pcomments", "(uid,sid,commenter,comment,date) VALUE ('".$_SESSION['uid']."', '".$pic_id."', '".$commenter."', '".$comment."', '".$date."')");
						if(isset($post_comment)){
							echo "<div class='Done'>Your Comment Posted Successfully, Refresh The page .</div>";
						}
					}
				}
			}else{
				echo "<h3>Sign In To Add new Comment, <a href='/signin'>Sign In</a></h3>";
			}
		}
	}else{
		$page_title = 'We didnot find the photo id you requested';
		$style_path = '../';
		require_once '../includes/header.php';
		echo "<div class='lblock'>";
		echo "<div class='Failed'>We didn't find the photo id you requested .</div>";
		echo "</div>";
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