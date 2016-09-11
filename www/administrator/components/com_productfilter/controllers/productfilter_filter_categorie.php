<?php
	defined('_JEXEC') or die();

	class ProductFilterControllerProductfilter_filter_categorie extends JControllerForm{
		public function cancel(){
			$link = JRoute::_('index.php?option=com_productfilter&view=productfilter_list_filter_categories', false);
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

			$link = JRoute::_('index.php?option=com_productfilter&view=productfilter_filter_categorie&layout=edit&id='.$id, false);
			$this->setRedirect($link);
		}
	}
?>