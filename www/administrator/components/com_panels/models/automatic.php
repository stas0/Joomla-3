<?php
	defined('_JEXEC') or die();

	class PanelsModelAutomatic extends JModelAdmin{
		public function getTable($type = 'Automatic', $prefix = 'PanelsTable', $config = array()){
			return JTable::getInstance($type, $prefix, $config);
		}

		public function getForm($data = array(), $loadData = true){
			$form = $this->loadForm(
				'com_panels.automatic',
				'automatic',
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
				'com_panels.edit.automatic.data',
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