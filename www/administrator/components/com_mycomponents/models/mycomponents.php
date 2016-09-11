<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
/*Модель через неё идут запросы в базу, соответственно модель работает на запись и вытаскивание данных,
*/

// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;

/**
 * Класс модели
 */
class MycomponentsModelMycomponents extends JModelList
{
//Конструктор
//Дополнительный ассоциативный массив параметров конфигурации.
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
				'adres', 'a.adres',				
				'ordering', 'a.ordering',
				'state', 'a.state'
			);
		}

		parent::__construct($config);
	}
	
//Метод для автоматического заполнения model state
//Примечание. Вызов GetState в этом методе приведет к рекурсии.
	
	
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');

		
		// Загрузите состояние фильтра.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$published = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $published);
		
		// Загрузка параметров
		$params = JComponentHelper::getParams('com_mycomponents');
		$this->setState('params', $params);

		// Список информации о состоянии
		parent::populateState('a.name', 'asc');
	}
	
	
//Родные фильтры joomla с помощью них создаётся поиск и фильтрация опубликованных и неопубликованных данных
		protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');
		return parent::getStoreId($id);
	}	
	

	/**
	 * Метод для создания запросов SQL для загрузки данных списка.
	 *
	 * Возвращение строк запроса из бд.
	 */
	 
	protected function getListQuery()
	{
		// Создайте новый объект запроса.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user	= JFactory::getUser();

		// Выбираем нужные поля из таблицы
		$query->select(
		$this->getState('list.select','*'));
		
		$query->from($db->quoteName('#__mycomponent').' AS a');
				
//Фильтры поиска				
		$search = $this->getState('filter.search');
		
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.name LIKE '.$search.')');
			}
		}		
				
				
// Фильтр по состоянию публикации
		$published = $this->getState('filter.state');
		
		if (is_numeric($published)) {
			$query->where('a.state = '.(int) $published);
		} elseif ($published === '') {
			
			$query->where('(a.state IN (0, 1))');
		}
				
		
		// сортировка
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		if ($orderCol == 'a.ordering' || $orderCol == 'category_title') {
			$orderCol = 'a.name '.$orderDirn.', a.ordering';
		}
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
		//return 'select * from #__wichlacz';
		return $query;
	}
		
		
		


}