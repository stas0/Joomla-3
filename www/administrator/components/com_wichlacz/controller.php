<?php
	defined('_JEXEC') or die();
	
	class WichlaczController extends JControllerLegacy{
			//	Отображение
		public function display($cachable = false, $urlparams = false){
			require_once JPATH_COMPONENT . '/helpers/wichlacz.php';
			
			$view = $this->input->get('view');
			$layout = $this->input->get('layout');
			$id = $this->input->get('id');
			
			if($view == 'wichlaczboiler' && $layout == 'edit' && !$this->checkEditId('com_wichlacz.edit.wichlaczboiler', $id)){
				echo 'Hello';
				$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				$this->redirect('index.php?option=com_wichlacz&view=wichlacz', false);
				
				return false;
			}
			
			parent::display();
			
			return $this;
		}
	}
?>