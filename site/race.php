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
 
// Import sessions
jimport( 'joomla.session.session' );
 
// Load classes
JLoader::registerPrefix('Race', JPATH_COMPONENT);
 
// Load plugins
JPluginHelper::importPlugin('race');

// Set the table directory
JTable::addIncludePath(JPATH_COMPONENT.'/tables');

// Get the input
$jinput = JFactory::getApplication()->input;

// Get the task
$taskName   = $jinput->get('task', '');

if (strpos($taskName, '.') != false)
{
	// A view/controller pair exists
	list($viewName, $controllerName) = explode('.', $taskName);
	
	// Define the controller name and path
	$controllerName	= strtolower($controllerName);

	// Set the view
	$jinput->set('view', $viewName);

	// Set the layout
	$jinput->set('layout', $controllerName);
}
else
{
	// Define specific controller if requested
	$controllerName = $jinput->get('controller','default');
}

// Require the controller
require_once (JPATH_COMPONENT.'/controllers/'.$controllerName.'.php');

// Create the controller
$className  = 'RaceControllers'.ucwords($controllerName);
$controller = new $className();

// Determine the task
//$task = $app->input->getCmd('task');

// Perform the Request task
$controller->execute();

// Redirect if set by the controller
$controller->redirect();