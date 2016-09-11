<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$canOrder  = $user->authorise('core.edit.state', 'com_wichlacz.category');
$archived  = $this->state->get('filter.state') == 2 ? true : false;
$trashed   = $this->state->get('filter.state') == -2 ? true : false;
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_wichlacz&task=wichlacz.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'wichlaczList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<!-- <br><br><br><br><br><br><br><br><br> -->
<form actrion="<?php echo JRoute::_('index.php?option=com_wichlacz&view=wichlaczboiler'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<table class="table table-striped" id="articleList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHTML::_( 'grid.sort', JText::_('COM_WICHLACZ_HEADING_ID'), 'a.id', $listDirn, $listOrder); ?>
					</th>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHTML::_( 'grid.sort', JText::_('COM_WICHLACZ_HEADING_STATE'), 'a.state', $listDirn, $listOrder); ?>
					</th>
					<th class="nowrap hidden-phone">
						<?php echo JHTML::_( 'grid.sort', JText::_('COM_WICHLACZ_HEADING_NAME'), 'a.name', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($this->items as $i => $item){
					$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;
					$canChange  = $user->authorise('core.edit.state', 'com_mycomponents.category.' . $item->catid) && $canCheckin;
				?>
				<tr>
					<td>
						<?php echo $item->id?>
					</td>
					<td>
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td align="center">
						<?php echo JHtml::_('jgrid.published', $item->state, $i, 'wichlacz.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
					</td>
					<td>
						<a href="<?php echo JRoute::_('index.php?option=com_wichlacz&task=wichlaczboiler.edit&id='.(int) $item->id);  ?>">
							<?php echo $this->escape($item->name); ?>
						</a>
					</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>