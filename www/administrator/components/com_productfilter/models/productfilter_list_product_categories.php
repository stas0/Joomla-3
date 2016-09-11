<?php
	defined('_JEXEC') or die();
	
	class ProductFilterModelProductFilter_list_product_categories extends JModelList{
		protected function getListQuery(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('*')
				->from($db->quoteName('#__productfilter_product_categories'));
			$query->order('ordering ASC');
			
			return $query;
		}
	}
?>