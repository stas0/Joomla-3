<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';
$paramsData = (array)WichlaczHelper::getParams($module->module);

$doc = JFactory::getDocument();
$doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
$doc->addScript(JURI::base(true) . '/modules/mod_wichlacz/assets/js/default.js');
$doc->addScript(JURI::base(true) . '/modules/mod_wichlacz/assets/js/validation.js');
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_wichlacz/assets/css/my_style.css');
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_wichlacz/assets/css/bootstrap.min.css');
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_wichlacz/assets/css/bootstrap-theme.min.css');

$urlImages = JURI::base(true) . '/modules/mod_wichlacz/assets/images/';
$filterData = (array)json_decode($paramsData['accordionField']);
$filterResultPage = JURI::base(). 'index.php/' .WichlaczHelper::getUrlMenuItem($paramsData['menuItem']);
$input = JFactory::getApplication()->input;
$layout = ($paramsData["layoutType"]) ? $paramsData["layoutType"] : 'default';
$filterRecipientMail = $paramsData["mailRecipient"];
$filterSenderMail = $paramsData["mailSender"];

if($input->get('filter_result') == 1){
	$layout = 'filter_result';
	$boilersResult = WichlaczHelper::getFilteredBoilers($_GET['room_space'], $_GET['material_wall']);//, $_GET['thermal_insulation']);
}

require_once JModuleHelper::getLayoutPath($module->module, $layout);
?>