<?php
	defined('_JEXEC') or die();

	class PanelsControllerAutomatic_list extends JControllerAdmin{
		public function getModel($type = 'Automatic', $prefix = 'AutomaticModel', $config = array('ignore_request')){
			$model = parent::getModel($type, $prefix, $config);

			return $model;
		}
	}
?>