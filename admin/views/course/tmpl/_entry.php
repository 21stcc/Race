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
?>

<div class="media well well-small span6">
    <a class="pull-left" href="<?php echo JRoute::_('index.php?option=com_race&view=course&layout=course&id='.$this->course->course_id); ?>">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="<?php echo JRoute::_('index.php?option=com_race&view=course&layout=course&id='.$this->course->course_id); ?>"><?php echo $this->course->name; ?></a></h4>
        </p>
    </div>
</div>