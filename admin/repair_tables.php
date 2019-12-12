<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

if(isset($_POST['repair_tables'])){
    $show_tables = $DB->query("SHOW TABLES");
    if($show_tables == true){
        while($table = $show_tables->fetch_array(MYSQLI_BOTH)){
            $optimize = $DB->query("REPAIR TABLE ".$table[0]."");
        }
        if(isset($optimize)){
            echo "<div class='Done'>Tables Has Been Repaired Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' /></div>";
        }
    }
}

echo "<form action='' method='POST'>
        <input type='submit' name='repair_tables' style='margin-left: 30%; text-shadow: 0px 0px 11px lightblue; margin-top: 20%; font-size: 50px; padding: 9px;' value='Repair Tables' />
    </form>";
?>