<?php
	defined('_JEXEC') or die();
	
	class PanelsModelAutomatic_list extends JModelList{
		protected function getListQuery(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('*')
				->from($db->quoteName('#__panels_automatic'));
			$query->order('ordering ASC');
			
			return $query;
		}
	}
?>