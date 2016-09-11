<?php
	defined('_JEXEC') or die();
	
	$controller = JControllerLegacy::getInstance('Wichlacz');
	$controller->execute(JFactory::getApplication()->input->get('task'));
	$controller->redirect();
?>