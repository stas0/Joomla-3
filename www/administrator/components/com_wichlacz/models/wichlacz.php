<?php
	class WichlaczModelWichlacz extends JModelList{
		public function __construct($config = array()){
			if(empty($config['filter_fields'])){
				$config['filter_fields'] = array(
					'state' => 'a.state',
					'name' 	=> 'a.name',
					'id' 	=> 'a.id',
				);
			}
			
			parent::__construct($config);
		}
		
		protected function getListQuery(){
			$db = $this->getDbo();
			$sql = $db->getQuery(true);
			
			$sql->select($this->getState('list.select', '*'));
			$sql->from($db->quoteName('#__wichlacz') . ' as a');
			
			$orderCol	= $this->state->get('list.ordering');
			$orderDirn	= $this->state->get('list.direction');
			if ($orderCol == 'a.ordering' || $orderCol == 'category_title') {
				$orderCol = 'a.name '.$orderDirn.', a.ordering';
			}
			$sql->order($db->escape($orderCol.' '.$orderDirn));
			
			return $sql;
		}
		
		protected function getStoreId($id = ''){
			$id .= ':' . $this->getState('filter.search');
			$id .= ':' . $this->getState('filter.state');
			
			return parent::getStoreId($id);
		}
		
		protected function populateState($ordering = null, $direction = null){
			$search = $this->getUserStateFromRequest($this->context . 'filter.search', 'filter_search');
			$this->setState('filter.search', $search);
			
			$published = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
			$this->setState('filter.state', $published);
			
			$params = JComponentHelper::getParams('com_wichlacz');
			$this->setState('params', $params);
			
			parent::populateState('a.name', 'asc');
		}
	}
?>