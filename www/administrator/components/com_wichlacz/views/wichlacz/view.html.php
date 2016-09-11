<?php
	defined('_JEXEC') or die();
		  
	class wichlaczViewwichlacz extends JViewLegacy{
		protected $items;
		protected $pagination;
		protected $state;
		
		public function display($tpl = null){
			$this->items         = $this->get('Items');
			$this->pagination    = $this->get('Pagination');
			$this->state         = $this->get('State');
			
			if (count($errors = $this->get('Errors'))){
				JError::raiseError(500, implode("\n", $errors));
	
				return false;
			}
			
			WichlaczHelper::addSubmenu('boilers');
			
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
			parent::display($tpl);
		}
		
		protected function addToolbar(){
			$user  = JFactory::getUser();
			$canDo = JHelperContent::getActions('com_wichlacz', 'category', $this->state->get('filter.category_id'));
			
			JToolbarHelper::title(JText::_('COM_WICHLACZ_MANNAGER_BOILERS'), 'Котлы');
			
			//if(count($user->getAuthorisedCategories('com_wichlacz', 'core.create')) > 0){
				JToolbarHelper::addNew('wichlaczboiler.add');
			//}
			
			if($canDo->get('core.edit')){
				JToolbarHelper::editList('wichlaczboiler.edit');
			}
			
			if($canDo->get('core.edit.state')){
				
			}
			
			JToolbarHelper::publish('wichlacz.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('wichlacz.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolbarHelper::deleteList('', 'wichlacz.delete');
		}
		
		protected function getSortFields(){
			return array(
				'a.state' => JText::_('JSTATUS'),
				'a.name' => JText::_('JGLOBAL_TITLE'),
				'a.id' => JText::_('JGRID_HEADING_ID')
			);
		}
	}
?>