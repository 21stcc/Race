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

class RaceViewsCPanel extends JViewLegacy
{
	function display($tpl = null)
	{
		$this->addToolbar();

		// Display the template
		return parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 **/
	protected function addToolbar()
	{
		JToolbarHelper::title(JText::_('COM_RACE_CPANEL'), 'generic.png');
		JToolBarHelper::preferences('com_race', '600', '600');
    	JToolBarHelper::help( 'screen.race', true );
	}
}