<?php

defined('_JEXEC') or die;

class Helper{
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
}

?>