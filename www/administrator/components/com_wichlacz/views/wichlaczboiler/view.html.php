<?php
	defined('_JEXEC') or die();
	
	class WichlaczViewWichlaczBoiler extends JViewLegacy{
		protected $state;
		protected $item;
		protected $form;
		
		public function display($tpl = null){
			$this->state = $this->get('State');
			$this->item = $this->get('item');
			$this->form = $this->get('form');
			
			if(count($errors = $this->get('Errors')) > 0){
				JError::raiseError(500, implode('\n', $errors));
				
				return false;
			}
			
			$this->addToolbar();
			
			parent::display($tpl);
		}
		
		public function addToolbar(){
			$user		= JFactory::getUser();
			$userId		= $user->get('id');
			$isNew		= ($this->item->id == 0);
			$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
			$canDo		= WichlaczHelper::getActions($this->item->catid, 0);
	
			JToolbarHelper::title(JText::_('COM_WICHLACZ_MANNAGER_BOILERS'));
	
			// Вывод кнопок навигации
			if (!$checkedOut && ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_wichlacz', 'core.create')))))
			{
				JToolbarHelper::apply('wichlaczboiler.save');
				JToolbarHelper::save('wichlaczboiler.save_apply');
			}
	
			if (empty($this->item->id)) {
				JToolbarHelper::cancel('wichlaczboiler.cancel');
			}
			else {
				JToolbarHelper::cancel('wichlaczboiler.cancel', 'JTOOLBAR_CLOSE');
			}
		}
	}
?>