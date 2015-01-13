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

// Load tooltip behavior
JHtml::_('behavior.tooltip');
?>

<h2 class="page-header"><?php echo JText::_('COM_RACE_COURSES'); ?></h2>

<form action="<?php echo JRoute::_('index.php?option=com_race'); ?>" method="post" name="adminForm" id="adminForm">
    <table class="adminlist table table-striped"" cellpadding="4" cellspacing="0" border="0" width="100%">
		<thead>
			<tr>
        		<th width="5">
            	    <?php echo JText::_('Num'); ?>
	        	</th>
        		<th width="20">
	                <?php echo JHtml::_('grid.checkall'); ?>
		        </th>
    	    	<th width="20%">
	                <?php echo JText::_('COM_RACE_COURSE_NAME'); ?>
    	    	</th>
        		<th width="10%">
            	    <?php echo JText::_('COM_RACE_COURSE_DISTANCE'); ?>
        		</th>
        		<th>
            	    <?php echo JText::_('COM_RACE_COURSE_SHORT_DESC'); ?>
        		</th>
        		<th width="1%" nowrap="nowrap">
                	<?php echo JText::_('COM_RACE_ID'); ?>
        		</th>
        	</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="14">
					<?php //echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php for($i=0, $n = count($this->courses); $i<$n; $i++) 
    		{
    			$this->_courseListView->course = $this->courses[$i]; ?>
    			<tr class="row<?php echo $i % 2; ?>">
    				<td>
						<?php echo $i + 1; ?>
					</td>
    				<td>
						<?php echo JHtml::_('grid.id', $i, $this->_courseListView->course->course_id); ?>
					</td>
					<td>
						<span class="editlinktip hasTip" title="<?php echo JText::_('COM_RACE_COURSE_EDIT');?><?php echo ' - ' . $this->_courseListView->course->name; ?>">
							<a href="<?php echo JRoute::_('index.php?option=com_race&task=course.edit&cid='.$this->_courseListView->course->course_id); ?>"><?php echo $this->_courseListView->course->name; ?>
							</a>
						</span>
					</td>
					<td>
						<?php echo $this->_courseListView->course->distance . ' ' . $this->_courseListView->course->distance_units; ?>
					</td>
					<td>
						<?php echo $this->_courseListView->course->short_description; ?>
					</td>
					<td>
						<?php echo $this->_courseListView->course->course_id; ?>
					</td>
    			</tr>
    		<?php
    			//echo $this->_courseListView->render();
    		} ?>
    	</tbody>       
    </table>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<?php
/**
 *	<div class="row-fluid">
 *   	<?php for($i=0, $n = count($this->courses);$i<$n;$i++) 
 *   	{
 *   		$this->_courseListView->course = $this->courses[$i];
 *   		echo $this->_courseListView->render();
 *   	} ?>
 *   </div>
 **/
?>