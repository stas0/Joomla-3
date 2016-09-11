<?php
	defined('_JEXEC') or die();

	$controller = JControllerLegacy::getInstance('productfilter');
	$controller->execute(JFactory::getApplication()->input->get('task'));
	$controller->redirect();
?>