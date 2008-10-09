# phpArmory - Work the World of Warcraft armory as you desire

## Summary

phpArmory is a PHP class library that can easily fetch and unserialize World of Warcraft Armory XML data into structured associative arrays.

This class library requires the PHP extensions for CURL, and XML installed. Please make sure that these extensions are installed on your server.

## Usage

Include phpArmory.class.php4 as the base class in your project, and inherit new classes from the phpArmory class.

If you need caching of the retrieved XML results, include the caching class from phpArmoryCache.class.php4 in your project, and inherit new classes from the phpArmoryCache class.

## Notes

If you use PHP5, please use the phpArmory.class.php5 file for normal data retrieval, and the phpArmoryCache.class.php5 for database / file cache data retrieval.

The PHP4 and PHP5 versions of phpArmory are not API compatible. The PHP4 versions are not supported anymore, as PHP 4 is deprecated, and everyone is recommended to use PHP5.
