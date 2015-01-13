<?php
/**
 * Race component for Joomla 3.x
 *
 * @version 0.1.0
 * @package Race
 * @copyright Copyright (C) 21st Century Clubs. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 **/

// No direct access
defined('_JEXEC') or die('Restricted access');
 
// Import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
class JFormFieldCourse extends JFormFieldList
{
        protected $type = 'course';
 
        /**
         * Method to get a list of options for a list input.
         *
         * @return      array           An array of JHtml options.
         */
        protected function getOptions() 
        {
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                $query->select('course_id,course_name');
                $query->from('#__race_courses');
                $db->setQuery((string)$query);
                $messages = $db->loadObjectList();
                $options = array();
                var_dump($messages);
                if ($messages)
                {
                        foreach($messages as $message) 
                        {
                                $options[] = JHtml::_('select.option', $message->course_id, $message->name);
                        }
                }
                var_dump($options);
                $options = array_merge(parent::getOptions(), $options);
                return $options;
        }
}