<?php
	defined('_JEXEC') or die();

	class PanelsControllerPanel extends JControllerForm{
		public function cancel(){
			$link = JRoute::_('index.php?option=com_panels&view=panel_list', false);
			$this->setRedirect($link);
		}

		public function save(){
			parent::save();

			$db = JFactory::getDbo();
			$input = JFactory::getApplication()->input;
			$id = $input->get('id');

			if($id == 0){
				$id = $db->insertid();
			}

			$link = JRoute::_('index.php?option=com_panels&view=panel&layout=edit&id='.$id, false);
			$this->setRedirect($link);
		}
	}
?>