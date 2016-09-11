<?php
	defined('_JEXEC') or die();

	class PanelsViewPanel extends JViewLegacy{
		protected $form = null;

		public function display($tpl = null){
			$this->form = $this->get('Form');
			$this->item = $this->get('Item');

			if(count($erorrs = $this->get('Errors'))){
				JError::raiseError(500, implode('<br>', $erorrs));
				
				return false;
			}

			$this->addToolBar();

			parent::display($tpl);
		}

		private function addToolBar(){
			$input = JFactory::getApplication()->input;

			$isNew = ($this->item->id == 0);

			if($isNew){
				$title = 'New';
			}else{
				$title = 'Edit';
			}
			
			JToolBarHelper::title($title);
			JToolBarHelper::save('panel.save', 'Save');
			JToolBarHelper::cancel('panel.cancel');
		}
	}
?>