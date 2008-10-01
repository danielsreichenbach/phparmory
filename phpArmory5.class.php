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
    private var $version = '0.4.0';
    
    /**
     * Current state of the phpArmory5 class. Allowed values are alpha, beta,
     * and release.
     * @access      private
     * @var         string      Contains the current versions' state.
     */
    private var $version_state = 'alpha';
    
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
	 * @var         integer
	 */
	private var $timeOut = 5;

	/**
	 * Time of last download, used to insert a random delay to prevent armorys'
	 * weird behaviour.
	 * @access      private     
	 * @var         integer
	 */
	private var $lastDownload = 0;

	/**
	 * Number of retries for downloading data.
	 * @access      private     
	 * @var         integer
	 */
	private var $downloadRetries = 5;

    /**
     * phpArmory5 class constructor.
     * @access      public
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
     * 
     * @access      public
     */
    public function getArea() {
        
    }

    /**
     * 
     * @access      protected
     */
    protected function setArea($areaName) {
        
    }

    /**
     * 
     * @access      public
     */
    public function getLocale() {
        
    }

    /**
     * 
     * @access      protected
     */
    protected function setLocale($localeName) {
        
    }

    /**
     * 
     * @access      public
     */
    public function getPatchLevel() {
        
    }

    /**
     * 
     * @access      public
     */
    public function getCharacterData($characterInfo) {
        
    }

    /**
     * 
     * @access      public
     */
    public function getCharacterIconURL() {
        
    }

    /**
     * 
     * @access      public
     */
    public function getGuildData($guildName = NULL, $realmName = NULL) {
        
    }

    /**
     * 
     * @access      public
     */
    public function getItemData($itemID) {
        
    }

    /**
     * 
     * @access      public
     */
    public function getItemDataByName($itemName, $filter = NULL) {
        
    }

    /**
     * 
     * @access      public
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
