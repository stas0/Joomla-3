<?php
	defined('_JEXEC') or die();

	class ProductFilterViewProductFilter extends JViewLegacy{
		public function display($tpl = null){
			$document = JFactory::getDocument();
			$document->addScript('/components/com_productfilter/assets/js/main.js');
			$document->addStyleSheet( '/components/com_productfilter/assets/css/main.css');

			$app = JFactory::getApplication();
			$menu = $app->getMenu();
			$this->menu = $menu;

			$this->filterCategories = (array)$this->get('ListFilters');
			$this->products = (array)$this->get('PorductList');
			$this->pagination = $this->get('PorductPagination');
			

			parent::display($tpl);
		}
	}
?>