<?php
	defined('_JEXEC') or die();
	
	class WichlaczControllerWichlacz extends JControllerAdmin{
		public function getModel($name = 'WichlaczBoiler', $prefix = 'WichlaczModel', $config = array('ignore_request' => true)){
			$model = parent::getModel($name, $prefix, $config);
			
			return $model;
		}
		
		public function saveOrderAjax(){
			$input = JFactory::getApplication()->input;
			$pks = $input->post->get('cid', array(), 'array');
			$order = $input->post->get('order', array(), 'array');
			
			JArrayHelper::toInteger($pks);
			JArrayHelper::toInteger($order);
			
			// Получаем модель
			$model = $this->getModel();
			
			// Сохранить порядок
			$return = $model->saveorder($pks, $order);
			
			if ($return){
				echo "1";
			}
			
			// Закрыть приложение
			JFactory::getApplication()->close();
		}
	}
?>