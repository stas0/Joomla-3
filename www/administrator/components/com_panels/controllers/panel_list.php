<?php
	defined('_JEXEC') or die();

	class PanelsControllerPanel_list extends JControllerAdmin{
		public function getModel($type = 'Panel', $prefix = 'PanelsModel', $config = array('ignore_request')){
			$model = parent::getModel($type, $prefix, $config);

			return $model;
		}
	}
?>