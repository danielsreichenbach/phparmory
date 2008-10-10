<?php
/**
 * phpArmory test case
 *
 * A test case to derive a new class object from the phpArmory class, and to
 * retrieve an item from the World of Warcraft armory.
 * @package phpArmory
 * @subpackage tests
 */

// Include the phpArmory class library
require_once ('../phpArmory.class.php4');

/**
 * Configuration
 *
 * @var string $charName	Case-sensitive name of the character
 * @var string $realmName	Case-sensitive name of the realm
 *
 */

$itemID = 19990;
$areaName = "eu";

// Instantiate the class library
$armory = new phpArmory();

$armory->setArea($areaName);

// Fetch item information
$item = $armory->itemFetch($itemID);

$sapi_type = substr(php_sapi_name(), 0, 3);

if ($sapi_type == 'cli') {
    var_dump ($item);
} else {
    $string = print_r($item, 1);
    $string = str_replace(array(" ", "\n"), array("&nbsp;", "<br />\n"), $string);

    echo "\$item = ".$string;
}

?>
