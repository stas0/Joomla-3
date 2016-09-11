<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';
require_once dirname(__FILE__) . '/models/productfilter.php';
require_once dirname(__FILE__) . '/tables/productfilterdata.php';
$paramsData = (array)HelperProductfilter::getParams($module->module);

$doc = JFactory::getDocument();
//$doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
$doc->addScript(JURI::base(true) . '/modules/mod_productfilter/assets/js/main.js');
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_productfilter/assets/css/main.css');

$productfilter_table = new ProductFilterTableProductFilterData();
$productfilter_model = new ProductFilterModelProductFilter();

$app = JFactory::getApplication();
$menu = $app->getMenu();

$productfilter_model->setCategorieId($params->get('product_categorie'));
$products = (array)$productfilter_model->getPorductList();
$filterCategories = (array)$productfilter_model->getListFilters();
$relatedFilters = $productfilter_model->getRelatedFilters();
$pagination = $productfilter_model->getPorductPagination();
$totalProductsActiveFilters = $productfilter_model->getTotalProductsActiveFilters();

require_once JModuleHelper::getLayoutPath($module->module, ($paramsData["layoutType"]) ? $paramsData["layoutType"] : 'default');
?>