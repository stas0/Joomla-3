<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;
 
/**
 * Класс вида
 */
class MycomponentsViewMycomponent extends JViewLegacy
{

	protected $state;

	protected $item;

	protected $form;

	/**
	 * Отображение данных
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		// Сообщение об ошибке.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

//Создание новых данных
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo		= MycomponentsHelper::getActions($this->item->catid, 0);

		JToolbarHelper::title(JText::_('COM_MYCOMPONENT_RAZDEL_NEW'), 'priceleafs.png');

		// Вывод кнопок навигации
		if (!$checkedOut && ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_mycomponents', 'core.create')))))
		{
			JToolbarHelper::apply('mycomponent.apply');
			JToolbarHelper::save('mycomponent.save');
		}

		if (empty($this->item->id)) {
			JToolbarHelper::cancel('mycomponent.cancel');
		}
		else {
			JToolbarHelper::cancel('mycomponent.cancel', 'JTOOLBAR_CLOSE');
		}
//Кнопка помощи, в данном случае я указал страницу куда ссылаться. При нажатии кнопки появится модальное окно с моим сайтом.
		JToolbarHelper::divider();
		$help_url  = 'http://joomla-umnik.ru/manual-po-ispolzovaniyu-komponenta-priceleaf-pro-c#sections1';
		JToolbarHelper::help('COM_PRICELEAF_VIEW_TYPE1', false, $help_url );
	}
}
