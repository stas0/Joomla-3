<?php
	defined('_JEXEC') or die();

	class ProductFilterModelProduct extends JModelAdmin{
		public function getTable($type = 'Product', $prefix = 'ProductFilterTable', $config = array()){
			return JTable::getInstance($type, $prefix, $config);
		}

		public function getForm($data = array(), $loadData = true){
			$form = $this->loadForm(
				'com_productfilter.product',
				'product',
				array(
					'control' => 'jform',
					'load_data' => $loadData
				)
			);
			if (empty($form))
	 
			{
				return false;
			}
	 		
			return $form;
		}

		public function loadFormData(){
			$data = JFactory::getApplication()->getUserState(
				'com_productfilter.edit.product.data',
				array()
			);
	 
			if (empty($data))
			{
				$data = $this->getItem();
			}
	 
			return $data;
		}

		public function save($data){
			$filters = $data['product_filter'];
			$data['product_filter'] = json_encode($data['product_filter']);

			$db = JFactory::getDbo();

			$query = 'delete from #__productfilter_filter where product_id = ' . $data['id'];
			$db->setQuery($query);
			$db->execute();

			foreach ($filters as $filter) {
				$query = 'insert into #__productfilter_filter (filter_id, product_id) values (';
				$query .= $filter . ',';
				$query .= $data['id'];
				$query .= ')';
				$db->setQuery($query);
				$db->execute();
			}

			parent::save($data);

			return true;
		}
	}
?>