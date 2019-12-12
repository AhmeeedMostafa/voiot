<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

if(isset($_POST['add_block'])){
    $b_name    = $DB->real_escape_string($_POST['b_name']);
    $b_content = $DB->real_escape_string($_POST['b_content']);
    $b_order   = $DB->real_escape_string(intval($_POST['b_order']));
    
    $add_block = add("blocks", "(b_title,b_content,b_order) VALUE ('".$b_name."','".$b_content."','".$b_order."')");
    if(isset($add_block)){
        die ("<div class='Done'>Block Has Been Added Successfully, You are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' /></div>");
    }
}

echo "<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>Add New Block</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Block Name</td>
            <td width='80%' class='table2'><input type='text' name='b_name' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Block Order</td>
            <td width='80%' class='table3'><input type='text' name='b_order' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Block Content</td>
            <td width='80%' class='table2'><textarea name='b_content' rows='8' cols='40'></textarea></td>
        </tr>
        <tr>
            <td width='100%' align='center' colspan='2'>
                <input type='submit' value='Add Block' name='add_block' />
            </td>
        </tr>
    </table>
</form>";

?>