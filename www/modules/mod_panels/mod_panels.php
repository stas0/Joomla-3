<?php
defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';
require_once JPATH_ADMINISTRATOR . '/components/com_panels/api/panels.php';
require_once JPATH_ADMINISTRATOR . '/components/com_panels/api/currency.php';

$paramsData = (array)modPanelsHelper::getParams($module->module);
$panels = new Panels();

$doc = JFactory::getDocument();
$doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
$doc->addScript(JURI::base(true) . '/modules/mod_panels/assets/js/main.js');
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_panels/assets/css/main.css');
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_panels/assets/lib/bootstrap/bootstrap.css');

    //  Get panels data
$defaultPanel = $panels->getPanel($paramsData['defaultPanel']);
$panelList = $panels->getPanels();
$panelStylesList = $panels->getPanelStyles($paramsData['defaultPanel']);
$panelAutomatics = $panels->getAutomatics();
    //  Currency
$currency = new ExchangeRate();
$eur = $currency->getExchangeRateByChar3('EUR');
$eur = $eur->rate[0]/100;

require_once JModuleHelper::getLayoutPath($module->module, ($paramsData["layoutType"]) ? $paramsData["layoutType"] : 'default');
?>