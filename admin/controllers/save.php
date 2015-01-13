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
 * Save Controller for Race component
 ************************************/
class RaceControllersSave extends RaceControllersDefault
{
    public function execute()
    {
        // Get the input
        $jinput = JFactory::getApplication()->input;

        // Get the view name
        $viewName = $jinput->get('view', 'cpanel');

        // Create the model
        $modelClass = 'RaceModels' . ucfirst($viewName);
        $model = new $modelClass();

        // Save the data
        if ($row = $model->store())
        {
            $msg = JText::_('COM_RACE_SAVE_SUCCESS');
        }
        else
        {
            $msg = JText::_('COM_RACE_SAVE_FAILURE');
        }

        // Redirect
        $link = 'index.php?option=com_race&view=' . $viewName;

        $this->setRedirect($link, $msg);
    }
}