<?php
	defined('_JEXEC') or die();

	class PanelsViewPanel_list extends JViewLegacy{
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

			Sidebar::fillSidebar('panels');

			JToolBarHelper::title('Panel list');
			JToolBarHelper::addNew('panel.add');
			JToolBarHelper::editList('panel.edit');
			JToolBarHelper::deleteList('', 'panel_list.delete');
		}
	}
?>