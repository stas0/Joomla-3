<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php
// ������ � ������� �������. ���� ��� �� ���������� ���������� � ����� ��������, joomla ������ ������ ��������.
defined('_JEXEC') or die;
 
/**
 * ����� �������
 */
class MycomponentsTableMycomponent extends JTable
{
	/**
	 * �����������
	 *
	 * ��������� ������� ���� ������. ��� �� � ��� �� ����� ��������.
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__mycomponent', 'id', $db);
	}
	
	
//��������� ��� ���������� �����������	
public function publish($pks = null, $state = 1, $userId = 0)
	{
		$k = $this->_tbl_key;
		
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// ���� ��� ��������� ������ ���������� ���������, ���� ��������� ���� ����������.
		if (empty($pks))
		{
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// ������ �� �������, ������ �������������, ������� ���� ������ ��������������
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

		// �������� ��������� ����������
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
			// �������� ����� �������
			foreach($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// ���� JTable �������� ���������� � ������ ��������� ������, ������� ���� �����������, ���������� ���������.
		if (in_array($this->$k, $pks)) {
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}	
	
}