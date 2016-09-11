<?php
	defined('_JEXEC') or die();

	class ProductFilterControllerProductfilter extends JControllerForm{
		public function cancel($key = NULL){
			$link = JRoute::_('index.php?option=com_productfilter&view=productfilter_list_filters', false);
			$this->setRedirect($link);
		}

		public function save($key = NULL, $urlVar = NULL){
			parent::save();

			$db = JFactory::getDbo();
			$input = JFactory::getApplication()->input;
			$id = $input->get('id');

			if($id == 0){
				$id = $db->insertid();
			}

			$link = JRoute::_('index.php?option=com_productfilter&view=productfilter&layout=edit&id='.$id, false);
			$this->setRedirect($link);
		}
	}
?>