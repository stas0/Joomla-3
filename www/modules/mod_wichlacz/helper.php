<?php

defined('_JEXEC') or die;

class WichlaczHelper{
	public static function getParams($module){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('params')));
		$query->from($db->quoteName('#__modules'));
		$query->where($db->quoteName('module') . ' = ' . $db->quote($module));
		$db->setQuery($query);
		$result = $db->loadResult();
		
		return json_decode($result);
	}
	
		//	Получить url пункта меню
	public static function getUrlMenuItem($id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('path, link');
		$query->from($db->quoteName('#__menu'));
		$query->where($db->quoteName('id') . ' = ' . $db->quote($id));
		$db->setQuery($query);
		$result = $db->loadResult();
		
		return $result;
	}
	
		//	Получить отфильтрованные котрлы
	public static function getFilteredBoilers($roomSpace, $materialWall){//, $thermalInsulation){
		$needPower = $roomSpace + $roomSpace*$materialWall/100;
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('w.*, m.path');
		$query->from($db->quoteName('#__wichlacz') . ' as w');
		$query->join('left', $db->quoteName('#__menu') . ' as m on(w.article_id = m.id)');
		$query->where('w.range_heating_max >= ' . $needPower . ' order by w.range_heating_max asc limit 0, 3');
		//echo $query;
		$db->setQuery($query);
		$result = $db->loadAssocList();
		
		return $result;
	}
}

?>