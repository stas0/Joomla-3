<?php
	defined('_JEXEC') or die();

	class Sidebar{
		public static function fillSidebar($view = ''){
			JHtmlSidebar::addEntry(
				'Products', 'index.php?option=com_productfilter&view=productfilter_list',
				($view == 'productfilter_list')
			);
			JHtmlSidebar::addEntry(
				'Product categories', 'index.php?option=com_productfilter&view=productfilter_list_product_categories',
				($view == 'productfilter_list_product_categories')
			);
			JHtmlSidebar::addEntry(
				'Filters', 'index.php?option=com_productfilter&view=productfilter_list_filters',
				($view == 'productfilter_list_filters')
			);
			JHtmlSidebar::addEntry(
				'Filter categories', 'index.php?option=com_productfilter&view=productfilter_list_filter_categories',
				($view == 'productfilter_list_filter_categories')
			);
		}
	}
?>