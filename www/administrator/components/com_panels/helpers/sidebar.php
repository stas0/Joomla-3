<?php
	defined('_JEXEC') or die();

	class Sidebar{
		public static function fillSidebar($view = ''){
			JHtmlSidebar::addEntry(
				'Panel', 'index.php?option=com_panels&view=panel_list',
				($view == 'panels')
			);
			JHtmlSidebar::addEntry(
				'Panel styles', 'index.php?option=com_panels&view=panel_styles_list',
				($view == 'panel_styles')
			);
		}
	}
?>