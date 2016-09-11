<?php
	defined('_JEXEC') or die();

	class ProductFilterModelProductFilter_list extends JModelList{
		protected function getListQuery(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('*')
				->from($db->quoteName('#__productfilter_products'));
			$query->order('ordering ASC');

			return $query;
		}
	}
?>