<?php
	defined('_JEXEC') or die();

	$controller = JControllerLegacy::getInstance('panels');
	$controller->execute(JFactory::getApplication()->input->get('task'));
	$controller->redirect();
?>