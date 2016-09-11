<?php
	class WichlaczModelWichlaczBoiler extends JModelAdmin{
		protected $text_prefix = 'COM_WICHLACZ';
		
		public function getTable($type = 'WichlaczBoiler', $prefix = 'WichlaczTable', $config = array()){
			return JTable::getInstance($type, $prefix, $config);
		}
		
		public function getForm($data = array(), $loadData = true) {
			// Получить форму
			$form = $this->loadForm('com_wichlacz.wichlaczboiler', 'wichlaczboiler', array('control' => 'jform', 'load_data' => $loadData));
			
			if (empty($form)){
				return false;
			}
			
			return $form;
		}
		
		protected function loadFormData(){
			// Проверка сессий для ранее введёных данных формы
			$data = JFactory::getApplication()->getUserState('com_wichlacz.edit.wichlaczboiler.data', array());
			
			if (empty($data)){
				$data = $this->getItem();
			}
			
			return $data;
		}
	}
?>