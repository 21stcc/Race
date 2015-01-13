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
 * Course View for Race component
 ********************************/
class RaceViewsCourseHtml extends JViewHtml
{
    /**
     * Render
     **/
    function render()
    {
        // Get the input
        $jinput = JFactory::getApplication()->input;

        // Create new helper
        $viewHelper = new RaceHelpersView();

        switch($this->layout)
        {
            case "display":
                // Get the course
                $this->course = $this->model->getItem();
            break;

            case "list":
            default:
                // List the courses
                $this->courses = $this->model->listItems();
                $this->_courseListView = $viewHelper->load('Course','_entry','phtml');

                // Get the total number of courses
                $this->totalCourses = $this->model->getTotal();
            break;
        }
        
		//display
		return parent::render();
	}
}