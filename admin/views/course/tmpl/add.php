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

JHtml::_('behavior.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=com_race&layout=add'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_RACE_COURSE_ADD'); ?></legend>
            <div class="row-fluid">
                <div class="span1">
                    <?php foreach ($this->form->getFieldset() as $field): ?>
                        <div class="control-group">
                            <div class="control-label"><?php echo $field->label; ?></div>
                            <div class="controls"><?php echo $field->input; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </fieldset>
    </div>
    <input type="hidden" name="task" value="course.add" />
    <?php echo JHtml::_('form.token'); ?>
</form>