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

/*********************************
 * Course model for Race component
 *********************************/
class RaceModelsCourse extends RaceModelsDefault
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Builds the query to be used by the course model
     * 
     * @return object Query object
     **/
    protected function _buildQuery()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);

        $query->select('course_id, name, short_description, long_description, distance, distance_units, ridewithgps_id');
        $query->from('#__race_courses');

        return $query;
    }

    /**
     * Builds the filter for the query
     * 
     * @param object Query object
     * @return object Query object
     **/
    protected function _buildWhere($query)
    {
        if(is_numeric($this->_id))
        {
            $query->where('course_id = ' . (int) $this->_id);
        }    
        return $query;
    }
    /**
     * Builds the sort for the query
     * 
     * @param object Query object
     * @return object Query object
     **/
    protected function _buildOrder($query)
    {
        $query->order('name');

        return $query;
    }
}