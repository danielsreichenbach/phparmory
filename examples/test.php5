<?php
/**
 * phpArmory5 test case
 *
 * A test case to derive a new class object from the phpArmory5 class.
 * @package phpArmory
 * @subpackage tests
 */

// Include the phpArmory class library
require_once ('../phpArmory.class.php5');

// Instantiate the class library
if ( $armory = new phpArmory5($areaName = 'eu') ) {
    echo "We have created an instance of phpArmory5.\n";

    echo "The current armory patch level is: " . $armory->getPatchLevel() . "\n";

    echo "World of Warcraft provides us with " . count ($armory->getTalentData()) . " talent definitions.\n";
} else {
    echo "Could not create an instance of phpArmory5. Please consult your PHP5 logs.\n";
}

?>
