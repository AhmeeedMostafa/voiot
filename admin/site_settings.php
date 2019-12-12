<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$get_settings = get("*", "site_settings");
$sresult      = $get_settings->fetch_object();


if(isset($_POST['save_settings'])){
    $sname     = $DB->real_escape_string($_POST['sname']);
    $sdesc     = $DB->real_escape_string($_POST['sdesc']);
    $smail     = $DB->real_escape_string($_POST['smail']);
    $skeywords = $DB->real_escape_string($_POST['skeywords']);
    $scase     = $_POST['scase'];
    $closemsg  = $DB->real_escape_string($_POST['closemsg']);
    
    $update = edit("site_settings", "sname='".$sname."',sdescription='".$sdesc."',smail='".$smail."',skeywords='".$skeywords."',scase='".$scase."',sclosemsg='".$closemsg."'");
    if(isset($update))
        die('<center class=\'Done\'>Save Has Been Done Successfully, You are redirecting to Main .<meta http-equiv=\'refresh\' content=\'2; url=index.php\' /></center>');
}

$be_sname     = $sresult->sname;
$be_sdesc     = $sresult->sdescription;
$be_smail     = $sresult->smail;
$be_skeywords = $sresult->skeywords;
$be_closemsg  = $sresult->sclosemsg;

echo "
<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td class='table' colspan='2'>Main Settings</td>
        </tr>
        <tr>
            <td class='table2'>Site Name</td>
            <td class='table2'><input type='text' size='30' name='sname' value='".$be_sname."' /></td>
        </tr>
        <tr>
            <td class='table3'>Site Description</td>
            <td class='table3'><textarea name='sdesc' rows='5' cols='40'>".$be_sdesc."</textarea></td>
        </tr>
        <tr>
            <td class='table2'>Site Mail</td>
            <td class='table2'><input type='mail' size='30' name='smail' value='".$be_smail."' /></td>
        </tr>
        <tr>
            <td class='table3'>Site KeyWords</td>
            <td class='table3'><textarea name='skeywords' rows='5' cols='40'>".$be_skeywords."</textarea></td>
        </tr>
        <tr>
            <td class='table2'>Site Cas</td>
            <td class='table2'>
                <select name='scase'>";
if($sresult->scase == 1){
    echo
   "<option value='1'>Open</option>
    <option value='0'>Close</option>";
}else{
    echo
    "<option value='0'>Close</option>
    <option value='1'>Open</option>";
}

echo "
                </select>
            </td>
        </tr>
        <tr>
            <td class='table3'>Close Message</td>
            <td class='table3'><textarea name='closemsg' rows='5' cols='40'>".$be_closemsg."</textarea></td>
        </tr><br />
    </table>
    <input type='submit' name='save_settings' value='Save Settings' />
</form>";
?>