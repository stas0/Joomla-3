<?php
	defined('_JEXEC') or die();

	class ProductFilterTableProductFilter extends JTable{
		public function __construct(&$db){
			parent::__construct('#__productfilter_filters', 'id', $db);
		}
	}
?>