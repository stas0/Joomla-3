<?php
	defined('_JEXEC') or die();
	
	class WichlaczViewWichlacz extends JViewLegacy{
		function display($tpl = null){
			$model = $this->getModel();
			$rows = $model->getWichlacz();
			$this->assignRef('row', $rows);
			
			parent::display();
		}
	}
?>