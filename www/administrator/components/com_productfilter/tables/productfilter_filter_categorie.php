<?php
	defined('_JEXEC') or die();

	class ProductFilterTableProductFilter_filter_categorie extends JTable{
		public function __construct(&$db){
			parent::__construct('#__productfilter_filter_categories', 'id', $db);
		}
	}
?>