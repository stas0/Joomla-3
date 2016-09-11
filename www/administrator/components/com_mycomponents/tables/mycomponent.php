<!--
Price leaf компонент онлайн калькулятор.
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;
 
/**
 * Класс таблицы
 */
class MycomponentsTableMycomponent extends JTable
{
	/**
	 * Конструктор
	 *
	 * Параметры объекта базы данных. Это то с чем мы будем работать.
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__mycomponent', 'id', $db);
	}
	
	
//Параметры для управления публикацией	
public function publish($pks = null, $state = 1, $userId = 0)
	{
		$k = $this->_tbl_key;
		
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// Если нет первичных ключей установить проверить, если экземпляр ключ установлен.
		if (empty($pks))
		{
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// Ничего не выбрано, нечего устанавливать, вернуть ложь нечего опубликовывать
			else {
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		$where = $k.'='.implode(' OR '.$k.'=', $pks);

		if (!property_exists($this, 'checked_out') || !property_exists($this, 'checked_out_time')) {
			$checkin = '';
		}
		else {
			$checkin = ' AND (checked_out = 0 OR checked_out = '.(int) $userId.')';
		}

		// Обновить состояние публикации
		$this->_db->setQuery(
			'UPDATE '.$this->_db->quoteName($this->_tbl) .
			' SET '.$this->_db->quoteName('state').' = '.(int) $state .
			' WHERE ('.$where.')' .
			$checkin
		);

		try
		{
			$this->_db->execute();
		}
		catch (RuntimeException $e)
		{
			$this->setError($e->getMessage());
			return false;
		}

		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Проверка строк чекбокс
			foreach($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// Если JTable значение экземпляра в списке первичных ключей, которые были установлены, установить экземпляр.
		if (in_array($this->$k, $pks)) {
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}	
	
}