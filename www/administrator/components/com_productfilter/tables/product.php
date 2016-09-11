<?php
	defined('_JEXEC') or die();

	class ProductFilterTableProduct extends JTable{
		public function __construct(&$db){
			parent::__construct('#__productfilter_products', 'id', $db);
		}
	}
?>