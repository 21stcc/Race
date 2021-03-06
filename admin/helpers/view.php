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

/********************************
 * View Helper for Race component
 ********************************/
class RaceHelpersView
{
    /**
     * Method to load a view
     *
     * @access  public
     * @param   string view name
     * @param   string layout name
     * @param   string view format
     * @param   array  array of view variables
     * @return  object view object
     **/
    public function load($viewName, $layoutName='default', $viewFormat='html', $vars=null)
    {
        // Get the input
        $jinput = JFactory::getApplication()->input;

        // Set the view
        $jinput->set('view', $viewName);

        // Register the layout paths for the view
        $paths = new SplPriorityQueue;
        $paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');
        $viewClass = 'RaceViews' . ucfirst($viewName) . ucfirst($viewFormat);
        $modelClass = 'RaceModels' . ucfirst($viewName);

        if (false === class_exists($modelClass))
        {
            $modelClass = 'RaceModelsDefault';
        }

        // Create view class
        $view = new $viewClass(new $modelClass(''), $paths);

        // Set the layout
        $view->setLayout($layoutName);
        
        if(isset($vars))
        {
            foreach($vars as $varName => $var)
            {
                $view->$varName = $var;
            }
        }

    return $view;
    }
}