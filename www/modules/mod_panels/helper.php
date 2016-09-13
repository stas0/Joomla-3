<?php

defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_panels/api/panels.php';

class modPanelsHelper{
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

	public static function getAjax(){
		$input = JFactory::getApplication()->input;
		$panelID = $input->getInt('panelID');

		$panels = new Panels();
		$panelStylesList = $panels->getPanelStyles($panelID);

		return $panelStylesList;
	}
}

?>