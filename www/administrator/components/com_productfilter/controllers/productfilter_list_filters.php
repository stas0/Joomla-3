<?php
	defined('_JEXEC') or die();

	class ProductFilterControllerProductFilter_list_filters extends JControllerAdmin{
		public function getModel($type = 'ProductFilter', $prefix = 'ProductFilterModel', $config = array('ignore_request')){
			$model = parent::getModel($type, $prefix, $config);

			return $model;
		}
	}
?>