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
 * phpArmory5 class
 * 
 * A class to fetch and unserialize XML data from the World of Warcraft armory
 * site.
 * @package phpArmory
 * @subpackage classes
 */
class phpArmory5 {
    
    /**
     * Current version of the phpArmory5 class.
     * @access      private     
     * @var         string      Contains the current class version.
     */
    private static $version = '0.4.0';
    
    /**
     * Current state of the phpArmory5 class. Allowed values are alpha, beta,
     * and release.
     * @access      private
     * @var         string      Contains the current versions' state.
     */
    private static $version_state = 'alpha';
    
	/**
	 * The URL of the World of Warcraft armory website to be used.
	 * @access      private     
	 * @var         string      Contains the URL of the armory website.
	 */
	private var $armory = "http://www.wowarmory.com/";

	/**
	 * The URL of the World of Warcraft website to be used.
	 * @access      private     
	 * @var         string      Contains the URL of the World of Warcraft website.
	 */
	private var $wow = "http://www.worldofwarcraft.com/";

	/**
	 * The armory area to send requests to.
	 * @access      private     
	 * @var         string      Contains the area / region to be used.
	 */
	private var $areaName = "us";
	
	/**
	 * The locale used to send requests.
	 * @access      private     
	 * @var         string      Contains the locale used to send requests.
	 */
	private var $localeName = "en";
	
	/**
	 * The case sensitive name of a realm.
	 * @access      private     
	 * @var         string      Contains the case sensitive name of a realm.
	 */
	private var $realmName = FALSE;
	
	/**
	 * The case sensitive name of a arena team.
	 * @access      private     
	 * @var         string      Contains the case sensitive name of a arena team.
	 */
	private var $arenaTeam = FALSE;
	
	/**
	 * The case sensitive name of a guild.
	 * @access      private     
	 * @var         string      Contains the case sensitive name of a guild.
	 */
	private var $guildName = FALSE;
	
	/**
	 * The case sensitive name of a character.
	 * @access      private     
	 * @var         string      Contains the case sensitive name of a character.
	 */
	private var $characterName = FALSE;
	
	/**
	 * The default user agent for making HTTP requests.
	 * @access      private     
	 * @var         string      Contains the user agent string used to query the armory.
	 */
	private var $userAgent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11";
	
	/**
	 * The amount of time in seconds after which to consider a connection timed
	 * out if no data has been yet retrieved.
	 * received.
	 * @access      private     
	 * @var         integer     Contains the nr# of seconds to wait between connection tries.
	 */
	private var $timeOut = 5;

	/**
	 * Time of last download, used to insert a random delay to prevent armorys'
	 * weird behaviour.
	 * @access      private     
	 * @var         integer     Contains the time passed since last download.
	 */
	private var $lastDownload = 0;

	/**
	 * Number of retries for downloading data.
	 * @access      private     
	 * @var         integer     Contains the nr# of retries to perform in case of connection failures.
	 */
	private var $downloadRetries = 5;

    /**
     * phpArmory5 class constructor.
     * @access      public
     * @param       string      $areaName               
     * @param       int         $downloadRetries        
     * @return      mixed       $result                 Returns TRUE if the class could be instantiated properly. Returns FALSE and an error string, if the class could not be instantiated.
     */
    public function __construct($areaName = NULL, $downloadRetries = NULL) {
        
    }
    
    /**
     * phpArmory5 destructor.
     * @access      public
     */
    public function __destruct() {
        
    }

    /**
     * Provides information on the current area configuration of phpArmory.
     * @access      public
     * @return      array       $areaSettings           Returns an array with self::$armoy, self::$wow, and self::$areaName.
     */
    public function getArea() {
        
    }

    /**
     * Configure the area in which phpArmory should operate.
     * @access      protected
     * @param       string      $areaName               The area phpArmory should operate in.
     * @return      mixed       $result                 Returns TRUE if $areaName is valid. Returns FALSE and an error string, if $areaName is not valid.
     */
    protected function setArea($areaName) {
        
    }

    /**
     * Provides information on the current locale in which phpArmory returns data.
     * @access      public
     * @return      string      $localeName             Returns the current locales' name.
     */
    public function getLocale() {
        
    }

    /**
     * Configure the locale in which phpArmory should query the armory.
     * @access      protected
     * @param       string      $localeName             The locale to query data in.
     * @return      mixed       $result                 Returns TRUE if $localeName is valid. Returns FALSE and an error string, if $localeName is not valid.
     */
    protected function setLocale($localeName) {
        
    }

    /**
     * Provides information on the current patch level of World of Warcraft.
     * @access      public
     * @return      array       $patchLevel             Returns an array with int $patchLevelMajor, int $patchLevelMinor, and int $patchLevelFix.
     */
    public function getPatchLevel() {
        
    }

    /**
     * Provides information on a specific character.
     * @access      public
     * @param       string      $characterName          The characters' name.
     * @param       string      $realmName              The characters' realm name.
     * @return      mixed       $result                 Returns an array containing TRUE and characterData if $characterName and $realmName are valid, otherwise FALSE and errorMessage.
     */
    public function getCharacterData($characterName, $realmName) {
        
    }

    /**
     * Provides the link to the matching portrait icon for a charater.
     * @access      public
     * @param       array       $characterInfo          The characterinfo array returned by self::getCharacterData.
     * @return      string      $result                 Returns an array containing TRUE and characterIconURL if $characterInfo is valid, otherwise FALSE and errorMessage.
     */
    public function getCharacterIconURL() {
        
    }

    /**
     * Provides information on a specific guild.
     * @access      public
     * @param       string      $guildName              The guilds' name.
     * @param       string      $realmName              The guilds' realm name.
     * @return      mixed       $result                 Returns an array containing TRUE and characterData if $guildName and $realmName are valid, otherwise FALSE and errorMessage.
     */
    public function getGuildData($guildName = NULL, $realmName = NULL) {
        
    }

    /**
     * Provides information on a specific item by querying its' ID.
     * @access      public
     * @param       int         $itemID                 The items' ID.
     * @return      mixed       $result                 Returns an array containing TRUE and itemData if $itemID is valid, otherwise FALSE and errorMessage.
     */
    public function getItemData($itemID) {
        
    }

    /**
     * Provides information on a specific item by querying its' name.
     * @access      public
     * @param       string      $itemName               The items' name.
     * @param       string      $itemFilter             An associative array of search paramters.
     * @return      mixed       $result                 Returns an array containing TRUE and itemData if $itemID is valid, otherwise FALSE and errorMessage.
     */
    public function getItemDataByName($itemName, $filter = NULL) {
        
    }

    /**
     * Provides information on the current talent tree definitions used by all character classes World of Warcraft.
     * @access      public
     * @return      mixed       $result                 Returns an array containing TRUE and TalentDefinitions, otherwise FALSE and errorMessage.
     */
    public function getTalentData() {
        
    }

    /**
     * 
     * @access      private
     */
    private function getXmlData($url, $userAgent = NULL, $timeout = NULL) {
        
    }

    /**
     * 
     * @access      private
     */
    private function convertXmlToArray($xmlData, $includeTopTag = false, $lowerCaseTags = true) {
        
    }

}
?>
