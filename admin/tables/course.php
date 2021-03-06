<?php
/**
 * Race component for Joomla 3.x
 *
 * @version 0.1.0
 * @package Race
 * @copyright Copyright (C) 21st Century Clubs. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 *************************************************************************/

// No direct access
defined('_JEXEC') or die('Restricted access');

// Import Joomla table library
jimport('joomla.database.table');

/********************
 * Course table class
 ********************/
class RaceTableCourse extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 **/
	function __construct($db)
	{
		parent::__construct('#__race_courses', 'course_id', $db);
	}
}