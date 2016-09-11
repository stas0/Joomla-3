<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

?>
<!--Сохранение данных из поля редактора, если этого не поствить то ничего работать не будет
echo $this->form->getField('opisanie')->save();
где opisanie поле в бд
-->
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'mycomponent.cancel' || document.formvalidator.isValid(document.id('mycomponent-form'))) {
			<?php echo $this->form->getField('opisanie')->save(); ?>
			Joomla.submitform(task, document.getElementById('mycomponent-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>


<form action="<?php echo JRoute::_('index.php?option=com_mycomponents&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="mycomponent-form" class="form-validate">
<div class="width-100 fltlft">		
<fieldset class="adminform">

<!--Вывод данных из бд в форму + вкладки навигации в данном случае она одна-->
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab"><?php echo empty($this->item->id) ? JText::_('COM_MYCOMPONENT_DETALIS') : JText::sprintf('COM_MYCOMPONENT_DETALIS', $this->item->id); ?></a></li>			
</ul>

	<?php foreach($this->form->getFieldset() as $field): ?>
	<?php if (!$field->hidden): ?>
	<?php echo $field->label; ?>
	<?php endif; ?>
	<?php echo $field->input; ?>
	<?php endforeach; ?>
</fieldset>
</div>


	
<div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</div>
</form>