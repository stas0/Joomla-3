<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;
 
/**
 * Класс контрорллера
 */
class MycomponentsControllerMycomponent extends JControllerForm
{


//Метод переопределения, что бы проверить можно ли добавить новую запись.
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Установить модель Mycomponent
		$model = $this->getModel('Mycomponent', '', array());

		// Предустановленная переадресация
		$this->setRedirect(JRoute::_('index.php?option=com_mycomponents&view=mycomponents' . $this->getRedirectToListAppend(), false));

		return parent::batch($model);
	}
}