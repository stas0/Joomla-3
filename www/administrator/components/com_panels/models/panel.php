<?php
	defined('_JEXEC') or die();

	class PanelsModelPanel extends JModelAdmin{
		public function getTable($type = 'Panel', $prefix = 'PanelsTable', $config = array()){
			return JTable::getInstance($type, $prefix, $config);
		}

		public function getForm($data = array(), $loadData = true){
			$form = $this->loadForm(
				'com_panels.panel',
				'panel',
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
				'com_panels.edit.panel.data',
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