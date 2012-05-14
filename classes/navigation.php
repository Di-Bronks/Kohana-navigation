<?php defined('SYSPATH') or die('No direct script access.');

class Navigation extends Navigation_Container
{
	protected static $_instance = array();

	public static function instance($resource = 'sitemap')
	{
		if(!isset(self::$_instance[$resource]))
		{
			self::$_instance[$resource] = new Model_Navigation($resource);
			return self::$_instance[$resource];
		}

		return self::$_instance[$resource];
	}

	/**
     * Creates a new navigation container
     *
     * @param array|Zend_Config $pages    [optional] pages to add
     * @throws Zend_Navigation_Exception  if $pages is invalid
     */
    public function __construct($pages = null)
    {
        if (is_array($pages)) 
		{
            $this->addPages($pages);
        } 
		elseif (null !== $pages) 
		{
            throw new Kohana_Exception(
                    'Invalid argument: $pages must be an array or null');
        }
    }
}