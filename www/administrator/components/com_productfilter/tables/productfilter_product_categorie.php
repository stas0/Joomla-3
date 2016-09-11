<?php
	defined('_JEXEC') or die();

	class ProductFilterTableProductFilter_product_categorie extends JTable{
		public function __construct(&$db){
			parent::__construct('#__productfilter_product_categories', 'id', $db);
		}
	}
?>