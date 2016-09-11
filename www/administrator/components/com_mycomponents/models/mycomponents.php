<!--
Price leaf ��������� ������ �����������.
����������� ���� http://joomla-umnik.ru
-->

<?php
/*������ ����� �� ���� ������� � ����, �������������� ������ �������� �� ������ � ������������ ������,
*/

// ������ � ������� �������. ���� ��� �� ���������� ���������� � ����� ��������, joomla ������ ������ ��������.
defined('_JEXEC') or die;

/**
 * ����� ������
 */
class MycomponentsModelMycomponents extends JModelList
{
//�����������
//�������������� ������������� ������ ���������� ������������.
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
	
//����� ��� ��������������� ���������� model state
//����������. ����� GetState � ���� ������ �������� � ��������.
	
	
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');

		
		// ��������� ��������� �������.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$published = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $published);
		
		// �������� ����������
		$params = JComponentHelper::getParams('com_mycomponents');
		$this->setState('params', $params);

		// ������ ���������� � ���������
		parent::populateState('a.name', 'asc');
	}
	
	
//������ ������� joomla � ������� ��� �������� ����� � ���������� �������������� � ���������������� ������
		protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');
		return parent::getStoreId($id);
	}	
	

	/**
	 * ����� ��� �������� �������� SQL ��� �������� ������ ������.
	 *
	 * ����������� ����� ������� �� ��.
	 */
	 
	protected function getListQuery()
	{
		// �������� ����� ������ �������.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user	= JFactory::getUser();

		// �������� ������ ���� �� �������
		$query->select(
		$this->getState('list.select','*'));
		
		$query->from($db->quoteName('#__mycomponent').' AS a');
				
//������� ������				
		$search = $this->getState('filter.search');
		
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.name LIKE '.$search.')');
			}
		}		
				
				
// ������ �� ��������� ����������
		$published = $this->getState('filter.state');
		
		if (is_numeric($published)) {
			$query->where('a.state = '.(int) $published);
		} elseif ($published === '') {
			
			$query->where('(a.state IN (0, 1))');
		}
				
		
		// ����������
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