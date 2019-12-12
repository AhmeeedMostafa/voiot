<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$get_blocks = get("*", "blocks", "ORDER BY `b_order` ASC");

################################EDIT######################################
if(isset($_GET['query']) && $_GET['query'] == 'edit'){
    $b_id = $_GET['id'];
    
    if(isset($_POST['edit_block'])){
        $eb_name = $DB->real_escape_string($_POST['eb_name']);
        $eb_content = $DB->real_escape_string($_POST['eb_content']);
        $eb_order   = $DB->real_escape_string(intval($_POST['eb_order']));
        
        $edit = edit("blocks", "b_name='".$eb_name."',b_content='".$eb_content."',b_order='".$eb_order."' WHERE id='".$b_id."'");
        if(isset($edit)){
            die("<div class='Done'>Block Has Been Edited Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' />");
        }
    }
    $get_blocks_by_id = get("*", "blocks","WHERE id='".$b_id."'");
    $res_blocks_by_id = $get_blocks_by_id->fetch_object();
    
    echo "<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>Edit Block</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Block Name</td>
            <td width='80%' class='table2'><input type='text' name='eb_name' value='".$res_blocks_by_id->b_name."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Block Order</td>
            <td width='80%' class='table3'><input size='4' type='text' name='eb_order' value='".$res_blocks_by_id->b_order."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Block Content</td>
            <td width='80%' class='table2'><textarea name='eb_content' rows='8' cols='40'>".$res_blocks_by_id->b_content."</textarea></td>
        </tr>
        <tr>
            <td width='100%' align='center' colspan='2'>
                <input type='submit' value='Edit Block' name='edit_block' />
            </td>
        </tr>
    </table>";
}

################################DELETE######################################
if(isset($_GET['query']) && $_GET['query'] == 'delete'){
    $b_id = $_GET['id'];
    
    $delete = delete("blocks" ,"id='".$b_id."'");
    if(isset($delete)){
        die ("<div class='Done'>Block Has Been Deleted Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' /></div>");
    }
}


echo "<table cellpadding='2' cellspacing='2' border='1' width='100%' height='auto'>
        <tr>
            <th class='table2'>Block Name</th>
            <th class='table3'>Block Order</th>
            <th class='table2'>Block Content</th>
            <th class='table3'>Operations</th>
        </tr>";
while($result = $get_blocks->fetch_object()){
    echo "<tr>
            <td class='table2'>".$result->b_title."</td>
            <td class='table3'>".$result->b_order."</td>
            <td class='table2'>".substr($result->b_content,0,50)."</td>";
            echo "<td class='table3' style='text-align: center'><a href='?page=edit_blocks&query=edit&id=".intval($result->id)."'><img src='../images/edit.ico' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href='?page=edit_blocks&query=delete&id=".intval($result->id)."'><img src='../images/delete.png' width='20' height='20' /></a></td>
        </tr>";
}
    echo "</table>";
?>