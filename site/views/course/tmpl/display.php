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

<h2 class="page-header"><?php echo JText::_('COM_RACE_COURSE') . ' - ' . $this->course->name; ?></h2>
<div class="row-fluid">
    <div class="span12 well well-large">
        <a style="float:right" href="#return" class="btn btn-info btn-small"><?php echo JText::_('COM_RACE_COURSE_BACK'); ?></a>
        <h3><?php echo $this->course->short_description; ?></h3>
        <h4><?php echo $this->course->distance . ' ' . $this->course->distance_units; ?></h4>
        <p class="body"><?php echo $this->course->long_description; ?></p>
        <p><span><b>Download: </b></span><a href="<?php echo 'http://ridewithgps.com/routes/' . $this->course->ridewithgps_id . '.gpx?sub_format=track'; ?>">gpx</a> - <a href="<?php echo 'http://ridewithgps.com/routes/' . $this->course->ridewithgps_id . '.tcx'; ?>">tcx</a>
        <?php
        if(!empty($this->course->ridewithgps_id))
        {
        ?>
        <p></p>
        <iframe src="<?php echo '//ridewithgps.com/routes/' . $this->course->ridewithgps_id . '/embed'; ?>" height="500px" width="100%" frameborder="0"></iframe>
        <?php
        }
        ?>       
    </div>
</div>