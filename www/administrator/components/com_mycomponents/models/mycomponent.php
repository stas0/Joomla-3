<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;
 
/**
 * Mycomponent Model
 */
class MycomponentsModelMycomponent extends JModelAdmin
{
/**
	 * Returns возвращает ссылку на объект.
	 *
	 * @param	type	Тип таблицы для создания экземпляра
	 * @param	string	Префикс для имени класса таблицы.
	 * @param	array	Массив для модели.
	 * @return	JTable	Объекты базы данных
	 */
	 
	protected $text_prefix = 'COM_MYCOMPONENT';	 
	 
	 
//Возвращает ссылку на объект таблицы, при его создании.	 
	public function getTable($type = 'Mycomponent', $prefix = 'MycomponentsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Метод получения данных
	 *
	 * @param	array	$data		Данные для формы.
	 * @param	boolean	$loadData	Форма для того что бы загрузить свои данные(по умолчанию).
	 * @return	mixed	Вернуть данные в случае успешного завершения.
	 */
	public function getForm($data = array(), $loadData = true) 
	{
		// Получить форму
		$form = $this->loadForm('com_mycomponents.mycomponent', 'mycomponent', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
	
	/**
	 * Метод, чтобы получить данные, которые должны быть выведены в форме.
	 *
	 * @return	mixed	Данные по форме.
	 */
	protected function loadFormData() 
	{
		// Проверка сессий для ранее введёных данных формы
		$data = JFactory::getApplication()->getUserState('com_mycomponents.edit.mycomponent.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
}