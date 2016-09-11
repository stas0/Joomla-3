<?php
	defined('_JEXEC') or die();
	
	class WichlaczControllerWichlaczBoiler extends JControllerForm{
		protected $text_prefix = 'COM_WICHLACZ_BOILER';
		
		public function batch($model = null){
			JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
			
			$model = $this->getModel('WichlaczBoiler', '', array());
			
			$this->setRedirect(JRoute::_('index.php?option=com_wichlacz&view=wichlacz' . $this->getRedirectToListAppend(), false));

			return parent::batch($model);
		}
		
		public function save(){
			parent::save();
			$db = JFactory::getDbo();
			$input = JFactory::getApplication()->input;
			
			
			
			$id = $input->get('id');
			
			if($id == 0){
				$id = $db->insertid();
			}
			
			//echo 'index.php?option=com_wichlacz&task=wichlaczboiler.edit&id=' . $input->get('id');
			
			$this->setRedirect('index.php?option=com_wichlacz&task=wichlaczboiler.edit&id=' . $id);
		}
		
		public function save_apply(){
			parent::save();
			
			$this->setRedirect(JRoute::_('index.php?option=com_wichlacz'));
		}
		
		public function cancel(){
			$this->setRedirect(JRoute::_('index.php?option=com_wichlacz'));
		}
	}
?>