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

        switch($this->layout)
        {
            case "add":
                // Get the form
                $this->form = $this->model->getForm();
            break;

            case "edit":
                // Get the course
                $this->course = $this->model->getItem();
                // Get the form
                $this->form = $this->model->getForm();
            break;

            case "list":
            default:
                // Create new helper
                $viewHelper = new RaceHelpersView();

                // List the courses
                $this->courses = $this->model->listItems();
                $this->_courseListView = $viewHelper->load('Course','_entry','phtml');

                // Get the total number of courses
                $this->totalCourses = $this->model->getTotal();
            break;
        }

        // Add toolbar
        $this->addToolbar();

        // Display
        return parent::render();
    }

    /**
     * Add the page title and toolbar
     **/
    protected function addToolbar()
    {
        $canDo  = RaceHelpersRace::getActions();

        // Get the toolbar object
        $bar = JToolBar::getInstance('toolbar');

        // Set the page title
        JToolbarHelper::title(JText::_('COM_RACE'));
        
        if ($canDo->get('core.admin'))
        {
            switch($this->layout)
            {
                case "add":
                case "edit":
                    // Get the input
                    $jinput = JFactory::getApplication()->input;
                    $jinput->set('hidemainmenu', true);
                    JToolBarHelper::apply('course.apply');
                    JToolBarHelper::save('course.save');
                    JToolBarHelper::cancel('course.cancel');
                break;
                case "list":
                default:
                    JToolBarHelper::addNew('course.add');
                    JToolBarHelper::editList('course.edit');
                    JToolBarHelper::deleteList('Are you sure you want to delete these courses?', 'course.delete');
                    JToolbarHelper::preferences('com_race');
                break;
            }
        }
    }
}