<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php

// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;

/**
 * Класс контроллера
 */
class MycomponentsControllerMycomponents extends JControllerAdmin
{
	/**
	 * Прокси для getModel
	 */
	public function getModel($name = 'Mycomponent', $prefix = 'MycomponentsModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
	
//Метод AJAX что бы сохранить представление записи.	
		public function saveOrderAjax()
	{

		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');

		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Получаем модель
		$model = $this->getModel();

		// Сохранить порядок
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Закрыть приложение
		JFactory::getApplication()->close();
	}
	
}
