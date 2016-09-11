<?php
	defined('_JEXEC') or die();

	class ProductFilterViewProductFilter_list extends JViewLegacy{
		public function display($tpl = null){
			$this->items = $this->get('Items');
			$this->pagination = $this->get('Pagination');

			if(count($errors = $this->get('Errors'))){
				JError::raiseError(500, implode('<br>', $errors));

				return false;
			}

			$this->addToolBar();
			$this->sidebar = JHtmlSidebar::render();

			parent::display($tpl);
		}

		protected function addToolBar(){
			require_once JPATH_COMPONENT . '/helpers/sidebar.php';

			Sidebar::fillSidebar('productfilter_list');

			JToolBarHelper::title('Product filter toolbar');
			JToolBarHelper::addNew('product.add');
			JToolBarHelper::editList('product.edit');
			JToolBarHelper::deleteList('', 'productfilter_list.delete');
		}
	}
?>