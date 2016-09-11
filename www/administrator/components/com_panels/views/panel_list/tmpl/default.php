<?php
	defined('_JEXEC') or die();
?>

<form 
	action="index.php?option=com_panels&view=panel_list"
	method="post" id="adminForm" name="adminForm">
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<td width="2%">
							ID
						</td>
						<td>
							Title
						</td>
						<td>
							Publish
						</td>
						<td>
							<?php echo JHtml::_('grid.checkall'); ?>
						</td>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($this->items)){ ?>
						<?php foreach ($this->items as $i => $value) { 
							$link = JRoute::_('index.php?option=com_panels&task=panel.edit&id=' . $value->id);
						?>
							<tr>
								<td>
									<?php echo $this->pagination->getRowOffset($i); ?>
								</td>
								<td>
									<a href="<?php echo $link; ?>">
										<?php echo $value->name; ?>
									</a>
								</td>
								<td>
									<?php echo $value->publish; ?>
								</td>
								<td>
									<?php echo JHtml::_('grid.id', $i, $value->id); ?>
								</td>
							</tr>
						<?php } ?>
					<?php  } ?>
				</tbody>
			</table>
		</div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<?php 	echo JHtml::_('form.token');?>
</form>