<?php
	defined('_JEXEC') or die();

	class ProductFilterViewProductFilter_list_filter_categories extends JViewLegacy{
		public function display($tpl = null){
			$this->items = $this->get('Items');
			$this->pagination = $this->get('Pagination');

			if(count($errors = $this->getErrors)){
				JError::raiseError(500, implode('<br>', $errors));

				return false;
			}

			$this->addToolBar();
			$this->sidebar = JHtmlSidebar::render();

			parent::display($tpl);
		}

		private function addToolBar(){
			require_once JPATH_COMPONENT . '/helpers/sidebar.php';

			Sidebar::fillSidebar('productfilter_list_filter_categories');

			JToolBarHelper::title('Product filter filters list');
			JToolBarHelper::addNew('productfilter_filter_categorie.add');
			JToolBarHelper::editList('productfilter_filter_categorie.edit');
			JToolBarHelper::deleteList('', 'productfilter_list_filter_categories.delete');
		}
	}
?>