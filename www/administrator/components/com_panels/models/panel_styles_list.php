<?php
	defined('_JEXEC') or die();
	
	class PanelsModelPanel_styles_list extends JModelList{
		protected function getListQuery(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('*')
				->from($db->quoteName('#__panel_styles'));
			$query->order('ordering ASC');
			
			return $query;
		}
	}
?>