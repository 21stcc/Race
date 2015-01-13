<?php
/**
 * Race component for Joomla 3.x
 *
 * @version 0.1.0
 * @package Race
 * @copyright Copyright (C) 21st Century Clubs. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 **/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Race component helper
 **/
class RaceHelpersRace
{
	public static $extension = 'com_race';

	/**
	 * @return  JObject
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_race';
		$level = 'component';

		$actions = JAccess::getActions('com_race', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}