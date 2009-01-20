<?php
/**
 * phpArmory5 test case
 *
 * A test case to derive a new class object from the phpArmory5 class.
 * @package phpArmory
 * @subpackage tests
 */

// Include the phpArmory class library
require_once ('../phpArmory.class.php');


$areaName           = 'us';
$characterName      = "Tsigo";
$characterRealmName = "Mal'Ganis";

$sapi_type = substr(php_sapi_name(), 0, 3);

// Instantiate the class library
if ( $armory = new phpArmory5($areaName = $areaName) ) {

    $ach = $armory->getAchievementData($characterName, $characterRealmName, 'Dungeons & Raids');
    if ($sapi_type == 'cli') {
        var_dump ($ach);
    } else {
        $string = print_r($ach, 1);
        $string = str_replace(array(" ", "\n"), array("&nbsp;", "<br />\n"), $string);

        echo "\$character = ".$string;
    }
} else {
    echo "Failed to create a phpArmory5 instance.\n";
}

?>
