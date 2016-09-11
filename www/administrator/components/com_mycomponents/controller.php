<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;
 
/**
 * Главный контроллер компонента mycomponent. Данный контроллер вызовет из папки controllers файл mycomponents он то и вызовет всё остальное модель вид.
 */
class MycomponentsController extends JControllerLegacy
{

//Возвращение способа отображения, кешируемый или нет
	public function display($cachable = false, $urlparams = false)
	{
	
//Добавление файла помощи и пунктов навигации, /helpers/priceleafs.php
//что бы пользователь мог перемещаться по страницам компонента, всё меню будет выводиться 
//в файле helpers.
		require_once JPATH_COMPONENT.'/helpers/mycomponents.php';

		$view   = $this->input->get('view', 'mycomponents');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// Проверка формы редактирования
		if ($view == 'mycomponent' && $layout == 'edit' && !$this->checkEditId('com_mycomponents.edit.mycomponent', $id)) {
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_mycomponents&view=mycomponents', false));

			return false;
		}
// Отображаем представление
		parent::display();
//Вернуть значение
		return $this;
	}
}