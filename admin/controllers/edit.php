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
 * Edit Controller for Race component
 ************************************/
class RaceControllersEdit extends RaceControllersDefault
{
    function execute()
    {
        // Get the input
        $jinput = JFactory::getApplication()->input;
        $viewName = $jinput->get('view', 'cpanel');

        // Set view and layout
        $jinput->set('view', $viewName);
        $jinput->set('layout', 'edit');
        $jinput->set('edit', true);

        // Display view
        return parent::execute();
    }
}