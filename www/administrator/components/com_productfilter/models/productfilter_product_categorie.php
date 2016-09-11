<?php
	defined('_JEXEC') or die();

	class ProductFilterModelProductFilter_product_categorie extends JModelAdmin{
		private $toJsonFields = array('filter_categories');

		public function getTable($type = 'ProductFilter_product_categorie', $prefix = 'ProductFilterTable', $config = array()){
			return JTable::getInstance($type, $prefix, $config);
		}

		public function getForm($data = array(), $loadData = true){
			$form = $this->loadForm(
				'com_productfilter.productfilter_product_categorie',
				'productfilter_product_categorie',
				array(
					'control' => 'jform',
					'load_data' => $loadData
				)
			);

			if (empty($form)){
				return false;
			}
	 		
			return $form;
		}

		public function loadFormData(){
			$data = JFactory::getApplication()->getUserState(
				'com_productfilter.edit.productfilter_product_categorie.data',
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