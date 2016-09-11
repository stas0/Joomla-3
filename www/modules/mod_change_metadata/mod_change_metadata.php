<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';
$paramsData = (array)Helper::getParams($module->module);

$doc = JFactory::getDocument();
$doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
$doc->addScript(JURI::base(true) . '/modules/mod_/assets/js/default.js');
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_/assets/css/default.css.php?id=' . $module->id);

require_once JModuleHelper::getLayoutPath($module->module, ($paramsData["layoutType"]) ? $paramsData["layoutType"] : 'default');
?>