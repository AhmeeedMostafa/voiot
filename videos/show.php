<?php
	if(intval($_GET['id'])){
	$vid_id = $_GET['id'];
	require_once '../includes/config.php';
	$get_title = $DB->query("SELECT * FROM `videos` WHERE id='".$vid_id."'");
	$num_rows = $get_title->num_rows;
	if($num_rows == 0){
		$page_title = 'The Video id is Wrong';
		$style_path = '../';
		require_once '../includes/header.php';
		echo "<div class='lblock'>";
		echo "<div class='Failed'>The Video id is Wrong .</div>";
		echo "</div>";
	}else{
		$title_res = $get_title->fetch_object();
		$style_path = '../';
		$page_title = $title_res->title;
		require_once '../includes/header.php';

			echo "<div class='lblock'>";
			if(isset($_GET['q']) && $_GET['q'] == 'delete'){
				if(isset($_SESSION['admin_id'])){
					$delete = delete("videos", "id='".$vid_id."'");
					if(isset($delete)){
						die("<div class='Done'>Video Has Been Deleted Successfuly, You Are Redirecting To The Videos Main Page .<meta http-equiv='refresh' content='2; url=/videos/' </div>");
					}
				}else{
					echo "<div class='Failed'>You Don't Have The permissions To Delete any Video !</div>";
				}
			}
			$get_vid = get("*", "videos", "WHERE id='".$vid_id."'");
			$vid_res = $get_vid->fetch_object();

				if(isset($_SESSION['admin_id'])){
					echo "<a href='show?id=".$vid_id."' class='sphoto_title'>
					<span style='font-size: 35px;'>".$vid_res->title."</span>
				</a><a href='/admin/?page=edit_videos&id=".$vid_id."'><img src='../images/edit.ico' width='20' height='20' /></a><a href='?id=".$vid_id."&q=delete'><img src='../images/delete.png' width='20' height='20' /></a>";
				}else{
					echo "<a href='show?id=".$vid_id."' class='sphoto_title'>
						<h1>".$vid_res->title."</h1>
					</a>";
				}
				echo "<video src='".$vid_res->source."' width='943' height='auto' title='".$vid_res->title."' controls></video><br />
				<h4>".$vid_res->content."</h4><br /><hr /><br />";

			echo "<h3 style='color: gray;'>:. Comments .:</h3><br />";
				$get_comments = get("*", "vcomments", "WHERE sid='".$vid_id."'");
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
						$post_comment = add("vcomments", "(uid,sid,commenter,comment,date) VALUE ('".$_SESSION['uid']."', '".$vid_id."', '".$commenter."', '".$comment."', '".$date."')");
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
		$page_title = 'We didnot find the video id you requested';
		$style_path = '../';
		require_once '../includes/header.php';
		echo "<div class='lblock'>";
		echo "<div class='Failed'>We didn't find the video id you requested .</div>";
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