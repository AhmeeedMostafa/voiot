<?php
require_once '../includes/functions.php';
if(isset($_SESSION['admin_id']) && isset($_SESSION['uid'])){
?>
<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' type='text/css' href='styles/admin_style.css' />
    <?php
        $page_title = 'Admin Control Panel';
        meta_tags($page_title);
    ?>
</head>
<body>
    <div id='header'>
        <div id='logo'>voiot</div>
        <div id='lmenu'>
            <ul>
                <li><a href='/videos'>Videos</a></li>
                <li><a href='/photos'>Photos</a></li>
                <li><a href='/upload'>Upload</a></li>
                <?php if(isset($_SESSION['uid'])){
                    echo "<li><a href='/users/?id=".$_SESSION['uid']."'>Profile</a></li>";
                }
                if(isset($_SESSION['admin_id'])){
                    echo "<li><a href='/admin/'>Admin CP</a></li>";
                }
                ?>
            </ul>
        </div>
        <div id='rmenu'>
            <ul>
                <li>
                    <form action='search' method='GET'>
                        <input type='text' id='search_text' class='txt' name='search_string'><label id='sbutton_label' for='search_button'><img src='/images/search-icon.gif'></label>
                        <input type='submit' name='search' id='search_button' style='display: none;' value='Search'>
                    </form>
                </li>
                <?php
                if(isset($_SESSION['uid'])){
                    echo "<li><a href='/signout'>Sign Out</a></li>";
                }else{
                    echo "<li><a href='/signin' style='padding-right: 15px;'>Sign In</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <div style='padding-top: 43px;'></div>
<table dir="ltr" align="center" width="100%" cellpadding="5" cellspacing="5">
    <tr>
        <td dir="ltr" class="rpanel" width="15%" valign="top">
            <div class="head">Public Settings</div>
            <div class="bodypanel">
            <a href="index.php">Main</a><br />
            <a href="../index.php" target="_blank">Site Preview</a><br />
            <a href="?page=site_settings">Site Settings</a><br />
            </div>
            <div class="head">Blocks</div>
            <div class="bodypanel">
                <a href="?page=add_nblock">Add New Block</a><br />
                <a href="?page=edit_blocks">Edit Blocks</a><br />
            </div>
            <div class="head">Users</div>
            <div class="bodypanel">
                <a href="?page=edit_users">Edit Users</a><br />
            </div>
            <div class="head">Base Settings</div>
            <div class="bodypanel">
                <a href="?page=optimize_tables">Optimize Tables</a><br />
                <a href="?page=repair_tables">Repair Tables</a><br />
            </div>
        </td>
        <td class="cpanel" width="85%" valign="top">
            <?php
                if(isset($_POST['save_notes'])){
                    $admin_notes = $DB->real_escape_string($_POST['admin_notes']);
                    $save        = edit("site_settings", "admin_notes='".$admin_notes."'");
                }
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    $url  = $page.".php"; 
                    if(file_exists($url)){
                        require_once $url;
                    }else{
                        echo "No Pages Found";
                    }
                }else{
                    $aid = $_SESSION['admin_id'];
                    $get_admin = get("*" ,"users", "WHERE id='".$aid."' AND permissions='admin'");
                    $re        = $get_admin->fetch_object();
                    $get_notes = get("admin_notes","site_settings");
                    $res_notes = $get_notes->fetch_object();
                    
                    echo "<div class='imp'>Welcome To Admin Control Panel ".$re->fname." ".$re->lname."</div>
                <br />
               <form action='index.php' method='post'>
                <table align='center' width='100%' cellpadding='2' cellspacing='2'>
                    <tr>
                        <td class='table'>Admin Public Notes</td>
                    </tr>
                    <tr>
                        <td align='center' class='table3'><textarea name='admin_notes' rows='6' cols='80' placeholder='Put Your Notes To Remember It, Admin Notes ...'>".stripslashes($res_notes->admin_notes)."</textarea></td>
                    </tr>
                    <tr>
                        <td align='center' class='table2'><input class='buttons' type='submit' value='Save Notes' name='save_notes' /></td>
                    </tr>
                </table>
               </form>
                <br />
                <table align='center' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td class='table' colspan='2'>Script Info</td>
                    </tr>
                    <tr>
                        <td width='50%' class='table2'>Script Name : Voiot</td>
                        <td width='50%' class='table3'>Programmer : Ahmed Mostafa</td>
                    </tr>
                    <tr>
                        <td width='50%' class='table3'>Version : 1</td>
                        <td width='50%' class='table2'>PHP Version : 5</td>
                    </tr>
                </table>";
                }
            ?>
        </td>
    </tr>
</table>
<?php
	}else{
		header("Location: /signin");
	}
	ob_end_flush();
?>