<?php
	defined('_JEXEC') or die();

	class ProductFilterControllerProductFilter_list_product_categories extends JControllerAdmin{
		public function getModel($type = 'ProductFilter_product_categorie', $prefix = 'ProductFilterModel', $config = array('ignore_request')){
			$model = parent::getModel($type, $prefix, $config);

			return $model;
		}
	}
?>