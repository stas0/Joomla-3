<?php
	defined('_JEXEC') or die();

	class PanelsTableAutomatic extends JTable{
		public function __construct(&$db){
			parent::__construct('#__panels_automatic', 'id', $db);
		}
	}
?>