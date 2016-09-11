<?php
	defined('_JEXEC') or die();

	class ProductFilterViewProductFilter_product_categorie extends JViewLegacy{
		protected $form = null;

		public function display($tpl = null){
			$this->form = $this->get('Form');
			$this->item = $this->get('Item');

			if(count($erorrs = $this->get('Errors'))){
				JError::raiseError(500, implode('<br>', $errors));
				
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
			JToolBarHelper::save('productfilter_product_categorie.save', 'Save');
			JToolBarHelper::cancel('productfilter_product_categorie.cancel');
		}
	}
?>