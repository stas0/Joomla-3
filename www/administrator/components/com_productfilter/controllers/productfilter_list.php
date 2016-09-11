<?php
	defined('_JEXEC') or dir();

	class ProductFilterControllerProductFilter_list extends JControllerAdmin{
		public function getModel($name = 'Product', $prefix = 'ProductFilterModel', $config = array('ignore_request' => true)){
			$model = parent::getModel($name, $prefix, $config);

			return $model;
		}
	}
?>