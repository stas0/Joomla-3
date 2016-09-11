<?php
	defined('_JEXEC') or die();
	
	JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
	JHtml::_('behavior.formvalidation');
	JHtml::_('formbehavior.chosen', 'select');
	JHtml::stylesheet(JURI::base() . '/components/com_wichlacz/css/editBoiler.css');
	JHtml::script(JURI::base() . '/components/com_wichlacz/js/editBoiler.js');
?>

<script>
	Joomla.submitbutton = function(task){
		if (task == 'wichlaczboiler.cancel' || document.formvalidator.isValid(document.getElementById('wichlaczboiler-form'))) {
			Joomla.submitform(task, document.getElementById('wichlaczboiler-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_wichlacz&layout=edit&id='. (int)$this->item->id); ?>"
	method="post" name="adminForm" id="wichlaczboiler-form" class="form-validate">
	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'detalis'))?>
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'detalis', JText::_('COM_WICHLACZ_BOILER_DETALIS'), true)?>
		<div clas="container-fluid">
			<div class="span9">
				<?php 
				foreach($this->form->getFieldset('detalis') as $field){
				?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php
				}
				?>
			</div>
			<div class="span3">
				<?php 
				foreach($this->form->getFieldset('rightColumn') as $field){
				?>
					<div class="control-group">
						<?php echo $field->label; ?>
						<?php echo $field->input; ?>
					</div>
				<?php
				}
				?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab', 'myTab'); ?>
	</div>
	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>