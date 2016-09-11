<?php
	defined('_JEXEC') or die();

	class ProductFilterModelProductFilter_filter_categorie extends JModelAdmin{
		public function getTable($type = 'ProductFilter_filter_categorie', $prefix = 'ProductFilterTable', $config = array()){
			return JTable::getInstance($type, $prefix, $config);
		}

		public function getForm($data = array(), $loadData = true){
			$form = $this->loadForm(
				'com_productfilter.productfilter_filter_categorie',
				'productfilter_filter_categorie',
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
				'com_productfilter.edit.productfilter_filter_categorie.data',
				array()
			);
	 
			if (empty($data))
			{
				$data = $this->getItem();
			}
	 
			return $data;
		}
	}
?>