<?php
	defined('_JEXEC') or die();
	
	$controller = JControllerLegacy::getInstance('Wichlacz');
	$controller->execute(JFactory::getApplication()->input->task('task'));
	$controller->redirect();
?>