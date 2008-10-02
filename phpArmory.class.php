<?php
/**
 * phpArmory is an embeddable class to retrieve XML data from the WoW armory.
 * 
 * phpArmory is an embeddable PHP5 class, which allow you to fetch XML data
 * from the World of Warcraft armory in order to display arena teams,
 * characters, guilds, and items on a web page.
 * @author Michael Cotterell <mepcotterell@gmail.com>
 * @author Daniel S. Reichenbach <daniel.s.reichenbach@mac.com>
 * @copyright Copyright (c) 2007, Michael Cotterell
 * @copyright Copyright (c) 2008, Daniel S. Reichenbach
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 * @link https://github.com/marenkay/phparmory/tree
 * @package phpArmory
 * @version 0.3.2
 */
 
/**
 * phpArmory class
 * 
 * A class to fetch and unserialize XML data from the World of Warcraft armory
 * site.
 * @package phpArmory
 * @subpackage classes
 */
class phpArmory {

	/**
	 * The URL of the Armory website
	 *
	 * @var string
	 */
	var $armory = "http://www.wowarmory.com/";

	/**
	 * The URL of the WoW website
	 *
	 * @var string
	 */
	var $wow = "http://www.worldofwarcraft.com/";

	/**
	 * The armory area to send requests to
	 *
	 * @var string
	 */
	var $area = "us";
	
	/**
	 * The case sensitive name of a realm.
	 *
	 * @var string
	 */
	var $realm = FALSE;
	
	/**
	 * The case sensitive name of a guild.
	 *
	 * @var string
	 */
	var $guild = FALSE;
	
	/**
	 * The case sensitive name of a character.
	 *
	 * @var string
	 */
	var $character = FALSE;
	
	/**
	 * The default user agent for making HTTP requests
	 *
	 * @var string
	 */
	var $userAgent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11";
	// var $userAgent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.0.3) Gecko/2008092510 Firefox/3.0.3";
	
	/**
	 * The amounto of time in senconds after which to consider
	 * a connection timed out if not data has been yet been
	 * received.
	 *
	 * @var integer
	 */
	var $timeout = 5;

	/**
	 * Time of last download, used to insert a random delay to prevent armorys weird behaviour
	 *
	 * @var integer
	 */
	var $lastdownload = 0;

	/**
	 * Number of retries for downloading
	 *
	 * @var integer
	 */
	var $retries = 5;
	 
	/**#@-*/
	/**
	* The Constructor
	*
	* This function is called when the object is created. It has
	* one optional parameter which sets the base url of the
	* Armory website that will be used to fetch the serialized
	* XML data. (Useful for connecting to the European Armory)
	*
	* @param string	$armory	URL of the Armory website
	*/
	function phpArmory($armory = NULL, $retries = NULL){
	
        if (!extension_loaded('curl') && !extension_loaded('xml')) {
            exit ("Unable to instatiate phparmory: curl or xml extension missing.");
        }
		if ($armory){
			$this->armory = $armory;
		}
		if ($retries){
			$this->retries = $retries;
		}
	}

	function setArea($l) {
		switch($l)
		{
			case 'eu':
				$this->area = 'eu';
				$this->armory = 'http://eu.wowarmory.com/';
				$this->wow = 'http://www.wow-europe.com/';
			break;
                        case 'us':
				$this->area = 'us';
                                $this->armory = 'http://www.wowarmory.com/';
				$this->wow = 'http://www.worldofwarcraft.com/';
                        break;
		}
	}


	function getCurrentPatchlevel() {
		$major=0;
		$minor=0;
		$patch=0;

		if($this->area == 'eu') {
			$patchnotes=$this->xmlFetch($this->wow."en/patchnotes/",NULL,5);
			if(!preg_match('@<h3 .+>Patch ([0-9\.]+)</h3>@',$patchnotes,$matches)) return sprintf("%02d%02d%02d",$major,$minor,$patch);
		} else {
			$patchnotes=$this->xmlFetch($this->wow."patchnotes/",NULL,5);
			if(!preg_match('@<a href="/patchnotes/">Patch ([0-9\.]+)</a>@',$patchnotes,$matches)) return sprintf("%02d%02d%02d",$major,$minor,$patch);
		}
		
		list($major,$minor,$patch)=explode(".",$matches[1]);
		return sprintf("%02d%02d%02d",$major,$minor,$patch);
	}

	/**
	* characterFetch
	*
	* This function returns the unserialized XML data for a character
	* from the Armory. Both parameters are optional if their
	* corresponding instance variables are set. Most of the
	* time it is safe to assume that the realm instance 
	* variable is set. Therefore, most of the time, the 
	* second paramater is optional whereas the first
	* parameter usually needs to be defined. It is very
	* important to remember that both paramaters are case
	* sensitive.
	*
	* @return string[]		An associative array
	* @param string	$character	The name of the character
	* @param string	$realm		The character's realm
	*/
	function characterFetch($character = NULL, $realm = NULL){
		
		if(($character==NULL)&&($this->character)) $character = $this->character;
		if(($realm==NULL)&&($this->realm)) $realm = $this->realm;
		$realm = ucfirst($realm);
		$character = ucfirst($character);

		// report("Getting data for character: $character realm: $realm from ".strtoupper($this->area)." armory.");

		$urlbase = $this->armory."character-";
		$urlend = ".xml?r=".urlencode($realm)."&n=".urlencode($character);
		$result = $this->xmlToArray($this->xmlFetch($urlbase."sheet".$urlend));
		
		$pages = array("reputation", "skills", "talents");
		foreach ($pages as $page) {
			$temp = $this->xmlToArray($this->xmlFetch($urlbase.$page.$urlend));
			unset($temp['characterinfo']['character']);
			$result = array_merge($result, reset($temp));	//['characterinfo']
		}
		$patchlevel["armorypatchlevel"]=$this->getCurrentPatchlevel();
		$result = array_merge($result, $patchlevel);	//['characterinfo']

		return $result;

	}

	function TalentDefinitionFetch(){
		$classes=array("warrior","paladin","hunter","rogue","priest","shaman","mage","warlock","druid");
		// report("getting talent definitions from web!","DEBUG");

		foreach($classes as $class) {
			$class=strtolower($class);
			$url = $this->wow."shared/global/talents/".$class."/data.js";
			$result[$class] = $this->xmlFetch($url);
		}
		return $result;
	}

	
	/**
	* characterIconURL
	*
	* This function returns the url of a portrait icon for a
	* character from the Armory.
	*
	* @param string[]	$info		The character info array including level, gender, race, and class
	* @return string			The URL of the icon
	* @author Claire Matthews <poeticdragon@stormblaze.net>
	*/
	function characterIconURL($info) {

		$dir = "wow" . ($info['level'] < 60 ? "-default" : ($info['level'] < 70 ? "" : "-70"));
		return $this->armory."images/portraits/$dir/{$info['genderid']}-{$info['raceid']}-{$info['classid']}.gif";

	}

	/**
	* guildFetch
	* 
	* This function returns the unserialized XML data for a Guild
	* from the Armory. Both parameters are optional if their
	* corresponding instance variables are set. Most of the
	* time it is safe to assume that the realm instance 
	* variable is set. Therefore, most of the time, the 
	* second paramater is optional whereas the first
	* parameter usually needs to be defined. It is very
	* important to remember that both paramaters are case
	* sensitive.
	*
	* @return string[]		An associative array
	* @param string	$guild	The name of the guild
	* @param string	$realm	The guild's realm
	*/
	function guildFetch($guild = NULL, $realm = NULL){
	
		if(($guild==NULL)&&($this->guild)) $guild = $this->guild;
		if(($realm==NULL)&&($this->realm)) $realm = $this->realm;
	
		$url = $this->armory."guild-info.xml?r=".str_replace(" ", "+",$realm)."&n=".str_replace(" ", "+",$guild);
		return $this->xmlToArray($this->xmlFetch($url));
	
	}
	
	/**
	* itemFetch
	* 
	* This function returns the unserialized XML data
	* for an item from the Armory. The itemID parameter
	* is required.
	*
	* @return string[]				An associative array
	* @param integer	$itemID		The ID of the item
	*/
	function itemFetch($itemID){
	
		$url = $this->armory."item-tooltip.xml?i=".$itemID;
		return $this->xmlToArray($this->xmlFetch($url));
	
	}
	
	/**
	* itemNameFetch
	* 
	* This function returns the unserialized XML data
	* for an item from the Armory. The item parameter
	* is required. The second parameter filters search
	* results by the specified string and is optional.
	*
	* @return string[]			An associative array
	* @param string		$item	The name of the item
	* @param string[]	$filter	Associative array of search parameters
	* @author Thiago Melo <http://thiago.oxente.org/>
	* @author Claire Matthews <poeticdragon@stormblaze.net>
	*/
	function itemNameFetch($item, $filter = NULL) {

		$url = $this->armory."search.xml?searchQuery=".str_replace(" ", "+",$item)."&searchType=items";
		$items = $this->xmlToArray($this->xmlFetch($url));
		$items = $items['armorysearch']['searchresults']['items']['item'];

		if (!is_array($items[0])) $items = array($items);

		foreach ($items as $x_item) {
			if (strtolower($x_item['name']) == strtolower($item)) {
				$itemID = $x_item['id'];
				if ($filter==NULL) {
					return $this->itemFetch($itemID);
				} elseif (is_array($filter)) {
					$x_item = $this->itemFetch($itemID);
					$tooltip = $x_item['itemtooltip'];
					foreach ($filter as $attrib => $x_filter) {
						if ($tooltip[$attrib] != $x_filter) {
							unset($x_item); break;
						}
					}
					if ($x_item) return $x_item;
				}
			}
		}

	}

	/**
	* xmlFetch
	* 
	* This function returns the string of characters
	* returned from an HTTP GET request to the url 
	* defined in the url parameter. It is interesting
	* to note that although the function is called 
	* xmlFetch, the returned string may not neccesarily
	* be serialized XML data when the function is 
	* called publicly. 
	*
	* @todo Make the function independent of cURL
	*
	* @param string		$url			URL of the page to fetch data from
	* @param string		$userAgent		The user agent making the GET request
	* @param integer	$timeout		The connection timeout in seconds
	*/
	function xmlFetch($url, $userAgent = NULL, $timeout = NULL){
		
		if (function_exists('curl_init')){	

			if(($userAgent==NULL)&&($this->userAgent)) $userAgent = $this->userAgent;
			if(($timeout==NULL)&&($this->timeout)) $timeout = $this->timeout;
		
			for($i=1;$i<=$this->retries;$i++) {
				if(time() < $this->lastdownload+1) {
					$delay=rand(1,2);
					// report("...inserting delay of ".$delay." seconds.");
					sleep($delay);	//random delay
				}
	
				// report("Try $i: downloading from URL: ".$url);
				$ch = curl_init();
				$timeout = $this->timeout;
						
				curl_setopt ($ch, CURLOPT_URL, $url);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				curl_setopt ($ch, CURLOPT_USERAGENT, $userAgent);
				curl_setopt ($ch, CURLOPT_HEADER, 0);
				curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
				curl_setopt ($ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt ($ch, CURLOPT_LOW_SPEED_LIMIT, 5);
				curl_setopt ($ch, CURLOPT_LOW_SPEED_TIME, $timeout);
				curl_setopt ($ch, CURLOPT_TIMEVALUE, $timeout*3);
	
				$f = curl_exec($ch);
				$this->lastdownload=time();
				// report("content:".$f."\n\n");
				curl_close($ch);

				if(strpos($f,'errCode="noCharacter"')) return ("Character not found on armory, check spelling and area settings!");
				if(strpos($f,'errorhtml') AND $i<=$this->retries-1) return("Armory send an error page, retrying...");
				else {
					if(strlen($f) AND $i<=$this->retries-1) break;
						else return("No data, retrying...");
				}
			}
		
		} else {
			return("your php installation is lacking CURL support, cannot download!");
		}
		if(strlen($f)<100) return("Download failed, giving up! Server response: ".$f);
		
		return $f;
	
	}

	/**
	* xmlToArray
	* 
	* This function converts an xml string to an associative array
	* duplicating the xml file structure.
	*
	* @param string		$xmlData 		The XML data string to convert.
	* @param boolean 	$includeTopTag	Whether or not the topmost xml tag should be included in the array. The default value for this is false.
	* @param boolean	$lowerCaseTags	Whether or not tags should be set to lower case. Default value for this parameter is true.
	* @return string[]					An associative array
	* @author Colin Viebrock <colin@viebrock.ca>
	*/	
	function & xmlToArray($xmlData, $includeTopTag = false, $lowerCaseTags = true){

		$xmlArray = array();
		
		$parser = xml_parser_create();
		xml_parse_into_struct($parser, $xmlData, $vals, $index);
		xml_parser_free($parser);
	
		$temp = $depth = array();
	
		foreach ($vals as $value) {
	
			switch ($value['type']) {
		
			case 'open':
			case 'complete':
				array_push($depth, $value['tag']);
				$p = join('::', $depth);
				if ($lowerCaseTags) {
					$p = strtolower($p);
					if (is_array($value['attributes']))
						$value['attributes'] = array_change_key_case($value['attributes']);
				}
				$data = ( $value['attributes'] ? array($value['attributes']) : array());
				$data = ( trim($value['value']) ? array_merge($data, array($value['value'])) : $data);
				if ($temp[$p]) $temp[$p] = array_merge($temp[$p], $data);
				else $temp[$p] = $data;
				if ($value['type']=='complete') array_pop($depth);
				break;
	
			case 'close':
				array_pop($depth);
				break;
	
			}
	
		}
		
		if (!$includeTopTag) unset($temp["page"]);
		
		foreach ($temp as $key => $value) {
	
			if (count($value)==1) { $value = reset($value); }

			$levels = explode('::', $key);
			$num_levels = count($levels);
	
			if ($num_levels==1) {
				$xmlArray[$levels[0]] = $value;
			} else {
				$pointer = &$xmlArray;
				for ($i=0; $i<$num_levels; $i++) {
					if ( !isset( $pointer[$levels[$i]] ) ) {
						$pointer[$levels[$i]] = array();
					}
					$pointer = &$pointer[$levels[$i]];
				}
				$pointer = $value;
			}
	
		}
	
		return ($includeTopTag ? $xmlArray : reset($xmlArray));

	}


	/**#@-*/
	
}

?>
