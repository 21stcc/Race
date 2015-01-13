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

/***************************************
 * Default controller for Race component
 ***************************************/
class RaceModelsDefault extends JModelBase
{
    /**
     * Protected fields
     **/
    protected $_id = null;
    protected $_data = null;

    protected $__state_set = null;
    protected $_db = null;
    protected $_limitstart = 0;
    protected $_limit = 10;
    protected $_pagination = null;
    protected $_total = null;
    //protected $id = null;

    /**
     * Constructor
     **/
    public function __construct()
    {
        parent::__construct();

        // Get the input
        $jinput = JFactory::getApplication()->input;

        // Get the item ids and whether editing an existing item
        $array = $jinput->get('cid', array(), 'ARRAY');
        $edit  = $jinput->get('edit', false);

        // If editing an existing item then set the item id
        if($edit)
        {
            $this->setId((int)$array[0]);
        }
    }

    /**
     * Method to set the item identifier
     *
     * @access  public
     * @param   int item identifier
     **/
    public function setId($id)
    {
        // Set item id and wipe data
        $this->_id   = $id;
        $this->_data = null;
    }

    /**
     * Method to get the form
     *
     * @access  public
     * @return  form object
     **/
    public function getForm()
    {
        // Get the application
        $app = JFactory::getApplication();

        // Get the view
        $view = $app->input->get('view', 'cpanel');
        
        // Get the form
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        JForm::addFieldPath(JPATH_COMPONENT . '/models/fields');
        JForm::addRulePath(JPATH_COMPONENT . '/models/rules');

        // Create the form
        try
        {
            $form = JForm::getInstance('jform', $view, array('control' => 'jform'));
        }

        catch (Exception $e)
        {
            $app->enqueueMessage($e->getMessage(), 'error');
            return false;
        }

        // Get the data for an existing item
        if (isset($this->_id))
        {
            $data = (array) $this->getItem();
            // Bind the form data if present
            if (!empty($data))
            {
                $form->bind($data);
            }
        }
        return $form;
    }

    public function store($data=null)
    {
        // Get the input
        $jinput = JFactory::getApplication()->input;
        $viewName = $jinput->get('view', '');
        $post = $jinput->post->getArray();
        $data = $post['jform'];

        $row = JTable::getInstance($viewName,'RaceTable');

        $date = date("Y-m-d H:i:s");
 
        // Bind the form fields to the table
        if (!$row->bind($data))
        {
            return false;
        }

        $row->modified = $date;
        if (!$row->created)
        {
            $row->created = $date;
        }

        // Make sure the record is valid
        if (!$row->check())
        {
            return false;
        }

        // Store the web link table to the database
        if (!$row->store())
        {
            return false;
        }

        return $row;
    }

    /**
     * Method to delete an item
     * @return boolean True if successfully deleted
     **/
    public function delete()
    {
        // Get the input
        $jinput = JFactory::getApplication()->input;

        // Get the view
        $viewName = $jinput->get('view','');

        // Get the item ids and whether editing an existing item
        $array = $jinput->get('cid', array(), 'ARRAY');

        $row = JTable::getInstance($viewName,'RaceTable');

        foreach ($array as $id)
        {
            $this->setId($id);
            $row->load($this->_id);

            // Delete the item
            if (!$row->delete())
            {
                return false;
            }
        }
       
        return true;
    }

    /**
     * Modifies a property of the object, creating it if it does not already exist.
     *
     * @param string $property The name of the property.
     * @param mixed $value The value of the property to set.
     *
     * @return mixed Previous value of the property.
     **/
    public function set($property, $value = null)
    {
        $previous = isset($this->$property) ? $this->$property : null;
        $this->$property = $value;
        return $previous;
    }

    public function get($property, $default = null)
    {
        return isset($this->$property) ? $this->$property : $default;
    }

    /**
     * Build a query, where clause and return an object
     *
     **/
    public function getItem()
    {
        $db = JFactory::getDBO();

        $query = $this->_buildQuery();
        $this->_buildWhere($query);
        $db->setQuery($query);

        $item = $db->loadObject();

        return $item;
    }

    /**
     * Build query and where for protected _getList function and return a list
     *
     * @return array An array of results.
     **/
    public function listItems()
    {
        $query = $this->_buildQuery();
        $query = $this->_buildWhere($query);
        $query = $this->_buildOrder($query);
        $list = $this->_getList($query, $this->_limitstart, $this->_limit);

        return $list;
    }

    /**
     * Gets an array of objects from the results of database query.
     *
     * @param string $query The query.
     * @param integer $limitstart Offset.
     * @param integer $limit The number of records.
     *
     * @return array An array of results.
     **/
    protected function _getList($query, $limitstart = 0, $limit = 0)
    {
        $db = JFactory::getDBO();
        $db->setQuery($query, $limitstart, $limit);
        $result = $db->loadObjectList();
     
        return $result;
    }
     
    /**
     * Returns a record count for the query
     *
     * @param string $query The query.
     *
     * @return integer Number of rows for query
     **/
    protected function _getListCount($query)
    {
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $db->query();

        return $db->getNumRows();
    }

    /**
     * Method to get model state variables
     *
     * @param string $property Optional parameter name
     * @param mixed $default Optional default value
     *
     * @return object The property where specified, the state object where omitted
     **/
    public function getState($property = null, $default = null)
    {
        if (!$this->__state_set)
        {
            // Protected method to auto-populate the model state.
            $this->populateState();

            // Set the model state set flag to true.
            $this->__state_set = true;
        }

        return $property === null ? $this->state : $this->state->get($property, $default);
    }

    /**
     * Get total number of rows for pagination
     **/
    function getTotal()
    {
        if ( empty ( $this->_total ) )
        {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }
     
    /**
     * Generate pagination
     **/
    function getPagination()
    {
        // Lets load the content if it doesn't already exist
        if (empty($this->_pagination))
        {
            $this->_pagination = new JPagination( $this->getTotal(), $this->getState($this->_view.'_limitstart'), $this->getState($this->_view.'_limit'),null,JRoute::_('index.php?view='.$this->_view.'&layout='.$this->_layout));
        }
        return $this->_pagination;
    }
}