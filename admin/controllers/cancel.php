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

/************************************
 * Cancel Controller for Race component
 ************************************/
class RaceControllersCancel extends RaceControllersDefault
{
    function execute()
    {
        // Get the input
        $jinput = JFactory::getApplication()->input;

        // Get view name
        $viewName = $jinput->get('view');

        // Set layout
        $jinput->set('layout', 'list');
        $jinput->set('edit', false);

        // Display view
        //return parent::execute();

        $msg = JText::_('COM_RACE_OPERATION_CANCELLED');
        $this->setRedirect('index.php?option=com_race&view=' . $viewName, $msg );
    }
}