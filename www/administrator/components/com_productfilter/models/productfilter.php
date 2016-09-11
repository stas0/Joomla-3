<?php
	defined('_JEXEC') or die();

	class ProductFilterModelProductFilter extends JModelAdmin{
		private $toJsonFields = array('related_filters');

		public function getTable($type = 'ProductFilter', $prefix = 'ProductFilterTable', $config = array()){
			return JTable::getInstance($type, $prefix, $config);
		}

		public function getForm($data = array(), $loadData = true){
			$form = $this->loadForm(
				'com_productfilter.productfilter',
				'productfilter',
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
				'com_productfilter.edit.productfilter.data',
				array()
			);
	 
			if (empty($data))
			{
				$data = $this->getItem();
			}
	 
			return $data;
		}

		public function save($data){
			require_once __DIR__ . '/../helpers/fields.php';
			HelperFields::toJson($data, $this->toJsonFields);

			parent::save($data);

			return true;
		}
	}
?>