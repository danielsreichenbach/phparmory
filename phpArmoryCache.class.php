<?php
/**
 * phpArmory is an embeddable class to retrieve XML data from the WoW armory.
 *
 * phpArmory is an embeddable PHP5 class, which allow you to fetch XML data
 * from the World of Warcraft armory in order to display arena teams,
 * characters, guilds, and items on a web page.
 * @author Daniel S. Reichenbach <daniel.s.reichenbach@mac.com>
 * @copyright Copyright (c) 2008, Daniel S. Reichenbach
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 * @link https://github.com/marenkay/phparmory/tree
 * @package phpArmory
 * @version 0.4.0
 */

/**
 * phpArmory5Cache extends phpArmory5, thus we require the base class file.
 */
require_once('phpArmory5.class.php');

/**
 * phpArmory5Cache class
 *
 * A class to fetch and cache unserialized XML data from the World of Warcraft
 * armory site.
 * @package phpArmory
 * @subpackage classes
 */
class phpArmory5Cache extends phpArmory5 {

    /**
     * Current version of the phpArmory5Cache class.
     * @access      private
     * @var         string      Contains the current class version.
     */
    private static $version = '0.4.0';

    /**
     * Current state of the phpArmory5Cache class. Allowed values are alpha, beta,
     * and release.
     * @access      private
     * @var         string      Contains the current versions' state.
     */
    private static $version_state = 'alpha';

    /**
     *
     * @access      private
     * @var         string
     */
    private $ = "";

    /**
     *
     * @access      private
     * @var         integer
     */
    private $ = 0;

    /**
     * phpArmory5Cache class constructor.
     * @todo IMPLEMENTATION MISSING.
     */
    public function __construct() {

    }

    /**
     * phpArmory5Cache destructor.
     * @todo IMPLEMENTATION MISSING.
     */
    public function __destruct() {

    }

}
?>
