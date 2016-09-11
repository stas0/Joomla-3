<?php
	defined('_JEXEC') or die();
	
	class ProductFilterModelProductFilter_list_filters extends JModelList{
		protected function getListQuery(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('*')
				->from($db->quoteName('#__productfilter_filters'));
			$query->order('ordering ASC');
			
			return $query;
		}
	}
?>